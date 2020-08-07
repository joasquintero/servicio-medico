@extends('layouts.app')
@section('css')
    <link href="{{ asset('css/modules.css') }}" rel="stylesheet">
@endsection
@section('title')
    ENFERMEDADES
@endsection

@section('content')
    <div class="mdl-grid">
        @if(Auth::user()->hasRole('admin'))
            @include('illnesses.admin.content')
        @elseif(Auth::user()->hasRole('operator'))
            @include('illnesses.operator.content')
        @elseif(Auth::user()->hasRole('doctor'))
            @include('illnesses.doctor.content')
        @elseif(Auth::user()->hasRole('patient'))
            @include('illnesses.patient.content')
        @endif
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/illnesses.js') }}"></script>
    @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('operator') || Auth::user()->hasRole('doctor'))
        <script>
            user_id = '{{ Auth::user()->id }}',
            urlStoreIllness = encodeURI('{{ route('illness.store') }}'),
            urlUpdateIllness = encodeURI('{{ route('illness.update') }}'),
            urlDeleteIllness = encodeURI('{{ route('illness.delete') }}'),
            urlInfoIllness = encodeURI('{{ route('illness.info') }}')
        </script>
    @endif
@endsection