@extends('layouts.app')

@section('page_title', __('Update user information'))

@section('page')

    <div class="row">
        <div class="col">
            <div class="row">
                <form class="col-sm-12 pb-3" action="{{ route('users.update', $user->id) }}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            @lang('Thông tin')
                        </div>
                        <div class="card-body">

                            <div class="form-row">
                                @csrf
                                @method('put')

                                <div class="form-group col-md-6">
                                    <label>@lang('Email')</label>
                                    <input name="email" value="{{ old('email', $user->email) }}" type="text"
                                        class="form-control @error('email')is-invalid @enderror"
                                        placeholder="@lang('Email')">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>@lang('Username')</label>
                                    <input name="username" value="{{ old('username', $user->username) }}"
                                        class="form-control @error('username')is-invalid @enderror"
                                        placeholder="@lang('(optional)')">
                                    @error('username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>


                                <div class="form-group col-md-6">
                                    <label>@lang('Trạng thái')</label>
                                    <select name="status" class="form-control">
                                        <option value="active" @if (old('status', $user->status) == 'active') selected @endif>Đã xác nhận</option>
                                        <option value="banned" @if (old('status', $user->status) == 'banned') selected @endif>Bị chặn</option>
                                        <option value="unconfirmed" @if (old('status', $user->status) == 'unconfirmed') selected @endif>Chưa xác nhận</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>@lang('Vai trò')</label>
                                    <select name="role_id" class="form-control">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" @if ($user->role_id == $role->id) selected @endif>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>@lang('Tên')</label>
                                    <input name="first_name" value="{{ old('first_name', $user->first_name) }}"
                                        type="text" class="form-control @error('first_name')is-invalid @enderror"
                                        placeholder="@lang('Tên')">
                                    @error('first_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label>@lang('Họ')</label>
                                    <input name="last_name" value="{{ old('last_name', $user->last_name) }}" type="text"
                                        class="form-control @error('last_name')is-invalid @enderror"
                                        placeholder="@lang('Họ')">
                                    @error('last_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label>@lang('Năm sinh')</label>
                                    <input name="birthday" value="{{ old('birthday', $user->birthday) }}" type="date"
                                        class="form-control @error('birthday')is-invalid @enderror"
                                        placeholder="@lang('Date of Birth')">
                                    @error('birthday')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label>@lang('Số điện thoại')</label>
                                    <input name="phone" value="{{ old('phone', $user->phone) }}" type="text"
                                        class="form-control @error('phone')is-invalid @enderror"
                                        placeholder="@lang('Số điện thoại')">
                                    @error('phone')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label>@lang('Địa chỉ')</label>
                                    <input name="address" value="{{ old('address', $user->address) }}" type="text"
                                        class="form-control @error('address')is-invalid @enderror"
                                        placeholder="@lang('Địa chỉ')">
                                    @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">

                                    <label>@lang('Quốc gia')</label>
                                    <select name="country" class="form-control">
                                        @foreach (countries() as $code => $country)
                                            <option value="{{ $code }}" @if (old('country', $user->country) == $code) selected @endif>{{ $country['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('country')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>

                            <div class="form-row">
                                <button type="submit" class="btn btn-success btn-lg">@lang('Cập nhật')</button>
                            </div>
                        </div>
                    </div>
                </form>

                <form class="col-sm-12 pb-3" action="{{ route('users.change_password', $user->id) }}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            @lang('Đổi mật khẩu')
                        </div>
                        <div class="card-body">


                            <div class="form-group">
                                <label>@lang('Mật khẩu mới')</label>
                                <input name="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>



                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-lg">@lang('Đổi mật khẩu')</button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-4">

            <div class="card" style="height: auto;">
                <div class="card-header">
                    @lang("Thông tin User")
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang("Cập nhật mới nhất")
                            <span>{{ $user->updated_at->diffForHumans() }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang("Tạo mới")
                            <span>{{ $user->created_at->diffForHumans() }}</span>
                        </li>
                        @if ($user->email_verified_at)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                @lang("Xác minh")
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
