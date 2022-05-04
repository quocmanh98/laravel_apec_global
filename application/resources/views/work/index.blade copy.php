@extends('layouts.app')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
{{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script> --}}
@section('page_title', __('Qúa trình làm việc'))

@section('page')
    @include('includes.navbarWork')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                    <h4 class="card-title m-0">
                        Qúa trình làm việc <br>
                    </h4>
                    <div class="form-search form-inline">
                        <form action="">
                            <input type="text" name="keyword" placeholder="Qúa trình làm việc"
                                class='form-control form-search' value='{{ request()->input('keyword') }}'
                                autocomplete="off" id="search">
                            <input type="submit" value="Tìm kiếm" name='btn-search' class="btn btn-primary">
                        </form>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        {{-- <table class="table table-bordered verticle-middle table-responsive-sm">
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" name="checkall" id='checkall'>
                                    </th>
                                    <th scope="col"> # </th>
                                    <th scope="col">Mã nhân viên</th>
                                    <th scope="col">Họ tên nhân viên</th>
                                    <th scope="col">Ảnh nhân viên</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Điện thoại</th>
                                    <th scope="col">Ngày tạo</th>
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
                                                <th scope="row">{{ $t++ }}</th>
                                                <td>{{ $v->code }}</td>
                                                <td>{{ $v->fullname }}</td>
                                                <td><img src="{{ url('/') }}/{{ $v->avatar }}" alt="" class='img-fluid'></td>
                                                <td>{{ $v->email }}</td>
                                                <td>{{ $v->phone }}</td>
                                                <td>{{ $v->created_at }}</td>
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
                        </table> --}}
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
