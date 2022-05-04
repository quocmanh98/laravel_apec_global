<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PositionController extends Controller
{

    public function list(Request $request){

        $this->authorize('position.index');
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

            $position =   Position::onlyTrashed()->paginate(10);
        }else{
            $keyword = "";
            if($request->keyword){
                $keyword = $request->keyword;
            }
            $position =    Position::where('positions_name','LIKE',"%{$keyword}%")
            ->orWhere('positions_code','LIKE',"%{$keyword}%")
            ->paginate(10);
        }

        // $position = $this->positions->aLL();
        $count_position_active =   Position::count();
        $count_position_trash =   Position::onlyTrashed()->count();

        $count = [ $count_position_active ,  $count_position_trash];
        return view('admin.position.index',compact('position','count','list_act'));

    }

    public function create(){
        $this->authorize('position.add');
        return view('admin.position.create');
    }

    public function store(Request $request){

        $request->validate(

            [
                'positions_code' => 'required|max:255',
                'positions_name' => 'required|string|max:255|min:8',
                'status' => 'required'
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute có độ dài tối đa :max ký tự',
                'min' => ':attribute có độ dài tối đa :min ký tự',
            ],
            [
                'positions_code' => 'Mã chức vụ',
                'positions_name' => 'Tên chức vụ',
                'status' => 'Trạng thái'
            ]

        );

          Position::create(
            [
                'positions_code' => $request->positions_code,
                'positions_name' => $request->positions_name,
                'positions_slug' => Str::slug($request->positions_name),
                'positions_status' => $request->status
            ]
            );

            return redirect('admin/position')->with('status','Đã thêm dữ liệu chức vụ thành công');

    }

    public function delete($id){

        $this->authorize('position.delete');
        $position = position::findOrFail($id);
        $position->delete();
        return redirect('admin/position')->with('status','Đã xoá tạm thời dữ liệu chức vụ thành công');

    }


    public function edit($id){

        $this->authorize('position.edit');
        $position = position::findOrFail($id);
        return view('admin.position.edit',compact('position'));

    }

    public function update(Request $request,$id){
        $request->validate(

            [
                'positions_name' => 'required|string|max:255|min:8',
                'status' => 'required'
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute có độ dài tối đa :max ký tự',
                'min' => ':attribute có độ dài tối đa :min ký tự',
            ],
            [
                'positions_name' => 'Tên chức vụ',
                'status' => 'Trạng thái'
            ]

        );

        position::findOrFail($id)->update(
            [
                'positions_name' => $request->positions_name,
                'positions_slug' => Str::slug($request->positions_name),
                'positions_status' => $request->status
            ]
            );

            return redirect('admin/position')->with('status','Đã sửa dữ liệu chức vụ thành công');

    }


    public function action(Request $request){
        // dd($request->all());
        $this->authorize('position.index');
        $list_check = $request->input('list_check');

        if( $list_check ){

            if(!(empty( $list_check))){

                $act = $request->input('act');

                if($act=='delete'){
                    position::destroy($list_check);
                    return redirect('admin/position')->with('status','Đã xoá tạm thời dữ liệu chức vụ thành công');
                }

                if($act == 'restore'){

                    position::withTrashed()
                    ->whereIn('id',$list_check)
                    ->restore();
                    return redirect('admin/position')->with('status','Đã khôi phục dữ liệu chức vụ thành công');

                }

                if($act == 'forceDelete'){

                    position::withTrashed()
                    ->whereIn('id',$list_check)
                    ->forceDelete();
                    return redirect('admin/position')->with('status','Đã xoá vĩnh viễn dữ liệu chức vụ thành công');

                }

            }

        }else{
            return redirect('admin/position')->with('status','Bạn cần chọn phần tử cần thực thi');
        }

    }


}
