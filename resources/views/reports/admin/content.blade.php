<div class="mdl-grid">
<div class="mdl-cell mdl-cell--1-col">    
</div>
    <div class="mdl-cell mdl-cell--12-col">
    <div class="mdl-grid border">
        <div class="mdl-cell mdl-cell--12-col wide-card mdl-card mdl-shadow--4dp">
            <div class="mdl-tabs mdl-js-tabs">
                <div class="mdl-tabs__tab-bar">
                    <a href="#tab1" class="mdl-tabs__tab is-active">CONSULTAS</a>
                    <a href="#tab2" class="mdl-tabs__tab">ESTADÍSTICAS</a>
                </div>
                <div class="mdl-tabs__panel is-active" id="tab1">
                    <div class="mdl-grid">
                        <div class="mdl-cell mdl-cell--1-col">
                        </div>
                        <div class="mdl-cell mdl-cell--11-col">
                            <table class="table mdl-data-table mdl-js-data-table mdl-shadow--1dp">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Paciente</th>
                                        <th>Fecha</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="hser-tbody">
                                @foreach ($consultations as $consultation)
                                    <tr onclick="generateReport(this)">
                                        <td name="id">{{ $consultation->id }}</td>
                                        <td name="patient_id">{{ getUserName($consultation->patient_id) }}</td>
                                        <td name="date">{{ $consultation->date }}</td>
                                        <td><a href="{{ route('report.generate', [$consultation->id]) }}">Descargar</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
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
            </div>
        </div>
        </div>
    </div>    
</div>