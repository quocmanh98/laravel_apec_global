@extends('layouts.app')

<style>
    .red {
        color: red
    }

</style>

@section('page_title', __('Cập nhật trạng thái duyệt'))

@section('page')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <form action="{{ route('recruit.update', $user->id) }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('Xác nhận duyệt') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>@lang('Loại nhân viên')</label> <label class="red">(*)</label>
                                    <select name="Approval" class="form-control  @error('Approval') is-invalid @enderror">
                                        <option value="">Chọn loại nhân viên</option>
                                        @foreach ($typeofemployees as $v)
                                            <option value="{{ $v->id }}">{{ $v->typeofemployeess_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('Approval')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12">
                                    <label>@lang('Ngày vào làm')</label> <label class="red">(*)</label>
                                    <input type="date" name="dayin" class='form-control @error('dayin') is-invalid @enderror'>
                                    @error('dayin')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                                <div class="form-group col-md-12">
                                    <label>@lang('Trạng thái duyệt')</label> <label class="red">(*)</label>
                                    <select name="ApprovalStatus"
                                        class="form-control">
                                        <option value="2" @if ($user->ApprovalStatus == 2) selected @endif>Đã duyệt
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <button type="submit" class="btn btn-success btn-lg">@lang('Đồng ý')</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>



    </form>

@endsection
