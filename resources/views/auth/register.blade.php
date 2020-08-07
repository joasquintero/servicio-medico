<div id="register_container" class="mdl-cell mdl-cell--12-col wide-card mdl-card mdl-shadow--4dp" style="display:none">
    <div class="mdl-layout__header-row" style="background-color:rgb(83, 109, 254);color:#fff; justify-content: center;">
        <div class="mdl-grid">
            <h4>{{ __('Registrar') }}</h4>
        </div>
    </div>

        <form method="POST" action="{{ route('register') }}" style="margin-top:10%;">
            @csrf

            <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--12-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <div class="col-md-6">
                        <input id="names" type="text" class="mdl-textfield__input{{ $errors->has('names') ? ' is-invalid' : '' }}" name="names" value="{{ old('names') }}" required autofocus>
                        <label for="names" class="mdl-textfield__label">{{ __('Nombres') }}</label>
                        @if ($errors->has('names'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('names') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--12-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <div class="col-md-6">
                        <input id="family_names" type="text" class="mdl-textfield__input{{ $errors->has('family_names') ? ' is-invalid' : '' }}" name="family_names" value="{{ old('family_names') }}" required >
                        <label for="family_names" class="mdl-textfield__label">{{ __('Apellidos') }}</label>
                        @if ($errors->has('family_names'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('family_names') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--12-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <div class="col-md-6">
                        <input id="id_number" type="text" class="mdl-textfield__input{{ $errors->has('id_number') ? ' is-invalid' : '' }}" name="id_number" value="{{ old('id_number') }}" required>
                        <label for="id_number" class="mdl-textfield__label">{{ __('Cédula') }}</label>
                        @if ($errors->has('id_number'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('id_number') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--12-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <div class="col-md-6">
                        <input id="email" type="email" class="mdl-textfield__input{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required >
                        <label for="email" class="mdl-textfield__label">{{ __('Correo') }}</label>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--12-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <div class="col-md-6">
                        <input id="password" type="password" class="mdl-textfield__input{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ old('password') }}" required>
                        <label for="password" class="mdl-textfield__label">{{ __('Contraseña') }}</label>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--12-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input id="password-confirm" type="password" class="mdl-textfield__input" name="password_confirmation" required>
                    <label for="password-confirm" class="mdl-textfield__label">{{ __('Confirmar Contraseña') }}</label>
                </div>
            </div>

            <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--6-col">
                    <button type="submit" class="mdl-cell mdl-cell--12-col mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">
                        {{ __('Registrar') }}
                    </button>
                </div>
                <div class="mdl-cell mdl-cell--6-col">
                    <button id="btn_login" class="mdl-cell mdl-cell--12-col mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--colored">
                        {{ __('Entrar') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>