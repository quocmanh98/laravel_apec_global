<style>
    .table tbody tr td:nth-child(4) img {
        width: 80px;
        height: 100px;
        object-fit: cover;
    }

</style>
@extends('layouts.app')
@php
$roomCode = 'MPB' . time();
$create_at = date('Y-m-d H:i:s');
@endphp
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
{{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script> --}}
@section('page_title', __('Danh sách nhân viên'))

@section('page')
    @include('includes.navbarEmployee')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                    <h4 class="card-title m-0">
                        Danh sách nhân viên
                    </h4>
                    <div class="form-search form-inline">
                        <form action="">
                            <input type="text" name="keyword" placeholder="Tìm kiếm nhân viên"
                                class='form-control form-search' value='{{ request()->input('keyword') }}'
                                autocomplete="off" id="search">
                            <input type="submit" value="Tìm kiếm" name='btn-search' class="btn btn-primary">
                        </form>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" style="text-align: center">
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" name="checkall" id='checkall'>
                                    </th>
                                    <th scope="col"> # </th>
                                    <th scope="col">Ảnh</th>
                                    <th scope="col">Họ tên</th>
                                    <th scope="col">Phòng ban</th>
                                    <th scope="col">Chức vụ</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Điện thoại</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($item->total() > 0)
                                    @if (!empty($item))
                                        @php
                                            $t = 1;
                                        @endphp
                                        @foreach ($item as $k => $v)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" class='checkitem' name='list_check[]'
                                                        value="{{ $v->id }}">
                                                </td>

                                                <td scope="row">{{ $t++ }}</td>

                                                <td>

                                                    <a href="{{ route('users.show',$v->id) }}"> <img src="{{ url('/') }}/{{ $v->avatar }}" alt="" class='img-fluid'></a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('users.show',$v->id) }}">
                                                        {{ $v->fullname }}
                                                    </a>
                                                </td>
                                                <td>
                                                    @foreach($department as $key => $value)
                                                        @if( ($value->id) == ( $v->phong_ban_id  ) )
                                                            {{ $value->departments_name  }}
                                                        @endif
                                                    @endforeach
                                            </td>
                                                <td>
                                                    @foreach($position as $key => $value)
                                                    @if( ($value->id) == ( $v->chuc_vu_id  ) )
                                                        {{ $value->positions_name  }}
                                                    @endif
                                                @endforeach
                                                </td>
                                                <td>{{ $v->email }}</td>
                                                <td>{{ $v->phone }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr class="alert alert-primary">
                                            <td colspan="7">
                                                <p>Không tìm thấy bản ghi !</p>
                                            </td>
                                        </tr>
                                    @endif
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
                        {{-- {{ $typeofemployees->links() }} --}}
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
    </div>

@endsection
