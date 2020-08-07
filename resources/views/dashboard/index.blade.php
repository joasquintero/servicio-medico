@extends('layouts.app')
@section('css')
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
@endsection

@section('content')
{{-- <div id="div_cover">uhuou</div> --}}
<div class="container">
    <div class="mdl-grid">
    @if(Auth::user()->hasRole(['admin']))
        @include('dashboard.admin.dashboard')
    @elseif(Auth::user()->hasRole(['operator']))
        @include('dashboard.operator.dashboard')
    @elseif(Auth::user()->hasRole(['doctor']))
        @include('dashboard.doctor.dashboard')
    @elseif(Auth::user()->hasRole(['patient']))
        @include('dashboard.patient.dashboard')
    @elseif(Auth::user()->hasRole(['pending']))
    <br><br>
        <div class="mdl-cell mdl-cell--1-col"></div>
        <div class="mdl-cell mdl-cell--10-col border">
            <h1 style="font-size:3.8em;" class="hvr-underline-from-left">Pendiente por verificación del Administrador</h1>
        </div>
    @endif
    </div>
</div>
@endsection

@section('js')
    <script>
        names = "{{ Auth::user()->names . ' ' . Auth::user()->family_names }}",
        role = "{{ getUserRol(Auth::user()->id) }}"
    </script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
@endsection