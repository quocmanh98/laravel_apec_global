<style>
    .table tbody tr td:nth-child(2) img {
        width: 80px;
        height: 100px;
        object-fit: cover;
    }

</style>
@extends('layouts.app')
@php
use App\Models\User;
$count_user_all= User::all()->count();
$count_user_one= User::where('ApprovalStatus',1)->count();
$count_user_two= User::where('ApprovalStatus',2)->count();
@endphp
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
{{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script> --}}
@section('page_title', __('Danh sách ứng viên'))

@section('page')
    <div class="row">
        <div class="col-lg-12 col-md-6">
            <div class="card">
                <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                    <h3><b>Danh sách</b> ứng viên</h2>
                    <div class="form-search form-inline">
                        <form action="">
                            <input type="text" name="keyword" placeholder="Tìm kiếm ứng viên"
                                class='form-control form-search' value='{{ request()->input('keyword') }}'
                                autocomplete="off" id="search">
                            <input type="submit" value="Tìm kiếm" name='btn-search' class="btn btn-primary">
                        </form>
                    </div>

                </div>
                <form action="{{ route('recruit.action') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="analytic">
                            <a href="{{ request()->fullUrlWithQuery(['ApprovalStatus' => '0']) }}"
                                class="text-primary">Tất cả <span class="text-muted">({{ $count_user_all }})</span></a> |
                            <a href="{{ request()->fullUrlWithQuery(['ApprovalStatus' => '1']) }}"
                                class="text-primary">Chờ duyệt <span class="text-muted">({{ $count_user_one }})</span></a> |
                            <a href="{{ request()->fullUrlWithQuery(['ApprovalStatus' => '2']) }}" class="text-primary">Đã duyệt <span class="text-muted">({{ $count_user_two }})</span></a>
                        </div>
                        <div class="form-action form-inline py-3">
                            <a href="{{ route('recruit.export') }}" class="btn btn-primary">Xuất tất cả nhân viên</a>
                            {{--  <select   class="form-control mr-1" id="" name='act'>
                                <option>Chọn</option>
                                @foreach ($list_act as $k => $act)
                                    <option value='{{ $k }}'>{{ $act }}</option>
                                @endforeach
                            </select>
                            <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">  --}}
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered verticle-middle table-responsive-sm">
                                <thead style="text-align: center">
                                    <tr>
                                        <th scope="col"> # </th>
                                        <th scope="col">Họ và tên</th>
                                        <th scope="col">Vị trí công việc</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Điện thoại</th>
                                        <th scope="col">Trạng thái duyệt</th>
                                        <th scope="col">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                    @if ($users->total() > 0)
                                        @php
                                            $t = 1;
                                        @endphp
                                        @foreach ($users as $k => $v)
                                        @if ($v->ApprovalStatus == 1)
                                            <tr>
                                                <th scope="row">{{ $t++ }}</th>

                                                <td><a href="{{ route('recruit.showBrowser', $v->id) }}">
                                                        {{ $v->fullname }}
                                                    </a></td>
                                                    <td>
                                                        {{ $v->recruitment }}
                                                    </td>
                                                <td>{{ $v->email }}</td>
                                                <td>{{ $v->phone }}</td>
                                                <td>
                                                    <span class="badge badge-danger">Chờ duyệt</span>
                                                </td>
                                                <td>
                                                    <a class="btn btn-danger"
                                                    href="{{ route('recruit.edit', $v->id) }}" role="button">Xác nhận</a>
                                                </td>
                                            </tr>
                                            @else
                                            <tr>
                                                <th scope="row">{{ $t++ }}</th>
                                                <td><a href="{{ route('recruit.show', $v->id) }}">
                                                        {{ $v->fullname }}
                                                    </a></td>
                                                    <td>
                                                        {{ $v->recruitment }}
                                                    </td>
                                                <td>{{ $v->email }}</td>
                                                <td>{{ $v->phone}}</td>
                                                <td>
                                                    <span class="badge badge-primary">Đã duyệt</span>
                                                </td>
                                                <td>
                                                    {{-- <a class="btn btn-primary mt-2 mb-2"
                                                    href="{{ route('recruit.export', $v->id) }}" role="button">Xuất Excel</a> --}}
                                                    <a class="btn btn-primary"
                                                    href="{{ route('recruit.editCandidate', $v->id) }}" role="button">Cập nhật</a>
                                                </td>
                                            </tr>
                                            @endif
                                        @endforeach
                                    @else
                                        <tr class="alert alert-danger">
                                            <td colspan="8">
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
