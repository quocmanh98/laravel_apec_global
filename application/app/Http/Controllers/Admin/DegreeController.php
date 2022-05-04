<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Degree;
use Illuminate\Http\Request;

class DegreeController extends Controller
{

    public function list(Request $request){

        $this->authorize('degree.index');
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
            $degree =   degree::onlyTrashed()->paginate(10);
        }else{
            $keyword = "";
            if($request->keyword){
                $keyword = $request->keyword;
            }
            $degree =    degree::where('degrees_name','LIKE',"%{$keyword}%")
            ->orWhere('degrees_code','LIKE',"%{$keyword}%")
            ->paginate(10);
        }
        // $degree = $this->degrees->aLL();
        $count_degree_active =   degree::count();
        $count_degree_trash =   degree::onlyTrashed()->count();

        $count = [ $count_degree_active ,  $count_degree_trash];
        return view('admin.degree.index',compact('degree','count','list_act'));

    }

    public function create(){
        $this->authorize('degree.add');
        return view('admin.degree.create');
    }

    public function store(Request $request){
        $this->authorize('degree.add');

        $request->validate(

            [
                'degrees_code' => 'required|max:255',
                'degrees_name' => 'required|string|max:255',
                'status' => 'required'
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute có độ dài tối đa :max ký tự',
                'min' => ':attribute có độ dài tối đa :min ký tự',
            ],
            [
                'degrees_code' => 'Mã bằng cấp',
                'degrees_name' => 'Tên bằng cấp',
                'status' => 'Trạng thái'
            ]

        );

          degree::create(
            [
                'degrees_code' => $request->degrees_code,
                'degrees_name' => $request->degrees_name,
                'degrees_status' => $request->status
            ]
            );

            return redirect('admin/degree')->with('status','Đã thêm dữ liệu bằng cấp thành công');

    }

    public function delete($id){

        $this->authorize('degree.delete');
        $degree = degree::findOrFail($id);
        $degree->delete();
        return redirect('admin/degree')->with('status','Đã xoá tạm thời dữ liệu bằng cấp thành công');

    }


    public function edit($id){

        $this->authorize('degree.edit');
        $degree = degree::findOrFail($id);
        return view('admin.degree.edit',compact('degree'));

    }

    public function update(Request $request,$id){
        $request->validate(

            [
                'degrees_name' => 'required|string|max:255',
                'status' => 'required'
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute có độ dài tối đa :max ký tự',
                'min' => ':attribute có độ dài tối đa :min ký tự',
            ],
            [
                'degrees_name' => 'Tên bằng cấp',
                'status' => 'Trạng thái'
            ]

        );

        degree::findOrFail($id)->update(
            [
                'degrees_name' => $request->degrees_name,
                'degrees_status' => $request->status
            ]
            );

            return redirect('admin/degree')->with('status','Đã sửa dữ liệu bằng cấp thành công');

    }


    public function action(Request $request){
        // dd($request->all());
        $this->authorize('degree.index');

        $list_check = $request->input('list_check');

        if( $list_check ){

            if(!(empty( $list_check))){

                $act = $request->input('act');

                if($act=='delete'){
                    degree::destroy($list_check);
                    return redirect('admin/degree')->with('status','Đã xoá tạm thời dữ liệu bằng cấp thành công');
                }

                if($act == 'restore'){

                    degree::withTrashed()
                    ->whereIn('id',$list_check)
                    ->restore();
                    return redirect('admin/degree')->with('status','Đã khôi phục dữ liệu bằng cấp thành công');

                }

                if($act == 'forceDelete'){

                    degree::withTrashed()
                    ->whereIn('id',$list_check)
                    ->forceDelete();
                    return redirect('admin/degree')->with('status','Đã xoá vĩnh viễn dữ liệu bằng cấp thành công');

                }

            }

        }else{
            return redirect('admin/degree')->with('status','Bạn cần chọn phần tử cần thực thi');
        }

    }


}
