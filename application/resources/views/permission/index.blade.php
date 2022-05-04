@extends('layouts.app')

@section('page_title', __('Phân quyền'))

@section('page')
@include('includes.navbar')
    <form action="{{ route('permissions.update') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('Quản lý phân quyền')</h4>
                        <a href="{{ route('admin.permission.list') }}" class="btn btn-secondary ml-5">Danh sách phân quyền</a> <br>
                        <a href="{{ route('admin.permission.create') }}" class="btn btn-secondary ml-5 mr-5">Thêm phân quyền</a> <br>
                    </div>
                    <div class="card-body">
                        @can('dashboard-show')
                            "ok"
                        @endcan
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped verticle-middle table-responsive-sm">
                                <thead>
                                    <tr>
                                        <th>@lang('Tên phân quyền') </th>
                                        @foreach ($roles as $role)
                                            <th class="text-center">{{ $role->display_name }} </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $permission)
                                        <tr>

                                            <td>{{ $permission->display_name ?: $permission->name }} </td>

                                            @foreach ($roles as $role)
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <div class="form-check">
                                                            <input name="roles[{{ $role->id }}][]"
                                                                class="form-check-input" type="checkbox"
                                                                value="{{ $permission->id }}"
                                                                id="rp-{{ $role->id }}-{{ $permission->id }}" @if ($role->hasPermissionTo($permission->name)) checked @endif>
                                                            <label class="form-check-label"
                                                                for="rp-{{ $role->id }}-{{ $permission->id }}"></label>
                                                        </div>
                                                    </div>
                                                </td>
                                            @endforeach

                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                    <div class='ml-3'>
                        {{ $permissions->links() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-success btn-lg">@lang('Cập nhật')</button>
            </div>
        </div>
    </form>
@endsection
