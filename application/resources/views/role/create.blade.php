@extends('layouts.app')

@section('page_title', __('Tạo vai trò'))

@section('page')
    <form action="{{ route('roles.store') }}" method="post">
        @csrf

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('Tạo vai trò') }}</h4>
                    </div>
                    <div class="card-body">
                        <p>{{ __('Vai trò thông tin chung') }}</p>
                        <div class="basic-form">

                            <div class="form-group">
                                <label>@lang('Tên vai trò')</label>
                                <input name="name" value="{{ old('name') }}" type="text"
                                    class="form-control @error('name')is-invalid @enderror"
                                    placeholder="@lang('Nhập tên vai trò')">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>@lang('Tên hiển thị')</label>
                                <input name="display_name" value="{{ old('display_name') }}"
                                    class="form-control @error('display_name')is-invalid @enderror"
                                    placeholder="@lang('Nhập tên hiển thị')">
                                @error('display_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-success btn-lg">@lang('Tạo vai trò')</button>
            </div>
        </div>
    </form>
@endsection
