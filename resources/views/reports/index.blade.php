@extends('layouts.app')
@section('css')
    <link href="{{ asset('css/modules.css') }}" rel="stylesheet">
@endsection
@section('title')
    REPORTES
@endsection

@section('content')
    @if(Auth::user()->hasRole('admin'))
        @include('reports.admin.content')
    @elseif(Auth::user()->hasRole('operator'))
        @include('reports.operator.content')
    @elseif(Auth::user()->hasRole('doctor'))
        @include('reports.doctor.content')
    @endif
@endsection

@section('js')
    <script src="{{ asset('js/reports.js') }}"></script>
@endsection