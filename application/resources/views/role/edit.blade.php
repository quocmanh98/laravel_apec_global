@extends('layouts.app')

@section('page_title', __('Update Role'))

@section('page')
    <form action="{{ route('roles.update', $data->id) }}" method="post">
        @csrf
        @method('put')

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('Cập nhật vai trò') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">

                            <div class="form-group">
                                <label>@lang('Tên')</label>
                                <input name="name" value="{{ old('name', $data->name) }}" type="text"
                                    class="form-control @error('name')is-invalid @enderror"
                                    placeholder="@lang('Tên')">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>@lang('Vai trò')</label>
                                <input name="display_name" value="{{ old('display_name', $data->display_name) }}"
                                    class="form-control @error('display_name')is-invalid @enderror"
                                    placeholder="@lang('Vai trò')">
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
                <button type="submit" class="btn btn-success btn-lg">@lang('Cập nhật')</button>
            </div>
        </div>
    </form>
@endsection
