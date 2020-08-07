<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Servicio Médico') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="{{ asset('css/material.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/vanilla-datatable.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/alertify.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/themes/default.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/hover.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    @yield('css')
</head>
<!-- TODO: Adaptar las vistas a todos los roles -->
<body oncontextmenu="return false;">

    <div class = "mdl-layout mdl-js-layout mdl-layout--fixed-header">
        <header class = "mdl-layout__header">
            <div class = "mdl-layout__header-row">      
                <span class = "mdl-layout-title" style="margin-left: 5%;">@yield('title', 'Servicios Médicos')</span>          
                <span class = "mdl-layout-title" style="margin-left: 2%;border-left: 2px solid #eee;padding-left:2%;">
                    <div class="reloj" id="reloj"></div>
                </span>     
            </div>  
        </header>
        @include('layouts.navbar')
        <main class = "mdl-layout__content">    
            <div class="page-content">
                @yield('content')
            </div>
        </main>
        @if(URL::current() != route('dashboard'))
        <aside class="hser-panel mdl-shadow--4dp">
            <button class="panel-x hser-btn mdl-shadow--4dp">
                &#215;
            </button>
            <div class="hser-panel-table">
                @yield('panel')
            </div>
        </aside>
        @endif
    </div>

    <script src="{{ asset('js/material.min.js') }}"></script>
    <script src="{{ asset('js/vanilla-datatable.min.js') }}"></script>
    <script src="{{ asset('js/model.js') }}"></script>
    <script src="{{ asset('js/helpers.js') }}"></script>
    <script src="{{ asset('js/alertify.min.js') }}"></script>
    <script src="{{ asset('js/jspdf.debug.js') }}"></script>
    <script>
        urlTracking = '{{ route("tracking.store") }}'
        currentURL = '{{ URL::current() }}',
        userId = '{{ \Auth::check() ? \Auth::user()->id : false }}'
    </script>
    @yield('js')
</body>
</html>
