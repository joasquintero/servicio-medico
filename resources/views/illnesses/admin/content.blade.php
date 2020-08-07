<div class = "mdl-cell mdl-cell--5-col hser-table">
    <div class="mdl-grid">
        <table class="table mdl-cell mdl-cell--10-col mdl-data-table mdl-js-data-table mdl-shadow--4dp">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                </tr>
            </thead>
            <tbody class="hser-tbody">
            @foreach ($illnesses as $illness)
                <tr onclick="getRecordInfo(this)" ondblclick="erase(this)">
                    <td name="id">{{ $illness->id }}</td>
                    <td name="name">{{ $illness->name }}</td>
                    <td name="type">{{ $illness->type }}</td>
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
            Enfermedad
        </div>
        <div class = "mdl-cell mdl-cell--2-col">
        <button class="mdl-button mdl-js-button mdl-shadow--4dp btn_clear_form" onclick="clearForm()">
                <i class="material-icons"> + </i>
            </button>
        </div>
        </div>

        <form class="mdl-grid form hser_create_form" onsubmit="sendCreate(this)">
            {{ csrf_field() }}
            <div class="mdl-cell mdl-cell--12-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                <label class="mdl-textfield__label" for="name">{{ __('Nombre') }}</label>
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="mdl-cell mdl-cell--12-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" id="type" type="text" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" name="type" value="{{ old('type') }}" required>
                <label class="mdl-textfield__label" for="type">{{ __('Tipo') }}</label>
                @if ($errors->has('type'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('type') }}</strong>
                    </span>
                @endif
            </div>
            <div class="mdl-cell mdl-cell--12-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <textarea class="mdl-textfield__input" id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{ old('description') }}" required></textarea>
                <label class="mdl-textfield__label" for="description">{{ __('Descripción') }}</label>
                @if ($errors->has('description'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('description') }}</strong>
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