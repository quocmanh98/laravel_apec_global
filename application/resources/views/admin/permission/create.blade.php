@extends('layouts.app')
@section('page_title', __('Tạo phân quyền '))

@section('page')
    <form action="{{ route('admin.permission.store') }}" method="post">
        @csrf

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('Tạo phân quyền') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">

                            <div class="form-row">

                                <div class="form-group col-md-6">
                                    <label>@lang('Tên route phân quyền')</label>
                                    <input name="name" value="{{ old('name') }}" type="text"
                                        class="form-control @error('name')is-invalid @enderror"
                                        placeholder="@lang('Tên Route')">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label>@lang('Tên hiển thị phân quyền')</label>
                                    <input name="display_name" value="{{ old('display_name') }}" type="text"
                                        class="form-control @error('display_name')is-invalid @enderror"
                                        placeholder="@lang('Tên hiển thị')">
                                    @error('display_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label>@lang('Trạng thái')</label>
                                    <select name="status" class="form-control @error('status')is-invalid @enderror" >
                                        <option value="1" @if (old('status') == '1') selected @endif>Hiện</option>
                                        <option value="0" @if (old('status') == '0') selected @endif>Ẩn</option>

                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-12">
                                    <input type="submit" class="btn btn-success btn-lg" value='Thêm mới'>
                                </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
