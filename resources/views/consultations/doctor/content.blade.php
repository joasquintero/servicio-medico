<div class = "mdl-cell mdl-cell--5-col mdl-cell--12-col-phone hser-table">
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
            @foreach ($consultationsDoc as $consultation)
                <tr onclick="getConsultationRecord(this)" ondblclick="erase(this)">
                    <td name="id">{{ $consultation->id }}</td>
                    <td name="patient_id">{{ getUserName($consultation->patient_id) }}</td>
                    <td name="date">{{ $consultation->date }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="mdl-cell mdl-cell--1-col mdl-cell--1-col-tablet mdl-cell--1-col-phone">
            <button class="mdl-button mdl-js-button mdl-button--fab mdl-button--colored hser_btn_to_right" onclick="slideRight()">
                <i class="material-icons"> &gt; </i>
            </button>
            <button class="mdl-button mdl-js-button mdl-button--fab mdl-button--colored hser_btn_to_left" onclick="slideLeft()">
                <i class="material-icons"> &lt; </i>
            </button>
        </div>
    </div>
</div>
<div class = "mdl-cell mdl-cell--7-col mdl-cell--12-col-phone hser-card">
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col wide-card mdl-card mdl-shadow--4dp">
            <div class="mdl-layout__header-row card_title">
                <div class = "mdl-cell mdl-cell--1-col">
                </div>
                <div class = "mdl-cell mdl-cell--9-col">
                    DATOS
                </div>
                <div class = "mdl-cell mdl-cell--2-col">
                <button class="mdl-button mdl-js-button mdl-shadow--4dp btn_clear_form" onclick="clearForm()">
                        <i class="material-icons"> + </i>
                    </button>
                </div>
            </div>

            <form class="mdl-grid form">
                {{ csrf_field() }}
                <div class="mdl-cell mdl-cell--6-col">
                    <div class="mdl-cell mdl-cell--12-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" id="doctor_id" type="text" class="form-control{{ $errors->has('doctor_id') ? ' is-invalid' : '' }}" name="doctor_id" readonly autofocus>
                        <label class="mdl-textfield__label" for="doctor_id">{{ __('Doctor') }}</label>
                        @if ($errors->has('doctor_id'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('doctor_id') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="mdl-cell mdl-cell--12-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" id="patient_id" type="text" class="form-control{{ $errors->has('patient_id') ? ' is-invalid' : '' }}" name="patient_id" value="{{ old('patient_id') }}" readonly required>
                        <label class="mdl-textfield__label" for="patient_id">{{ __('Paciente') }}</label>
                        @if ($errors->has('patient_id'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('patient_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="mdl-cell mdl-cell--6-col">
                    <div class="mdl-cell mdl-cell--12-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-focused">
                        <input class="mdl-textfield__input" id="date" type="date" name="date">
                        <label class="mdl-textfield__label" for="date">{{ __('Fecha') }}</label>
                        @if ($errors->has('date'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('date') }}</strong>
                            </span>
                        @endif
                    </div>
                    @if (!empty($meeting_id))
                        <div class="mdl-cell mdl-cell--1-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" id="meeting" type="checkbox" name="meeting" value="{{ old('meeting') }}" checked required>
                                <label class="mdl-textfield__label" for="meeting">{{ __('Cita') }}</label>
                        </div>
                    @endif
                    <div class="mdl-cell mdl-cell--11-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" id="reference" type="text" class="form-control{{ $errors->has('reference') ? ' is-invalid' : '' }}" name="reference" value="{{ old('reference') }}">
                        <label class="mdl-textfield__label" for="reference">{{ __('Referecia') }}</label>
                        @if ($errors->has('reference'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('reference') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="mdl-grid border">
        <div class="mdl-cell mdl-cell--11-col wide-card mdl-card mdl-shadow--4dp">
            <div class="mdl-tabs mdl-js-tabs">
                <div class="mdl-tabs__tab-bar">
                    <a href="#tab1" onclick="tabFocus(this)" class="mdl-tabs__tab is-active">Motivo</a>
                    <a href="#tab2" onclick="tabFocus(this)" class="mdl-tabs__tab">HEA</a>
                    <a href="#tab3" class="mdl-tabs__tab">Antecedentes</a>
                    <a href="#tab4" onclick="tabFocus(this)" class="mdl-tabs__tab">Exámen</a>
                    <a href="#tab5" class="mdl-tabs__tab">Paraclínicos</a>
                    <a href="#tab6" class="mdl-tabs__tab">Diagnóstico</a>
                    <a href="#tab7" class="mdl-tabs__tab">Tratamiento</a>
                </div>
                <div class="mdl-tabs__panel is-active" id="tab1">
                    <div class="mdl-grid">
                        <div class="mdl-cell mdl-cell--12-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <textarea class="mdl-textfield__input hser-input-disable" id="motives" type="text" name="motives" value="{{ old('motives') }}"></textarea>
                            <label class="mdl-textfield__label" for="motives">{{ __('Descripción') }}</label>
                            @if ($errors->has('motives'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('motives') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="mdl-tabs__panel" id="tab2">
                    <div class="mdl-grid">
                        <div class="mdl-cell mdl-cell--12-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <textarea class="mdl-textfield__input hser-input-disable" id="cih" type="text" name="cih" value="{{ old('cih') }}"></textarea>
                            <label class="mdl-textfield__label" for="cih">{{ __('Historia de enfermedad actual') }}</label>
                            @if ($errors->has('cih'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('cih') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="mdl-tabs__panel" id="tab3">
                    <div class="mdl-grid table_scroll">
                        <div class="hser-table-btn mdl-cell mdl-cell--1-col">
                            <button class="hser-btn" onclick="cloneRow(this)">+</button>
                            <button class="hser-btn" onclick="deleteRow(this)">-</button>
                        </div>
                        <table id="background-table" class="table mdl-cell mdl-cell--11-col mdl-data-table mdl-js-data-table mdl-shadow--1dp">
                            <thead>
                                <tr>
                                    <th>Familiar</th>
                                    <th>Enfermedad</th>
                                </tr>
                            </thead>
                            <tbody class="hser-tbody">
                                <tr>
                                    <td>
                                        <select name="relative" class="mdl-textfield__input">
                                            <option value="">Seleccione Familiar</option>
                                            <option value="1">El/Ella</option>
                                            <option value="2">Abuelo/a</option>
                                            <option value="3">Padre</option>
                                            <option value="4">Madre</option>
                                            <option value="5">Hermano/a</option>
                                            <option value="6">Tio/a</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input class="mdl-textfield__input  hser-input-disable illness_id" id="illness_id" type="text"name="illness_id" value="{{ old('illness_id') }}" readonly>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mdl-tabs__panel" id="tab4">
                    <div class="mdl-grid">
                        <div class="mdl-cell mdl-cell--12-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <textarea class="mdl-textfield__input hser-input-disable" id="phisic_test" type="text" name="phisic_test" value="{{ old('phisic_test') }}"></textarea>
                            <label class="mdl-textfield__label" for="phisic_test">{{ __('Exámen Físico') }}</label>
                            @if ($errors->has('phisic_test'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('phisic_test') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="mdl-tabs__panel" id="tab5">
                    <div class="mdl-grid table_scroll">
                        <div class="hser-table-btn mdl-cell mdl-cell--1-col">
                            <button class="hser-btn" onclick="cloneRow(this)">+</button>
                            <button class="hser-btn" onclick="deleteRow(this)">-</button>
                        </div>
                        <table id="paraclinic-table" class="table mdl-cell mdl-cell--11-col mdl-data-table mdl-js-data-table mdl-shadow--1dp">
                            <thead>
                                <tr>
                                    <th>Exámen</th>
                                    <th>Archivo</th>
                                </tr>
                            </thead>
                            <tbody class="hser-tbody">
                                <tr>
                                    <td>
                                        <input class="mdl-textfield__input hser-input-disable" id="test_name" type="text" name="text_name" value="{{ old('text_name') }}">
                                    </td>
                                    <td style="display:flex; flex-direction: row;">
                                        <input class="mdl-textfield__input" style="width:90%;" id="test_file" type="file" name="test_file" value="{{ old('test_file') }}">
                                        <input type="hidden" id="file_encoded">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mdl-tabs__panel" id="tab6">
                    <div class="mdl-grid table_scroll">
                        <div class="hser-table-btn mdl-cell mdl-cell--1-col">
                            <button class="hser-btn" onclick="cloneRow(this)">+</button>
                            <button class="hser-btn" onclick="deleteRow(this)">-</button>
                        </div>
                        <table id="diagnosis-table" class="table mdl-cell mdl-cell--11-col mdl-data-table mdl-js-data-table mdl-shadow--1dp">
                            <thead>
                                <tr>
                                    <th>Enfermedad</th>
                                    <th>Descripción</th>
                                </tr>
                            </thead>
                            <tbody class="hser-tbody">
                                <tr>
                                    <td>
                                        <input class="mdl-textfield__input  hser-input-disable illness_id" id="illness_id" type="text"name="illness_id" value="{{ old('illness_id') }}" readonly>
                                    </td>
                                    <td>
                                        <input class="mdl-textfield__input hser-input-disable" id="illness_description" type="text" name="illness_description" value="{{ old('illness_description') }}"></td>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mdl-tabs__panel" id="tab7">
                    <div class="mdl-grid table_scroll">
                        <div class="hser-table-btn mdl-cell mdl-cell--1-col">
                            <button class="hser-btn" onclick="cloneRow(this)">+</button>
                            <button class="hser-btn" onclick="deleteRow(this)">-</button>
                        </div>
                        <table id="treatment-table" class="table mdl-cell mdl-cell--11-col mdl-data-table mdl-js-data-table mdl-shadow--1dp">
                            <thead>
                                <tr>
                                    <th>Tipo</th>
                                    <th>Tratamiento</th>
                                    <th>Descripción</th>
                                </tr>
                            </thead>
                            <tbody class="hser-tbody">
                                <tr>
                                    <td>
                                        <select name="treatment_type" class="mdl-textfield__input">
                                            <option value="1">Médico</option>
                                            <option value="2">Quirúrgico</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input class="mdl-textfield__input hser-input-disable" id="treatment_name" type="text">
                                    </td>
                                    <td>
                                        <input class="mdl-textfield__input hser-input-disable" id="treatment_description" type="text">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <button id="hser-save-consultation" class="mdl-cell mdl-cell--1-col mdl-shadow--4dp hser-btn btn-tracking">G<br>u<br>a<br>r<br>d<br>a<br>r</button>
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
<table id="illnesses" class="mdl-cell mdl-cell--12-col mdl-data-table mdl-js-data-table mdl-shadow--4dp">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
        </tr>
    </thead>
    <tbody class="hser-tbody">
    @foreach ($illnesses as $illness)
        <tr ondblclick="getTrFullname(this, input)">
            <td name="id">{{ $illness->id }}</td>
            <td name="name">{{ $illness->name }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection