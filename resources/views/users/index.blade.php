@extends('layouts.app')
@section('title')
    USUARIOS
@endsection
@section('css')
    <link href="{{ asset('css/modules.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="mdl-grid">
        @if(Auth::user()->hasRole('admin'))
            @include('users.admin.content')
        @elseif(Auth::user()->hasRole('operator'))
            @include('users.operator.content')
        @elseif(Auth::user()->hasRole('doctor'))
            @include('users.doctor.content')
        @elseif(Auth::user()->hasRole('patient'))
            @include('users.patient.content')
        @endif
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/users.js') }}"></script>
    @if(Auth::user()->hasRole('admin'))
        <script>
            user_id = '{{ Auth::user()->id }}',
            urlStoreUser = encodeURI('{{ route('user.store') }}'),
            urlUpdateUser = encodeURI('{{ route('user.update') }}'),
            urlDeleteUser = encodeURI('{{ route('user.delete') }}'),
            urlInfoUser = encodeURI('{{ route('user.info') }}')
        </script>
    @endif
@endsection