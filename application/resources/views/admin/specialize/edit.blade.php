@extends('layouts.app')
@php
$specializeCode = "MCM" . time();
$create_at = date("Y-m-d H:i:s");
@endphp
@section('page_title', __('Sửa chuyên môn '))

@section('page')
    <form action="{{ route('admin.specialize.update',$specialize->id) }}" method="post">
        @csrf

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('Sửa chuyên môn') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>@lang('Mã chuyên môn')</label>
                                    <input type="text"
                                        class="form-control @error('specializes_code')is-invalid @enderror"
                                        placeholder="@lang('Mã chuyên môn')" value="{{ $specialize->specializes_code }}" disabled>
                                </div>

                                <div class="form-group col-md-12">
                                    <label>@lang('Tên chuyên môn')</label>
                                    <input name="specializes_name" value="{{ $specialize->specializes_name }}" type="text"
                                        class="form-control @error('specializes_name')is-invalid @enderror"
                                        placeholder="@lang('Tên chuyên môn')">
                                    @error('specializes_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label>@lang('Slug')</label>
                                    <input name="specializes_slug" value="{{ $specialize->specializes_slug }}" type="text"
                                        class="form-control" disabled>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>@lang('Trạng thái')</label>
                                    <select name="status" class="form-control">
                                        <option value="0" @if (old('status', $specialize->specializes_status) == 0) selected @endif>Ẩn</option>
                                        <option value="1" @if (old('status', $specialize->specializes_status) == 1) selected @endif>Hiện</option>
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
