@extends('layouts.app')
@php
$roomCode = "MBP" . time();
$create_at = date("Y-m-d H:i:s");
@endphp
@section('page_title', __('Sửa chức vụ '))

@section('page')
    <form action="{{ route('admin.position.update',$position->id) }}" method="post">
        @csrf

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('Sửa chức vụ') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>@lang('Mã chức vụ')</label>
                                    <input type="text"
                                        class="form-control @error('positions_code')is-invalid @enderror"
                                        placeholder="@lang('Mã chức vụ')" value="{{ $position->positions_code }}" disabled>
                                </div>

                                <div class="form-group col-md-12">
                                    <label>@lang('Tên chức vụ')</label>
                                    <input name="positions_name" value="{{ $position->positions_name }}" type="text"
                                        class="form-control @error('positions_name')is-invalid @enderror"
                                        placeholder="@lang('Tên chức vụ')">
                                    @error('positions_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label>@lang('Slug')</label>
                                    <input name="positions_slug" value="{{ $position->positions_slug }}" type="text"
                                        class="form-control" disabled>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>@lang('Trạng thái')</label>
                                    <select name="status" class="form-control">
                                        <option value="0" @if (old('status', $position->positions_status) == 0) selected @endif>Ẩn</option>
                                        <option value="1" @if (old('status', $position->positions_status) == 1) selected @endif>Hiện</option>
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
