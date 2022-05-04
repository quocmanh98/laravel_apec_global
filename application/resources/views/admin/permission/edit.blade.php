@extends('layouts.app')
@section('page_title', __('Sửa phân quyền '))

@section('page')
    <form action="{{ route('admin.permission.update',$permission->id) }}" method="post">
        @csrf

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('Sửa phân quyền') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>@lang('Tên route phân quyền')</label>
                                    <input type="text" name='name'
                                        class="form-control @error('name')is-invalid @enderror"
                                        placeholder="@lang('Tên route')" value="{{ $permission->name }}">
                                        @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-12">
                                    <label>@lang('Tên phân quyền')</label>
                                    <input name="display_name" value="{{ $permission->display_name }}" type="text"
                                        class="form-control @error('display_name')is-invalid @enderror"
                                        placeholder="@lang('Tên phân quyền')">
                                    @error('display_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label>@lang('Trạng thái')</label>
                                    <select name="status" class="form-control">
                                        <option value="0" @if (old('status', $permission->permissions_status) == 0) selected @endif>Ẩn</option>
                                        <option value="1" @if (old('status', $permission->permissions_status) == 1) selected @endif>Hiện</option>
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
