@extends('layouts.installer')

@section('title',  trans('installer_messages.database.title') )

@section('page')

@error('database_connection')
<div class="alert alert-danger" role="alert">
    {!! $message !!}
</div>
@enderror

<form method="post" action="{{ route('install.databaseInfo') }}">
    @csrf
    <div class="row mb-3">
        <p>{!! trans('installer_messages.database.templateTitle') !!}</p>
    </div>
    <div class="row mb-3">
        <label for="database_connection" class="col-sm-3 col-form-label">
            {{ trans('installer_messages.database.form.db_connection_label') }}
        </label>

        <div class="col-sm-5">
            <select name="database_connection" class="form-select">
                <option value="mysql">{{ trans('installer_messages.database.form.db_connection_label_mysql') }}</option>
            </select>
        </div>
        <div class="col-sm-4">
            {{ trans('installer_messages.database.form.db_connection_info') }}
        </div>
    </div>

    <div class="row mb-3">
        <label for="database_hostname" class="col-sm-3 col-form-label  ">
            {{ trans('installer_messages.database.form.db_host_label') }}
        </label>
        <div class="col-sm-5">
            <input name="host" value="{{ old('host', '127.0.0.1') }}" class="form-control" id="database_hostname" placeholder="{{ trans('installer_messages.database.form.db_host_placeholder') }}"  required>
        </div>
        <div class="col-sm-4">
            {{ trans('installer_messages.database.form.db_host_info') }}
        </div>
    </div>

    <div class="row mb-3">
        <label for="database_port" class="col-sm-3 col-form-label">
            {{ trans('installer_messages.database.form.db_port_label') }}
        </label>
        <div class="col-sm-5">
            <input name="port" value="{{ old('port', '3306' ) }}" class="form-control" id="database_port" placeholder="{{ trans('installer_messages.database.form.db_port_placeholder') }}" required>
        </div>
        <div class="col-sm-4">
            {{ trans('installer_messages.database.form.db_port_info') }}
        </div>
    </div>

    <div class="row mb-3">
        <label for="database_name" class="col-sm-3 col-form-label">
            {{ trans('installer_messages.database.form.db_name_label') }}
        </label>
        <div class="col-sm-5">
            <input name="database" value="{{ old('database') }}" class="form-control" id="database_name"   placeholder="{{ trans('installer_messages.database.form.db_name_placeholder') }}" required>
        </div>
        <div class="col-sm-4">
            {{ trans('installer_messages.database.form.db_name_info') }}
        </div>
    </div>

    <div class="row mb-3">
        <label for="database_username" class="col-sm-3 col-form-label">
            {{ trans('installer_messages.database.form.db_username_label') }}
        </label>
        <div class="col-sm-5">
            <input name="username" value="{{ old('username') }}" class="form-control" id="database_username" placeholder="{{ trans('installer_messages.database.form.db_username_placeholder') }}" required>
        </div>
        <div class="col-sm-4">
            {{ trans('installer_messages.database.form.db_username_info') }}
        </div>
    </div>

    <div class="row mb-3">
        <label for="database_password" class="col-sm-3 col-form-label">
            {{ trans('installer_messages.database.form.db_password_label') }}
        </label>
        <div class="col-sm-5">
            <input name="password" value="{{ old('password') }}" class="form-control" id="database_password" placeholder="{{ trans('installer_messages.database.form.db_password_placeholder') }}">
        </div>
        <div class="col-sm-4">
            {{ trans('installer_messages.database.form.db_password_info') }}
        </div>
    </div>

    <small class="d-block text-end mt-3">
        <button type="submit" time="20" class="btn btn-secondary">
            {{ trans('installer_messages.database.next') }}
        </button>
    </small>
</form>

@endsection
