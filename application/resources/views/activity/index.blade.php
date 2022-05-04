@extends('layouts.app')

@section('page_title', __('Nhật ký hoạt động người dùng'))

@section('page')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{__('Nhật ký hoạt động người dùng')}}</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped verticle-middle table-responsive-sm">
                        <thead>
                            <tr>
                                <th scope="col">@lang('Tài khoản')</th>
                                <th scope="col">@lang('Trạng thái')</th>
                                <th scope="col">@lang('Địa chỉ IP')</th>
                                <th scope="col">@lang('Thiết bị')</th>
                                <th scope="col">@lang('Hệ điều hành')</th>
                                <th scope="col">@lang('Trình duyệt')</th>
                                <th scope="col">@lang('Thời gian')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $value)
                            <tr>
                                <td>{{ $value->user->fullname }}</td>
                                <td>{{ $value->description }}</td>
                                <td> {{ $value->ip_address }} </td>
                                <td> {{ $value->device }} </td>
                                <td> {{ $value->platform }} </td>
                                <td> {{ $value->browser }} </td>
                                <td> {{ $value->created_at->diffForHumans() }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <div class="float-right">
                    {{$data->links()}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
