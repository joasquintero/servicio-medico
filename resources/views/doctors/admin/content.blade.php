<div class = "mdl-cell mdl-cell--5-col hser-table">
    <div class="mdl-grid">
        <table class="table mdl-cell mdl-cell--11-col mdl-data-table mdl-js-data-table mdl-shadow--4dp">
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
            @foreach ($doctors as $doctor)
                <tr onclick="getRecordInfo(this)" ondblclick="erase(this)">
                    <td name="id">{{ $doctor->id }}</td>
                    <td name="names">{{ $doctor->names }}</td>
                    <td name="family_names">{{ $doctor->family_names }}</td>
                    <td name="id_number">{{ $doctor->id_number }}</td>
                    <td name="email">{{ $doctor->email }}</td>
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
            Doctor
        </div>
        <div class = "mdl-cell mdl-cell--2-col">
            <button class="mdl-button mdl-js-button mdl-shadow--4dp btn_clear_form" onclick="clearForm()">
                <i class="material-icons"> + </i>
            </button>
        </div>
        </div>

        <form class="mdl-grid form hser_create_form" onsubmit="sendCreate(this)">
            {{ csrf_field() }}
            <div class="mdl-cell mdl-cell--4-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" id="names" type="text" class="form-control{{ $errors->has('names') ? ' is-invalid' : '' }}" name="names" value="{{ old('names') }}" required autofocus>
                <label class="mdl-textfield__label" for="names">{{ __('Nombres') }}</label>
                @if ($errors->has('names'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('names') }}</strong>
                    </span>
                @endif
            </div>
            <div class="mdl-cell mdl-cell--4-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" id="family_names" type="text" class="form-control{{ $errors->has('family_names') ? ' is-invalid' : '' }}" name="family_names" value="{{ old('family_names') }}" required>
                <label class="mdl-textfield__label" for="family_names">{{ __('Apellidos') }}</label>
                @if ($errors->has('family_names'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('family_names') }}</strong>
                    </span>
                @endif
            </div>
            <div class="mdl-cell mdl-cell--4-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" id="id_number" type="text" class="form-control{{ $errors->has('id_number') ? ' is-invalid' : '' }}" name="id_number" value="{{ old('id_number') }}" maxlength="12" required>
                <label class="mdl-textfield__label" for="id_number">{{ __('Cédula') }}</label>
                @if ($errors->has('id_number'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('id_number') }}</strong>
                    </span>
                @endif
            </div>
            <div class="mdl-cell mdl-cell--4-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                <label class="mdl-textfield__label" for="email">{{ __('Correo') }}</label>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="mdl-cell mdl-cell--4-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" id="phone" type="phone" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" minlength="6" required>
                <label class="mdl-textfield__label" for="phone">{{ __('Teléfono') }}</label>
                @if ($errors->has('phone'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                @endif
            </div>

            <div class="mdl-cell mdl-cell--4-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" id="address" type="address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}" minlength="6" required>
                <label class="mdl-textfield__label" for="address">{{ __('Dirección') }}</label>
                @if ($errors->has('address'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('address') }}</strong>
                    </span>
                @endif
            </div>

            <div class="mdl-cell mdl-cell--2-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" id="age" type="number" class="form-control{{ $errors->has('age') ? ' is-invalid' : '' }}" name="age" value="{{ old('age') }}" maxlength="2" >
                <label class="mdl-textfield__label" for="age">{{ __('Edad') }}</label>
                @if ($errors->has('age'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('age') }}</strong>
                    </span>
                @endif
            </div>

            <div class="mdl-cell mdl-cell--4-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" id="major" type="text" class="form-control{{ $errors->has('major') ? ' is-invalid' : '' }}" name="major" value="{{ old('major') }}">
                <label class="mdl-textfield__label" for="major">{{ __('Especialidad') }}</label>
                @if ($errors->has('major'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('major') }}</strong>
                    </span>
                @endif
            </div>
            <div class="mdl-cell mdl-cell--4-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" id="birthplace" type="text" class="form-control{{ $errors->has('birthplace') ? ' is-invalid' : '' }}" name="birthplace" value="{{ old('birthplace') }}">
                <label class="mdl-textfield__label" for="birthplace">{{ __('Lugar de Nacimiento') }}</label>
                @if ($errors->has('birthplace'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('birthplace') }}</strong>
                    </span>
                @endif
            </div>
            <div class="mdl-cell mdl-cell--2-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" id="birthdate" type="date" class="form-control{{ $errors->has('birthdate') ? ' is-invalid' : '' }}" name="birthdate" value="{{ old('birthdate') }}">
                <label class="mdl-textfield__label" for="birthdate">{{ __('Fecha de Nacimiento') }}</label>
                @if ($errors->has('birthdate'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('birthdate') }}</strong>
                    </span>
                @endif
            </div>
            <div class="mdl-cell mdl-cell--4-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <select class="mdl-textfield__input" id="gender" name="gender">
                    <option>Seleccionar Género</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                </select>
                @if ($errors->has('gender'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('gender') }}</strong>
                    </span>
                @endif
            </div>
            <div class="mdl-cell mdl-cell--4-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" id="entry_time" type="time" class="form-control{{ $errors->has('entry_time') ? ' is-invalid' : '' }}" name="entry_time" value="{{ old('entry_time') }}">
                <label class="mdl-textfield__label" for="entry_time">{{ __('Hora de Entrada') }}</label>
                @if ($errors->has('entry_time'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('entry_time') }}</strong>
                    </span>
                @endif
            </div>
            <div class="mdl-cell mdl-cell--4-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" id="exit_time" type="time" class="form-control{{ $errors->has('exit_time') ? ' is-invalid' : '' }}" name="exit_time" value="{{ old('exit_time') }}">
                <label class="mdl-textfield__label" for="exit_time">{{ __('Hora de Salida') }}</label>
                @if ($errors->has('exit_time'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('exit_time') }}</strong>
                    </span>
                @endif
            </div>
            <div class="mdl-cell mdl-cell--12-col">
            <table class = "mdl-cell mdl-cell--12-col mdl-data-table mdl-js-data-table">
                    <thead>
                        <tr>
                            <th>Lun</th>
                            <th>Mar</th>
                            <th>Miér</th>
                            <th>Jue</th>
                            <th>Vier</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <label for="lunes" class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect">
                                  <input type="checkbox" name="workdays[]" id="lunes" value="lunes" class="mdl-checkbox__input">
                                </label>
                            </td>
                            <td>
                                <label for="martes" class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect">
                                  <input type="checkbox" name="workdays[]" id="martes" value="martes" class="mdl-checkbox__input">
                                </label>
                            </td>
                            <td>
                                <label for="miercoles" class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect">
                                  <input type="checkbox" name="workdays[]" id="miercoles" value="miercoles" class="mdl-checkbox__input">
                                </label>
                            </td>
                            <td>
                                <label for="jueves" class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect">
                                  <input type="checkbox" name="workdays[]" id="jueves" value="jueves" class="mdl-checkbox__input">
                                </label>
                            </td>
                            <td>
                                <label for="viernes" class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect">
                                  <input type="checkbox" name="workdays[]" id="viernes" value="viernes" class="mdl-checkbox__input">
                                </label>
                            </td>
                        </tr>
                    </tbody>
                </table>  
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