@extends('layouts.app')

@section('page_title', __('Thông tin nhân viên'))

@section('page')
    <div class="row">

        <div class="col-lg-6 col-xl-12">
            <div class="card">
                <h6 class="card-header d-flex align-items-center justify-content-between">
                    @lang('Thông tin nhân viên')
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-link" data-toggle="tooltip"
                        data-placement="top" title="" data-original-title="Edit User">
                        @lang('Sửa')
                    </a>
                </h6>
                <div class="card-body">
                    <div class="basic-form">

                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label>@lang('Mã nhân viên')</label>
                                <input value="{{ $user->code }}" type="text" class="form-control"
                                    placeholder="@lang('Mã nhân viên')" disabled>
                            </div>


                            <div class="form-group col-md-3">
                                <label>@lang('Hình ảnh')</label> <br>
                                <img src="{{ url('/') }}/{{ $user->avatar }}" alt="" style="max-width:75%"
                                    class="img-fluid" disabled>
                            </div>

                            <div class="form-group col-md-6">
                                <label>@lang('Họ tên nhân viên')</label>
                                <input name="full_name" value="{{ $user->fullname }}" type="text" class="form-control"
                                    placeholder="@lang('Họ tên nhân viên')" disabled>
                            </div>

                            <div class="form-group col-md-3">
                                <label>@lang('Giới tính')</label>
                                <select name="gender" class="form-control" disabled>
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
                            </div>

                            <div class="form-group col-md-3">
                                <label>@lang('Tên đăng nhập')</label>
                                <input name="username" value="{{ $user->username }}" class="form-control"
                                    placeholder="@lang('Tên đăng nhập')" disabled>
                            </div>

                            <div class="form-group col-md-3">
                                <label>@lang('Ngày sinh')</label>
                                <input name="birthday" value="{{ $user->birthday }}" type="date" class="form-control"
                                    disabled placeholder="@lang('Ngày sinh')" disabled>
                            </div>

                            <div class="form-group col-md-3">
                                <label>@lang('Điện thoại')</label>
                                <input name="phone" value="{{ $user->phone }}" type="text" class="form-control"
                                    placeholder="@lang('Nhập số điện thoại')" disabled>
                            </div>

                            <div class="form-group col-md-3">
                                <label>@lang('Email')</label>
                                <input name="email" value="{{ $user->email }}" type="email" class="form-control"
                                    placeholder="@lang('Nhập email')" disabled>
                            </div>


                            <div class="form-group col-md-3">
                                <label>@lang('Tình trạng hôn nhân')</label>
                                <select name="marriage_id" class="form-control" disabled>
                                    @foreach ($marriages as $k => $v)
                                        @if ($user->hon_nhan_id == $v->id)
                                            <option value="{{ $v->id }}">{{ $v->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-3">

                                <label>@lang('Quốc tịch')</label>
                                <select name="country" class="form-control" disabled>
                                    @foreach ( $nationality as $k => $v)
                                        @if ($user->quoc_tich == $v->id)
                                            <option value="{{  $v->id }}">{{ $v->nationalitys_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('country')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div><samp></samp>
                                @enderror
                            </div>

                            <div class="form-group col-md-3">
                                <label>@lang('Tôn giáo')</label>
                                <select name="religion" class="form-control" disabled>
                                    @foreach ($religions as $k => $v)
                                        @if ($user->ton_giao == $v->id)
                                            <option value="{{ $v->id }}">{{ $v->religions_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('religion')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-3">
                                <label>@lang('Dân tộc')</label>
                                <select name="nation" class="form-control" disabled>
                                    @foreach ($nations as $k => $v)
                                        @if ($user->dan_toc_id == $v->id)
                                            <option value="{{ $v->id }}">{{ $v->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('nation')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-3">
                                <label>@lang('Số CCCD/CMND')</label>
                                <input name="so_cccd" value="{{ $user->so_cmnd }}" class="form-control"
                                    placeholder="@lang('Số CCCD/CMND')" disabled>
                            </div>

                            <div class="form-group col-md-3">
                                <label>@lang('Ngày cấp CCCD/CMND')</label>
                                <input name="ngaycap_cccd" value="{{ $user->ngay_cap_cmnd }}" type="date"
                                    class="form-control" placeholder="@lang('Ngày cấp CCCD')" disabled>
                            </div>
                            <br>


                            <div class="form-group col-md-4">
                                <label>@lang('Ảnh mặt trước CCCD/CMND:')</label>
                               <br>
                                <img src="{{ url('/') }}/{{ $user->mattruoc_cccd }}" alt="" class="img-fluid"
                                    style="max-width:50%" disabled>
                            </div>

                            <div class="form-group col-md-4">
                                <label>@lang('Ảnh mặt sau CCCD/CMND:')</label> <br>
                                <img src="{{ url('/') }}/{{ $user->matsau_cccd }}" alt="" class="img-fluid"
                                    style="max-width:50%" disabled>
                            </div>

                            <div class="form-group col-md-3">
                                <label>@lang('Nơi cấp CCCD/CMND')</label>
                                <input name="noicap_cccd" value="{{ $user->noi_cap_cmnd }}" class="form-control"
                                    placeholder="@lang('Nơi cấp CCCD')" disabled>
                            </div>

                            <div class="form-group col-md-6">
                                <label>@lang('Nguyên quán')</label>
                                <textarea name="nguyenquan" id="mytextarea" class="form-control" cols="30"
                                    rows="5" disabled>{{ $user->nguyen_quan }}</textarea>
                            </div>

                            <div class="form-group col-md-6">
                                <label>@lang('Tạm trú')</label>
                                <textarea name="tamtru" id="mytextarea" class="form-control" cols="30" rows="5" disabled>{{ $user->tam_tru }}</textarea>
                            </div>

                            <div class="form-group col-md-4">
                                <label>@lang('Loại nhân viên')</label>
                                <select name="typeofemployees" class="form-control" disabled>
                                    @foreach ($typeofemployees as $k => $v)
                                        @if ($user->loai_nv_id == $v->id)
                                            <option value="{{ $v->id }}">{{ $v->typeofemployeess_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label>@lang('Phòng ban')</label>
                                <select name="department" class="form-control" disabled>
                                    @foreach ($departments as $k => $v)
                                        @if ($user->phong_ban_id == $v->id)
                                            <option value="{{ $v->id }}">{{ $v->departments_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label>@lang('Chức vụ')</label>
                                <select name="position" class="form-control" disabled>
                                    @foreach ($positions as $k => $v)
                                        @if ($user->chuc_vu_id == $v->id)
                                            <option value="{{ $v->id }}">{{ $v->positions_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label>@lang('Trình độ')</label>
                                <select name="level" class="form-control" disabled>
                                    @foreach ($levels as $k => $v)
                                        @if ($user->trinh_do_id == $v->id)
                                            <option value="{{ $v->id }}">{{ $v->levels_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label>@lang('Bằng cấp')</label>
                                <select name="degree" class="form-control" disabled>
                                    @foreach ($degrees as $k => $v)
                                        @if ($user->bang_cap_id == $v->id)
                                            <option value="{{ $v->id }}">{{ $v->degrees_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label>@lang('Chuyên môn')</label>
                                <select name="specialize" class="form-control" disabled>
                                    @foreach ($specializes as $k => $v)
                                        @if ($user->chuyen_mon_id == $v->id)
                                            <option value="{{ $v->id }}">{{ $v->specializes_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group col-md-4">
                                <label>@lang('Trạng thái làm việc')</label>
                                <select name="status_work" class="form-control" disabled>
                                    <option value="">Chọn </option>
                                    <option value="1" @if ($user->status_work == 1) selected @endif>Đã nghỉ việc
                                    </option>
                                    <option value="2" @if ($user->status_work == 2) selected @endif>Đang làm việc
                                    </option>
                                </select>
                            </div>


                            <div class="form-group col-md-4">
                                <label>@lang('Role')</label>
                                <select name="role_id" class="form-control" disabled>
                                    @foreach ($roles as $role)
                                        @if ($user->role_id == $role->id)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>



                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('footer-asset')
@endpush

@push('head-asset')
@endpush
