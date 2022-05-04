<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Department;
use App\Models\Admin\Level;
use App\Models\Admin\Position;
use App\Models\User;

class Employee extends Controller
{
    public function list(){
        $this->authorize('employee.index');
        $department =  Department::all();
        $position = Position::all();
        $level = Level::all();
        $item = User::where('ApprovalStatus', 2)->paginate(10);
        return view('employee.list',compact('department','level','item','position'));
    }
    public function filer($slug){
        $this->authorize('employee.department.filer');
        $v = Department::where('departments_slug',$slug)->first();
        $department =  Department::all();
        $level = Level::all();
        $item = User::join('departments', 'users.phong_ban_id', '=', 'departments.id')
        ->join('levels', 'users.trinh_do_id', '=', 'levels.id')
        ->where('levels.id', $slug)->where('users.ApprovalStatus', 2)->paginate(15);
        return view('employee.filer.index',compact('item','department','level'));
    }

}
