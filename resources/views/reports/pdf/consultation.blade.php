<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <style>
        .title {
            background: #0142828a;
            color: #fff;
            border: 2px solid #36a4dd;
            height: 5px;
            font-size: 1.5em;
            padding: 4px 4px 4px 4px;
            font-family: Arial, Helvetica, sans-serif;
        }
        .subtitle {
            background: #afafaf;
            color: #000;
            border: 1px solid #36a4dd;
            font-size: 0.9em;
            text-align:left;
            height: 5px;
            padding: 4px 4px 4px 4px;
            font-family: Arial, Helvetica, sans-serif;
        }
        .border {
            color: #000;
            border-right: 1px solid #36a4dd;
            border-top: 1px solid #36a4dd;
            border-bottom: 1px solid #36a4dd;
            font-size: 0.9em;
            text-align:left;
            padding: 4px 4px 4px 4px;
            font-family: Arial, Helvetica, sans-serif;
        }
        .border-blank {
            color: #000;
            border-right: 1px solid #36a4dd;
            border-top: 1px solid #36a4dd;
            border-bottom: 1px solid #36a4dd;
            font-size: 0.9em;
            text-align:left;
            padding: 4px 4px 4px 4px;
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>
    <body oncontextmenu="return false;">
        <div class="mdl-grid">
            <table style="width:100%;">
                <tbody>
                    <tr>
                        <td style="width:30%;">LOGO</td>
                        <td style="width:70%;text-align: right; color: #0142828a;">INSTITUTO UNIVERSITARIO DE TECNOLOGÍA DE MARACAIBO</td>
                    </tr>
                    <tr>
                        <td style="width:40%;">Referencia: {{ $consultation->reference }}</td>
                        <td style="width:60%;text-align: right;"></td>
                    </tr>
                    <tr>
                        <td style="width:40%;">Doctor: {{ getUserName($consultation->doctor_id) }}</td>
                        <td style="width:60%;text-align: right;">Fecha: {{ $consultation->date }}</td>
                    </tr>
                </tbody>
            </table>
            <br>
            <div class="mdl-cell mdl-cell--12-col wide-card mdl-card mdl-shadow--4dp">
                <div class="mdl-layout__header-row card_title title">
                    <div class = "mdl-cell mdl-cell--12-col" style="text-align:center; font-size:0.6em;">
                        DATOS DEL PACIENTE
                    </div>
                </div>
                <table style="width:100%;">
                    <tbody>
                        <tr>
                            <td class="subtitle">Nombre del Paciente:</td>
                            <td class="border">{{ getUserName($consultation->patient_id) }}</td>
                            <td class="border-blank"></td>
                            <td class="subtitle">Dirección:</td>
                            <td class="border">{{ $patient->address }}</td>
                            <td class="border-blank"></td>
                        </tr>
                        <tr>
                            <td class="subtitle">Cédula de Identidad:</td>
                            <td class="border">{{ $patient->id_number }}</td>
                            <td class="subtitle">Teléfono:</td>
                            <td class="border">{{ $patient->phone }}</td>
                            <td class="subtitle">Sexo:</td>
                            <td class="border">{{ $patient->gender }}</td>
                        </tr>
                        <tr>
                            <td class="subtitle">Correo:</td>
                            <td class="border">{{ $patient->email }}</td>
                            <td class="border-blank"></td>
                            <td class="subtitle">Edad:</td>
                            <td class="border">{{ $patient->age }}</td>
                            <td class="border-blank"></td>
                        </tr>
                    </tbody>
                </table>
                
                <div class="title">
                    <div style="font-size:0.6em;">
                        MOTIVO
                    </div>
                </div>
                <div class="border">
                    <p style="text-align:justify;">{{ $consultation->motives }}</p>
                </div>
                
                <div class="title">
                    <div style="font-size:0.6em;">
                        HISTORIA DE ENFERMEDAD ACTUAL
                    </div>
                </div>
                <div class="border">
                    <p style="text-align:justify;">{{ $consultation->cih }}</p>
                </div>
                
                <div class="title">
                    <div style="font-size:0.6em;">
                        ANTECEDENTES
                    </div>
                </div>
                <table style="width:100%;">
                    <thead>
                        <tr>
                            <th class="subtitle">Familiar</th>
                            <th class="subtitle">Enfermedad</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($backgrounds as $background)
                        <tr>
                            <td class="border">
                            @switch($background->relative)
                                @case(1)
                                    El/Ella
                                    @break
                                @case(2)
                                    Abuelo/a
                                    @break
                                @case(3)
                                    Padre
                                    @break
                                @case(4)
                                    Madre
                                    @break
                                @case(5)
                                    Hermano/a
                                    @break
                                @case(6)
                                    Tio/a
                                    @break
                            @endswitch
                            </td>
                            <td class="border">{{ getIllnessName($background->illness_id) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div class="title">
                    <div style="font-size:0.6em;">
                        EXAMEN FÍSICO
                    </div>
                </div>
                <div class="border">
                    <p style="text-align:justify;">{{ $consultation->phisic_test }}</p>
                </div>
                
                <div class="title">
                    <div style="font-size:0.6em;">
                        PARACLÍNICOS
                    </div>
                </div>
                <table style="width:100%;">
                    <thead>
                        <tr>
                            <th class="subtitle">Exámen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tests as $test)
                        <tr>
                            <td class="border">{{ $test->name }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div class="title">
                    <div style="font-size:0.6em;">
                        DIAGNÓSTICO
                    </div>
                </div>
                <table style="width:100%;">
                    <thead>
                        <tr>
                            <th class="subtitle">Enfermedad</th>
                            <th class="subtitle">Descripción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($diagnosis as $diagnosis)
                        <tr>
                            <td class="border">{{ getIllnessName($diagnosis->illness_id) }}</td>
                            <td class="border">{{ $diagnosis->description }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div class="title">
                    <div style="font-size:0.6em;">
                        TRATAMIENTO
                    </div>
                </div>
                <table style="width:100%;">
                    <thead>
                        <tr>
                            <th class="subtitle">Tipo</th>
                            <th class="subtitle">Tratamiento</th>
                            <th class="subtitle">Descripción</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($treatments as $treatment)
                        <tr>
                            <td class="border">
                                @switch($treatment->type)
                                    @case(1)
                                        Médico
                                        @break
                                    @case(2)
                                        Quirúrgico
                                        @break
                                @endswitch
                            </td>
                            <td class="border">{{ $treatment->name }}</td>
                            <td class="border">{{ $treatment->description }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>