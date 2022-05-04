<style>
    .table tbody tr td:nth-child(3) img {
        width: 80px;
        height: 100px;
        object-fit: cover;
    }

</style>
@php
use App\Models\User;
$count_user_active = User::where('ApprovalStatus',2)->count();
$count_user_trash = User::where('ApprovalStatus',2)->onlyTrashed()->count();
$count_user_work = User::where('status_work',2)->where('ApprovalStatus',2)->count();
$count_user_no_work = User::where('status_work',1)->where('ApprovalStatus',2)->count();
@endphp
@extends('layouts.app')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
{{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script> --}}
@section('page_title', __('Quản lý nhân viên'))

@section('page')
    @include('includes.navbar')
    <div class="row">
        <div class="col-lg-12 col-md-6">
            <div class="card">
                <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                    <h3><b>Quản lý</b> nhân viên</h2>
                        <div class="form-search form-inline">
                            <form action="">
                                <input type="text" name="keyword" placeholder="Tìm kiếm nhân viên"
                                    class='form-control form-search' value='{{ request()->input('keyword') }}'
                                    autocomplete="off" id="search">
                                <input type="submit" value="Tìm kiếm" name='btn-search' class="btn btn-primary">
                            </form>
                        </div>
                        <a href="{{ route('users.create') }}" class="btn btn-secondary">Thêm nhân viên</a>

                </div>
                <form action="{{ route('users.action') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="analytic">
                            <a href="{{ request()->fullUrlWithQuery(['status' => 'active']) }}" class="text-primary">Kích
                                hoạt<span class="text-muted">({{ $count_user_active }})</span></a> |
                            <a href="{{ request()->fullUrlWithQuery(['status' => 'trash']) }}" class="text-primary">Vô
                                hiệu hoá<span class="text-muted">({{ $count_user_trash  }})</span></a> |
                            <a href="{{ request()->fullUrlWithQuery(['status' => 2]) }}" class="text-primary">Đang làm
                                việc <span class="text-muted">({{ $count_user_work }})</span></a> |
                            <a href="{{ request()->fullUrlWithQuery(['status' => 1]) }}" class="text-primary">Đã nghỉ
                                việc <span class="text-muted">({{ $count_user_no_work }})</span></a>

                        </div>
                        <div class="form-action form-inline py-3">
                            <select class="form-control mr-1" id="" name='act'>
                                <option>Chọn</option>
                                @foreach ($list_act as $k => $act)
                                    <option value='{{ $k }}'>{{ $act }}</option>
                                @endforeach
                            </select>
                            <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered verticle-middle table-responsive-sm">
                                <thead style="text-align: center">
                                    <tr>
                                        <th>
                                            <input type="checkbox" name="checkall" id='checkall'>
                                        </th>
                                        <th scope="col"> # </th>
                                        <th scope="col">Họ và tên</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Điện thoại</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Quản lý</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                    @if ($users->total() > 0)
                                        @php
                                            $t = 1;
                                        @endphp
                                        @foreach ($users as $k => $v)
                                            @if ($v->ApprovalStatus == 2)
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" class='checkitem' name='list_check[]'
                                                            value="{{ $v->id }}">
                                                    </td>
                                                    <td scope="row">{{ $t++ }}</td>
                                                    <td><a href="{{ route('users.show', $v->id) }}">
                                                            {{ $v->fullname }}
                                                        </a></td>
                                                    <td>{{ $v->email }}</td>
                                                    <td>{{ $v->phone }}</td>
                                                    <td>
                                                        @if ($v->status_work == 2)
                                                            <span class="badge badge-primary"> Đang làm việc </span>
                                                        @else
                                                            <span class="badge badge-danger"> Đã nghỉ việc </span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-primary"
                                                            href="{{ route('users.edit', $v->id) }}"
                                                            role="button">Sửa</a>
                                                        <a class="btn btn-danger"
                                                            href="{{ route('users.delete', $v->id) }}"
                                                            role="button">Xoá</a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @else
                                        <tr class="alert alert-primary">
                                            <td colspan="7">
                                                <p>Không tìm thấy bản ghi !</p>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
                <div class="card-footer">
                    <div class="float-right">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

@endsection
