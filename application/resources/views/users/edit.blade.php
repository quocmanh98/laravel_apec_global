@extends('layouts.app')

<style>
    .red {
        color: red;
    }

</style>

@section('page_title', __('Sửa thông tin nhân viên'))

@section('page')

    <div class="row">

        <div class="col-12">
            <form action="{{ route('users.update', $user->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h1 class="m-auto">Sửa thông tin nhân viên</h1> <br>
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
                                <div class="form-group col-md-4">
                                    <label>@lang('Mã nhân viên: ')</label> <label class="red">(*)</label>
                                    <input name="code" value="{{ $user->code }}" type="text" class="form-control"
                                        disabled>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>@lang('Họ tên: ')</label> <label class="red">(*)</label>
                                    <input name="full_name" value="{{ $user->fullname }}" type="text"
                                        class="form-control @error('full_name') is-invalid @enderror"
                                        placeholder="@lang('Nhập họ tên')">
                                    @error('full_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label>@lang('Ảnh:')</label>
                                    <input type="file" class="form-control @error('avatar') is-invalid @enderror"
                                        name="avatar">
                                    {{-- <img src="{{ url('/') }}/{{ $user->avatar }}" alt="" class='w-50 img-fluid'> --}}
                                    @error('avatar')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label>@lang('Giới tính')</label> <label class="red">(*)</label>

                                    <select name="gender" class="form-control ">
                                        <option value="0" @if ($user->gioi_tinh == 0) selected @endif>Nam</option>
                                        <option value="1" @if ($user->gioi_tinh == 1) selected @endif>Nữ</option>
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label>@lang('Ngày sinh')</label> <label class="red">(*)</label>
                                    <input name="birthday" value="{{ $user->birthday }}" type="date"
                                        class="form-control @error('birthday') is-invalid @enderror"
                                        placeholder="@lang('Ngày sinh')">
                                    @error('birthday')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label>@lang('Điện thoại')</label>
                                    <input name="phone" value="{{ $user->phone }}" type="text" class="form-control"
                                        disabled>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>@lang('Email')</label>
                                    <input name="email" value="{{ $user->email }}" type="email" class="form-control"
                                        placeholder="@lang('Nhập email')" disabled>
                                </div>


                                <div class="form-group col-md-4">
                                    <label>@lang('Tình trạng hôn nhân')</label>
                                    <select name="marriage_id"
                                        class="form-control @error('marriage_id') is-invalid @enderror">
                                        <option value="">Chọn</option>
                                        @foreach ($marriages as $k => $v)
                                            <option value="{{ $v->id }}"
                                                @if ($user->hon_nhan_id == $v->id) selected @endif> {{ $v->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('marriage_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">

                                    <label>@lang('Quốc tịch')</label> <label class="red">(*)</label>
                                    <select name="country" class="form-control @error('country') is-invalid @enderror">
                                        <option value="">Chọn</option>
                                        @foreach ($nationalitys as $v)
                                            <option value="{{ $v->id }}"
                                                @if ($user->quoc_tich == $v->id) selected @endif>
                                                {{ $v->nationalitys_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('country')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div><samp></samp>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label>@lang('Tôn giáo')</label> <label class="red">(*)</label>
                                    <select name="religion" class="form-control @error('religion') is-invalid @enderror">
                                        <option value="">Chọn</option>
                                        @foreach ($religions as $k => $v)
                                            <option value="{{ $v->id }}"
                                                @if ($user->hon_nhan_id == $v->id) selected @endif>
                                                {{ $v->religions_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('religion')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label>@lang('Dân tộc')</label> <label class="red">(*)</label>
                                    <select name="nation" class="form-control">
                                        @foreach ($nations as $k => $v)
                                            <option value="{{ $v->id }}"
                                                @if ($user->dan_toc_id == $v->id) selected @endif> {{ $v->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('nation')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label>@lang('Số CCCD/CMND')</label> <label class="red">(*)</label>
                                    <input name="so_cccd" value="{{ $user->so_cmnd }}"
                                        class="form-control @error('so_cccd') is-invalid @enderror"
                                        placeholder="@lang('Số CCCD/CMND')">
                                    @error('so_cccd')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>



                                <div class="form-group col-md-3">
                                    <label>@lang('Ngày cấp CCCD/CMND')</label> <label class="red">(*)</label>
                                    <input name="ngaycap_cccd" value="{{ $user->ngay_cap_cmnd }}" type="date"
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
                                    <label>@lang('Nơi cấp CCCD/CMND')</label> <label class="red">(*)</label>
                                    <input name="noicap_cccd" value="{{ $user->noi_cap_cmnd }}"
                                        class="form-control @error('noicap_cccd') is-invalid @enderror"
                                        placeholder="@lang('Nơi cấp CCCD/CMND')">
                                    @error('noicap_cccd')
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
                                    <div class='row'>
                                        <div class='col-md-4'>
                                            <label>@lang('Tỉnh/thành phố:')</label> <label
                                                class="red">(*)</label>

                                            <input type="text" id="province" name='province' list="provinces"
                                                placeholder="Nhập tỉnh/thành phố"
                                                class="form-control  @error('province') is-invalid @enderror"
                                                value='{{ $user->province }}'>
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
                                                placeholder="Nhập quận/huyện" value='{{ $user->district }}'
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
                                                value='{{ $user->ward }}'>
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
                                                value=" {!! $user->nguyen_quan !!}" placeholder="Địa chỉ thường trú chi tiết">
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
                                            <textarea name="tamtru" id="textarea" cols="10" rows="2"
                                                class="form-control @error('tamtru') is-invalid @enderror">{!! $user->tam_tru !!}</textarea>
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
                                                        @if ($user->trinh_do_id == $v->id) selected @endif>
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
                                                        @if ($user->bang_cap_id == $v->id) selected @endif>
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
                                                        @if ($user->chuyen_mon_id == $v->id) selected @endif>
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
                                    <b><label>@lang('Thông tin công việc:')</label></b> <label
                                        class="red">(*)</label> <br>
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label>@lang('Phòng ban')</label> <label class="red">(*)</label>
                                            <select name="department" class="form-control">
                                                @foreach ($departments as $k => $v)
                                                    <option value="{{ $v->id }}"
                                                        @if ($user->phong_ban_id == $v->id) selected @endif>
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

                                        <div class="form-group col-md-3">
                                            <label>@lang('Chức vụ')</label> <label class="red">(*)</label>
                                            <select name="position" class="form-control">
                                                @foreach ($positions as $k => $v)
                                                    <option value="{{ $v->id }}"
                                                        @if ($user->chuc_vu_id == $v->id) selected @endif>
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

                                        <div class="form-group col-md-3">
                                            <label>@lang('Loại nhân viên')</label> <label
                                                class="red">(*)</label>
                                            <select name="type" class="form-control @error('type') is-invalid @enderror">
                                                <option value="">Chọn</option>
                                                @foreach ($typeofemployees as $k => $v)
                                                    <option value="{{ $v->id }}"
                                                        @if ($user->loai_nv_id == $v->id) selected @endif>
                                                        {{ $v->typeofemployeess_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('type')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label>@lang('Vị trí công việc:')</label> <label
                                                class="red">(*)</label>
                                            <input type="text" name='recruitment'
                                                class="form-control @error('recruitment') is-invalid @enderror"
                                                value="{{ $user->recruitment }}" placeholder="Nhập vị trí công việc">
                                            @error('recruitment')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>

                                <div class='col-md-6'>
                                    <label>@lang('Trạng thái làm việc')</label> <label class="red">(*)</label>
                                    <select name="status_work"
                                        class="form-control @error('status_work') is-invalid @enderror">
                                        <option value="">Chọn</option>
                                        <option value="2" @if ($user->status_work == 2) selected @endif>Đang làm việc
                                        </option>
                                        <option value="1" @if ($user->status_work == 1) selected @endif>Đã nghỉ việc
                                        </option>
                                    </select>
                                    @error('status_work')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class='col-md-6'>
                                    <label>@lang('Vai trò:')</label> <label class="red">(*)</label>
                                    <select name="role" class="form-control @error('role') is-invalid @enderror">
                                        @foreach ($roles as $k => $v)
                                            <option value="{{ $v->id }}"
                                                @if ($user->role_id == $v->id) selected @endif>
                                                {{ $v->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
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
            </form>
        </div>
    </div>

@endsection
