<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Specialize;
use Illuminate\Http\Request;

class SpecializeController extends Controller
{


    public function list(Request $request){


        $this->authorize('specialize.index');
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

            $specialize =   specialize::onlyTrashed()->paginate(10);
        }else{
            $keyword = "";
            if($request->keyword){
                $keyword = $request->keyword;
            }
            $specialize =    specialize::where('specializes_name','LIKE',"%{$keyword}%")
            ->orWhere('specializes_code','LIKE',"%{$keyword}%")
            ->paginate(10);
        }

        // $specialize = $this->specializes->aLL();
        $count_specialize_active =   specialize::count();
        $count_specialize_trash =   specialize::onlyTrashed()->count();

        $count = [ $count_specialize_active ,  $count_specialize_trash];
        return view('admin.specialize.index',compact('specialize','count','list_act'));

    }

    public function create(){
        $this->authorize('specialize.add');
        return view('admin.specialize.create');
    }

    public function store(Request $request){

        $request->validate(

            [
                'specializes_code' => 'required|max:255',
                'specializes_name' => 'required|string|max:255',
                'status' => 'required'
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute có độ dài tối đa :max ký tự',
                'min' => ':attribute có độ dài tối đa :min ký tự',
            ],
            [
                'specializes_code' => 'Mã chuyên môn',
                'specializes_name' => 'Tên chuyên môn',
                'status' => 'Trạng thái'
            ]

        );

          specialize::create(
            [
                'specializes_code' => $request->specializes_code,
                'specializes_name' => $request->specializes_name,
                'specializes_status' => $request->status
            ]
            );

            return redirect('admin/specialize')->with('status','Đã thêm dữ liệu chuyên môn thành công');

    }

    public function delete($id){

        $this->authorize('specialize.delete');
        $specialize = specialize::findOrFail($id);
        $specialize->delete();
        return redirect('admin/specialize')->with('status','Đã xoá tạm thời dữ liệu chuyên môn thành công');

    }


    public function edit($id){

        $this->authorize('specialize.edit');
        $specialize = specialize::findOrFail($id);
        return view('admin.specialize.edit',compact('specialize'));

    }

    public function update(Request $request,$id){
        $request->validate(

            [
                'specializes_name' => 'required|string|max:255',
                'status' => 'required'
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute có độ dài tối đa :max ký tự',
                'min' => ':attribute có độ dài tối đa :min ký tự',
            ],
            [
                'specializes_name' => 'Tên chuyên môn',
                'status' => 'Trạng thái'
            ]

        );

        specialize::findOrFail($id)->update(
            [
                'specializes_name' => $request->specializes_name,
                'specializes_status' => $request->status
            ]
            );

            return redirect('admin/specialize')->with('status','Đã sửa dữ liệu chuyên môn thành công');

    }


    public function action(Request $request){
        $this->authorize('specialize.index');
        // dd($request->all());

        $list_check = $request->input('list_check');

        if( $list_check ){

            if(!(empty( $list_check))){

                $act = $request->input('act');

                if($act=='delete'){
                    specialize::destroy($list_check);
                    return redirect('admin/specialize')->with('status','Đã xoá tạm thời dữ liệu chuyên môn thành công');
                }

                if($act == 'restore'){

                    specialize::withTrashed()
                    ->whereIn('id',$list_check)
                    ->restore();
                    return redirect('admin/specialize')->with('status','Đã khôi phục dữ liệu chuyên môn thành công');

                }

                if($act == 'forceDelete'){

                    specialize::withTrashed()
                    ->whereIn('id',$list_check)
                    ->forceDelete();
                    return redirect('admin/specialize')->with('status','Đã xoá vĩnh viễn dữ liệu chuyên môn thành công');

                }

            }

        }else{
            return redirect('admin/specialize')->with('status','Bạn cần chọn phần tử cần thực thi');
        }

    }


}
