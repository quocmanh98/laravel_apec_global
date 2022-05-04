<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('page_title', option('app_name') . " - " . option('app_description'))</title>
    <meta name="description" content="{{ option('app_description') }}">
    <link rel='shortcut icon' type='image/x-icon' href="{{ option('app_favicon') }}">
    <link href="{{ asset('assets/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap4-toggle.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    {{--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @stack('head')
    @yield('head')
</head>

<body>

    {{-- *******************
        Preloader start
    ******************** --}}
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    {{-- *******************
        Preloader end
    ******************** --}}

    {{-- **********************************
        Main wrapper start
    *********************************** --}}
    <div id="main-wrapper">

        @include('includes.header')

        @include('includes.sidebar')

        {{-- **********************************
            Content body start
        *********************************** --}}
        <div class="content-body">
            <div class="container-fluid">

                @include('includes.alerts')
                @if (session('status'))
                    <div  class="alert alert-primary" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                @yield('page')
            </div>
        </div>
        {{-- **********************************
            Content body end
        ********************************** --}}

        {{-- **********************************
            Footer start
        ********************************** --}}
        <div class="footer">
            <div class="copyright">
                <p>Copyright © <a href='/'>APEC GLOBAL</a> 2022</p>
            </div>
        </div>
        {{-- **********************************
            Footer end
        ********************************** --}}
    </div>
    {{-- **********************************
        Main wrapper end
    ********************************** --}}

    {{-- **********************************
        Scripts
    ********************************** --}}
    <script src="{{ asset('assets/js/global.min.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.min.js') }}"></script>
    <script src="{{ asset('assets/js/deznav-init.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap4-toggle.min.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script>
        $("#checkall").change(function(){
            $(".checkitem").prop("checked",$(this).prop("checked"))
        })

        $(".checkitem").change(function(){
            if($(this).prop("checked") == false){
                $("checkall").prop("checked",false)
            }

            if($(".checkitem:checked").length == $(".checkitem").length){
                $("checkall").prop("checked",true)
            }
        })

    </script>
    @stack('footer')
    @yield('footer')
</body>

</html>
