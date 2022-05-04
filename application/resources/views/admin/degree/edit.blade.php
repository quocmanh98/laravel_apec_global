@extends('layouts.app')
@php
$degreeCode = "MBC" . time();
$create_at = date("Y-m-d H:i:s");
@endphp
@section('page_title', __('Sửa bằng cấp '))

@section('page')
    <form action="{{ route('admin.degree.update',$degree->id) }}" method="post">
        @csrf

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('Sửa bằng cấp') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>@lang('Mã bằng cấp')</label>
                                    <input type="text"
                                        class="form-control @error('degrees_code')is-invalid @enderror"
                                        placeholder="@lang('Mã bằng cấp')" value="{{ $degree->degrees_code }}" disabled>
                                </div>

                                <div class="form-group col-md-12">
                                    <label>@lang('Tên bằng cấp')</label>
                                    <input name="degrees_name" value="{{ $degree->degrees_name }}" type="text"
                                        class="form-control @error('degrees_name')is-invalid @enderror"
                                        placeholder="@lang('Tên bằng cấp')">
                                    @error('degrees_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label>@lang('Slug')</label>
                                    <input name="degrees_slug" value="{{ $degree->degrees_slug }}" type="text"
                                        class="form-control" disabled>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>@lang('Trạng thái')</label>
                                    <select name="status" class="form-control">
                                        <option value="0" @if (old('status', $degree->degrees_status) == 0) selected @endif>Ẩn</option>
                                        <option value="1" @if (old('status', $degree->degrees_status) == 1) selected @endif>Hiện</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-12">
                                    <input type="submit" class="btn btn-success btn-lg" value='Sửa'>
                                </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
