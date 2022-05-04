
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('uploads/default/favicon.ico') }}">
    <title>@if (trim($__env->yieldContent('title')))@yield('title') | @endif {!! trans('installer_messages.title') !!}</title>
    <meta name="description" content="">
    {{-- Bootstrap core CSS --}}
    <link href="{{ asset('assets/css/bootstrap-v5.css') }}" rel="stylesheet" >
    {{-- Custom styles for this template  --}}
    <link href="{{ asset('assets/css/installer.css') }}" rel="stylesheet">
  </head>
  <body class="bg-light">
    <main class="container">
      <div class="row">
        <div class="col-sm-12 col-md-10 col-lg-9 pb-md-4 mx-auto">
            <div class="my-3 p-5 bg-white rounded shadow-sm">
            @yield('page')
            </div>
        </div>
      </div>
    </main>
  </body>
</html>
