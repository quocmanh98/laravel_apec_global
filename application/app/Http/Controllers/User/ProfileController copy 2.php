<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
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
use App\Events\User\Banned;
use App\Events\User\Deleted;
use App\Events\User\Unconfirmed;


class ProfileController extends Controller
{
    /**
     * @var User
     */
    private $user;

    /**
     * ProfileController constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }


    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $this->authorize('profile.show');

        $user = auth()->user();
        $marriages = Marriages::all();
        $districts = District::all();
        $wards = Ward::all();
        $provinces = Province::all();
        $religions = Religion::all();
        $roles = Role::all();
        $departments = Department::all();
        $nations = Nation::all();
        $nationalitys = Nationality::all();
        $positions = Position::all();
        $typeofemployees = Typeofemployees::all();
        $levels = Level::all();
        $degrees = Degree::all();
        $specializes = Specialize::all();

        return view('profile.show', compact('user', 'roles', 'marriages', 'districts', 'wards', 'provinces', 'nationalitys', 'religions', 'departments', 'nations', 'positions', 'typeofemployees', 'levels', 'degrees', 'specializes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $this->authorize('profile.update');
        $user = auth()->user();
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
        $roles = Role::all();
        return view('profile.edit', compact('user', 'roles', 'marriages', 'districts', 'wards', 'provinces', 'nationality', 'religions', 'departments', 'nations', 'positions', 'typeofemployees', 'levels', 'degrees', 'specializes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->authorize('profile.update');
        $id = auth()->id();

        $request->validate(
            [

                'username' => 'required|min:6|max:255',
                'email' => 'required|email',
                'avatar' => 'required|image|mimes:png,jpg',
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
                'mattruoc_cccd' => 'required|image|mimes:png,jpg',
                'matsau_cccd' => 'required|image|mimes:png,jpg',
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


            $this->user->where('id', $id)->update([

                'username' => $request->username,
                'email' => $request->email,
                'fullname' => $request->full_name,
                'phone' => $request->phone,
                'gioi_tinh' => $request->gender,
                'avatar' => $avatar,
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
                'status' => $request->status,
                'status_work' => $request->status_work,
                'mattruoc_cccd' => $mattruoc,
                'matsau_cccd' => $matsau,
                'role_id' => 'be9df9e4-03e8-4a80-8c7d-367f4c8867db',
            ]);

            $user = $this->user->find($id);

            if ($request->input('status') == 'banned') {
                event(new Banned($user));
            }

            if ($request->input('status') == 'unconfirmed') {
                event(new Unconfirmed($user));
            }

            return redirect()->route('profile.index')->withSuccess('Sửa hồ sơ thành công.⚡️');
        }

        // $this->user->where('id', $id)->update($request->except(['_token']));

        // return back()->withInput($request->all())->withSuccess('User created successfully.⚡️');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function change_password(Request $request)
    {
        $this->authorize('profile.update');
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => 'required|min:6|max:50',
            'new_confirm_password' => 'same:new_password',
        ]);

        $this->user->where('id', auth()->id())->update([
            'password' => Hash::make($request->new_password)
        ]);
        return back()->withSuccess('Password Change successfull');
    }
}
