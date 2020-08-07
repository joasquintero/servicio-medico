@extends('layouts.app')
@section('css')
    <link href="{{ asset('css/modules.css') }}" rel="stylesheet">
@endsection
@section('title')
    AUDITORIA
@endsection

@section('content')
<div class="mdl-grid">
    <div class="mdl-cell mdl-cell--1-col">    
    </div>
    <div class="mdl-cell mdl-cell--10-col">
        <div class="mdl-grid border">
            <div class="mdl-cell mdl-cell--1-col">
            </div>
            <div class="mdl-cell mdl-cell--12-col wide-card mdl-card mdl-shadow--4dp">
                <div class="mdl-grid">
                    <table class="table mdl-data-table mdl-js-data-table mdl-cell mdl-cell--10-col">
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Rol</th>
                                <th>Módulo</th>
                                <th>Acción</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($tracking as $track)
                            <tr ondblclick="erase(this)">
                                <td>{{ getUserName($track->user_id) }}</td>
                                <td>{{ getRolName($track->user_rol_id) }}</td>
                                <td>{{ $track->module }}</td>
                                <td>{{ $track->action }}</td>
                                <td>{{ $track->created_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script src="{{ asset('js/tracking.js') }}"></script>
    @if(Auth::user()->hasRole('admin'))
        <script>
            user_id = '{{ Auth::user()->id }}',
            urlDeleteTracking = encodeURI('{{ route('tracking.delete') }}')
        </script>
    @endif
@endsection