<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LevelController extends Controller
{

    public function list(Request $request){

        $this->authorize('level.viewAny');
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
            $level =   level::onlyTrashed()->paginate(10);
        }else{
            $keyword = "";
            if($request->keyword){
                $keyword = $request->keyword;
            }
            $level =    level::where('levels_name','LIKE',"%{$keyword}%")
            ->orWhere('levels_code','LIKE',"%{$keyword}%")
            ->paginate(10);
        }

        // $level = $this->levels->aLL();
        $count_level_active =   level::count();
        $count_level_trash =   level::onlyTrashed()->count();

        $count = [ $count_level_active ,  $count_level_trash];
        return view('admin.level.index',compact('level','count','list_act'));

    }

    public function create(){
        $this->authorize('level.add');
        return view('admin.level.create');
    }

    public function store(Request $request){

        $request->validate(

            [
                'levels_code' => 'required|max:255',
                'levels_name' => 'required|string|max:255',
                'status' => 'required'
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute có độ dài tối đa :max ký tự',
                'min' => ':attribute có độ dài tối đa :min ký tự',
            ],
            [
                'levels_code' => 'Mã trình độ',
                'levels_name' => 'Tên trình độ',
                'status' => 'Trạng thái'
            ]

        );

          level::create(
            [
                'levels_code' => $request->levels_code,
                'levels_name' => $request->levels_name,
                'levels_status' => $request->status
            ]
            );

            return redirect('admin/level')->with('status','Đã thêm dữ liệu trình độ thành công');

    }

    public function delete($id){

        $this->authorize('level.delete');
        $level = level::findOrFail($id);
        $level->delete();
        return redirect('admin/level')->with('status','Đã xoá tạm thời dữ liệu trình độ thành công');

    }


    public function edit($id){

        $this->authorize('level.edit');
        $level = level::findOrFail($id);
        return view('admin.level.edit',compact('level'));

    }

    public function update(Request $request,$id){
        $request->validate(

            [
                'levels_name' => 'required|string|max:255',
                'status' => 'required'
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute có độ dài tối đa :max ký tự',
                'min' => ':attribute có độ dài tối đa :min ký tự',
            ],
            [
                'levels_name' => 'Tên trình độ',
                'status' => 'Trạng thái'
            ]

        );

        level::findOrFail($id)->update(
            [
                'levels_name' => $request->levels_name,
                'levels_status' => $request->status
            ]
            );

            return redirect('admin/level')->with('status','Đã sửa dữ liệu trình độ thành công');

    }


    public function action(Request $request){
        // dd($request->all());

        $this->authorize('level.viewAny');
        $list_check = $request->input('list_check');

        if( $list_check ){

            if(!(empty( $list_check))){

                $act = $request->input('act');

                if($act=='delete'){
                    level::destroy($list_check);
                    return redirect('admin/level')->with('status','Đã xoá tạm thời dữ liệu trình độ thành công');
                }

                if($act == 'restore'){

                    level::withTrashed()
                    ->whereIn('id',$list_check)
                    ->restore();
                    return redirect('admin/level')->with('status','Đã khôi phục dữ liệu trình độ thành công');

                }

                if($act == 'forceDelete'){

                    level::withTrashed()
                    ->whereIn('id',$list_check)
                    ->forceDelete();
                    return redirect('admin/level')->with('status','Đã xoá vĩnh viễn dữ liệu trình độ thành công');

                }

            }

        }else{
            return redirect('admin/level')->with('status','Bạn cần chọn phần tử cần thực thi');
        }

    }


}
