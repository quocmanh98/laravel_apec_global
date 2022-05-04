@extends('layouts.auth')

@section('page_title', __('Đăng nhập'))

@section('page')
    <div class="auth-form">
        @if (session('status'))
            <div class="alert alert-danger" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <h4 class="text-center mb-4">@lang('Đăng nhập')</h4>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label><strong>@lang("Email")</strong></label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="hello@example.com"
                    name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="invalid-feedback">
                        {!! $message !!}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label><strong>@lang("Mật khẩu")</strong></label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                    name="password" required autocomplete="current-password">
                @error('password')
                    <div class="invalid-feedback">
                        {!! $message !!}
                    </div>
                @enderror
            </div>

            <div class="form-row d-flex justify-content-between mt-4 mb-2">
                @if (option('auth_rememberMe'))
                    <div class="form-group">
                        <div class="custom-control custom-checkbox ml-1">
                            <input type="checkbox" class="custom-control-input" id="basic_checkbox_1">
                            <label class="custom-control-label" for="basic_checkbox_1">@lang('Nhớ mật khẩu')</label>
                            <a class="text-primary" href="{{ route('ung-vien.ung-tuyen-ho-so') }}">@lang(' | Ứng tuyển
                                hồ sơ')</a>
                        </div>
                    </div>
                @endif

                @if (option('auth_forgotPassword'))
                    <div class="form-group">
                        <a href="{{ route('password.request') }}">@lang("Quên mật khẩu?")</a> <br>
                    </div>
                @endif
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-block">@lang('Đăng nhập')</button>
            </div>
        </form>

        @if (!option('auth_disableRegistration'))
        @endif

    </div>
@endsection
