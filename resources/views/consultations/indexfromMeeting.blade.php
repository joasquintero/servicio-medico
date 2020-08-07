@extends('layouts.app')
@section('css')
    <link href="{{ asset('css/modules.css') }}" rel="stylesheet">
@endsection
@section('title')
    CONSULTA
@endsection

@section('content')
    <div class="mdl-grid">
        @if(Auth::user()->hasRole('admin'))
            @include('consultations.admin.contentFromMeeting')
        @elseif(Auth::user()->hasRole('doctor'))
            @include('consultations.doctor.contentFromMeeting')
        @endif
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/consultations.js') }}"></script>
    @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('doctor'))
        <script>
            var input
            user_id = '{{ Auth::user()->id }}',
            patient = '{{ $patient }}',
            userNames = '{{ $doctor }}',
            urlIllnessId = encodeURI("{{ route('illness.id') }}"),
            urlIllnessName = encodeURI("{{ route('illness.name') }}"),
            urlPatientName = encodeURI("{{ route('patient.name') }}"),
            urlUserName = encodeURI("{{ route('user.name') }}"),
            urlStoreConsultation = encodeURI("{{ route('consultation.store') }}"),
            urlUpdateConsultation = encodeURI("{{ route('consultation.update') }}"),
            urlDeleteConsultation = encodeURI("{{ route('consultation.delete') }}"),
            urlInfoConsultation = encodeURI("{{ route('consultation.info') }}")
        </script>
    @endif
@endsection