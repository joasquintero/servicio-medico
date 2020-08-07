onload = function(){
    tfield = [
        'id',
        'patient_id',
        'date'
    ];
    var tr;
    clearForm();
    setInputDate('date');
    setInputDoctor('doctor_id');
    setInputPatient('patient_id');
    patientsDatatable = new DataTable("#patients");
    illnessesDataTable = new DataTable("#illnesses");
     /**
     * Método para desplegar el panel con la tabla de pacientes
     */
    patientField = document.getElementById('patient_id'),
    patientField.onfocus = function(e) {
        input = e.target,
        illnesses = document.getElementById('illnesses').parentElement.parentElement,
        illnesses.style.display = 'none',
        patients = document.getElementById('patients').parentElement.parentElement,
        patients.style.display = '',
        panel = document.getElementsByTagName('aside')[0],
        panel.style.right = '0%',
        panel.style.animationName = 'panelToLeft',
        panel.style.animationDuration = '2s'
    }

    /**
     * Método para desplegar el panel con la tabla de enfermedades
     */
    illnessField = document.getElementsByClassName('illness_id')
    for (let x = 0; x < illnessField.length; x++) {
        illnessField[x].onfocus = function(e) {
            illnessesPanel(e)
        }
    }
    illnessesPanel = function (e) {
        input = e.target,
        patients = document.getElementById('patients').parentElement.parentElement,
        patients.style.display = 'none',
        illnesses = document.getElementById('illnesses').parentElement.parentElement,
        illnesses.style.display = '',
        panel = document.getElementsByTagName('aside')[0],
        panel.style.right = '0%',
        panel.style.animationName = 'panelToLeft',
        panel.style.animationDuration = '2s'
    }

    /**
     * Método para cerrar los paneles
     */
    panel_x = document.getElementsByClassName('panel-x')[0],
    panel_x.onclick = function (e) {
        panel = document.getElementsByTagName('aside')[0],
        panel.style.animationName = 'panelToRight',
        panel.style.right = '-35%'
    }

    input_disable = document.getElementsByClassName('hser-input-disable')[0],
    input_disable.onkeypress = function (e) {
        if (e.which == 13) {
            e.target.readOnly = true
        }
    }

    input_disable = document.getElementsByClassName('hser-input-disable')[0],
    input_disable.ondblclick = function (e) {
        e.target.readOnly = false
    }

    sendForm = document.getElementById('hser-save-consultation'),
    sendForm.onclick = function (e) {
        e.preventDefault(),
        e.stopPropagation(),
        method = e.target.textContent
        if(method == 'Guardar'){
            data = getConsultationData(user_id),
            sendAjaxRequest(urlStoreConsultation, data, '', user_id)
        } else {
            data = getConsultationData(user_id),
            sendAjaxRequest(urlUpdateConsultation, data, '', user_id)
        }
    }
/**
 * TODO convertir en json datos de header y tablas
 */
    getConsultationData = function (user_id) {
        rows = []
        doctor = document.getElementById('doctor_id').value ? document.getElementById('doctor_id').value : '',
        patient = document.getElementById('patient_id').value ? document.getElementById('patient_id').value : '',
        date = document.getElementById('date').value ? document.getElementById('date').value : '',
        reference = document.getElementById('reference').value ? document.getElementById('reference').value : '',
        motives = document.getElementById('motives').value ? document.getElementById('motives').value : '',
        cih = document.getElementById('cih').value ? document.getElementById('cih').value : '',
        id = this.recordId ? this.recordId : '',
        phisic_test = document.getElementById('phisic_test').value ? document.getElementById('phisic_test').value : '',
        rows[0] = {}
        if (id != '') {
            rows[0].id = id
        }
        rows[0].doctor = doctor,
        rows[0].patient = patient,
        rows[0].reference = reference,
        rows[0].date = date,
        rows[0].motives = motives,
        rows[0].cih = cih,
        rows[0].phisic_test = phisic_test,
        rows[0].id_creator = user_id ? user_id : '',
        headerObj = {},
        headerObj = rows,
        header = JSON.stringify(headerObj),
        backgroundTable = tableToJson('background-table'),
        paraclinicTable = tableToJson('paraclinic-table'),
        diagnosisTable = tableToJson('diagnosis-table'),
        treatmentTable = tableToJson('treatment-table'),
        obj = [],
        obj = {},
        obj['header'] = header,
        obj['backgroundTable'] = backgroundTable,
        obj['paraclinicTable'] = paraclinicTable,
        obj['diagnosisTable'] = diagnosisTable,
        obj['treatmentTable'] = treatmentTable,
        dataObj = {},
        dataObj = obj,
        data = JSON.stringify(dataObj)
        return data
    }

    getConsultationRecord = function (e) {
        id = '{'
        +'"id" : "' + getRecordId(e) + '"'
        +'}',
        recordId = e.cells[0].textContent,
        storeTR(e),
        clearForm(),
        sendAjaxRequest(urlInfoConsultation, id)
    }
    
    erase = function(e){
        alertify.confirm("¿Desea eliminar este registro?",
        function () {
            try {
                id = e.cells.id.textContent
            } catch (error) {
                id = e.target.parentElement.cells.id.textContent
            }
            data = '{"id":"'+ id +'"}',
            sendAjaxRequest(urlDeleteConsultation, data, e)
        },
        function() {
        })
    }
}
