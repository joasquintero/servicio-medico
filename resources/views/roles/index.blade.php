@extends('layouts.app')
@section('css')
    <link href="{{ asset('css/modules.css') }}" rel="stylesheet">
@endsection
@section('title')
    ROLES
@endsection

@section('content')
    <div class="mdl-grid">
        @if(Auth::user()->hasRole('admin'))
            @include('roles.admin.content')
        @elseif(Auth::user()->hasRole('operator'))
            @include('roles.operator.content')
        @elseif(Auth::user()->hasRole('doctor'))
            @include('roles.doctor.content')
        @elseif(Auth::user()->hasRole('patient'))
            @include('roles.patient.content')
        @endif
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/roles.js') }}"></script>
    @if(Auth::user()->hasRole('admin'))
        <script>
            user_id = '{{ Auth::user()->id }}',
            urlStoreRol = encodeURI('{{ route('role.store') }}'),
            urlUpdateRol = encodeURI('{{ route('role.update') }}'),
            urlDeleteRol = encodeURI('{{ route('role.delete') }}'),
            urlInfoRol = encodeURI('{{ route('role.info') }}')
        </script>
    @endif
@endsection