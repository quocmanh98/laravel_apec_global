@extends('layouts.app')
@php
$positionCode = "MCV" . time();
$create_at = date("Y-m-d H:i:s");
@endphp
@section('page_title', __('Tạo chức vụ '))

@section('page')
    <form action="{{ route('admin.position.store') }}" method="post">
        @csrf

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('Tạo chức vụ') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">

                            <div class="form-row">

                                <input type="hidden" name="positions_code" value="{{ $positionCode }}">
                                <div class="form-group col-md-12">
                                    <label>@lang('Mã chức vụ')</label>
                                    <input  type="text"
                                        class="form-control"
                                        placeholder="@lang('Mã chức vụ')" value="{{ $positionCode }}" disabled>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>@lang('Tên chức vụ')</label>
                                    <input name="positions_name" value="{{ old('positions_name') }}" type="text"
                                        class="form-control @error('positions_name')is-invalid @enderror"
                                        placeholder="@lang('Tên chức vụ')">
                                    @error('positions_name')
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
