onload = function(){
    if(role == 'Paciente'){
        tfield = [
            'id',
            'doctor_id',
            'date'
        ];
    } else {
        tfield = [
            'id',
            'patient_id',
            'date'
        ];
    }
    var tr;
    clearForm();
    setInputPatient('patient');
    patientsDatatable = new DataTable("#patients");
    doctorsDataTable = new DataTable("#doctors");
    /**
     * Método para desplegar el panel con la tabla de pacientes
     */
    if (document.getElementById('patient_id')) {
        patientField = document.getElementById('patient_id'),
        patientField.onfocus = function(e) {
            input = e.target,
            illnesses = document.getElementById('doctors').parentElement.parentElement,
            illnesses.style.display = 'none',
            patients = document.getElementById('patients').parentElement.parentElement,
            patients.style.display = '',
            panel = document.getElementsByTagName('aside')[0],
            panel.style.right = '0%',
            panel.style.animationName = 'panelToLeft',
            panel.style.animationDuration = '2s'
        }
    }
    /**
     * Método para desplegar el panel con la tabla de doctores
     */
    patientField = document.getElementById('doctor_id'),
    patientField.onfocus = function(e) {
        input = e.target,
        illnesses = document.getElementById('patients').parentElement.parentElement,
        illnesses.style.display = 'none',
        patients = document.getElementById('doctors').parentElement.parentElement,
        patients.style.display = '',
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

    input_disable = document.getElementsByClassName('hser-input-disable')[0]
    if (input_disable) {
        input_disable.onkeypress = function (e) {
            if (e.which == 13) {
                e.target.readOnly = true
            }
        }
    }

    input_disable = document.getElementsByClassName('hser-input-disable')[0]
    if (input_disable) {
        input_disable.ondblclick = function (e) {
            e.target.readOnly = false
        }
    }

/**
 * Método para hacer submit al formulario tanto para crear como para actualizar
 */
    sendForm = document.getElementsByClassName('form')[0],
    sendForm.onsubmit = function (e) {
        e.preventDefault(),
        data = getFormInputs(e),
        method = getFormMethod(e.target)
        if(method == 'guardar'){
            sendAjaxRequest(urlStoreMeeting, data, method),
            setInputPatient('patient')
        } else {
            sendAjaxRequest(urlUpdateMeeting, data, method),
            setInputPatient('patient')
        }
    }

    getRecordInfo = function (e) {
        id = '{'
            +'"id" : "' + getRecordId(e) + '"'
            +'}',
        storeTR(e),
        sendAjaxRequest(urlInfoMeeting, id),
        setTimeout(function () {
            if (role == 'Doctor' || role == 'Administrador') {
                button = document.getElementById('toConsultation')
                if (button) {
                    button.remove()
                }
                doctor = document.getElementById('doctor_id').value,
                patient = document.getElementById('patient_id').value,
                sibling = document.getElementsByClassName('hser-btn')[1],
                sibling.parentElement.style.display = 'flex',
                sibling.parentElement.style.justifyContent = 'space-around',
                a = document.createElement('a'),
                a.id = 'toConsultation',
                a.style.width = '46%',
                a.style.textAlign = 'center',
                a.style.textDecoration = 'none',
                a.className = 'mdl-cell mdl-cell--6-col hser-btn btn-tracking',
                a.textContent = 'A CONSULTA',
                a.href = urlConsultation + '/' + doctor + '/' + patient
                if (patient) {
                    sibling.parentElement.appendChild(a)
                }
            }
        }, 2000)
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
            sendAjaxRequest(urlDeleteMeeting, data, e)
        },
        function() {
        })
    }

    /**
     * TODO: Metodo para verificar el horario y turno del medico para agendar cita
     */
    checkDocTime = function (e) {
        doctor_name = e.parentElement.parentElement[1].value
        if (doctor_name) {
            data = '{"doctor_name":"'+ doctor_name +'", "time":"'+ e.value +'"}',
            xhttp = new XMLHttpRequest(),
            xhttp.responseType = 'json',
            xhttp.open('POST', urlCheckDocTime, true),
            xhttp.setRequestHeader('Content-type', 'application/json'),
            xhttp.send(data),
            xhttp.onload = function () {
                if (this.response === false) {
                        alert/* ify.warnig */('Hora no disponible');
                        e.value = '';
                }
            }
        }
    }

    checkDocWorkdays = function (e) {
        date = new Date(e.value),
        days = [];
        days[0] = 'lunes',
        days[1] = 'martes',
        days[2] = 'miercoles',
        days[3] = 'jueves',
        days[4] = 'viernes',
        days[5] = 'sabado'
        days[6] = 'domingo',
        doctor_name = e.parentElement.parentElement[1].value
        if (doctor_name) {
            data = '{"doctor_name":"'+ doctor_name +'", "day":"'+ days[date.getDay()] +'"}',
            xhttp = new XMLHttpRequest(),
            xhttp.responseType = 'json',
            xhttp.open('POST', urlCheckDocWorkdays, true),
            xhttp.setRequestHeader('Content-type', 'application/json'),
            xhttp.send(data),
            xhttp.onload = function () {
                if (this.response === false) {
                    alert/* ify.warnig */('Dia no disponible');
                    e.value = '';
                }
            }
        }
    }
}