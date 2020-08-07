<div class = "mdl-cell mdl-cell--5-col hser-table">
    <div class="mdl-grid">
        <table class="table mdl-cell mdl-cell--10-col mdl-data-table mdl-js-data-table mdl-shadow--4dp">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                </tr>
            </thead>
            <tbody class="hser-tbody">
            @foreach ($roles as $role)
                <tr onclick="getRecordInfo(this)" ondblclick="erase(this)">
                    <td name="id">{{ $role->id }}</td>
                    <td name="name">{{ $role->name }}</td>
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
            ROL
        </div>
        <div class = "mdl-cell mdl-cell--2-col">
        <button class="mdl-button mdl-js-button mdl-shadow--4dp btn_clear_form hser-btn" onclick="clearForm()">
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
                <input class="mdl-textfield__input" id="slug" type="text" class="form-control{{ $errors->has('slug') ? ' is-invalid' : '' }}" name="slug" value="{{ old('slug') }}" required>
                <label class="mdl-textfield__label" for="slug">{{ __('Slug') }}</label>
                @if ($errors->has('slug'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('slug') }}</strong>
                    </span>
                @endif
            </div>
            <input type="hidden" name="id">
            <div class="mdl-cell mdl-cell--12-col">
                <button type="submit" class="mdl-cell mdl-cell--12-col hser-btn btn-tracking">
                    {{ __('Guardar') }}
                </button>
            </div>
        </form>
    </div>
</div>