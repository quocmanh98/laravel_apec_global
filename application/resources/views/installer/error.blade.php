@extends('layouts.installer')

@section('title', trans('installer_messages.error.title') )

@section('page')
    <div class="text-muted pt-3">
        <h3>{{ trans('installer_messages.error.status') }}</h3>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger" role="alert">
                {!! $error !!}
                </div>
            @endforeach
        @endif
        <hr>
        <p><strong>{{ trans('installer_messages.error.templateTitle') }}</strong></p>
        <p>{!! trans('installer_messages.error.description') !!}</p>

        <a class="btn btn-secondary" href="{{ route('install.welcome') }}">
            {{ trans('installer_messages.error.next') }}
        </a>
    </div>
@endsection
