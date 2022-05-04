@extends('layouts.app')
@php
$specializeCode = "MCM" . time();
$create_at = date("Y-m-d H:i:s");
@endphp
@section('page_title', __('Tạo chuyên môn '))

@section('page')
    <form action="{{ route('admin.specialize.store') }}" method="post">
        @csrf

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('Tạo chuyên môn') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">

                            <div class="form-row">

                                <input type="hidden" name="specializes_code" value="{{ $specializeCode  }}">
                                <div class="form-group col-md-12">
                                    <label>@lang('Mã chuyên môn')</label>

                                    <input  type="text"
                                        class="form-control @error('specializes_code')is-invalid @enderror"
                                        placeholder="@lang('Mã chuyên môn')" value="{{ $specializeCode  }}" disabled>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>@lang('Tên chuyên môn')</label>
                                    <input name="specializes_name" value="{{ old('specializes_name') }}" type="text"
                                        class="form-control @error('specializes_name')is-invalid @enderror"
                                        placeholder="@lang('Tên chuyên môn')">
                                    @error('specializes_name')
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
