@extends('layouts.installer')

@section('title', trans('installer_messages.welcome.title'))


@section('page')

@if ($errors->any())
@foreach ($errors->all() as $error)
    <div class="alert alert-danger" role="alert">
    {!! $error !!}
    </div>
@endforeach
@endif

@if (session('message'))
    <div class="alert alert-danger" role="alert">
        {{ session('message') }}
    </div>
@endif
<div class="text-muted pt-3">
    <p>{{ trans('installer_messages.welcome.body.message1') }}</p>
    <ol>
        <li>{{ trans('installer_messages.welcome.body.requirements.db_driver') }}</li>
        <li>{{ trans('installer_messages.welcome.body.requirements.db_host') }}</li>
        <li>{{ trans('installer_messages.welcome.body.requirements.db_name') }}</li>
        <li>{{ trans('installer_messages.welcome.body.requirements.db_username') }}</li>
        <li>{{ trans('installer_messages.welcome.body.requirements.db_password') }}</li>
    </ol>
    <p>{{ trans('installer_messages.welcome.body.message2') }}</p>
</div>

<div class="d-block text-end mt-3">
    <a href="{{ route('install.requirements') }}" class="btn btn-secondary">
        {{ trans('installer_messages.welcome.next') }}
    </a>
</div>
@endsection
