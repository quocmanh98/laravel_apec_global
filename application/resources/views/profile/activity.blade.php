@extends('layouts.app')

@section('page_title', __('Active Session'))

@section('page')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ __('Hoạt động gần nhất') }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped verticle-middle table-responsive-sm">
                            <thead>
                                <tr>
                                    <th scope="col">@lang('Trạng thái')</th>
                                    <th scope="col">@lang('IP')</th>
                                    <th scope="col">@lang('Thiết bị')</th>
                                    <th scope="col">@lang('Hệ điều hành')</th>
                                    <th scope="col">@lang('Trình duyệt')</th>
                                    <th scope="col">@lang('Thời gian đăng nhập')</th>
                                    <th scope="col">@lang('')</th>

                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($data as $value)
                                <tr>
                                    <td> {{ $value->description }} </td>
                                    <td> {{ $value->ip_address }} </td>
                                    <td> {{ $value->device }} </td>
                                    <td> {{ $value->platform }} </td>
                                    <td> {{ $value->browser }} </td>
                                    <td> {{ $value->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a href="{{ route('profile.activity.destroy', $value->id ) }}"
                                            class="btn btn-danger mr-1" data-toggle="tooltip" data-placement="top"
                                            title="@lang('Delete Activity')" data-method="DELETE"
                                            data-confirm-title="@lang('Please Confirm')"
                                            data-confirm-text="@lang('Are you sure that you want to delete this Activity?')"
                                            data-confirm-button="@lang('Yes, delete Activity!')">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="float-right">
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
