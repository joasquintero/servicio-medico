<div class = "mdl-cell mdl-cell--5-col hser-table">
    <div class="mdl-grid">
        <table class="table mdl-cell mdl-cell--10-col mdl-data-table mdl-js-data-table mdl-shadow--4dp">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Cédula</th>
                    <th>Correo</th>
                </tr>
            </thead>
            <tbody class="hser-tbody">
            @foreach ($users as $user)
                <tr onclick="getRecordInfo(this)" ondblclick="erase(this)">
                    <td name="id">{{ $user->id }}</td>
                    <td name="names">{{ $user->names }}</td>
                    <td name="family_names">{{ $user->family_names }}</td>
                    <td name="id_number">{{ $user->id_number }}</td>
                    <td name="email">{{ $user->email }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="mdl-cell mdl-cell--1-col mdl-cell--1-col-tablet mdl-cell--1-col-phone">
            <button class="mdl-button mdl-js-button mdl-button--fab mdl-button--colored hser_btn_to_right" onclick="slideRight()">
                <i class="material-icons"> > </i>
            </button>
            <button class="mdl-button mdl-js-button mdl-button--fab mdl-button--colored hser_btn_to_left" onclick="slideLeft()">
                <i class="material-icons"> < </i>
            </button>
        </div>
    </div>
</div>
<div class = "mdl-cell mdl-cell--7-col hser-card">
    <div class="mdl-cell mdl-cell--12-col wide-card mdl-card mdl-shadow--4dp">
        <div class="mdl-layout__header-row card_title">
        <div class = "mdl-cell mdl-cell--1-col">
        </div>
        <div class = "mdl-cell mdl-cell--9-col">
            Usuario
        </div>
        <div class = "mdl-cell mdl-cell--2-col">
            <button class="mdl-button mdl-js-button mdl-shadow--4dp btn_clear_form" onclick="clearForm()">
                <i class="material-icons"> + </i>
            </button>
        </div>
        </div>

        <form class="mdl-grid form hser_create_form" onsubmit="sendCreate(this)">
            {{ csrf_field() }}
            <div class="mdl-cell mdl-cell--6-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" id="names" type="text" class="form-control{{ $errors->has('names') ? ' is-invalid' : '' }}" name="names" value="{{ old('names') }}" required autofocus>
                <label class="mdl-textfield__label" for="names">{{ __('Nombres') }}</label>
                @if ($errors->has('names'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('names') }}</strong>
                    </span>
                @endif
            </div>
            <div class="mdl-cell mdl-cell--6-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" id="family_names" type="text" class="form-control{{ $errors->has('family_names') ? ' is-invalid' : '' }}" name="family_names" value="{{ old('family_names') }}" required>
                <label class="mdl-textfield__label" for="family_names">{{ __('Apellidos') }}</label>
                @if ($errors->has('family_names'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('family_names') }}</strong>
                    </span>
                @endif
            </div>
            <div class="mdl-cell mdl-cell--6-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" id="id_number" type="text" class="form-control{{ $errors->has('id_number') ? ' is-invalid' : '' }}" name="id_number" value="{{ old('id_number') }}" maxlength="12" required>
                <label class="mdl-textfield__label" for="id_number">{{ __('Cédula') }}</label>
                @if ($errors->has('id_number'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('id_number') }}</strong>
                    </span>
                @endif
            </div>
            <div class="mdl-cell mdl-cell--6-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                <label class="mdl-textfield__label" for="email">{{ __('Correo') }}</label>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            
            <div class="mdl-cell mdl-cell--6-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ old('password') }}" minlength="6" required>
                <label class="mdl-textfield__label" for="password">{{ __('Contraseña') }}</label>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <input type="hidden" name="id">
            <div class="mdl-cell mdl-cell--12-col">
                <button type="submit" class="mdl-cell mdl-cell--12-col mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored btn-tracking">
                    {{ __('Guardar') }}
                </button>
            </div>
        </form>
    </div>
</div>