@extends('layouts.app')
@php
$roomCode = 'MBC' . time();
$create_at = date('Y-m-d H:i:s');
@endphp
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
{{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script> --}}
@section('page_title', __('Quản lý bằng cấp'))

@section('page')
    @include('includes.navbar')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                    <h4 class="card-title m-0">{{ __('Quản lý bằng cấp') }}</h4>
                    <div class="form-search form-inline">
                        <form action="">
                            <input type="text" name="keyword" placeholder="Tìm kiếm bằng cấp"
                                class='form-control form-search' value='{{ request()->input('keyword') }}'
                                autocomplete="off" id="search">
                            <input type="submit" value="Tìm kiếm" name='btn-search' class="btn btn-primary">
                        </form>
                    </div>
                    <a href="{{ route('admin.degree.add') }}" class="btn btn-secondary">Thêm bằng cấp</a>

                </div>
                <form action="{{ route('admin.degree.action') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="analytic">
                            <a href="{{ request()->fullUrlWithQuery(['status' => 'active']) }}"
                                class="text-primary">Kích
                                hoạt<span class="text-muted">({{ $count[0] }})</span></a>
                            <a href="{{ request()->fullUrlWithQuery(['status' => 'trash']) }}" class="text-primary">Vô
                                hiệu hoá<span class="text-muted">({{ $count[1] }})</span></a>
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
                                <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" name="checkall" id='checkall'>
                                        </th>
                                        <th scope="col"> # </th>
                                        <th scope="col">Mã bằng cấp</th>
                                        <th scope="col">Tên bằng cấp</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Ngày tạo</th>
                                        <th scope="col">Quản lý</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($degree->total() > 0)
                                        @php
                                            $t = 1;
                                        @endphp
                                        @foreach ($degree as $k => $v)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" class='checkitem' name='list_check[]'
                                                        value="{{ $v->id }}">
                                                </td>
                                                <th scope="row">{{ $t++ }}</th>
                                                <td>{{ $v->degrees_code }}</td>
                                                <td>{{ $v->degrees_name }}</td>
                                                <td>
                                                    <div class="form-group col-md-6">
                                                        @if ($v->degrees_status == 1)
                                                            <span class="badge badge-primary">Hiện</span>
                                                        @else
                                                            <span class="badge badge-danger">Ẩn</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>{{ $v->created_at }}</td>
                                                <td>
                                                    <a class="btn btn-primary"
                                                        href="{{ route('admin.degree.edit', $v->id) }}"
                                                        role="button">Sửa</a>
                                                    <a class="btn btn-danger"
                                                        href="{{ route('admin.degree.delete', $v->id) }}"
                                                        role="button">Xoá</a>
                                                </td>
                                            </tr>
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
                        {{ $degree->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

@endsection
