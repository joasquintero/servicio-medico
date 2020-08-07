@extends('layouts.app')
@section('title')
    CAMBIO DE ROL
@endsection
@section('css')
    <link href="{{ asset('css/modules.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="mdl-grid">
<div class="mdl-cell mdl-cell--1-col">    
</div>
    <div class="mdl-cell mdl-cell--10-col">
    <div class="mdl-grid border">
        <div class="mdl-cell mdl-cell--1-col">
        </div>
        <div class="mdl-cell mdl-cell--10-col wide-card mdl-card mdl-shadow--4dp">
                <div class="mdl-cell mdl-cell--12-col">
                    <table class="table mdl-cell mdl-cell--12-col mdl-data-table mdl-js-data-table mdl-shadow--1dp">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Usuario</th>
                                <th>Rol Actual</th>
                                <th>Nuevo Rol</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ getUserName($user->id) }}</td>
                                <td>{{ getUserRol($user->id) }}</td>
                                <td>
                                    <select name="rol" class="mdl-textfield__input" onchange="setRol(this)">
                                        <option value="">Seleccione Rol</option>
                                        @foreach($roles as $rol)
                                            <option value="{{ $rol->slug }}">{{ $rol->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
        </div>
    </div>    
</div>
@endsection

@section('js')
    <script src="{{ asset('js/users.js') }}"></script>
    @if(Auth::user()->hasRole('admin'))
        <script>
            user_id = '{{ Auth::user()->id }}',
            urlsetRol = encodeURI('{{ route('user.rol') }}')
        </script>
    @endif
@endsection