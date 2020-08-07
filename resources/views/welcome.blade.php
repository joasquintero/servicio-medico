@extends('layouts.app')

@section('content')
<div class="mdl-grid">
    <div class="mdl-cell mdl-cell--4-col mdl-cell--2-col-tablet mdl-cell--0-col-phone"></div>
    <div class="mdl-cell mdl-cell--4-col mdl-cell--8-col-tablet mdl-cell--12-col-phone" style="margin-top:3%;">
        <div class="mdl-grid">
            {{-- Login --}}
            @include('auth.login')

            {{-- Register --}}
            @include('auth.register')
        </div>
    </div>
    <div class="mdl-cell mdl-cell--4-col mdl-cell--2-col-tablet mdl-cell--0-col-phone">
    </div>
</div>
@endsection

@section('js')
    <script src="{{ asset('js/auth/login.js') }}"></script>
@endsection
