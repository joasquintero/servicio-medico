@extends('layouts.app')
@section('title')
    PACIENTES
@endsection
@section('css')
    <link href="{{ asset('css/modules.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="mdl-grid">
        @if(Auth::user()->hasRole('admin'))
            @include('patients.admin.content')
        @elseif(Auth::user()->hasRole('operator'))
            @include('patients.operator.content')
        @elseif(Auth::user()->hasRole('doctor'))
            @include('patients.doctor.content')
        @elseif(Auth::user()->hasRole('patient'))
            @include('patients.patient.content')
        @endif
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/users.js') }}"></script>
    @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('operator'))
        <script>
            user_id = '{{ Auth::user()->id }}',
            urlStoreUser = encodeURI('{{ route('patient.store') }}'),
            urlUpdateUser = encodeURI('{{ route('patient.update') }}'),
            urlDeleteUser = encodeURI('{{ route('patient.delete') }}'),
            urlInfoUser = encodeURI('{{ route('patient.info') }}')
        </script>
    @endif
@endsection