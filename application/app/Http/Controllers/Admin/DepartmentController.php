<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DepartmentController extends Controller
{
    private $departments;

    public function __construct(Department $departments)
    {
        $this->departments = $departments;
    }

    public function active($id){
        $department = Department::findOrFail($id)->update(['departments_status'=> 1]);
        return redirect('admin/department')->with('status','Kích hoạt phòng ban thành công');
    }

    public function unactive($id){
        $department = Department::findOrFail($id)->update(['departments_status'=> 0]);
        return redirect('admin/department')->with('status','Huỷ kích hoạt phòng ban thành công');
    }

    public function list(Request $request){
        $this->authorize('department.index');
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
            $department = Department::onlyTrashed()->paginate(10);
        }else{
            $keyword = "";
            if($request->keyword){
                $keyword = $request->keyword;
            }
            $department =  Department::where('departments_name','LIKE',"%{$keyword}%")->paginate(10);
        }

        // $department = $this->departments->aLL();
        $count_department_active = Department::count();
        $count_department_trash = Department::onlyTrashed()->count();

        $count = [ $count_department_active ,  $count_department_trash];
        return view('admin.department.index',compact('department','count','list_act'));

    }

    public function create(){
        $this->authorize('department.add');
        return view('admin.department.create');
    }

    public function store(Request $request){

        $request->validate(

            [
                'departments_code' => 'required|max:255',
                'departments_name' => 'required|string|max:255|min:8',
                'status' => 'required'
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute có độ dài tối đa :max ký tự',
                'min' => ':attribute có độ dài tối đa :min ký tự',
            ],
            [
                'departments_code' => 'Mã phòng ban',
                'departments_name' => 'Tên phòng ban',
                'status' => 'Trạng thái'
            ]

        );

        Department::create(
            [
                'departments_code' => $request->departments_code,
                'departments_name' => $request->departments_name,
                'departments_slug' => Str::slug($request->departments_name),
                'departments_status' => $request->status
            ]
            );

            return redirect('admin/department')->with('status','Đã thêm dữ liệu phòng ban thành công');

    }

    public function delete($id){

        $this->authorize('department.delete');
        $department = Department::findOrFail($id);
        $department->delete();
        return redirect('admin/department')->with('status','Đã xoá tạm thời dữ liệu phòng ban thành công');

    }


    public function edit($id){

        $this->authorize('department.update');
        $department = Department::findOrFail($id);
        return view('admin.department.edit',compact('department'));

    }

    public function update(Request $request,$id){
        $request->validate(

            [
                'departments_name' => 'required|string|max:255|min:8',
                'status' => 'required'
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute có độ dài tối đa :max ký tự',
                'min' => ':attribute có độ dài tối đa :min ký tự',
            ],
            [
                'departments_name' => 'Tên phòng ban',
                'status' => 'Trạng thái'
            ]

        );

        Department::findOrFail($id)->update(
            [
                'departments_name' => $request->departments_name,
                'departments_slug' => Str::slug($request->departments_name),
                'departments_status' => $request->status
            ]
            );

            return redirect('admin/department')->with('status','Đã sửa dữ liệu phòng ban thành công');

    }


    public function action(Request $request){
        // dd($request->all());
        $this->authorize('department.index');

        $list_check = $request->input('list_check');

        if( $list_check ){

            if(!(empty( $list_check))){

                $act = $request->input('act');

                if($act=='delete'){
                    Department::destroy($list_check);
                    return redirect('admin/department')->with('status','Đã xoá tạm thời dữ liệu phòng ban thành công');
                }

                if($act == 'restore'){

                    Department::withTrashed()
                    ->whereIn('id',$list_check)
                    ->restore();
                    return redirect('admin/department')->with('status','Đã khôi phục dữ liệu phòng ban thành công');

                }

                if($act == 'forceDelete'){

                    Department::withTrashed()
                    ->whereIn('id',$list_check)
                    ->forceDelete();
                    return redirect('admin/department')->with('status','Đã xoá vĩnh viễn dữ liệu phòng ban thành công');

                }

            }

        }else{
            return redirect('admin/department')->with('status','Bạn cần chọn phần tử cần thực thi');
        }

    }

}
