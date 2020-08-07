@extends('layouts.app')
@section('title')
    DOCTORES
@endsection
@section('css')
    <link href="{{ asset('css/modules.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="mdl-grid">
        @if(Auth::user()->hasRole('admin'))
            @include('doctors.admin.content')
        @elseif(Auth::user()->hasRole('operator'))
            @include('doctors.operator.content')
        @elseif(Auth::user()->hasRole('doctor'))
            @include('doctors.doctor.content')
        @elseif(Auth::user()->hasRole('patient'))
            @include('doctors.patient.content')
        @endif
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/users.js') }}"></script>
    @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('operator'))
        <script>
            user_id = '{{ Auth::user()->id }}',
            urlStoreUser = encodeURI('{{ route('doctor.store') }}'),
            urlUpdateUser = encodeURI('{{ route('doctor.update') }}'),
            urlDeleteUser = encodeURI('{{ route('doctor.delete') }}'),
            urlInfoUser = encodeURI('{{ route('doctor.info') }}')
        </script>
    @endif
@endsection