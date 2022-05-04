@extends('layouts.app')
@php
$roomCode = "MTĐ" . time();
$create_at = date("Y-m-d H:i:s");
@endphp
@section('page_title', __('Sửa Loại nhân viên '))

@section('page')
    <form action="{{ route('admin.typeofemployees.update',$typeofemployees->id) }}" method="post">
        @csrf

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('Sửa Loại nhân viên') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>@lang('Mã Loại nhân viên')</label>
                                    <input type="text"
                                        class="form-control @error('typeofemployeess_code')is-invalid @enderror"
                                        placeholder="@lang('Mã Loại nhân viên')" value="{{ $typeofemployees->typeofemployeess_code }}" disabled>
                                </div>

                                <div class="form-group col-md-12">
                                    <label>@lang('Tên Loại nhân viên')</label>
                                    <input name="typeofemployeess_name" value="{{ $typeofemployees->typeofemployeess_name }}" type="text"
                                        class="form-control @error('typeofemployeess_name')is-invalid @enderror"
                                        placeholder="@lang('Tên Loại nhân viên')">
                                    @error('typeofemployeess_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label>@lang('Slug')</label>
                                    <input name="typeofemployeess_slug" value="{{ $typeofemployees->typeofemployeess_slug }}" type="text"
                                        class="form-control" disabled>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>@lang('Trạng thái')</label>
                                    <select name="status" class="form-control">
                                        <option value="0" @if (old('status', $typeofemployees->typeofemployeess_status) == 0) selected @endif>Ẩn</option>
                                        <option value="1" @if (old('status', $typeofemployees->typeofemployeess_status) == 1) selected @endif>Hiện</option>
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
