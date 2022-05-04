<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\updatePassword;
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
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class RecruitController extends Controller
{
    public function list(Request $request)
    {

        // 1 : chờ duyệt
        // 2: đã duyệt
        $this->authorize('recruit.list');
        $ApprovalStatus = $request->input('ApprovalStatus');
        $keyword = $request->input('keyword');

        if (!empty($ApprovalStatus)) {
            if ($ApprovalStatus == 1) {
                $users =   User::where('ApprovalStatus', $ApprovalStatus)->paginate(10);
            } else {
                $users =   User::where('ApprovalStatus', $ApprovalStatus)->paginate(10);
            }
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
        return view('recruit.index', compact('users'));
    }

    public function edit($id)
    {
        $this->authorize('recruit.edit');
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
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('recruit.edit', compact('user', 'roles', 'marriages', 'districts', 'wards', 'provinces', 'religions', 'departments', 'nations', 'positions', 'typeofemployees', 'levels', 'degrees', 'specializes'));
    }

    public function editCandidate($id, Request $request){
        $this->authorize('recruit.edit');
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
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('recruit.editCandidate', compact('user', 'roles', 'marriages', 'districts', 'wards', 'provinces', 'religions', 'departments', 'nations', 'positions', 'typeofemployees', 'levels', 'degrees', 'specializes','nationalitys'));
    }

    public function update($id, Request $request)
    {

        $request->validate(
            [
                'Approval' => 'required',
                'dayin' => 'required|date'
            ],
            [
                'required' => ':attribute không được để trống',
            ],
            [
                'Approval' => 'Loại nhân viên',
                'dayin' => 'Ngày vào làm'
            ]
        );

        if ($request->ApprovalStatus == 2) {
            $user = User::findOrFail($id);
            $pass_new = random_int(0, 99999999);
            $pass_two = htmlspecialchars(bcrypt(($pass_new)));
            $data = [
                'email' => $user->email,
                'pass_new' => $pass_new
            ];
            Mail::to($user->email)->send(new updatePassword($data));
            User::findOrFail($id)->update(
                [
                    'loai_nv_id' =>  $request->Approval,
                    'ApprovalStatus' => 2,
                    'password' =>  $pass_two,
                    'dayin' => $request->dayin
                ]
            );
            return redirect()->route('recruit.list')->with('status', 'Đã phê duyệt nhân viên thành công');
        }
    }

    public function updateCandidate($id, Request $request)
    {
        // dd($request->all());

        $request->validate(
            [
                'email' => 'required|email',
                'avatar' => 'image|mimes:png,jpg',
                'full_name' => 'required|min:6|max:255',
                'birthday' => 'required|date',
                'so_cccd' => 'required|min:6',
                'ngaycap_cccd' => 'required|date',
                'noicap_cccd' => 'required|min:8|max:255',
                'nguyenquan' => 'required|min:8|max:255',
                'tamtru' => 'required|min:8|max:255',
                'country' => 'required',
                'phone' => 'required',
                'religion' => 'required',
                'mattruoc_cccd' => 'image|mimes:png,jpg',
                'matsau_cccd' => 'image|mimes:png,jpg',
                'province' => 'required',
                'district' => 'required',
                'ward' => 'required',
                'recruitment' => 'required|min:6|max:255'
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài ít nhất :min ký tự',
                'max' => ':attribute có độ dài ít nhất :max ký tự',
            ],
            [
                'full_name' => 'Họ tên',
                'email' => 'Email',
                'avatar' => 'Hình ảnh cá nhân',
                'birthday' => 'Ngày sinh',
                'so_cccd' => 'Số CCCD/CMND',
                'ngaycap_cccd' => 'Ngày cấp CCCD/CMND',
                'noicap_cccd' => 'Nơi cấp CCCD/CMND',
                'nguyenquan' => 'Địa chỉ thường trú',
                'tamtru' => 'Nơi ở hiện tại',
                'phone' => 'Điện thoại',
                'religion' => 'Tôn giáo',
                'country' => 'Quốc gia',
                'religion' => 'Tôn giáo',
                'mattruoc_cccd' => 'Mặt trước CCCD/CMND',
                'matsau_cccd' => 'Mặt sau CCCD/CMND',
                'province' => 'Tỉnh/thành phố',
                'district' => 'Quận/huyện',
                'ward' => 'Phường/xã',
                'recruitment' => 'Vị trí ứng tuyển'
            ]
        );

        if($request->avatar){
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
            'email' => $request->email,
            'fullname' => $request->full_name,
            'phone' => $request->phone,
            'gioi_tinh' => $request->gender,
            'avatar' => (empty($request->avatar)) ? "public/uploads/demo.jpg" : $avatar,
            'country' => $request->country,
            'birthday' => $request->birthday,
            'tam_tru' => $request->tamtru.' '.$request->province1 . ' ' . $request->ward1 . ' ' . $request->district1,
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
            'nguyen_quan' => $request->nguyenquan.' '.$request->province . ' ' . $request->ward . ' ' . $request->district ,
            'mattruoc_cccd' => (empty($request->mattruoc_cccd)) ? "public/uploads/demo.jpg" : $mattruoc,
            'matsau_cccd' => (empty($request->matsau_cccd)) ? "public/uploads/demo.jpg" : $matsau,
            'ApprovalStatus' => 2,
            'recruitment' => $request->recruitment,
        ]);
        return redirect()->route('recruit.list')->with('status', 'Đã sửa hồ sơ thành công');

    }

    public function show($id,Request $request){
        $this->authorize('recruit.show');
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
        $user =User::findOrFail($id);
        return view('recruit.show', compact('user', 'roles', 'marriages', 'districts', 'wards', 'provinces', 'religions', 'departments', 'nations', 'positions', 'typeofemployees', 'levels', 'degrees', 'specializes', 'nationalitys'));
    }

    public function showBrowser($id,Request $request){
        $this->authorize('recruit.show');
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
        $user =User::findOrFail($id);
        return view('recruit.showBrowser', compact('user', 'roles', 'marriages', 'districts', 'wards', 'provinces', 'religions', 'departments', 'nations', 'positions', 'typeofemployees', 'levels', 'degrees', 'specializes', 'nationalitys'));
    }
}
