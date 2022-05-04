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
        return view('profile.edit', compact('user', 'roles', 'marriages', 'districts', 'wards', 'provinces', 'nationalitys', 'religions', 'departments', 'nations', 'positions', 'typeofemployees', 'levels', 'degrees', 'specializes'));
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
                'province1' => 'required',
                'district1' => 'required',
                'ward1' => 'required',
                'recruitment' => 'required|min:6|max:255'
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
                'province1' => 'Tỉnh/thành phố',
                'district1' => 'Quận/huyện',
                'ward1' => 'Phường/xã',
                'recruitment' => 'Vị trí ứng tuyển'
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
            'tam_tru' => $request->tamtru . ' ' . $request->province1 . ' ' . $request->ward1 . ' ' . $request->district1,
            'hon_nhan_id' => (empty($request->marriage_id)) ? Null : $request->marriage_id,
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
            'nguyen_quan' => $request->nguyenquan . ' ' . $request->province . ' ' . $request->ward . ' ' . $request->district . ' ' . $request->nguyenquan,
            'mattruoc_cccd' => (empty($request->mattruoc_cccd)) ? "public/uploads/demo.jpg" : $mattruoc,
            'matsau_cccd' => (empty($request->matsau_cccd)) ? "public/uploads/demo.jpg" : $matsau,
            'ApprovalStatus' => 2,
            'recruitment' => $request->recruitment,
        ]);
        return redirect()->route('profile.list')->with('status', 'Đã sửa thông tin thành công');
    }


    // $this->user->where('id', $id)->update($request->except(['_token']));

    // return back()->withInput($request->all())->withSuccess('User created successfully.⚡️');

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
