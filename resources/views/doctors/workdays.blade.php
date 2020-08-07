@extends('layouts.app')
@section('title')
    TURNOS MÉDICOS
@endsection
@section('css')
    <link href="{{ asset('css/modules.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--3-col"></div>
        <div class="mdl-cell mdl-cell--6-col">
            <table class="table mdl-cell mdl-cell--12-col mdl-data-table mdl-js-data-table mdl-shadow--4dp">
                <thead>
                    <tr>
                        <th>Médico</th>
                        <th>Horario</th>
                        <th>Dias</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($doctors as $doctor)
                    @php
                        $workdays = explode(",", $doctor->workdays);
                    @endphp
                    <tr>
                        <td style="text-align:left;">{{ $doctor->gender == 'Masculino' ? 'Dr. ' : 'Dra. ' }}{{  $doctor->names . ' ' . $doctor->family_names }}</td>
                        <td>{{ $doctor->entry_time . ' - ' . $doctor->exit_time }}</td>
                            <td>
                                @foreach($workdays as $workday)
                                    {{ ucfirst($workday) . ' ' }}
                                @endforeach                                
                            </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection