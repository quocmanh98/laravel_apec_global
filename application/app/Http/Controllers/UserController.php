<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Events\User\Banned;
use App\Events\User\Deleted;
use App\Events\User\Unconfirmed;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Admin\Degree;
use App\Models\Admin\Department;
use App\Models\Admin\District;
use App\Models\Admin\Level;
use App\Models\Admin\Marriages;
use App\Models\Admin\Nation;
use App\Models\Admin\Nationality;
use App\Models\Admin\Position;
use App\Models\Admin\Province;
use App\Models\Admin\Religion;
use App\Models\Admin\Specialize;
use App\Models\Admin\Typeofemployees;
use App\Models\Admin\Ward;
use App\Models\Role;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use Stevebauman\Location\Facades\Location;

class UserController extends Controller
{
    /**
     * @var User
     */
    private $users;

    /**
     * UsersController constructor.
     * @param User $users
     */
    public function __construct(User $users)
    {
        $this->users = $users;
    }

    public function list_ip(Request $request)
    {
        /* $ip = $request->ip(); Dynamic IP address */
        // $ip = '42.117.202.47'; /* Static IP address */
        $ip = $request->ip();
        if($ip == '::1'){
            $currentUserInfo = Location::get($ip);
        }else{
            $currentUserInfo = Location::get($ip);
        }
        return view('user.ip', compact('currentUserInfo'));
    }

    public function list(Request $request)
    {

        $this->authorize('user.viewAny');
        $status = $request->input('status');
        $keyword = $request->input('keyword');
        $list_act = [
            'delete' => 'Xoá tạm thời'
        ];

        if ($status == 'trash') {
            $list_act = [
                'restore' => 'Khôi phục',
                'forceDelete' => 'Xoá vĩnh viễn'
            ];
            $users =   User::onlyTrashed()->paginate(10);
        } else {
            $keyword = "";
            if ($request->keyword) {
                $keyword = $request->keyword;
            }
            $users = User::where('email', 'LIKE', "%{$keyword}%")
                ->orWhere('username', 'LIKE', "%{$keyword}%")
                ->orWhere('fullname', 'LIKE', "%{$keyword}%")
                ->paginate(10);
        }
        // $degree = $this->degrees->aLL();
        $count_user_active =    User::count();
        $count_user_trash =    User::onlyTrashed()->count();

        $count = [$count_user_active,  $count_user_trash];
        return view('users.index', compact('users', 'count', 'list_act'));
    }

    public function action(Request $request)
    {
        // dd($request->all());

        $list_check = $request->input('list_check');

        if ($list_check) {

            if (!(empty($list_check))) {

                $act = $request->input('act');

                if ($act == 'delete') {
                    User::destroy($list_check);
                    return redirect('users')->with('status', 'Đã xoá tạm thời dữ liệu nhân viên thành công');
                }

                if ($act == 'restore') {

                    User::withTrashed()
                        ->whereIn('id', $list_check)
                        ->restore();
                    return redirect('users')->with('status', 'Đã khôi phục dữ liệu nhân viên thành công');
                }

                if ($act == 'forceDelete') {

                    User::withTrashed()
                        ->whereIn('id', $list_check)
                        ->forceDelete();
                    return redirect('users')->with('status', 'Đã xoá vĩnh viễn dữ liệu nhân viên thành công');
                }
            }
        } else {
            return redirect('users')->with('status', 'Bạn cần chọn phần tử cần thực thi');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('user.viewAny');

        $status = $request->input('status');
        $keyword = $request->input('keyword');
        $list_act = [
            'delete' => 'Xoá tạm thời'
        ];

        if ($status == 1) {
            $users =   User::where('status_work', 1)->paginate(10);
        } elseif ($status == 2) {
            $users =   User::where('status_work', 2)->paginate(10);
        } elseif ($status == 'trash') {
            $list_act = [
                'restore' => 'Khôi phục',
                'forceDelete' => 'Xoá vĩnh viễn'
            ];
            $users =   User::onlyTrashed()->paginate(10);
        } else {
            $keyword = "";
            if ($request->keyword) {
                $keyword = $request->keyword;
            }
            $users = User::where('email', 'LIKE', "%{$keyword}%")
                ->orWhere('username', 'LIKE', "%{$keyword}%")
                ->orWhere('fullname', 'LIKE', "%{$keyword}%")
                ->paginate(10);
        }

        return view('users.index', compact('users', 'list_act'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $this->authorize('user.create');
        $marriages = Marriages::all();
        $districts = District::all();
        $wards = Ward::all();
        $provinces = Province::all();
        $nationality = Nationality::all();
        $religions = Religion::all();
        $roles = Role::all();
        $departments = Department::all();
        $nations = Nation::all();
        $positions = Position::all();
        $typeofemployees = Typeofemployees::all();
        $levels = Level::all();
        $degrees = Degree::all();
        $specializes = Specialize::all();
        return view('users.create', compact('roles', 'marriages', 'districts', 'wards', 'provinces', 'nationality', 'religions', 'departments', 'nations', 'positions', 'typeofemployees', 'levels', 'degrees', 'specializes'));
    }

    public function GetDistrict($province_id)
    {
        $district = District::where('province_id', $province_id)->get();
        return json_encode($district);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $this->authorize('user.create');

        $request->validate(
            [
                'username' => 'required|unique:users|min:6|max:255',
                'email' => 'required|unique:users|email',
                'avatar' => 'image|mimes:png,jpg',
                'full_name' => 'required|min:8|max:255',
                'birthday' => 'required|date',
                'so_cccd' => 'required|min:6',
                'ngaycap_cccd' => 'required|date',
                'noicap_cccd' => 'required|min:8|max:255',
                'noisinh' => 'required|min:8|max:255',
                'nguyenquan' => 'required|min:8|max:255',
                'hokhau' => 'required|min:8|max:255',
                'tamtru' => 'required|min:8|max:255',
                'phone' => 'required',
                'religion' => 'required',
                'mattruoc_cccd' => 'image|mimes:png,jpg',
                'matsau_cccd' => 'image|mimes:png,jpg',
                'province' => 'required',
                'district' => 'required',
                'ward' => 'required',
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài ít nhất :min ký tự',
                'max' => ':attribute có độ dài ít nhất :max ký tự',
            ],
            [
                'full_name' => 'Họ tên',
                'username' => 'Tên đăng nhập',
                'email' => 'Email',
                'avatar' => 'Hình ảnh đại diện',
                'birthday' => 'Ngày sinh',
                'so_cccd' => 'Số CCCD',
                'ngaycap_cccd' => 'Ngày cấp CCCD',
                'noicap_cccd' => 'Nơi cấp CCCD',
                'noisinh' => 'Nơi sinh',
                'nguyenquan' => 'Nguyên quán',
                'hokhau' => 'Hộ khẩu',
                'tamtru' => 'Tạm trú',
                'phone' => 'Điện thoại',
                'religion' => 'Tôn giáo',
                'mattruoc_cccd' => 'Mặt trước CCCD',
                'matsau_cccd' => 'Mặt sau CCCD',
                'province' => 'Tỉnh',
                'district' => 'Huyện',
                'ward' => 'Phường',
            ]
        );

        $input = array();
        if ($request->hasFile('avatar')) {
            $avatar = $request->avatar;
            $fileavatar = $avatar->getClientOriginalName();
            $avatar->move('public/uploads',  $fileavatar);
            $avatar = "public/uploads/" .  $fileavatar;

            $mattruoc_cccd = $request->mattruoc_cccd;
            $filemattruoc = $mattruoc_cccd->getClientOriginalName();
            $mattruoc_cccd->move('public/uploads',   $filemattruoc);
            $mattruoc = "public/uploads/" .   $filemattruoc;


            $matsau_cccd = $request->matsau_cccd;
            $filematsau =   $matsau_cccd->getClientOriginalName();
            $matsau_cccd->move('public/uploads',   $filematsau);
            $matsau = "public/uploads/" .   $filematsau;

            $this->users->create([
                'code' => $request->code,
                'username' => $request->username,
                'email' => $request->email,
                'fullname' => $request->full_name,
                'phone' => $request->phone,
                'gioi_tinh' => $request->gender,
                'avatar' => (empty($request->avatar)) ? "public/uploads/demo.jpg" : $avatar,
                'noi_sinh' => $request->noisinh,
                'country' => $request->country,
                'birthday' => $request->birthday,
                'ho_khau' => $request->hokhau,
                'tam_tru' => $request->tamtru,
                'district' => $request->district,
                'ward' => $request->ward,
                'province' => $request->province,
                'hon_nhan_id' => $request->marriage_id,
                'quoc_tich' => $request->country,
                'ton_giao' => $request->religion,
                'dan_toc_id' => $request->nation,
                'loai_nv_id' => $request->typeofemployees,
                'trinh_do_id' => $request->level,
                'chuyen_mon_id' => $request->specialize,
                'bang_cap_id' => $request->degree,
                'phong_ban_id' => $request->department,
                'chuc_vu_id' => $request->position,
                'so_cmnd' => $request->so_cccd,
                'noi_cap_cmnd' => $request->noicap_cccd,
                'ngay_cap_cmnd' => $request->ngaycap_cccd,
                'nguyen_quan' => $request->nguyenquan,
                'status' =>  empty($request->status)  ? 'unconfirmed' : $request->status,
                'mattruoc_cccd' => (empty($request->mattruoc_cccd)) ? "public/uploads/demo.jpg" : $mattruoc,
                'matsau_cccd' =>  (empty($request->matsau_cccd)) ? "public/uploads/demo.jpg" : $matsau,
                'role_id' => 'be9df9e4-03e8-4a80-8c7d-367f4c8867db',
            ]);
            return redirect()->route('users.index')->withSuccess('Thêm dữ liệu nhân viên thành công.⚡️');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id = null)
    {
        $this->authorize('user.view');
        $marriages = Marriages::all();
        $districts = District::all();
        $wards = Ward::all();
        $provinces = Province::all();
        $nationality = Nationality::all();
        $religions = Religion::all();
        $roles = Role::all();
        $departments = Department::all();
        $nations = Nation::all();
        $positions = Position::all();
        $typeofemployees = Typeofemployees::all();
        $levels = Level::all();
        $degrees = Degree::all();
        $specializes = Specialize::all();

        $user = $this->users->findOrFail($id);
        $ativities = Activity::where('user_id', $user->id)->paginate(15);
        return view('users.show', compact('user', 'ativities', 'marriages', 'districts', 'wards', 'provinces', 'nationality', 'religions', 'departments', 'nations', 'positions', 'typeofemployees', 'levels', 'degrees', 'specializes', 'roles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('user.update');
        $marriages = Marriages::all();
        $districts = District::all();
        $wards = Ward::all();
        $provinces = Province::all();
        $nationalitys = Nationality::all();
        $religions = Religion::all();
        $roles = Role::all();
        $departments = Department::all();
        $nations = Nation::all();
        $positions = Position::all();
        $typeofemployees = Typeofemployees::all();
        $levels = Level::all();
        $degrees = Degree::all();
        $specializes = Specialize::all();
        $user = $this->users->findOrFail($id);
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles', 'marriages', 'districts', 'wards', 'provinces', 'nationalitys', 'religions', 'departments', 'nations', 'positions', 'typeofemployees', 'levels', 'degrees', 'specializes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('user.update');

        // dd($request->all());
        $request->validate(
            [
                'avatar' => 'image|mimes:png,jpg',
                'full_name' => 'required|min:6|max:255',
                'birthday' => 'required|date',
                'so_cccd' => 'required|min:6',
                'ngaycap_cccd' => 'required|date',
                'noicap_cccd' => 'required|min:8|max:255',
                'nguyenquan' => 'required|min:8|max:255',
                'tamtru' => 'required|min:8|max:255',
                'country' => 'required',
                'religion' => 'required',
                'mattruoc_cccd' => 'image|mimes:png,jpg',
                'matsau_cccd' => 'image|mimes:png,jpg',
                'province' => 'required',
                'district' => 'required',
                'ward' => 'required',
                'recruitment' => 'required|min:6|max:255',
                'status_work' => 'required',
                'role' => 'required',
                'type' =>'required'
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài ít nhất :min ký tự',
                'max' => ':attribute có độ dài ít nhất :max ký tự',
            ],
            [
                'full_name' => 'Họ tên',
                'avatar' => 'Hình ảnh cá nhân',
                'birthday' => 'Ngày sinh',
                'so_cccd' => 'Số CCCD/CMND',
                'ngaycap_cccd' => 'Ngày cấp CCCD/CMND',
                'noicap_cccd' => 'Nơi cấp CCCD/CMND',
                'nguyenquan' => 'Địa chỉ thường trú',
                'tamtru' => 'Nơi ở hiện tại',
                'religion' => 'Tôn giáo',
                'country' => 'Quốc gia',
                'religion' => 'Tôn giáo',
                'mattruoc_cccd' => 'Mặt trước CCCD/CMND',
                'matsau_cccd' => 'Mặt sau CCCD/CMND',
                'province' => 'Tỉnh/thành phố',
                'district' => 'Quận/huyện',
                'ward' => 'Phường/xã',
                'recruitment' => 'Vị trí ứng tuyển',
                'status_work' => 'Trạng thái làm việc',
                'role' => 'Vai trò',
                'type' => 'Loại nhân viên'
            ]
        );

        if ($request->avatar) {
            $avatar = $request->avatar;
            $fileavatar = $avatar->getClientOriginalName();
            $avatar->move('public/uploads',  $fileavatar);
            $avatar = "public/uploads/" .  $fileavatar;
        }

        if ($request->mattruoc_cccd) {
            $mattruoc_cccd = $request->mattruoc_cccd;
            $filemattruoc = $mattruoc_cccd->getClientOriginalName();
            $mattruoc_cccd->move('public/uploads',   $filemattruoc);
            $mattruoc = "public/uploads/" .   $filemattruoc;
        }

        if ($request->matsau_cccd) {
            $matsau_cccd = $request->matsau_cccd;
            $filematsau =   $matsau_cccd->getClientOriginalName();
            $matsau_cccd->move('public/uploads',   $filematsau);
            $matsau = "public/uploads/" .   $filematsau;
        }


        User::findOrFail($id)->update([
            'fullname' => $request->full_name,
            'gioi_tinh' => $request->gender,
            'avatar' => (empty($request->avatar)) ? "public/uploads/demo.jpg" : $avatar,
            'country' => $request->country,
            'birthday' => $request->birthday,
            'tam_tru' => $request->tamtru,
            'hon_nhan_id' => $request->marriage_id,
            'quoc_tich' => $request->country,
            'ton_giao' => $request->religion,
            'dan_toc_id' => $request->nation,
            'loai_nv_id' => $request->typeofemployees,
            'trinh_do_id' => $request->level,
            'chuyen_mon_id' => $request->specialize,
            'bang_cap_id' => $request->degree,
            'phong_ban_id' => $request->department,
            'chuc_vu_id' => $request->position,
            'so_cmnd' => $request->so_cccd,
            'noi_cap_cmnd' => $request->noicap_cccd,
            'ngay_cap_cmnd' => $request->ngaycap_cccd,
            'nguyen_quan' => $request->nguyenquan,
            'mattruoc_cccd' => (empty($request->mattruoc_cccd)) ? "public/uploads/demo.jpg" : $mattruoc,
            'matsau_cccd' => (empty($request->matsau_cccd)) ? "public/uploads/demo.jpg" : $matsau,
            'ApprovalStatus' => 2,
            'recruitment' => $request->recruitment,
            'status_work' => $request->status_work,
            'role_id' => $request->role,
            'loai_nv_id' => $request->type
        ]);
        return redirect()->route('users.index')->with('status', 'Đã sửa thông tin thành công');
    }

    //

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function change_password(Request $request, $id)
    {
        $this->authorize('user.update');

        $request->validate([
            'password' => 'required|min:6|max:50',
        ]);

        $data = $request->only(['password']);
        $this->users->where('id', $id)->update($data);

        return back()->withInput($request->all())->withSuccess('Cập nhật mật khẩu thành công.⚡️');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('user.delete');
        $user = $this->users->findOrFail($id);
        if ($user != null) {
            $user->delete();
            event(new Deleted($user));
        }
        return redirect()->route('users.index')->withSuccess('User Deleted successfully.⚡️');
    }

    public function delete($id)
    {
        $this->authorize('user.delete');
        $user = $this->users->findOrFail($id);
        if ($user != null) {
            $user->delete();
            event(new Deleted($user));
        }
        return redirect()->route('users.index')->withSuccess('Xoá nhân viên thành công.⚡️');
    }

    public function export()
{
    return Excel::download(new UsersExport, 'users.xlsx');
}
}
