@extends('layouts.app')
@section('css')
    <link href="{{ asset('css/modules.css') }}" rel="stylesheet">
@endsection
@section('title')
    CITAS
@endsection

@section('content')
    <div class="mdl-grid">
        @if(Auth::user()->hasRole('admin'))
            @include('meetings.admin.content')
        @elseif(Auth::user()->hasRole('operator'))
            @include('meetings.operator.content')
        @elseif(Auth::user()->hasRole('doctor'))
            @include('meetings.doctor.content')
        @elseif(Auth::user()->hasRole('patient'))
            @include('meetings.patient.content')
        @endif
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/meetings.js') }}"></script>
        <script>
            user_id = '{{ Auth::user()->id }}',
            patient = "{{ Auth::user()->names . ', ' . Auth::user()->family_names }}",
            role = '{{ getUserRol(Auth::user()->id) }}',
            urlConsultation = "{{ route('consultations.index') }}",
            urlCheckDocTime = encodeURI("{{ route('doctor.time') }}"),
            urlCheckDocWorkdays = encodeURI("{{ route('doctor.workdays') }}"),
            urlPatientName = encodeURI("{{ route('patient.name') }}"),
            urlUserName = encodeURI("{{ route('user.name') }}"),
            urlStoreMeeting = encodeURI("{{ route('meeting.store') }}"),
            urlUpdateMeeting = encodeURI("{{ route('meeting.update') }}"),
            urlDeleteMeeting = encodeURI("{{ route('meeting.delete') }}"),
            urlInfoMeeting = encodeURI("{{ route('meeting.info') }}")
        </script>
@endsection