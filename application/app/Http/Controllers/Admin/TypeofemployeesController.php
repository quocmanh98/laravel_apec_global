<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\typeofemployees;
use Illuminate\Http\Request;

class TypeofemployeesController extends Controller
{

    public function list(Request $request){

        $this->authorize('typeofemployees.index');

        $status = $request->input('status');
        $keyword = $request->input('keyword');
        $list_act = [
            'delete' => 'Xoá tạm thời'
        ];

        if($status == 'trash'){
            $list_act = [
                'restore' => 'Khôi phục',
                'forceDelete' => 'Xoá vĩnh viễn'
            ];
            $typeofemployees =   typeofemployees::onlyTrashed()->paginate(10);
        }else{
            $keyword = "";
            if($request->keyword){
                $keyword = $request->keyword;
            }
            $typeofemployees =    typeofemployees::where('typeofemployeess_name','LIKE',"%{$keyword}%")
            ->orWhere('typeofemployeess_code','LIKE',"%{$keyword}%")
            ->paginate(10);
        }

        // $typeofemployees = $this->typeofemployeess->aLL();
        $count_typeofemployees_active =   typeofemployees::count();
        $count_typeofemployees_trash =   typeofemployees::onlyTrashed()->count();

        $count = [ $count_typeofemployees_active ,  $count_typeofemployees_trash];
        return view('admin.typeofemployees.index',compact('typeofemployees','count','list_act'));

    }

    public function create(){
        $this->authorize('typeofemployees.add');
        return view('admin.typeofemployees.create');
    }

    public function store(Request $request){

        $request->validate(

            [
                'typeofemployeess_code' => 'required|max:255',
                'typeofemployeess_name' => 'required|string|max:255',
                'status' => 'required'
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute có độ dài tối đa :max ký tự',
                'min' => ':attribute có độ dài tối đa :min ký tự',
            ],
            [
                'typeofemployeess_code' => 'Mã loại nhân viên',
                'typeofemployeess_name' => 'Tên loại nhân viên',
                'status' => 'Trạng thái'
            ]

        );
          typeofemployees::create(
            [
                'typeofemployeess_code' => $request->typeofemployeess_code,
                'typeofemployeess_name' => $request->typeofemployeess_name,
                'typeofemployeess_status' => $request->status
            ]
            );

            return redirect('admin/typeofemployees')->with('status','Đã thêm dữ liệu loại nhân viên thành công');

    }

    public function delete($id){

        $this->authorize('typeofemployees.delete');
        $typeofemployees = typeofemployees::findOrFail($id);
        $typeofemployees->delete();
        return redirect('admin/typeofemployees')->with('status','Đã xoá tạm thời dữ liệu loại nhân viên thành công');

    }


    public function edit($id){

        $this->authorize('typeofemployees.edit');
        $typeofemployees = typeofemployees::findOrFail($id);
        return view('admin.typeofemployees.edit',compact('typeofemployees'));

    }

    public function update(Request $request,$id){
        $request->validate(

            [
                'typeofemployeess_name' => 'required|string|max:255',
                'status' => 'required'
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute có độ dài tối đa :max ký tự',
                'min' => ':attribute có độ dài tối đa :min ký tự',
            ],
            [
                'typeofemployeess_name' => 'Tên loại nhân viên',
                'status' => 'Trạng thái'
            ]

        );

        typeofemployees::findOrFail($id)->update(
            [
                'typeofemployeess_name' => $request->typeofemployeess_name,
                'typeofemployeess_status' => $request->status
            ]
            );

            return redirect('admin/typeofemployees')->with('status','Đã sửa dữ liệu loại nhân viên thành công');

    }


    public function action(Request $request){
        $this->authorize('typeofemployees.index');
        // dd($request->all());

        $list_check = $request->input('list_check');

        if( $list_check ){

            if(!(empty( $list_check))){

                $act = $request->input('act');

                if($act=='delete'){
                    typeofemployees::destroy($list_check);
                    return redirect('admin/typeofemployees')->with('status','Đã xoá tạm thời dữ liệu loại nhân viên thành công');
                }

                if($act == 'restore'){

                    typeofemployees::withTrashed()
                    ->whereIn('id',$list_check)
                    ->restore();
                    return redirect('admin/typeofemployees')->with('status','Đã khôi phục dữ liệu loại nhân viên thành công');

                }

                if($act == 'forceDelete'){

                    typeofemployees::withTrashed()
                    ->whereIn('id',$list_check)
                    ->forceDelete();
                    return redirect('admin/typeofemployees')->with('status','Đã xoá vĩnh viễn dữ liệu loại nhân viên thành công');

                }

            }

        }else{
            return redirect('admin/typeofemployees')->with('status','Bạn cần chọn phần tử cần thực thi');
        }

    }


}
