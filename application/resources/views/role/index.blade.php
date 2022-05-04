@extends('layouts.app')

@section('page_title', __('Quản lý vai trò'))

@section('page')
@include('includes.navbar')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ __('Quản lý vai trò') }}</h4>
                    <a href="{{ route('roles.create') }}" class="btn btn-secondary">Thêm</a>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped verticle-middle table-responsive-sm">
                            <thead>
                                <tr>
                                    <th scope="col">User</th>
                                    <th scope="col">Vai trò User</th>
                                    <th scope="col">Xử lý</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $role)
                                    <tr>

                                        <td>
                                            {{ $role->name }}
                                        </td>
                                        <td>
                                            {{ $role->display_name }}
                                        </td>
                                        <td>
                                            @if ($role->isRemovable())
                                            <span class="d-flex">
                                                <a href="{{ route('roles.edit', $role->id) }}"
                                                    class="btn btn-primary mr-1" data-toggle="tooltip" data-placement="top"
                                                    title="@lang('Sửa')">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ route('roles.destroy', $role->id) }}"
                                                    class="btn btn-danger mr-1" data-toggle="tooltip" data-placement="top"
                                                    title="@lang('Xoá')" data-method="DELETE"
                                                    data-confirm-title="@lang('Vui lòng xác nhận')"
                                                    data-confirm-text="@lang('Bạn có chắc chắn muốn xóa Vai trò này không?')"
                                                    data-confirm-button="@lang('Có, xóa Vai trò!')">
                                                    <i class="fas fa-times"></i>
                                                </a>
                                            </span>
                                            @else
                                            <span class="d-flex">
                                                <button class="btn btn-primary mr-1"
                                                    title="@lang('X')" disabled>
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button
                                                    class="btn btn-danger mr-1"
                                                    title="@lang('X')" disabled>
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </span>
                                            @endif
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
