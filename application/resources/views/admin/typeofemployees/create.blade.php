@extends('layouts.app')
@php
$typeofemployeesCode = "MLNV" . time();
$create_at = date("Y-m-d H:i:s");
@endphp
@section('page_title', __('Tạo Loại nhân viên '))

@section('page')
    <form action="{{ route('admin.typeofemployees.store') }}" method="post">
        @csrf

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('Tạo Loại nhân viên') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">

                            <div class="form-row">

                                <input type="hidden" name="typeofemployeess_code" value="{{ $typeofemployeesCode  }}">
                                <div class="form-group col-md-12">
                                    <label>@lang('Mã Loại nhân viên')</label>

                                    <input  type="text"
                                        class="form-control @error('typeofemployeess_code')is-invalid @enderror"
                                        placeholder="@lang('Mã Loại nhân viên')" value="{{ $typeofemployeesCode  }}" disabled>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>@lang('Tên Loại nhân viên')</label>
                                    <input name="typeofemployeess_name" value="{{ old('typeofemployeess_name') }}" type="text"
                                        class="form-control @error('typeofemployeess_name')is-invalid @enderror"
                                        placeholder="@lang('Tên Loại nhân viên')">
                                    @error('typeofemployeess_name')
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
