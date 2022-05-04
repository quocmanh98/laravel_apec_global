@extends('layouts.app')
@php
$employeesCode = 'MNV' . time();
$create_at = date('Y-m-d H:i:s');
@endphp

@section('page_title', __('Thêm nhân viên'))

@section('page')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!--<form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">-->
    <!--    @csrf-->

    <!--    <div class="row">-->
    <!--        <div class="col">-->
    <!--            <div class="card">-->
    <!--                <div class="card-header">-->
    <!--                    <h4 class="card-title">{{ __('Thêm nhân viên') }}</h4>-->
    <!--                </div>-->
    <!--                <div class="card-body">-->
    <!--                    <div class="basic-form">-->

    <!--                        <div class="form-row">-->
    <!--                            <div class="form-group col-md-3">-->
    <!--                                <label>@lang('Mã nhân viên')</label>-->
    <!--                                <input type="hidden" name="code" value="{{ $employeesCode }}">-->
    <!--                                <input value="{{ $employeesCode }}" type="text"-->
    <!--                                    class="form-control @error('code') is-invalid @enderror"-->
    <!--                                    placeholder="@lang('Mã nhân viên')" disabled>-->
    <!--                                @error('code')-->
    <!--                                    <div class="invalid-feedback">-->
    <!--                                        {{ $message }}-->
    <!--                                    </div>-->
    <!--                                @enderror-->
    <!--                            </div>-->

    <!--                            <div class="form-group col-md-3">-->
    <!--                                <label>@lang('Ảnh 3x4 (Nếu có):')</label>-->
    <!--                                <input type="file" class="form-control @error('avatar') is-invalid @enderror"-->
    <!--                                    name="avatar">-->
    <!--                                @error('avatar')-->
    <!--                                    <div class="invalid-feedback">-->
    <!--                                        {{ $message }}-->
    <!--                                    </div>-->
    <!--                                @enderror-->
    <!--                            </div>-->

    <!--                            <div class="form-group col-md-3">-->
    <!--                                <label>@lang('Họ tên nhân viên')</label>-->
    <!--                                <input name="full_name" value="{{ old('full_name') }}" type="text"-->
    <!--                                    class="form-control @error('full_name') is-invalid @enderror"-->
    <!--                                    placeholder="@lang('Họ tên nhân viên')">-->
    <!--                                @error('full_name')-->
    <!--                                    <div class="invalid-feedback">-->
    <!--                                        {{ $message }}-->
    <!--                                    </div>-->
    <!--                                @enderror-->
    <!--                            </div>-->

    <!--                            <div class="form-group col-md-3">-->
    <!--                                <label>@lang('Giới tính')</label>-->
    <!--                                <select name="gender" class="form-control">-->
    <!--                                    <option value="0" @php-->
    <!--                                        if (old('gender') == 0) {-->
    <!--                                            'selected';-->
    <!--                                        }-->
    <!--                                    @endphp>Nam</option>-->
    <!--                                    <option value="1" @php-->
    <!--                                        if (old('gender') == 1) {-->
    <!--                                            'selected';-->
    <!--                                        }-->
    <!--                                    @endphp>Nữ</option>-->
    <!--                                </select>-->
    <!--                                @error('gender')-->
    <!--                                    <div class="invalid-feedback">-->
    <!--                                        {{ $message }}-->
    <!--                                    </div>-->
    <!--                                @enderror-->
    <!--                            </div>-->

    <!--                            <div class="form-group col-md-3">-->
    <!--                                <label>@lang('Tên đăng nhập')</label>-->
    <!--                                <input name="username" value="{{ old('username') }}"-->
    <!--                                    class="form-control @error('username') is-invalid @enderror"-->
    <!--                                    placeholder="@lang('Tên đăng nhập')">-->
    <!--                                @error('username')-->
    <!--                                    <div class="invalid-feedback">-->
    <!--                                        {{ $message }}-->
    <!--                                    </div>-->
    <!--                                @enderror-->
    <!--                            </div>-->

    <!--                            <div class="form-group col-md-3">-->
    <!--                                <label>@lang('Ngày sinh')</label>-->
    <!--                                <input name="birthday" value="{{ old('birthday') }}" type="date"-->
    <!--                                    class="form-control @error('birthday') is-invalid @enderror"-->
    <!--                                    placeholder="@lang('Ngày sinh')">-->
    <!--                                @error('birthday')-->
    <!--                                    <div class="invalid-feedback">-->
    <!--                                        {{ $message }}-->
    <!--                                    </div>-->
    <!--                                @enderror-->
    <!--                            </div>-->

    <!--                            <div class="form-group col-md-3">-->
    <!--                                <label>@lang('Điện thoại')</label>-->
    <!--                                <input name="phone" value="{{ old('phone') }}" type="text"-->
    <!--                                    class="form-control @error('phone') is-invalid @enderror"-->
    <!--                                    placeholder="@lang('Nhập số điện thoại')">-->
    <!--                                @error('phone')-->
    <!--                                    <div class="invalid-feedback">-->
    <!--                                        {{ $message }}-->
    <!--                                    </div>-->
    <!--                                @enderror-->
    <!--                            </div>-->

    <!--                            <div class="form-group col-md-3">-->
    <!--                                <label>@lang('Email')</label>-->
    <!--                                <input name="email" value="{{ old('email') }}" type="email"-->
    <!--                                    class="form-control @error('email') is-invalid @enderror"-->
    <!--                                    placeholder="@lang('Nhập email')">-->
    <!--                                @error('email')-->
    <!--                                    <div class="invalid-feedback">-->
    <!--                                        {{ $message }}-->
    <!--                                    </div>-->
    <!--                                @enderror-->
    <!--                            </div>-->


    <!--                            <div class="form-group col-md-3">-->
    <!--                                <label>@lang('Tình trạng hôn nhân')</label>-->
    <!--                                <select name="marriage_id" class="form-control">-->
    <!--                                    @foreach ($marriages as $k => $v)-->
    <!--                                        <option value="{{ $v->id }}">{{ $v->name }}</option>-->
    <!--                                    @endforeach-->
    <!--                                </select>-->
    <!--                                @error('marriage_id')-->
    <!--                                    <div class="invalid-feedback">-->
    <!--                                        {{ $message }}-->
    <!--                                    </div>-->
    <!--                                @enderror-->
    <!--                            </div>-->

    <!--                            <div class="form-group col-md-3">-->

    <!--                                <label>@lang('Quốc tịch')</label>-->
    <!--                                <select name="country" class="form-control">-->
    <!--                                    @foreach (countries() as $code => $country)-->
    <!--                                        <option value="{{ $code }}">{{ $country['name'] }}</option>-->
    <!--                                    @endforeach-->
    <!--                                </select>-->
    <!--                                @error('country')-->
    <!--                                    <div class="invalid-feedback">-->
    <!--                                        {{ $message }}-->
    <!--                                    </div><samp></samp>-->
    <!--                                @enderror-->
    <!--                            </div>-->

    <!--                            <div class="form-group col-md-3">-->
    <!--                                <label>@lang('Tôn giáo')</label>-->
    <!--                                <select name="religion" class="form-control">-->
    <!--                                    @foreach ($religions as $k => $v)-->
    <!--                                        <option value="{{ $v->id }}">{{ $v->religions_name }}</option>-->
    <!--                                    @endforeach-->
    <!--                                </select>-->
    <!--                                @error('religion')-->
    <!--                                    <div class="invalid-feedback">-->
    <!--                                        {{ $message }}-->
    <!--                                    </div>-->
    <!--                                @enderror-->
    <!--                            </div>-->

    <!--                            <div class="form-group col-md-3">-->
    <!--                                <label>@lang('Dân tộc')</label>-->
    <!--                                <select name="nation" class="form-control">-->
    <!--                                    @foreach ($nations as $k => $v)-->
    <!--                                        <option value="{{ $v->id }}">{{ $v->name }}</option>-->
    <!--                                    @endforeach-->
    <!--                                </select>-->
    <!--                                @error('nation')-->
    <!--                                    <div class="invalid-feedback">-->
    <!--                                        {{ $message }}-->
    <!--                                    </div>-->
    <!--                                @enderror-->
    <!--                            </div>-->

    <!--                            <div class="form-group col-md-4">-->
    <!--                                <label>@lang('Số CCCD/CMND')</label>-->
    <!--                                <input name="so_cccd" value="{{ old('so_cccd') }}"-->
    <!--                                    class="form-control @error('so_cccd') is-invalid @enderror"-->
    <!--                                    placeholder="@lang('Số CCCD')">-->
    <!--                                @error('so_cccd')-->
    <!--                                    <div class="invalid-feedback">-->
    <!--                                        {{ $message }}-->
    <!--                                    </div>-->
    <!--                                @enderror-->
    <!--                            </div>-->

    <!--                            <div class="form-group col-md-4">-->
    <!--                                <label>@lang('Ngày cấp CCCD/CMND')</label>-->
    <!--                                <input name="ngaycap_cccd" value="{{ old('ngaycap_cccd') }}" type="date"-->
    <!--                                    class="form-control @error('ngaycap_cccd') is-invalid @enderror"-->
    <!--                                    placeholder="@lang('Ngày cấp CCCD')">-->
    <!--                                @error('ngaycap_cccd')-->
    <!--                                    <div class="invalid-feedback">-->
    <!--                                        {{ $message }}-->
    <!--                                    </div>-->
    <!--                                @enderror-->
    <!--                            </div>-->

    <!--                            <div class="form-group col-md-4">-->
    <!--                                <label>@lang('Nơi cấp CCCD/CMND')</label>-->
    <!--                                <input name="noicap_cccd" value="{{ old('noicap_cccd') }}"-->
    <!--                                    class="form-control @error('noicap_cccd') is-invalid @enderror"-->
    <!--                                    placeholder="@lang('Nơi cấp CCCD')">-->
    <!--                                @error('noicap_cccd')-->
    <!--                                    <div class="invalid-feedback">-->
    <!--                                        {{ $message }}-->
    <!--                                    </div>-->
    <!--                                @enderror-->
    <!--                            </div>-->

    <!--                            <div class="form-group col-md-6">-->
    <!--                                <label>@lang('Ảnh mặt trước CCCD/CMND:')</label>-->
    <!--                                <input type="file" class="form-control @error('mattruoc_cccd') is-invalid @enderror"-->
    <!--                                    name="mattruoc_cccd">-->
    <!--                                @error('mattruoc_cccd')-->
    <!--                                    <div class="invalid-feedback">-->
    <!--                                        {{ $message }}-->
    <!--                                    </div>-->
    <!--                                @enderror-->
    <!--                            </div>-->

    <!--                            <div class="form-group col-md-6">-->
    <!--                                <label>@lang('Ảnh mặt sau CCCD/CMND:')</label>-->
    <!--                                <input type="file" class="form-control @error('matsau_cccd') is-invalid @enderror"-->
    <!--                                    name="matsau_cccd">-->
    <!--                                @error('matsau_cccd')-->
    <!--                                    <div class="invalid-feedback">-->
    <!--                                        {{ $message }}-->
    <!--                                    </div>-->
    <!--                                @enderror-->
    <!--                            </div>-->

    <!--                            <div class="form-group col-md-6">-->
    <!--                                <b><label>@lang('Nơi sinh:')</label></b> <br>-->
    <!--                                <label style="color:red">-->
    <!--                                    Chú ý:-->
    <!--                                    Địa chỉ chi tiết (Vui lòng không nhập lại tỉnh/thành, quận/huyện, phường/xã)-->
    <!--                                </label>-->
    <!--                                <div class='row'>-->
    <!--                                    <div class='col-md-6'>-->
    <!--                                        <label>@lang('Tỉnh/thành phố:')</label>-->

    <!--                                        <input type="text" id="province" name='province' list="provinces"-->
    <!--                                            placeholder="Nhập tỉnh/thành phố"-->
    <!--                                            class="form-control  @error('province') is-invalid @enderror"-->
    <!--                                            value='{{ old('province') }}'>-->
    <!--                                        <datalist id="provinces">-->
    <!--                                            @foreach ($provinces as $v)-->
    <!--                                                <option value="{{ $v->name }}">-->
    <!--                                            @endforeach-->
    <!--                                        </datalist>-->
    <!--                                        @error('province')-->
    <!--                                            <div class="invalid-feedback">-->
    <!--                                                {{ $message }}-->
    <!--                                            </div>-->
    <!--                                        @enderror-->
    <!--                                    </div>-->
    <!--                                    <div class="form-group col-md-6">-->
    <!--                                        <label>@lang('Quận/huyện:')</label>-->

    <!--                                        <input type="text" id="district" name='district' list="districts"-->
    <!--                                            placeholder="Nhập quận/huyện" value='{{ old('district') }}'-->
    <!--                                            class="form-control  @error('district') is-invalid @enderror">-->
    <!--                                        <datalist id="districts">-->
    <!--                                            @foreach ($districts as $v)-->
    <!--                                                <option value="{{ $v->name }}">-->
    <!--                                            @endforeach-->
    <!--                                        </datalist>-->
    <!--                                        @error('district')-->
    <!--                                            <div class="invalid-feedback">-->
    <!--                                                {{ $message }}-->
    <!--                                            </div>-->
    <!--                                        @enderror-->
    <!--                                    </div>-->
    <!--                                    <div class="form-group col-md-6">-->
    <!--                                        <label>@lang('Phường/xã:')</label>-->

    <!--                                        <input type="text" id="ward" name='ward' list="wards"-->
    <!--                                            placeholder="Nhập phường/xã"-->
    <!--                                            class="form-control @error('ward') is-invalid @enderror"-->
    <!--                                            value='{{ old('ward') }}'>-->
    <!--                                        <datalist id="wards">-->
    <!--                                            @foreach ($wards as $v)-->
    <!--                                                <option value="{{ $v->name }}">-->
    <!--                                            @endforeach-->
    <!--                                        </datalist>-->
    <!--                                        @error('ward')-->
    <!--                                            <div class="invalid-feedback">-->
    <!--                                                {{ $message }}-->
    <!--                                            </div>-->
    <!--                                        @enderror-->
    <!--                                    </div>-->
    <!--                                    <div class="form-group col-md-6">-->
    <!--                                        <label>Địa chỉ chi tiết: </label>-->
    <!--                                        <input type="text" name="noisinh"-->
    <!--                                            class="form-control @error('noisinh') is-invalid @enderror"-->
    <!--                                            value='{{ old('noisinh') }}'>-->
    <!--                                        @error('noisinh')-->
    <!--                                            <div class="alert alert-primary" role="alert">-->
    <!--                                                {{ $message }}-->
    <!--                                            </div>-->
    <!--                                        @enderror-->
    <!--                                    </div>-->

    <!--                                </div>-->
    <!--                            </div>-->

    <!--                            <div class="form-group col-md-6">-->
    <!--                                <b><label>@lang('Hộ khẩu:')</label></b> <br>-->
    <!--                                <label style="color:red">-->
    <!--                                    Chú ý:-->
    <!--                                    Địa chỉ chi tiết (Vui lòng không nhập lại tỉnh/thành, quận/huyện, phường/xã)-->
    <!--                                </label>-->
    <!--                                <div class='row'>-->
    <!--                                    <div class='col-md-6'>-->
    <!--                                        <label>@lang('Tỉnh/thành phố:')</label>-->

    <!--                                        <input type="text" id="province" name='province' list="provinces"-->
    <!--                                            placeholder="Nhập tỉnh/thành phố"-->
    <!--                                            class="form-control  @error('province') is-invalid @enderror"-->
    <!--                                            value='{{ old('province') }}'>-->
    <!--                                        <datalist id="provinces">-->
    <!--                                            @foreach ($provinces as $v)-->
    <!--                                                <option value="{{ $v->name }}">-->
    <!--                                            @endforeach-->
    <!--                                        </datalist>-->
    <!--                                        @error('province')-->
    <!--                                            <div class="invalid-feedback">-->
    <!--                                                {{ $message }}-->
    <!--                                            </div>-->
    <!--                                        @enderror-->
    <!--                                    </div>-->
    <!--                                    <div class="form-group col-md-6">-->
    <!--                                        <label>@lang('Quận/huyện:')</label>-->

    <!--                                        <input type="text" id="district" name='district' list="districts"-->
    <!--                                            placeholder="Nhập quận/huyện" value='{{ old('district') }}'-->
    <!--                                            class="form-control  @error('district') is-invalid @enderror">-->
    <!--                                        <datalist id="districts">-->
    <!--                                            @foreach ($districts as $v)-->
    <!--                                                <option value="{{ $v->name }}">-->
    <!--                                            @endforeach-->
    <!--                                        </datalist>-->
    <!--                                        @error('district')-->
    <!--                                            <div class="invalid-feedback">-->
    <!--                                                {{ $message }}-->
    <!--                                            </div>-->
    <!--                                        @enderror-->
    <!--                                    </div>-->
    <!--                                    <div class="form-group col-md-6">-->
    <!--                                        <label>@lang('Phường/xã:')</label>-->

    <!--                                        <input type="text" id="ward" name='ward' list="wards"-->
    <!--                                            placeholder="Nhập phường/xã"-->
    <!--                                            class="form-control @error('ward') is-invalid @enderror"-->
    <!--                                            value='{{ old('ward') }}'>-->
    <!--                                        <datalist id="wards">-->
    <!--                                            @foreach ($wards as $v)-->
    <!--                                                <option value="{{ $v->name }}">-->
    <!--                                            @endforeach-->
    <!--                                        </datalist>-->
    <!--                                        @error('ward')-->
    <!--                                            <div class="invalid-feedback">-->
    <!--                                                {{ $message }}-->
    <!--                                            </div>-->
    <!--                                        @enderror-->
    <!--                                    </div>-->
    <!--                                    <div class="form-group col-md-6">-->
    <!--                                        <label>Địa chỉ chi tiết:</label>-->
    <!--                                        <input type="text" name="hokhau"-->
    <!--                                            class="form-control @error('hokhau') is-invalid @enderror"-->
    <!--                                            value='{{ old('hokhau') }}'>-->
    <!--                                        @error('hokhau')-->
    <!--                                            <div class="alert alert-primary" role="alert">-->
    <!--                                                {{ $message }}-->
    <!--                                            </div>-->
    <!--                                        @enderror-->
    <!--                                    </div>-->

    <!--                                </div>-->
    <!--                            </div>-->

    <!--                            <div class="form-group col-md-6">-->
    <!--                                <b><label>@lang('Nguyên quán:')</label></b> <br>-->
    <!--                                <label style="color:red">-->
    <!--                                    Chú ý:-->
    <!--                                    Địa chỉ chi tiết (Vui lòng không nhập lại tỉnh/thành, quận/huyện, phường/xã)-->
    <!--                                </label>-->
    <!--                                <div class='row'>-->
    <!--                                    <div class='col-md-6'>-->
    <!--                                        <label>@lang('Tỉnh/thành phố:')</label>-->

    <!--                                        <input type="text" id="province" name='province' list="provinces"-->
    <!--                                            placeholder="Nhập tỉnh/thành phố"-->
    <!--                                            class="form-control  @error('province') is-invalid @enderror"-->
    <!--                                            value='{{ old('province') }}'>-->
    <!--                                        <datalist id="provinces">-->
    <!--                                            @foreach ($provinces as $v)-->
    <!--                                                <option value="{{ $v->name }}">-->
    <!--                                            @endforeach-->
    <!--                                        </datalist>-->
    <!--                                        @error('province')-->
    <!--                                            <div class="invalid-feedback">-->
    <!--                                                {{ $message }}-->
    <!--                                            </div>-->
    <!--                                        @enderror-->
    <!--                                    </div>-->
    <!--                                    <div class="form-group col-md-6">-->
    <!--                                        <label>@lang('Quận/huyện:')</label>-->

    <!--                                        <input type="text" id="district" name='district' list="districts"-->
    <!--                                            placeholder="Nhập quận/huyện" value='{{ old('district') }}'-->
    <!--                                            class="form-control  @error('district') is-invalid @enderror">-->
    <!--                                        <datalist id="districts">-->
    <!--                                            @foreach ($districts as $v)-->
    <!--                                                <option value="{{ $v->name }}">-->
    <!--                                            @endforeach-->
    <!--                                        </datalist>-->
    <!--                                        @error('district')-->
    <!--                                            <div class="invalid-feedback">-->
    <!--                                                {{ $message }}-->
    <!--                                            </div>-->
    <!--                                        @enderror-->
    <!--                                    </div>-->
    <!--                                    <div class="form-group col-md-6">-->
    <!--                                        <label>@lang('Phường/xã:')</label>-->

    <!--                                        <input type="text" id="ward" name='ward' list="wards"-->
    <!--                                            placeholder="Nhập phường/xã"-->
    <!--                                            class="form-control @error('ward') is-invalid @enderror"-->
    <!--                                            value='{{ old('ward') }}'>-->
    <!--                                        <datalist id="wards">-->
    <!--                                            @foreach ($wards as $v)-->
    <!--                                                <option value="{{ $v->name }}">-->
    <!--                                            @endforeach-->
    <!--                                        </datalist>-->
    <!--                                        @error('ward')-->
    <!--                                            <div class="invalid-feedback">-->
    <!--                                                {{ $message }}-->
    <!--                                            </div>-->
    <!--                                        @enderror-->
    <!--                                    </div>-->
    <!--                                    <div class="form-group col-md-6">-->
    <!--                                        <label>Địa chỉ chi tiết:</label>-->
    <!--                                        <input type="text" name="nguyennquan"-->
    <!--                                            class="form-control @error('nguyenquan') is-invalid @enderror"-->
    <!--                                            value='{{ old('nguyenquan') }}'>-->
    <!--                                        @error('nguyenquan')-->
    <!--                                            <div class="alert alert-primary" role="alert">-->
    <!--                                                {{ $message }}-->
    <!--                                            </div>-->
    <!--                                        @enderror-->
    <!--                                    </div>-->

    <!--                                </div>-->
    <!--                            </div>-->

    <!--                            <div class="form-group col-md-6">-->
    <!--                                <b><label>@lang('Nơi ở hiện tại:')</label></b> <br>-->
    <!--                                <label style="color:red">-->
    <!--                                    Chú ý:-->
    <!--                                    Địa chỉ chi tiết (Vui lòng không nhập lại tỉnh/thành, quận/huyện, phường/xã)-->
    <!--                                </label>-->
    <!--                                <div class='row'>-->
    <!--                                    <div class='col-md-6'>-->
    <!--                                        <label>@lang('Tỉnh/thành phố:')</label>-->

    <!--                                        <input type="text" id="province" name='province' list="provinces"-->
    <!--                                            placeholder="Nhập tỉnh/thành phố"-->
    <!--                                            class="form-control  @error('province') is-invalid @enderror"-->
    <!--                                            value='{{ old('province') }}'>-->
    <!--                                        <datalist id="provinces">-->
    <!--                                            @foreach ($provinces as $v)-->
    <!--                                                <option value="{{ $v->name }}">-->
    <!--                                            @endforeach-->
    <!--                                        </datalist>-->
    <!--                                        @error('province')-->
    <!--                                            <div class="invalid-feedback">-->
    <!--                                                {{ $message }}-->
    <!--                                            </div>-->
    <!--                                        @enderror-->
    <!--                                    </div>-->
    <!--                                    <div class="form-group col-md-6">-->
    <!--                                        <label>@lang('Quận/huyện:')</label>-->

    <!--                                        <input type="text" id="district" name='district' list="districts"-->
    <!--                                            placeholder="Nhập quận/huyện" value='{{ old('district') }}'-->
    <!--                                            class="form-control  @error('district') is-invalid @enderror">-->
    <!--                                        <datalist id="districts">-->
    <!--                                            @foreach ($districts as $v)-->
    <!--                                                <option value="{{ $v->name }}">-->
    <!--                                            @endforeach-->
    <!--                                        </datalist>-->
    <!--                                        @error('district')-->
    <!--                                            <div class="invalid-feedback">-->
    <!--                                                {{ $message }}-->
    <!--                                            </div>-->
    <!--                                        @enderror-->
    <!--                                    </div>-->
    <!--                                    <div class="form-group col-md-6">-->
    <!--                                        <label>@lang('Phường/xã:')</label>-->

    <!--                                        <input type="text" id="ward" name='ward' list="wards"-->
    <!--                                            placeholder="Nhập phường/xã"-->
    <!--                                            class="form-control @error('ward') is-invalid @enderror"-->
    <!--                                            value='{{ old('ward') }}'>-->
    <!--                                        <datalist id="wards">-->
    <!--                                            @foreach ($wards as $v)-->
    <!--                                                <option value="{{ $v->name }}">-->
    <!--                                            @endforeach-->
    <!--                                        </datalist>-->
    <!--                                        @error('ward')-->
    <!--                                            <div class="invalid-feedback">-->
    <!--                                                {{ $message }}-->
    <!--                                            </div>-->
    <!--                                        @enderror-->
    <!--                                    </div>-->
    <!--                                    <div class="form-group col-md-6">-->
    <!--                                        <label>Địa chỉ chi tiết:</label>-->
    <!--                                        <input type="text" name="tamtru"-->
    <!--                                            class="form-control @error('tamtru') is-invalid @enderror"-->
    <!--                                            value='{{ old('tamtru') }}'>-->
    <!--                                        @error('tamtru')-->
    <!--                                            <div class="alert alert-primary" role="alert">-->
    <!--                                                {{ $message }}-->
    <!--                                            </div>-->
    <!--                                        @enderror-->
    <!--                                    </div>-->

    <!--                                </div>-->
    <!--                            </div>-->

    <!--                            <div class="form-group col-md-6">-->
    <!--                                <label>@lang('Phòng ban')</label>-->
    <!--                                <select name="department" class="form-control">-->
    <!--                                    @foreach ($departments as $k => $v)-->
    <!--                                        <option value="{{ $v->id }}">{{ $v->departments_name }}</option>-->
    <!--                                    @endforeach-->
    <!--                                </select>-->
    <!--                                @error('department')-->
    <!--                                    <div class="invalid-feedback">-->
    <!--                                        {{ $message }}-->
    <!--                                    </div>-->
    <!--                                @enderror-->
    <!--                            </div>-->

    <!--                            <div class="form-group col-md-6">-->
    <!--                                <label>@lang('Chức vụ')</label>-->
    <!--                                <select name="position" class="form-control">-->
    <!--                                    @foreach ($positions as $k => $v)-->
    <!--                                        <option value="{{ $v->id }}">{{ $v->positions_name }}</option>-->
    <!--                                    @endforeach-->
    <!--                                </select>-->
    <!--                                @error('position')-->
    <!--                                    <div class="invalid-feedback">-->
    <!--                                        {{ $message }}-->
    <!--                                    </div>-->
    <!--                                @enderror-->
    <!--                            </div>-->

    <!--                            <div class="form-group col-md-6">-->
    <!--                                <label>@lang('Trình độ')</label>-->
    <!--                                <select name="level" class="form-control">-->
    <!--                                    @foreach ($levels as $k => $v)-->
    <!--                                        <option value="{{ $v->id }}">{{ $v->levels_name }}</option>-->
    <!--                                    @endforeach-->
    <!--                                </select>-->
    <!--                                @error('level')-->
    <!--                                    <div class="invalid-feedback">-->
    <!--                                        {{ $message }}-->
    <!--                                    </div>-->
    <!--                                @enderror-->
    <!--                            </div>-->

    <!--                            <div class="form-group col-md-6">-->
    <!--                                <label>@lang('Bằng cấp')</label>-->
    <!--                                <select name="degree" class="form-control">-->
    <!--                                    @foreach ($degrees as $k => $v)-->
    <!--                                        <option value="{{ $v->id }}">{{ $v->degrees_name }}</option>-->
    <!--                                    @endforeach-->
    <!--                                </select>-->
    <!--                                @error('degree')-->
    <!--                                    <div class="invalid-feedback">-->
    <!--                                        {{ $message }}-->
    <!--                                    </div>-->
    <!--                                @enderror-->
    <!--                            </div>-->

    <!--                            <div class="form-group col-md-6">-->
    <!--                                <label>@lang('Chuyên môn')</label>-->
    <!--                                <select name="specialize" class="form-control">-->
    <!--                                    @foreach ($specializes as $k => $v)-->
    <!--                                        <option value="{{ $v->id }}">{{ $v->specializes_name }}</option>-->
    <!--                                    @endforeach-->
    <!--                                </select>-->
    <!--                                @error('specialize')-->
    <!--                                    <div class="invalid-feedback">-->
    <!--                                        {{ $message }}-->
    <!--                                    </div>-->
    <!--                                @enderror-->
    <!--                            </div>-->


    <!--                            {{-- <div class="form-group col-md-6">-->
    <!--                                <label>@lang('Trạng thái làm việc')</label>-->
    <!--                                <select name="status_work" class="form-control" disabled>-->
    <!--                                    <option value="">Chọn </option>-->
    <!--                                    <option value="0" @if (old('status_work') == 0) selected @endif>Đã nghỉ việc</option>-->
    <!--                                    <option value="1" @if (old('status_work') == 1) selected @endif>Đang làm việc</option>-->
    <!--                                </select>-->
    <!--                                @error('status')-->
    <!--                                    <div class="invalid-feedback">-->
    <!--                                        {{ $message }}-->
    <!--                                    </div>-->
    <!--                                @enderror-->
    <!--                            </div> --}}-->

    <!--                            <div class="form-group col-md-6">-->
    <!--                                <label>@lang('Trạng thái tài khoản')</label>-->
    <!--                                <select name="status" class="form-control" disabled>-->
    <!--                                    <option value="">Chọn </option>-->
    <!--                                    <option value="active" @if (old('status') == 'active') selected @endif>Đã xác-->
    <!--                                        nhận</option>-->
    <!--                                    <option value="banned" @if (old('status') == 'banned') selected @endif>Bị chặn-->
    <!--                                    </option>-->
    <!--                                    <option value="unconfirmed" @if (old('status') == 'unconfirmed') selected @endif>Chưa-->
    <!--                                        xác nhận</option>-->
    <!--                                </select>-->
    <!--                                @error('status')-->
    <!--                                    <div class="invalid-feedback">-->
    <!--                                        {{ $message }}-->
    <!--                                    </div>-->
    <!--                                @enderror-->
    <!--                            </div>-->

    <!--                            <div class="form-group col-md-6">-->
    <!--                                <label>@lang('Role')</label>-->
    <!--                                <select name="role_id" class="form-control" disabled>-->
    <!--                                    @foreach ($roles as $role)-->
    <!--                                        <option value="{{ $role->id }}">{{ $role->name }}</option>-->
    <!--                                    @endforeach-->
    <!--                                </select>-->
    <!--                                @error('role_id')-->
    <!--                                    <div class="invalid-feedback">-->
    <!--                                        {{ $message }}-->
    <!--                                    </div>-->
    <!--                                @enderror-->
    <!--                            </div>-->



    <!--                        </div>-->


    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->



    <!--    <div class="row">-->
    <!--        <div class="col">-->
    <!--            <button type="submit" class="btn btn-success btn-lg">@lang('Thêm nhân viên')</button>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</form>-->
    
    <!--{{ route('saveinfo.store') }}-->
    
     <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">

        @csrf

        <div class="row m-auto">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h1 class="m-auto">Thêm nhân viên</h1> <br>
                    </div>
                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                        <div class="basic-form">
                            <div class="form-row">
                                <div class="form-group">
                                    <input type="hidden" name="code" value="{{ $employeesCode }}">
                                </div>

                                <div class="form-group col-md-3">
                                    <label>@lang('Ảnh:')</label>
                                    <input type="file" class="form-control @error('avatar') is-invalid @enderror"
                                        name="avatar" value='public/uploads/demo.jpg'>
                                    @error('avatar')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>@lang('Họ tên ứng viên')</label> <label class="red">(*)</label>
                                    <input name="full_name" value="{{ old('full_name') }}" type="text"
                                        class="form-control @error('full_name') is-invalid @enderror"
                                        placeholder="@lang('Họ tên ứng viên')">
                                    @error('full_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>@lang('Giới tính')</label> <label class="red">(*)</label>

                                    <select name="gender" class="form-control ">
                                        <option value="0" @if (old('gender') == 0) selected @endif>Nam</option>
                                        <option value="1" @if (old('gender') == 1) selected @endif>Nữ</option>
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>@lang('Ngày sinh')</label> <label class="red">(*)</label>
                                    <input name="birthday" value="{{ old('birthday') }}" type="date"
                                        class="form-control @error('birthday') is-invalid @enderror"
                                        placeholder="@lang('Ngày sinh')">
                                    @error('birthday')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>@lang('Điện thoại')</label> <label class="red">(*)</label>
                                    <input name="phone" value="{{ old('phone') }}" type="text"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        placeholder="@lang('Nhập số điện thoại')">
                                    @error('phone')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>@lang('Email')</label> <label class="red">(*)</label>
                                    <input name="email" value="{{ old('email') }}" type="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="@lang('Nhập email')">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>


                                <div class="form-group col-md-3">
                                    <label>@lang('Tình trạng hôn nhân')</label>
                                    <select name="marriage_id"
                                        class="form-control @error('marriage_id') is-invalid @enderror">
                                        <option value="">Chọn</option>
                                        @foreach ($marriages as $k => $v)
                                            <option value="{{ $v->id }}"
                                                @if (old('marriage_id') == $v->id) selected @endif> {{ $v->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('marriage_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">

                                    <label>@lang('Quốc tịch')</label> <label class="red">(*)</label>
                                    <select name="country" class="form-control @error('country') is-invalid @enderror">
                                        <option value="">Chọn</option>
                                        @foreach ($nationalitys  as $v)
                                            <option value="{{ $v->id }}"
                                                @if (old('country') == $v->id) selected @endif>{{ $v->nationalitys_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('country')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div><samp></samp>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>@lang('Tôn giáo')</label> <label class="red">(*)</label>
                                    <select name="religion" class="form-control @error('religion') is-invalid @enderror">
                                        <option value="">Chọn</option>
                                        @foreach ($religions as $k => $v)
                                            <option value="{{ $v->id }}"
                                                @if (old('religion') == $v->id) selected @endif>
                                                {{ $v->religions_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('religion')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>@lang('Dân tộc')</label> <label class="red">(*)</label>
                                    <select name="nation" class="form-control">
                                        @foreach ($nations as $k => $v)
                                            <option value="{{ $v->id }}"
                                                @if (old('nation') == $v->id) selected @endif> {{ $v->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('nation')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>@lang('Số CCCD/CMND')</label> <label class="red">(*)</label>
                                    <input name="so_cccd" value="{{ old('so_cccd') }}"
                                        class="form-control @error('so_cccd') is-invalid @enderror"
                                        placeholder="@lang('Số CCCD/CMND')">
                                    @error('so_cccd')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>@lang('Nơi cấp CCCD/CMND')</label> <label class="red">(*)</label>
                                    <input name="noicap_cccd" value="{{ old('noicap_cccd') }}"
                                        class="form-control @error('noicap_cccd') is-invalid @enderror"
                                        placeholder="@lang('Nơi cấp CCCD/CMND')">
                                    @error('noicap_cccd')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>@lang('Ngày cấp CCCD/CMND')</label> <label class="red">(*)</label>
                                    <input name="ngaycap_cccd" value="{{ old('ngaycap_cccd') }}" type="date"
                                        class="form-control @error('ngaycap_cccd') is-invalid @enderror"
                                        placeholder="@lang('Ngày cấp CCCD/CMND')">
                                    @error('ngaycap_cccd')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>



                                <div class="form-group col-md-4">
                                    <label>@lang('Ảnh mặt trước CCCD/CMND:')</label>
                                    <input type="file" class="form-control @error('mattruoc_cccd') is-invalid @enderror"
                                        name="mattruoc_cccd">
                                    @error('mattruoc_cccd')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label>@lang('Ảnh mặt sau CCCD/CMND:')</label>
                                    <input type="file" class="form-control @error('matsau_cccd') is-invalid @enderror"
                                        name="matsau_cccd">
                                    @error('matsau_cccd')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>


                                <div class="form-group col-md-12">

                                    <b><label>@lang('Địa chỉ thường trú:')</label></b> <label
                                        class="red">(*)</label> <br>
                                    <label style="color:red">
                                        Chú ý:
                                        Địa chỉ thường trú chi tiết (<b>Không nhập lại tỉnh/thành, quận/huyện, phường/xã
                                            !</b>)
                                    </label>
                                    {{-- <div class='row'>
                                        <div class='col-md-4'>
                                            <label>@lang('Tỉnh/thành phố:')</label>
                                            <select name="" id="" class="form-control form-control-sm js_location"
                                                data-type='city'>
                                                <option value="">Mời chọn Tỉnh/TP</option>
                                                @foreach ($provinces as $v)
                                                    <option value="{{ $v->id }}">
                                                        {{ $v->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class='col-md-4'>
                                            <label>@lang('Quận/huyện:')</label>
                                            <select id="district" class="form-control form-control-sm js_location"
                                                data-type='district'>
                                                <option>Mời chọn Quận/huyện</option>
                                            </select>
                                        </div>
                                        <div class='col-md-4'>
                                            <label>@lang('Phường/xã:')</label>
                                            <select id="wards" class="form-control form-control-sm">
                                                <option>Mời chọn Phường/xã</option>
                                            </select>
                                        </div>
                                    </div> --}}
                                    <div class='row'>
                                        <div class='col-md-4'>
                                            <label>@lang('Tỉnh/thành phố:')</label> <label
                                                class="red">(*)</label>

                                            <input type="text" id="province" name='province' list="provinces"
                                                placeholder="Nhập tỉnh/thành phố"
                                                class="form-control  @error('province') is-invalid @enderror"
                                                value='{{ old('province') }}'>
                                            <datalist id="provinces">
                                                @foreach ($provinces as $v)
                                                    <option value="{{ $v->name }}">
                                                @endforeach
                                            </datalist>
                                            @error('province')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>@lang('Quận/huyện:')</label> <label class="red">(*)</label>

                                            <input type="text" id="district" name='district' list="districts"
                                                placeholder="Nhập quận/huyện" value='{{ old('district') }}'
                                                class="form-control  @error('district') is-invalid @enderror">
                                            <datalist id="districts">
                                                @foreach ($districts as $v)
                                                    <option value="{{ $v->name }}">
                                                @endforeach
                                            </datalist>
                                            @error('district')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>@lang('Phường/xã:')</label> <label class="red">(*)</label>

                                            <input type="text" id="ward" name='ward' list="wards"
                                                placeholder="Nhập phường/xã"
                                                class="form-control @error('ward') is-invalid @enderror"
                                                value='{{ old('ward') }}'>
                                            <datalist id="wards">
                                                @foreach ($wards as $v)
                                                    <option value="{{ $v->name }}">
                                                @endforeach
                                            </datalist>
                                            @error('ward')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Địa chỉ thường trú chi tiết :</label> <label
                                                class="red">(*)</label>
                                            <input type="text" name="nguyenquan"
                                                class="form-control @error('nguyenquan') is-invalid @enderror"
                                                value='{{ old('nguyenquan') }}'
                                                placeholder="Địa chỉ thường trú chi tiết">
                                            @error('nguyenquan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <b><label>@lang('Nơi ở hiện tại:')</label></b> <label class="red">(*)</label>
                                    <br>
                                    <div class='row'>
                                        <div class="form-group col-md-12">
                                            <input type="text" name="tamtru"
                                                class="form-control @error('tamtru') is-invalid @enderror"
                                                value='{{ old('tamtru') }}' placeholder="Nơi ở hiện tại chi tiết">
                                            @error('tamtru')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>

                                <div class='col-md-12'>
                                    <b><label>@lang('Trình độ học vấn:')</label></b> <label
                                    class="red">(*)</label> <br>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>@lang('Trình độ')</label> <label class="red">(*)</label>
                                            <select name="level" class="form-control">
                                                @foreach ($levels as $k => $v)
                                                    <option value="{{ $v->id }}"
                                                        @if (old('level') == $v->id) selected @endif>
                                                        {{ $v->levels_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('level')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label>@lang('Bằng cấp')</label> <label class="red">(*)</label>
                                            <select name="degree" class="form-control">
                                                @foreach ($degrees as $k => $v)
                                                    <option value="{{ $v->id }}"
                                                        @if (old('degree') == $v->id) selected @endif>
                                                        {{ $v->degrees_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('degree')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label>@lang('Chuyên môn')</label> <label class="red">(*)</label>
                                            <select name="specialize" class="form-control">
                                                @foreach ($specializes as $k => $v)
                                                    <option value="{{ $v->id }}"
                                                        @if (old('specialize') == $v->id) selected @endif>
                                                        {{ $v->specializes_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('specialize')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class='col-md-12'>
                                    <b><label>@lang('Thông tin ứng tuyển:')</label></b> <label
                                        class="red">(*)</label> <br>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>@lang('Phòng ban')</label> <label class="red">(*)</label>
                                            <select name="department" class="form-control">
                                                @foreach ($departments as $k => $v)
                                                    <option value="{{ $v->id }}"
                                                        @if (old('department') == $v->id) selected @endif>
                                                        {{ $v->departments_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('department')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label>@lang('Chức vụ')</label> <label class="red">(*)</label>
                                            <select name="position" class="form-control">
                                                @foreach ($positions as $k => $v)
                                                    <option value="{{ $v->id }}"
                                                        @if (old('position') == $v->id) selected @endif>
                                                        {{ $v->positions_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('position')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label>@lang('Vị trí ứng tuyển:')</label> <label
                                                class="red">(*)</label>
                                            <input type="text" name='recruitment'
                                                class="form-control @error('recruitment') is-invalid @enderror"
                                                value="{{ old('recruitment') }}" placeholder="Nhập vị trí ứng tuyển">
                                            @error('recruitment')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row mb-5 ml-2">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success btn-lg">@lang('Gửi')</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
