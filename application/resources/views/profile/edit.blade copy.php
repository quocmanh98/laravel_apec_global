@extends('layouts.app')

@section('page_title', __('Thay đổi thông tin'))

@section('page')

    <div class="row">
        <div class="col ">
            <div class="row ">
                <form class="col-sm-12 pb-3" action="{{ route('profile.update') }}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            @lang('Thông tin cơ bản')
                        </div>
                        <div class="form-row p-4">
                            <div class="form-group col-md-3">
                                <label>@lang('Mã nhân viên')</label>
                                <input value="{{ $user->code }}" type="text"
                                    class="form-control"
                                    placeholder="@lang('Mã nhân viên')" disabled>
                            </div>

                            <div class="form-group col-md-6">
                                <label>@lang('Ảnh 3x4 (Nếu có):')</label>
                                <input type="file" class="form-control @error('avatar') is-invalid @enderror"
                                    name="avatar">
                                @error('avatar')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-3">
                                <img src="{{ url('/') }}/{{ $user->avatar }}" alt="" style="max-width:50%">
                            </div>

                            <div class="form-group col-md-6">
                                <label>@lang('Họ tên nhân viên')</label>
                                <input name="full_name" value="{{ $user->fullname }}" type="text"
                                    class="form-control @error('full_name') is-invalid @enderror"
                                    placeholder="@lang('Họ tên nhân viên')">
                                @error('full_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label>@lang('Giới tính')</label>
                                <select name="gender" class="form-control">
                                    <option value="0" @php
                                        if ($user->gioi_tinh == 0) {
                                            'selected';
                                        }
                                    @endphp>Nam</option>
                                    <option value="1" @php
                                        if ($user->gioi_tinh == 1) {
                                            'selected';
                                        }
                                    @endphp>Nữ</option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label>@lang('Tên đăng nhập')</label>
                                <input name="username" value="{{ $user->username }}"
                                    class="form-control @error('username') is-invalid @enderror"
                                    placeholder="@lang('Tên đăng nhập')">
                                @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label>@lang('Ngày sinh')</label>
                                <input name="birthday" value="{{ $user->birthday }}" type="date"
                                    class="form-control @error('birthday') is-invalid @enderror"
                                    placeholder="@lang('Ngày sinh')">
                                @error('birthday')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label>@lang('Điện thoại')</label>
                                <input name="phone" value="{{ $user->phone }}" type="text"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    placeholder="@lang('Nhập số điện thoại')">
                                @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label>@lang('Email')</label>
                                <input name="email" value="{{ $user->email }}" type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="@lang('Nhập email')">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                            <div class="form-group col-md-6">
                                <label>@lang('Tình trạng hôn nhân')</label>
                                <select name="marriage_id" class="form-control">
                                    @foreach ($marriages as $k => $v)
                                    <option value="{{ $v->id }}">{{ $v->name }}</option>
                                    @endforeach
                                </select>
                                @error('marriage_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">

                                <label>@lang('Quốc tịch')</label>
                                <select name="country" class="form-control">
                                    @foreach (countries() as $code => $country)
                                    <option value="{{ $code }}">{{ $country['name'] }}</option>
                                    @endforeach
                                </select>
                                @error('country')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div><samp></samp>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label>@lang('Tôn giáo')</label>
                                <select name="religion" class="form-control">
                                    @foreach ($religions as $k => $v)
                                    <option value="{{ $v->id }}">{{ $v->religions_name }}</option>
                                    @endforeach
                                </select>
                                @error('religion')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label>@lang('Dân tộc')</label>
                                <select name="nation" class="form-control">
                                    @foreach ($nations as $k => $v)
                                        <option value="{{ $v->id }}">{{ $v->name }}</option>
                                    @endforeach
                                </select>
                                @error('nation')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label>@lang('Số CCCD/CMND')</label>
                                <input name="so_cccd" value="{{ $user->so_cmnd }}"
                                    class="form-control @error('so_cccd') is-invalid @enderror"
                                    placeholder="@lang('Số CCCD/CMND')">
                                @error('so_cccd')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label>@lang('Ngày cấp CCCD/CMND')</label>
                                <input name="ngaycap_cccd" value="{{ $user->ngay_cap_cmnd }}" type="date"
                                    class="form-control @error('ngaycap_cccd') is-invalid @enderror"
                                    placeholder="@lang('Ngày cấp CCCD')">
                                @error('ngaycap_cccd')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <br>


                            <div class="form-group col-md-6">
                                <label>@lang('Ảnh mặt trước CCCD/CMND:')</label>
                                <input type="file" class="form-control @error('mattruoc_cccd') is-invalid @enderror"
                                    name="mattruoc_cccd"> <br>
                                    <img src="{{ url('/') }}/{{ $user->mattruoc_cccd }}" alt="" class="img-fluid" style="max-width:25%">
                                @error('mattruoc_cccd')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label>@lang('Ảnh mặt sau CCCD/CMND:')</label>
                                <input type="file" class="form-control @error('matsau_cccd') is-invalid @enderror"
                                    name="matsau_cccd">  <br>
                                    <img src="{{ url('/') }}/{{ $user->matsau_cccd }}" alt="" class="img-fluid" style="max-width:25%">
                                @error('matsau_cccd')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label>@lang('Nơi cấp CCCD/CMND')</label>
                                <input name="noicap_cccd" value="{{ $user->noi_cap_cmnd }}"
                                    class="form-control @error('noicap_cccd') is-invalid @enderror"
                                    placeholder="@lang('Nơi cấp CCCD')">
                                @error('noicap_cccd')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label>@lang('Tỉnh:')</label>

                                <input type="text" id="province" name='province' list="provinces"
                                    placeholder="Nhập tỉnh"
                                    class="form-control  @error('province') is-invalid @enderror" value='{{ $user->province }}'>
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


                            <div class="form-group col-md-6">
                                <label>@lang('Huyện:')</label>

                                <input type="text" id="district" name='district' list="districts"
                                    placeholder="Nhập huyện" value='{{ $user->district }}'
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


                            <div class="form-group col-md-6">
                                <label>@lang('Phường:')</label>

                                <input type="text" id="ward" name='ward' list="wards" placeholder="Nhập phường"
                                    class="form-control @error('ward') is-invalid @enderror"  value='{{ $user->ward }}'>
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



                            <div class="form-group col-md-6">
                                <label>@lang('Nơi sinh')</label>
                                <textarea name="noisinh" id="mytextarea" class="form-control @error('noisinh') is-invalid @enderror" cols="30"
                                    rows="5">{{ $user->noi_sinh }}</textarea>

                                @error('noisinh')
                                    <div class="alert alert-primary" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">

                                <label>@lang('Hộ khẩu')</label>
                                <textarea name="hokhau" id="mytextarea" class="form-control @error('hokhau') is-invalid @enderror" cols="30"
                                    rows="5">{{ $user->ho_khau }}</textarea>
                                @error('hokhau')
                                <div class="alert alert-primary" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label>@lang('Nguyên quán')</label>
                                <textarea name="nguyenquan" id="mytextarea" class="form-control @error('nguyenquan') is-invalid @enderror" cols="30"
                                    rows="5">{{ $user->nguyen_quan}}</textarea>
                                @error('nguyenquan')
                                <div class="alert alert-primary" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label>@lang('Tạm trú')</label>
                                <textarea name="tamtru" id="mytextarea" class="form-control @error('tamtru') is-invalid @enderror" cols="30"
                                    rows="5">{{ $user->tam_tru }}</textarea>
                                @error('tamtru')
                                <div class="alert alert-primary" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label>@lang('Loại nhân viên')</label>
                                <select name="typeofemployees" class="form-control">
                                    @foreach ($typeofemployees as $k => $v)
                                        <option value="{{ $v->id }}">{{ $v->typeofemployeess_name }}</option>
                                    @endforeach
                                </select>
                                @error('typeofemployees')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label>@lang('Phòng ban')</label>
                                <select name="department" class="form-control">
                                    @foreach ( $departments as $k => $v)
                                        <option value="{{ $v->id }}">{{ $v->departments_name }}</option>
                                    @endforeach
                                </select>
                                @error('department')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label>@lang('Chức vụ')</label>
                                <select name="position" class="form-control">
                                    @foreach ( $positions as $k => $v)
                                        <option value="{{ $v->id }}">{{ $v->positions_name }}</option>
                                    @endforeach
                                </select>
                                @error('position')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label>@lang('Trình độ')</label>
                                <select name="level" class="form-control">
                                    @foreach ( $levels as $k => $v)
                                        <option value="{{ $v->id }}">{{ $v->levels_name }}</option>
                                    @endforeach
                                </select>
                                @error('level')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label>@lang('Bằng cấp')</label>
                                <select name="degree" class="form-control">
                                    @foreach ( $degrees as $k => $v)
                                        <option value="{{ $v->id }}">{{ $v->degrees_name }}</option>
                                    @endforeach
                                </select>
                                @error('degree')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label>@lang('Chuyên môn')</label>
                                <select name="specialize" class="form-control">
                                    @foreach ( $specializes as $k => $v)
                                        <option value="{{ $v->id }}">{{ $v->specializes_name }}</option>
                                    @endforeach
                                </select>
                                @error('specialize')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                            <div class="form-group col-md-6">
                                <label>@lang('Trạng thái làm việc')</label>
                                <select name="status_work" class="form-control">
                                    <option value="">Chọn </option>
                                    <option value="0" @if ($user->status_work  == 0) selected @endif>Đã nghỉ việc</option>
                                    <option value="1" @if ($user->status_work == 1) selected @endif>Đang làm việc</option>
                                </select>
                                @error('status_work')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label>@lang('Trạng thái tài khoản')</label>
                                <select name="status" class="form-control">
                                    <option value="">Chọn </option>
                                    <option value="active" @if ($user->status == 'active') selected @endif>Đã xác nhận</option>
                                    <option value="banned" @if ($user->status == 'banned') selected @endif>Bị chặn</option>
                                    <option value="unconfirmed" @if ($user->status == 'unconfirmed') selected @endif>Chưa xác nhận</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6" >
                                <label>@lang('Role')</label>
                                <select name="role_id" class="form-control">
                                    @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-row">
                                <button type="submit" class="btn btn-success btn-lg">@lang('Update User')</button>
                            </div>

                        </div>
                    </div>
                </form>

                <form class="col-sm-12 pb-3" action="{{ route('profile.change_password') }}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            @lang('Change Password')
                        </div>
                        <div class="card-body">


                            <div class="form-group">
                                <label>@lang('Current Password')</label>
                                <input name="current_password" type="password"
                                    class="form-control @error('current_password') is-invalid @enderror">
                                @error('current_password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label>@lang('New Password')</label>
                                <input name="new_password" type="password"
                                    class="form-control @error('new_password') is-invalid @enderror">
                                @error('new_password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label>@lang('New Confirm Password')</label>
                                <input name="new_confirm_password" type="password"
                                    class="form-control @error('new_confirm_password') is-invalid @enderror">
                                @error('new_confirm_password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-lg">@lang('Change Password')</button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-4">

            <div class="card" style="height: auto;">
                <div class="card-header">
                    @lang("User Info")
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang("Last Update")
                            <span>{{ $user->updated_at->diffForHumans() }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang("Created")
                            <span>{{ $user->created_at->diffForHumans() }}</span>
                        </li>
                        @if ($user->email_verified_at)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                @lang("Verified at")
                                <span>{{ $user->email_verified_at->diffForHumans() }}</span>
                            </li>
                        @endif

                        @if ($user->last_login_at)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                @lang("Last Logged In")
                                <span>{{ $user->last_login_at->diffForHumans() }}</span>
                            </li>
                        @endif

                    </ul>
                </div>
            </div>
        </div>
    </div>


@endsection
