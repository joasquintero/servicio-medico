<div class = "mdl-layout__drawer">
    <span class = "mdl-layout-title">
        @if(Auth::user())
            {{ Auth::user()->names }}
        @else
            Servicios Médicos
        @endif
    </span>
    <hr>
    <nav class = "mdl-navigation">
        @guest
            <a class="mdl-navigation__link hvr-underline-from-left" href="{{ url('/') }}">{{ __('Entrar') }}</a>
        @else
            <a class="mdl-navigation__link hvr-underline-from-left" href="{{ route('dashboard') }}">{{ __('Inicio') }}</a>
        @if(Auth::user()->hasRole('admin'))
            <a class="mdl-navigation__link hvr-underline-from-left" href="{{ route('roles.index') }}">{{ __('Roles') }}</a>
            <a class="mdl-navigation__link hvr-underline-from-left" href="{{ route('permissions.index') }}">{{ __('Permisos') }}</a>
            <a class="mdl-navigation__link hvr-underline-from-left" href="{{ route('users.index') }}">{{ __('Usuarios') }}</a>
            <a class="mdl-navigation__link hvr-underline-from-left" href="{{ route('doctors.index') }}">{{ __('Doctores') }}</a>
            <a class="mdl-navigation__link hvr-underline-from-left" href="{{ route('operators.index') }}">{{ __('Operadores') }}</a>
            <a class="mdl-navigation__link hvr-underline-from-left" href="{{ route('patients.index') }}">{{ __('Pacientes') }}</a>
            <a class="mdl-navigation__link hvr-underline-from-left" href="{{ route('illnesses.index') }}">{{ __('Enfermedades') }}</a>
            <a class="mdl-navigation__link hvr-underline-from-left" href="{{ route('consultations.index') }}">{{ __('Consultas') }}</a>
            <a class="mdl-navigation__link hvr-underline-from-left" href="{{ route('tracking.index') }}">{{ __('Auditoria') }}</a>
            <a class="mdl-navigation__link hvr-underline-from-left" href="{{ route('user.pending') }}">{{ __('Cambio de Rol') }}</a>
            <a class="mdl-navigation__link hvr-underline-from-left" href="{{ route('reports.index') }}">{{ __('Reportes') }}</a>
        @elseif(Auth::user()->hasRole('operator'))
            <a class="mdl-navigation__link hvr-underline-from-left" href="{{ route('doctors.index') }}">{{ __('Doctores') }}</a>
            <a class="mdl-navigation__link hvr-underline-from-left" href="{{ route('patients.index') }}">{{ __('Pacientes') }}</a>
            <a class="mdl-navigation__link hvr-underline-from-left" href="{{ route('illnesses.index') }}">{{ __('Enfermedades') }}</a>
        @elseif(Auth::user()->hasRole('doctor'))
            <a class="mdl-navigation__link hvr-underline-from-left" href="{{ route('patients.index') }}">{{ __('Pacientes') }}</a>
            <a class="mdl-navigation__link hvr-underline-from-left" href="{{ route('illnesses.index') }}">{{ __('Enfermedades') }}</a>
            <a class="mdl-navigation__link hvr-underline-from-left" href="{{ route('consultations.index') }}">{{ __('Consultas') }}</a>
        @endif
        <a class="mdl-navigation__link hvr-underline-from-left" href="{{ route('meetings.index') }}">{{ __('Citas') }}</a>
        <hr>
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
            </a>
                <a class="mdl-navigation__link hvr-underline-from-left" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Salir') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
        </li>
        @endguest 
    </nav>
</div>