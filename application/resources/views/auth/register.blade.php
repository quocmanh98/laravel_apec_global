@extends('layouts.auth')

@section('page_title', __('Register'))

@section('page')
<div class="auth-form">
    <h4 class="text-center mb-4">@lang('Đăng ký')</h4>
    <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label><strong>@lang('Họ tên')</strong></label>
            <input name="fullname" value="{{ old('fullname') }}" type="text" class="form-control @error('fullname') is-invalid @enderror" placeholder="fullname">
            @error('fullname')
            <div class="invalid-feedback">
                {!! $message !!}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label><strong>@lang('Tên đăng nhập')</strong></label>
            <input name="username" value="{{ old('username') }}" type="text" class="form-control @error('username') is-invalid @enderror" placeholder="username">
            @error('username')
            <div class="invalid-feedback">
                {!! $message !!}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label><strong>@lang('Email')</strong></label>
            <input name="email" value="{{ old('email') }}" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="hello@example.com" required>
            @error('email')
            <div class="invalid-feedback">
                {!! $message !!}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label><strong>@lang('Ảnh:')</strong></label>
            <input type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar">
            @error('avatar')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label><strong>@lang('Password')</strong></label>
            <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required>
            @error('password')
            <div class="invalid-feedback">
                {!! $message !!}
            </div>
            @enderror
        </div>
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary btn-block">@lang('Đăng ký')</button>
        </div>
    </form>
    <div class="new-account mt-3">
        <p>@lang('Bạn đã có tài khoản để đăng nhập ?') <a class="text-primary" href="{{ route('login') }}">@lang('Đăng nhập')</a></p>
    </div>
</div>
@endsection
