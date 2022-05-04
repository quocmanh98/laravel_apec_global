@extends('layouts.app')
@php
use Illuminate\Support\Str;
{{--  $roomCode = "MPB" .time();
$roomCodeMPB = Str::substr($roomCode, 9, 8);
$create_at = date("Y-m-d H:i:s");  --}}
$roomCode = "MBP" . time();
$create_at = date("Y-m-d H:i:s");
@endphp
@section('page_title', __('Tạo phòng ban '))

@section('page')
    <form action="{{ route('admin.department.store') }}" method="post">
        @csrf

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('Tạo phòng ban') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">

                            <div class="form-row">

                                <input type="hidden" name="departments_code" value="{{ $roomCode }}">
                                <div class="form-group col-md-12">
                                    <label>@lang('Mã phòng ban')</label>

                                    <input  type="text"
                                        class="form-control @error('departments_code')is-invalid @enderror"
                                        placeholder="@lang('Mã phòng ban')" value="{{ $roomCode }}" disabled>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>@lang('Tên phòng ban')</label>
                                    <input name="departments_name" value="{{ old('departments_name') }}" type="text"
                                        class="form-control @error('departments_name')is-invalid @enderror"
                                        placeholder="@lang('Tên phòng ban')">
                                    @error('departments_name')
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
