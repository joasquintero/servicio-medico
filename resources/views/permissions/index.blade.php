@extends('layouts.app')
@section('title')
    PERMISOS
@endsection
@section('css')
    <link href="{{ asset('css/modules.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="mdl-grid">
        @if(Auth::user()->hasRole('admin'))
            @include('permissions.admin.content')
        @elseif(Auth::user()->hasRole('operator'))
            @include('permissions.operator.content')
        @elseif(Auth::user()->hasRole('doctor'))
            @include('permissions.doctor.content')
        @elseif(Auth::user()->hasRole('patient'))
            @include('permissions.patient.content')
        @endif
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/permissions.js') }}"></script>
    @if(Auth::user()->hasRole('admin'))
        <script>
            user_id = '{{ Auth::user()->id }}',
            urlStorePermission = encodeURI('{{ route('permission.store') }}'),
            urlUpdatePermission = encodeURI('{{ route('permission.update') }}'),
            urlDeletePermission = encodeURI('{{ route('permission.delete') }}'),
            urlInfoPermission = encodeURI('{{ route('permission.info') }}')
        </script>
    @endif
@endsection