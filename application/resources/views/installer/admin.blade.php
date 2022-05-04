@extends('layouts.installer')

@section('title', trans('installer_messages.admin.title'))

@section('page')
@error('create_user_account')
<div class="alert alert-danger" role="alert">
    {!! $message !!}
</div>
@enderror

<h3 class="h4">{!! trans('installer_messages.admin.templateTitle') !!}</h3>
<p>{!! trans('installer_messages.admin.body') !!}</p>
<form method="post" action="{{ route('install.admin') }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">
            {{ trans('installer_messages.admin.form.admin_name_label') }}
        </label>
        <div class="col-sm-9">
          <input name="username" value="{{ old('username', $user->username??"") }}" type="text" class="form-control @error('name') is-invalid @enderror">
          @error('username')
          <div class="invalid-feedback">
              {{ $message }}
          </div>
          @enderror
          <div class="form-text">
            {{ trans('installer_messages.admin.form.admin_name_info') }}
          </div>

        </div>
    </div>

    <div class="mb-3 row">
      <label class="col-sm-3 col-form-label">
          {{ trans('installer_messages.admin.form.admin_email_label') }}
      </label>
      <div class="col-sm-9">
        <input name="email" value="{{ old('email', $user->email??"") }}" type="email" class="form-control @error('email') is-invalid @enderror">
        @error('email')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        <div class="form-text">
          {{ trans('installer_messages.admin.form.admin_email_info') }}
        </div>

      </div>

    </div>

    <div class="mb-3 row">
      <label class="col-sm-3 col-form-label">
          {{ trans('installer_messages.admin.form.admin_password_label') }}
      </label>
      <div class="col-sm-9">
        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror">
        @error('password')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        <div class="form-text">
          {!! trans('installer_messages.admin.form.admin_password_info') !!}
        </div>

      </div>

    </div>

    <small class="d-block text-end mt-3">
      <button type="submit" href="{{ route('install.requirements') }}" class="btn btn-secondary">
        {{ trans('installer_messages.admin.next') }}
      </button>
    </small>
</form>
@endsection
