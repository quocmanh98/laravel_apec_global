@extends('layouts.auth')

@section('page_title', __('Quên mật khẩu'))

@section('page')
<div class="auth-form">
    <h4 class="text-center mb-4">@lang('Quên mật khẩu')</h4>
    <form action="{{ route('password.email') }}" method="POST">
        @csrf
        @if(session('status'))
        <div class="alert alert-primary" role="alert">
            {{ session('status') }}
        </div>
        @endif
        <div class="form-group">
            <label><strong>@lang('Email')</strong></label>
            <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" required autofocus>
            @error('email')
            <div class="invalid-feedback">
                {!! $message !!}
            </div>
            @enderror
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-block"> {{ __('Đặt lại mật khẩu') }}</button>
        </div>
    </form>
</div>
@endsection
