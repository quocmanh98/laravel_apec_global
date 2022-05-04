<?php

namespace App\Http\Controllers\Authorization;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PermissionController extends Controller
{
     /**
     * @var Role
     */
    private $roles;

    /**
     * @var Permission
     */
    private $permissions;

    /**
     * PermissionsController constructor.
     * @param Role $roles
     * @param Permission $permissions
     */
    public function __construct(Role $roles, Permission $permissions)
    {
        $this->roles = $roles;
        $this->permissions = $permissions;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('permission.update');

        return view('permission.index', [
            'roles' => $this->roles->all(),
            'permissions' => $this->permissions->orderBy('created_at', 'desc')->paginate(60)
        ]);
    }

    public function list(Request $request){

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
            $permission =   Permission::onlyTrashed()->orderBy('created_at', 'desc')->paginate(10);
        }else{
            $keyword = "";
            if($request->keyword){
                $keyword = $request->keyword;
            }
            $permission =    Permission::where('name','LIKE',"%{$keyword}%")
            ->orWhere('display_name','LIKE',"%{$keyword}%")
            ->orderBy('created_at', 'desc')->paginate(10);
        }

        // $permission = $this->permissions->aLL();
        $count_permission_active =   Permission::count();
        $count_permission_trash =   Permission::onlyTrashed()->count();

        $count = [ $count_permission_active ,  $count_permission_trash];
        return view('admin.permission.list',compact('permission','count','list_act'));

    }

    public function action(Request $request){
        // dd($request->all());

        $list_check = $request->input('list_check');

        if( $list_check ){

            if(!(empty( $list_check))){

                $act = $request->input('act');

                if($act=='delete'){
                    Permission::destroy($list_check);
                    return redirect('permissions/list')->with('status','Đã xoá tạm thời dữ liệu phân quyền thành công');
                }

                if($act == 'restore'){

                    Permission::withTrashed()
                    ->whereIn('id',$list_check)
                    ->restore();
                    return redirect('permissions/list')->with('status','Đã khôi phục dữ liệu phân quyền thành công');

                }

                if($act == 'forceDelete'){

                    Permission::withTrashed()
                    ->whereIn('id',$list_check)
                    ->forceDelete();
                    return redirect('permissions/list')->with('status','Đã xoá vĩnh viễn dữ liệu phân quyền thành công');

                }

            }

        }else{
            return redirect('permissions/list')->with('status','Bạn cần chọn phần tử cần thực thi');
        }

    }

    public function create(){

        return view('admin.permission.create');
    }

    public function store(Request $request){

        $request->validate(

            [
                'name' => 'required|max:255|unique:permissions,name',
                'display_name' => 'required|string|max:255|unique:permissions,display_name',
                'status' => 'required'
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute có độ dài tối đa :max ký tự',
                'min' => ':attribute có độ dài tối đa :min ký tự',
            ],
            [
                'name' => 'Tên route',
                'display_name' => 'Tên phân quyền',
                'status' => 'Trạng thái'
            ]

        );

          permission::create(
            [
                'name' => $request->name,
                'display_name' => $request->display_name,
                'permissions_status' => $request->status
            ]
            );

            return redirect('permissions')->with('status','Đã thêm dữ liệu phân quyền thành công');

    }

    /**
     * Update permissions for each role.
     *
     * @param Request $request
     * @return mixed
     */
    public function update(Request $request)
    {
        $this->authorize('permission.update');

        $roles = $request->input('roles');
        $allRoles = $this->roles->pluck('name', 'id');

        foreach ($allRoles as $roleId => $roleName ) {
            $permissions = Arr::get($roles, $roleId, []);
            $this->roles->updatePermissions($roleId, $permissions);
        }
        // event(new PermissionsUpdated);
        return redirect()->route('permissions.index')
            ->withSuccess(__('Đã cập nhật quyền thành công.'));
    }

    public function delete($id){

        $permission = permission::findOrFail($id);
        $permission->delete();
        return redirect('permissions/list')->with('status','Đã xoá tạm thời dữ liệu phân quyền thành công');

    }


    public function edit($id){

        $permission = permission::findOrFail($id);
        return view('admin.permission.edit',compact('permission'));

    }

    public function updatePermission(Request $request,$id){
        $request->validate(

            [
                'name' => 'required|max:255',
                'display_name' => 'required|string|max:255',
                'status' => 'required'
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute có độ dài tối đa :max ký tự',
                'min' => ':attribute có độ dài tối đa :min ký tự',
            ],
            [
                'name' => 'Tên route',
                'display_name' => 'Tên phân quyền',
                'status' => 'Trạng thái'
            ]

        );

        permission::findOrFail($id)->update(
            [
                'name' => $request->name,
                'display_name' => $request->display_name,
                'permissions_status' => $request->status
            ]
            );

            return redirect('permissions/list')->with('status','Đã sửa dữ liệu phân quyền thành công');

    }
}
