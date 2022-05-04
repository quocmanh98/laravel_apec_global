@extends('layouts.app')
@php
use Illuminate\Support\Str;
@endphp
@section('page_title', __('Thông tin nhân viên'))

@section('page')
    <div class="row">
        <div class="col-lg-5 col-xl-4 ">
            <div class="card" style="height: auto;">
                <h6 class="card-header d-flex align-items-center justify-content-between">
                    @lang('Thông tin nhân viên')
                    <a href="{{ route('profile.edit') }}" class="btn btn-link" data-toggle="tooltip" data-placement="top"
                        title="" data-original-title="Edit User">
                        @lang('Sửa')
                    </a>
                </h6>
                <div class="card-body">
                    <div class="d-flex align-items-center flex-column pt-3">
                        <div>
                            <img class="rounded-circle img-thumbnail img-responsive mb-4" width="130" height="130"
                                src="{{ url('/') }}/{{ $user->avatar }}">
                        </div>
                        <h5>{{ $user->fullname }}</h5>
                        <a href="mailto:{{ $user->email }}" class="text-muted font-weight-light mb-2">
                            {{ $user->email }}
                        </a>
                    </div>

                    <ul class="list-group list-group-flush mt-3">
                        @if ($user->username )
                        <li class="list-group-item">
                            <strong>@lang('Tên tài khoản:')</strong>
                            {!! $user->username !!}
                        </li>
                        @endif
                        <li class="list-group-item">
                            <strong>@lang('Ngày sinh:')</strong>
                            {{ $user->birthday }}
                        </li>
                        <li class="list-group-item">
                            <strong>@lang('Quốc tịch:')</strong>
                            @foreach ($nationalitys as $k => $v)
                                @if ($v->id == $user->quoc_tich)
                                    {{ $v->nationalitys_name }}
                                @endif
                            @endforeach
                        </li>
                        <li class="list-group-item">
                            <strong>@lang('Loại nhân viên:')</strong>
                            @foreach ($typeofemployees as $k => $v)
                                @if ($v->id == $user->chuc_vu_id)
                                    {{ $v->typeofemployeess_name }}
                                @endif
                            @endforeach
                        </li>
                        <li class="list-group-item">
                            <strong>@lang('Phòng ban:')</strong>
                            @foreach ($departments as $k => $v)
                                @if ($v->id == $user->phong_ban_id)
                                    {{ $v->departments_name }}
                                @endif
                            @endforeach
                        </li>
                        <li class="list-group-item">
                            <strong>@lang('Chức vụ:')</strong>
                            @foreach ($positions as $k => $v)
                                @if ($v->id == $user->chuc_vu_id)
                                    {{ $v->positions_name }}
                                @endif
                            @endforeach
                        </li>
                        @if ($user->recruitment)
                            <li class="list-group-item">
                                <strong>@lang('Vị trí công việc:')</strong>
                                {{ $user->recruitment }}
                            </li>
                        @endif
                        <li class="list-group-item">
                            <strong>@lang('Trạng thái làm việc:')</strong>
                            @if ($user->status_work == 1)
                                Đang làm việc
                            @else
                                Đã nghỉ việc
                            @endif
                        </li>
                        <li class="list-group-item">
                            <strong>@lang('Vai trò:')</strong>
                            @foreach ($roles as $v)
                                @if ($v->id == $user->role_id)
                                    {{ $v->name }}
                                @endif
                            @endforeach
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-7 col-xl-8">
            <div class="card">
                <div class="card-header">
                    @lang("Thông tin chi tiết")
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped verticle-middle table-responsive-sm">
                            <tbody>
                                <tr>
                                    <td>@lang('Mã nhân viên')</td>
                                    <td>{{ $user->code }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('Họ tên nhân viên')</td>
                                    <td>{{ $user->fullname }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('Email')</td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('Điện thoại')</td>
                                    <td>{{ $user->phone }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('Giới tính')</td>
                                    <td>
                                        @if ($user->gioi_tinh == 0)
                                            Nam
                                        @else
                                            Nữ
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>@lang('Tình trạng hôn nhân')</td>
                                    <td>
                                        @foreach ($marriages as $k => $v)
                                            @if ($v->id == $user->hon_nhan_id)
                                                {{ $v->name }}
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td>@lang('Tôn giáo')</td>
                                    <td>
                                        @foreach ($religions as $k => $v)
                                            @if ($v->id == $user->ton_giao)
                                                {{ $v->religions_name }}
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td>@lang('Dân tộc')</td>
                                    <td>
                                        @foreach ($nations as $k => $v)
                                            @if ($v->id == $user->dan_toc_id)
                                                {{ $v->name }}
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td>@lang('Số CMND/CCCD')</td>
                                    <td>{{ $user->so_cmnd }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('Nơi cấp CMND/CCCD')</td>
                                    <td>{{ $user->noi_cap_cmnd }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('Ngày cấp CMND/CCCD')</td>
                                    <td>{{ $user->ngay_cap_cmnd }}</td>

                                </tr>
                                @if ( $user->mattruoc_cccd )
                                <tr>
                                    <td>@lang('Ảnh mặt trước CCCD/CMND')</td>
                                    <td>
                                        <img src="{{ url('/') }}/{{ $user->mattruoc_cccd }}" alt="" class="w-50">
                                    </td>
                                </tr>
                                @endif

                                @if ( $user->matsau_cccd )
                                <tr>
                                    <td>@lang('Ảnh mặt sau CCCD/CMND')</td>
                                    <td>
                                        <img src="{{ url('/') }}/{{ $user->matsau_cccd }}" alt="" class="w-50">
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <td>@lang('Trình độ')</td>
                                    <td>
                                        @foreach ($levels as $k => $v)
                                            @if ($v->id == $user->trinh_do_id)
                                                {{ $v->levels_name }}
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td>@lang('Bằng cấp')</td>
                                    <td>
                                        @foreach ($degrees as $k => $v)
                                            @if ($v->id == $user->bang_cap_id)
                                                {{ $v->degrees_name }}
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td>@lang('Chuyên môn')</td>
                                    <td>
                                        @foreach ($specializes as $k => $v)
                                            @if ($v->id == $user->chuyen_mon_id)
                                                {{ $v->specializes_name }}
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td>@lang('Địa chỉ thường trú:')</td>
                                    <td>{!! $user->nguyen_quan !!} </td>
                                </tr>
                                <tr>
                                    <td>@lang('Nơi ở hiện tại:')</td>
                                    <td>{!! $user->tam_tru !!}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
