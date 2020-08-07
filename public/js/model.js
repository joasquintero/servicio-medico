/**
 * Inicialización de datatable
 */
dataTable = new DataTable(".table");
var recordId;

/** @param url url al que se le hará la petición
 *  @param data datos que se le pasarán
 * Petición ajax que se le hace al servidor
 */
sendAjaxRequest = function (url, data, e, user_id) {
    xhttp = new XMLHttpRequest(),
    xhttp.responseType = 'json',
    xhttp.open('POST', url, true),
    xhttp.setRequestHeader('Content-type', 'application/json'),
    xhttp.send(data),
    // xhttp.addEventListener( 'load', reqListener );
    xhttp.onload = function () {
        if (this.response) {
            code = this.response[0],
            method = this.response[1],
            datos = this.response[2]
            switch (method) {
                case 'save':
                    createRecord(datos, tfield, code);
                    trackingStore(urlTracking, userId, currentURL, 'Guardar');
                    break;
                case 'update':
                    updateRecord(datos, tfield, code);
                    trackingStore(urlTracking, userId, currentURL, 'Actualizar');
                    break;
                case 'delete':
                    deleteRecord(code, e);
                    trackingStore(urlTracking, userId, currentURL, 'Eliminar');
                    break;
                case 'info':
                    infoRecord(datos, code);
                    trackingStore(urlTracking, userId, currentURL, 'Información');
                    break;
                case 'consultationInfo':
                    infoConsultation(datos, code);
                    trackingStore(urlTracking, userId, currentURL, 'Info Consulta');
                    break;
            }
        }
    }
}

showErrors = function (response) {
    var counter = 0
    var element
    for (const field in response) {
        if (response.hasOwnProperty(field)) {
            if (counter == 0) {
                element =  response[field];
            } else {
                element +=  response[field];
            }
        }
        counter++
    }
    return element
}

/**
 * @param response respuesta del servidor con datos
 * @param tfield columnas de la tabla
 * Función que acciona la construccióm de la fila en la tabla
 * con mensajes de alerta
 */
createRecord = function (response, tfield, code) {
    if(code == 200){
        constructTRow(tfield, response);
        clearForm();
        alertify.success('Guardado existosamente');
    } else {
        alertify.error('Error al intentar guardar. Verifique los datos ingresados \n \n' + showErrors(response));
    }
}

updateRecord = function (response, tfield, code ) {
    if(code == 200){
        clearForm(),
        updateTable(response, tfield)
        alertify.success('Actualización existosa')
    } else {
        alertify.error('Error al intentar actualizar. Verifique los datos ingresados \n \n' + showErrors(response));
    }
}

infoRecord = function (response, code) {
    if(code == 200){
        populateForm(response)
    } else {
        alertify.warnig('No se encontro información asociada');
    }
}

deleteRecord = function (code, e) {
    if(code == 200){
        try {
            e.remove()
        } catch (error) {
            e.target.parentElement.remove()
        }
        clearForm(),
        alertify.success('Eliminado existosamente')
    } else {
        alertify.error('Error al intentar eliminar. Intente de nuevo.')
    }
}

infoConsultation = function (response, code) {
    if(code == 200){
        populateConsultation(response)
    } else {
        alertify.warnig('No se encontro información asociada');
    }
}

populateConsultation = function (response) {
    inputs = document.getElementsByTagName('input'),
    selects = document.getElementsByTagName('select'),
    textareas = document.getElementsByTagName('textarea'),
    button = document.getElementById('hser-save-consultation'),
    fillConsultationHeader(response),
    fillBackgroundTable(response),
    fillDiagnosisTable(response),
    fillTreatmentTable(response),
    fillParaclinicTable(response),
    button.innerHTML = 'A <br> c <br> t <br> a <br> l <br> i <br> z <br> a <br> r'
}

fillBackgroundTable = function (response) {
    backgroundTable = document.getElementById('background-table'),
    backgroundTable.deleteRow(1)
    for (let b = 0; b < response.backgrounds.length; b++) {
        if (response.backgrounds.length > 0) {
            let row = response.backgrounds[b]
            tr = document.createElement('tr')
            td1 = document.createElement('td')
            select = document.createElement('select'),
            option = document.createElement('option')
            option.innerText = 'Seleccione Familiar'
            option.value = '',
            option1 = document.createElement('option')
            option1.innerText = 'El/Ella'
            option1.value = '1',
            option2 = document.createElement('option')
            option2.innerText = 'Abuelo/a'
            option2.value = '2',
            option3 = document.createElement('option')
            option3.innerText = 'Padre'
            option3.value = '3',
            option4 = document.createElement('option')
            option4.innerText = 'Madre'
            option4.value = '4',
            option5 = document.createElement('option')
            option5.innerText = 'Hermano/a'
            option5.value = '5',
            option6 = document.createElement('option')
            option6.innerText = 'Tio/a'
            option6.value = '6', 
            select.classList.toggle('mdl-textfield__input')
            select.name = "relative"
            select.appendChild(option)
            select.appendChild(option1)
            select.appendChild(option2)
            select.appendChild(option3)
            select.appendChild(option4)
            select.appendChild(option5)
            select.appendChild(option6)
            select.value = row.relative
            td1.appendChild(select)
            tr.appendChild(td1)
            td2 = document.createElement('td')
            td2.innerHTML = '<input class="mdl-textfield__input  hser-input-disable illness_id" type="text"name="illness_id" value="'+ getTableField(urlIllnessName, row.illness_id) +'" readonly>'
            tr.appendChild(td2)
            backgroundTable.tBodies[0].appendChild(tr)
        }
        illnessField = document.getElementsByClassName('illness_id')
        for (let x = 0; x < illnessField.length; x++) {
            illnessField[x].onfocus = function(e) {
                illnessesPanel(e)
            }
        }
    }
}
/**
 * TODO: Eliminar primera fila vacía
 */
fillDiagnosisTable = function (response) {
    diagnosisTable = document.getElementById('diagnosis-table'),
    diagnosisTable.deleteRow(1)
    for (let d = 0; d < response.diagnosis.length; d++) {
        if (response.diagnosis.length > 0) {
            let row = response.diagnosis[d]
            tr = document.createElement('tr')
            td1 = document.createElement('td')
            td1.innerHTML = '<input class="mdl-textfield__input  hser-input-disable illness_id" id="illness_id" type="text"name="illness_id" value="'+ getTableField(urlIllnessName, row.illness_id) +'" readonly>'
            tr.appendChild(td1)
            td2 = document.createElement('td')
            td2.innerHTML = '<input class="mdl-textfield__input hser-input-disable" id="illness_description" type="text" value="'+ row.description +'" name="illness_description">'
            tr.appendChild(td2)
            diagnosisTable.tBodies[0].appendChild(tr)
        }
        illnessField = document.getElementsByClassName('illness_id')
        for (let x = 0; x < illnessField.length; x++) {
            illnessField[x].onfocus = function(e) {
                illnessesPanel(e)
            }
        }
    }
}
fillTreatmentTable = function (response) {
    treatmentTable = document.getElementById('treatment-table')
    treatmentTable.deleteRow(1)
    for (let t = 0; t < response.treatments.length; t++) {
        if (response.treatments.length > 0) {
            let row = response.treatments[t]
            tr = document.createElement('tr')
            td1 = document.createElement('td')
            select = document.createElement('select'),
            option1 = document.createElement('option'),
            option1.innerText = 'Médico'
            option1.value = '1'
            option2 = document.createElement('option')
            option2.innerText = 'Quirúrgico'
            option2.value = '2'
            select.classList.toggle('mdl-textfield__input')
            select.name = "treatment_type"
            select.appendChild(option1)
            select.appendChild(option2)
            select.value = row.type
            td1.appendChild(select)
            tr.appendChild(td1)
            td2 = document.createElement('td')
            td2.innerHTML = '<input class="mdl-textfield__input hser-input-disable" id="treatment_name" value="'+ row.name +'" type="text">'
            tr.appendChild(td2)
            td3 = document.createElement('td')
            td3.innerHTML = '<input class="mdl-textfield__input hser-input-disable" id="treatment_description" value="'+ row.description +'" type="text">'
            tr.appendChild(td3)
            treatmentTable.tBodies[0].appendChild(tr)
        }
    }
}
fillParaclinicTable = function (response) {
    paraclinicTable = document.getElementById('paraclinic-table')
    paraclinicTable.deleteRow(1)
    for (let t = 0; t < response.tests.length; t++) {
        if (response.tests.length > 0) {
            let row = response.tests[t]
            blob = blobToFile(row.file, response.header.patient_id + '-' + response.header.date + '-' + row.name),
            a = document.createElement('a'),
            a.style.width = '10%'
            a.textContent = 'V'
            a.download = response.header.patient_id + '-' + response.header.date + '-' + row.name
            a.href = blob
            a.click()
            tr = document.createElement('tr')
            td1 = document.createElement('td')
            td1.innerHTML = '<input class="mdl-textfield__input hser-input-disable" id="test_name" type="text" name="text_name" value="'+ row.name +'">'
            tr.appendChild(td1)
            input = document.createElement('input')
            input.type = 'hidden'
            input.id = 'file_encoded'
            td2 = document.createElement('td')
            td2.style.display = 'flex' 
            td2.style.flexDirection = 'row'
            td2.innerHTML = '<input class="mdl-textfield__input" style="width:90%;" id="test_file" type="file" name="test_file" value="'+ response.header.patient_id + '-' + response.header.date + '-' + row.name +'">'
            td2.appendChild(input)
            td2.appendChild(a)
            tr.appendChild(td2)
            paraclinicTable.tBodies[0].appendChild(tr)
        }
    }
}
fillConsultationHeader = function (response) {
    for (const field in response.header) {
        if (response.header.hasOwnProperty(field)) {
            for (const i of inputs) {
                if (i.name == field) {
                    if (i.name == 'patient_id' || i.name == 'doctor_id') {
                        i.value = getTableField(urlUserName, response.header[field])
                    } else {
                        i.value = response.header[field]
                    }
                }
            }
            for (const t of textareas) {
                if (t.name == field) {
                    t.value = response.header[field]
                }
            }
        }
    }
}

/**
 * @param tfield array ordenado por las columnas que serán pobladas en la tabla
 * @param data respuesta del servidor con los datos
 * Función que construye una fila en la tabla dependiendo de el orden de la tabla
 * y los datos dados
 */
constructTRow = function (tfield, data) {
    tbody = document.getElementsByClassName('hser-tbody')[0],
    tr = document.createElement('tr')
    for (let x = 0; x < tfield.length; x++) {
        for (const field in data) {
            if (data.hasOwnProperty(field)) {
                if(tfield[x] === field){
                    if (tfield[x] != 'patient_id') {
                        td = document.createElement('td'),
                        td.setAttribute('name', field),
                        td.innerText = data[field],
                        tr.append(td)
                    } else {
                        td = document.createElement('td'),
                        td.setAttribute('name', field),
                        td.innerText = getTableField(urlPatientName, data[field]),
                        tr.append(td)
                    }
                }
            }
        }
    }
    tr.addEventListener('click', function (e) {
        getRecordInfo(e)
    }),
    tr.addEventListener('dblclick', function (e) {
        erase(e)
    }),
    tbody.prepend(tr)

}

/**
 * @param e event dobleclick
 * Función que busca el id del registro clickeado
 */
getRecordId = function(e) {
    try {
        id =  e.cells[0].innerText
    } catch (error) {
        id =  e.target.parentElement.cells[0].innerText
    }
    form = document.getElementsByClassName('form')[0],
    form.id.value = id
    return id
}

populateForm = function (response) {
    form = document.getElementsByClassName('form')[0],
    button = form.getElementsByTagName('button')[0],
    inputs = form.getElementsByTagName('input'),
    selects = form.getElementsByTagName('select'),
    textareas = form.getElementsByTagName('textarea'),
    checkbox = document.getElementsByTagName('input')

    for (const field in response) {
        if (response.hasOwnProperty(field)) {
            for (const i of inputs) {
                if (i.name == field && field != 'id') {
                    if (i.name == 'patient_id' || i.name == 'doctor_id') {
                        i.value = getTableField(urlUserName, response[field])
                    } else {
                        i.value = response[field]
                    }
                }
                
            }
            for (const x of selects) {
                if (x.name == field && field != 'id') {
                    x.value = response[field]
                }
                
            }
            for (const z of textareas) {
                if (z.name == field && field != 'id') {
                    console.log(z.name + ' ' + field),
                    z.value = response[field]
                }
                
            }
            for (const c of checkbox) {
                if (field == 'workdays' ) {
                    arr = response[field] ? response[field].split(',') : []
                    if (arr.includes(c.id)) {
                        c.parentElement.classList.toggle('is-checked')
                    }
                }
            }
        }
    }
    if (button) {
        button.innerText = 'ACTUALIZAR'
    }
}

updateTable = function (response, tfield) {
    cells = this.tr.cells
    for (let x = 1; x < cells.length; x++) {
        name = tfield.includes(cells[x].attributes.name.value) == true ? cells[x].attributes.name.value : ''
        if(cells[x].attributes.name.value == name){
            for (const field in response) {
                if (response.hasOwnProperty(field)) {
                    if(tfield[x] === field){
                        if(name == field){
                            cells[x].innerText = response[field]
                        }
                    }
                }
            }
        }
        
    }
}
getFormMethod = function(form){
    button = form.getElementsByTagName('button')[0]
    if(button.textContent == "Guardar"){
        return 'guardar'
    } else {
        return 'actualizar'
    }
}

storeTR = function (e) {
    this.tr = e
}