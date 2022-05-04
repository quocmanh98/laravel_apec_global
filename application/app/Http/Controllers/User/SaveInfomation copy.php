<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
use Illuminate\Support\Facades\Validator;

class SaveInfomation extends Controller
{
    public function saveinfo(){
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
        return view('user.saveinfo', compact('roles', 'marriages', 'districts', 'wards', 'provinces', 'nationality', 'religions', 'departments', 'nations', 'positions', 'typeofemployees', 'levels', 'degrees', 'specializes'));
    }

    public function store(Request $request){
        {
            // dd($request->all());

            // $request->validate(
            //     [
            //         'email' => 'required|unique:users|email',
            //         'avatar' => 'image|mimes:png,jpg',
            //         'full_name' => 'required|min:6|max:255',
            //         'birthday' => 'required|date',
            //         'so_cccd' => 'required|min:6',
            //         'ngaycap_cccd' => 'required|date',
            //         'noicap_cccd' => 'required|min:8|max:255',
            //         'nguyenquan' => 'required|min:8|max:255',
            //         'tamtru' => 'required|min:8|max:255',
            //         'country' => 'required',
            //         'phone' => 'required',
            //         'religion' => 'required',
            //         'mattruoc_cccd' => 'image|mimes:png,jpg',
            //         'matsau_cccd' => 'image|mimes:png,jpg',
            //         'province' => 'required',
            //         'district' => 'required',
            //         'ward' => 'required',
            //         'recruitment' => 'required|min:6|max:255'
            //     ],
            //     [
            //         'required' => ':attribute không được để trống',
            //         'min' => ':attribute có độ dài ít nhất :min ký tự',
            //         'max' => ':attribute có độ dài ít nhất :max ký tự',
            //     ],
            //     [
            //         'full_name' => 'Họ tên',
            //         'email' => 'Email',
            //         'avatar' => 'Hình ảnh cá nhân',
            //         'birthday' => 'Ngày sinh',
            //         'so_cccd' => 'Số CCCD/CMND',
            //         'ngaycap_cccd' => 'Ngày cấp CCCD/CMND',
            //         'noicap_cccd' => 'Nơi cấp CCCD/CMND',
            //         'nguyenquan' => 'Địa chỉ thường trú',
            //         'tamtru' => 'Nơi ở hiện tại',
            //         'phone' => 'Điện thoại',
            //         'religion' => 'Tôn giáo',
            //         'country' => 'Quốc gia',
            //         'religion' => 'Tôn giáo',
            //         'mattruoc_cccd' => 'Mặt trước CCCD/CMND',
            //         'matsau_cccd' => 'Mặt sau CCCD/CMND',
            //         'province' => 'Tỉnh/thành phố',
            //         'district' => 'Quận/huyện',
            //         'ward' => 'Phường/xã',
            //         'recruitment' => 'Vị trí ứng tuyển'
            //     ]
            //

            $validator = Validator::make($request->all(), [
                'email' => 'required|unique:users|email',
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
            ]);

            if ($validator->fails()) {
                response()->json(['errors'=>$validator->errors()]);
            }else{
                response()->json(['success'=>'Added new records.']);
            }

            $input = array();
                $avatar = $request->avatar;
                $fileavatar = $avatar->getClientOriginalName();
                $avatar->move('public/uploads',  $fileavatar);
                $avatar = "public/uploads/" .  $fileavatar;

                $mattruoc_cccd= $request->mattruoc_cccd;
                $filemattruoc = $mattruoc_cccd->getClientOriginalName();
                $mattruoc_cccd->move('public/uploads',   $filemattruoc );
                $mattruoc = "public/uploads/" .   $filemattruoc ;


                $matsau_cccd = $request->matsau_cccd;
                $filematsau =   $matsau_cccd->getClientOriginalName();
                $matsau_cccd->move('public/uploads',   $filematsau );
                $matsau = "public/uploads/" .   $filematsau ;


                User::create([
                    'code' => $request->code,
                    'email' => $request->email,
                    'fullname' => $request->full_name,
                    'phone' => $request->phone,
                    'gioi_tinh' => $request->gender,
                    'avatar' => ( empty($request->avatar)  ) ? Null : $avatar,
                    'country' => $request->country,
                    'birthday' => $request->birthday,
                    'tam_tru' => $request->province .' '. $request->ward .' '. $request->district .' '. $request->tamtru,
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
                    'nguyen_quan' => $request->province .' '. $request->ward .' '. $request->district .' '. $request->nguyenquan,
                    'mattruoc_cccd' => $mattruoc,
                    'matsau_cccd' => $matsau,
                    'ApprovalStatus' => 1,
                    'recruitment' => $request->recruitment,
                    'role_id' => 'be9df9e4-03e8-4a80-8c7d-367f4c8867db',
                ]);
                return redirect()->route('ung-vien.ung-tuyen-ho-so')->withSuccess('Công Ty Tập Đoàn Apcel xác nhận thông tin bạn đã gửi. Chúng tôi sẽ liên hệ bạn trong thời gian sớm nhất !');
        }
    }
}
