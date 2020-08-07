<div id="login_container" class="mdl-cell mdl-cell--12-col wide-card mdl-card mdl-shadow--4dp">
    <div class="mdl-layout__header-row" style="background-color:rgb(83, 109, 254);color:#fff; justify-content: center;">
        <div class="mdl-grid">
            <h4>{{ __('Entrar') }}</h4>
        </div>
    </div>
    <form method="POST" action="{{ route('login') }}" style="margin-top:10%;">
        @csrf
        <!-- Textfield with Floating Label -->
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--12-col">
                <div class="mdl-cell mdl-cell--12-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" id="id_number" type="text" class="form-control{{ $errors->has('id_number') ? ' is-invalid' : '' }}" name="id_number" value="{{ old('id_number') }}" required autofocus>
                    <label class="mdl-textfield__label" for="id_number">{{ __('Cédula') }}</label>
                    @if ($errors->has('cedula'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('cedula') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <!-- Textfield with Floating Label -->
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--12-col">
                <div class="mdl-cell mdl-cell--12-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ old('password') }}" required>
                    <label class="mdl-textfield__label" for="password">{{ __('Contraseña') }}</label>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>  
            </div>
        </div> 
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--6-col">
                <button type="submit" class="mdl-cell mdl-cell--12-col mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">
                    {{ __('Entrar') }}
                </button>
            </div>
            <div class="mdl-cell mdl-cell--6-col">
                <button id="btn_register" class="mdl-cell mdl-cell--12-col mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--colored">
                    {{ __('Registrar') }}
                </button>
            </div>
            <!-- <div class="mdl-cell mdl-cell--12-col">
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('¿Olvidó su contraseña?') }}
                </a>
            </div> -->
        </div>
    </form>
</div>