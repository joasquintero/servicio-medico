<div class = "mdl-cell mdl-cell--5-col hser-table">
    <div class="mdl-grid">
        <table class="table mdl-cell mdl-cell--10-col mdl-data-table mdl-js-data-table mdl-shadow--4dp">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Paciente</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody class="hser-tbody">
            @foreach ($meetings as $meeting)
                <tr onclick="getRecordInfo(this)" ondblclick="erase(this)">
                    <td name="id">{{ $meeting->id }}</td>
                    <td name="patient_id">{{ getUserName($meeting->patient_id) }}</td>
                    <td name="date">{{ $meeting->date }}</td>
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
            CITA
        </div>
        <div class = "mdl-cell mdl-cell--2-col">
        <button class="mdl-button mdl-js-button mdl-shadow--4dp btn_clear_form hser-btn" onclick="clearForm()">
                <i class="material-icons"> + </i>
            </button>
        </div>
        </div>

        <form class="mdl-grid form hser_create_form" onsubmit="sendCreate(this)">
            {{ csrf_field() }}
            <div class="mdl-cell mdl-cell--6-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" id="doctor_id" type="text" name="doctor_id" value="{{ old('doctor_id') }}" readonly required>
                <label class="mdl-textfield__label" for="doctor_id">{{ __('Doctor') }}</label>
                @if ($errors->has('doctor_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('doctor_id') }}</strong>
                    </span>
                @endif
            </div>
            <div class="mdl-cell mdl-cell--6-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" id="patient_id" type="text" name="patient_id" value="{{ old('patient_id') }}" readonly required>
                <label class="mdl-textfield__label" for="patient_id">{{ __('Paciente') }}</label>
                @if ($errors->has('patient_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('patient_id') }}</strong>
                    </span>
                @endif
            </div>
            <div class="mdl-cell mdl-cell--6-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input oninput="checkDocWorkdays(this)" class="mdl-textfield__input" id="date" type="date" name="date" value="{{ old('date') }}" required>
                <label class="mdl-textfield__label" for="date">{{ __('Fecha') }}</label>
                @if ($errors->has('date'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('date') }}</strong>
                    </span>
                @endif
            </div>
            <div class="mdl-cell mdl-cell--6-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input oninput="checkDocTime(this)" class="mdl-textfield__input" id="hour" type="time" name="hour" value="{{ old('hour') }}" required>
                <label class="mdl-textfield__label" for="hour">{{ __('Hora') }}</label>
                @if ($errors->has('hour'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('hour') }}</strong>
                    </span>
                @endif
            </div>
            <input type="hidden" name="id">
            <div class="mdl-cell mdl-cell--12-col">
                <button type="submit" class="mdl-cell mdl-cell--12-col hser-btn btn-tracking">
                    {{ __('GUARDAR') }}
                </button>
            </div>
        </form>
    </div>
</div>
@section('panel')
<table id="patients" class="mdl-cell mdl-cell--12-col mdl-data-table mdl-js-data-table mdl-shadow--4dp">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombres</th>
            <th>Apellidos</th>
        </tr>
    </thead>
    <tbody class="hser-tbody">
    @foreach ($patients as $patient)
        <tr ondblclick="getTrFullname(this, input)">
            <td name="id">{{ $patient->id }}</td>
            <td name="names">{{ $patient->names }}</td>
            <td name="family_names">{{ $patient->family_names }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<table id="doctors" class="mdl-cell mdl-cell--12-col mdl-data-table mdl-js-data-table mdl-shadow--4dp">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellidos</th>
        </tr>
    </thead>
    <tbody class="hser-tbody">
    @foreach ($doctors as $doctor)
        <tr ondblclick="getTrFullname(this, input)">
            <td name="id">{{ $doctor->id }}</td>
            <td name="names">{{ $doctor->names }}</td>
            <td name="family_names">{{ $doctor->family_names }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection