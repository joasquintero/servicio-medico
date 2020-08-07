reloj()
/**
 * Función que despliega la tabla y formulario a la derecha
 */
slideRight = function(){
    hser_table = document.getElementsByClassName('dataTable-wrapper')[0].parentElement.parentElement,
    hser_table.classList.remove('hser-table'),
    hser_table.classList.remove('hser-slide-left-table'),
    hser_table.classList.toggle('hser-slide-right-table'),
    hser_button_to_right = hser_table.getElementsByTagName('button')[0],
    hser_button_to_right.style.visibility = 'hidden',
    hser_button_to_left = hser_table.getElementsByTagName('button')[1],
    hser_button_to_left.style.visibility = 'visible',

    hser_card = document.getElementsByClassName('hser-card')[0],
    hser_card.classList.remove('hser-slide-left-card'),
    hser_card.classList.remove('hser-card'),
    hser_card.classList.toggle('hser-slide-right-card')
}

/**
 * Función que despliega la tabla y formulario a la izquierda
 */
slideLeft = function(){
    hser_table = document.getElementsByClassName('dataTable-wrapper')[0].parentElement.parentElement,
    hser_table.classList.toggle('hser-table'),
    hser_table.classList.remove('hser-slide-right-table'),
    hser_table.classList.toggle('hser-slide-left-table'),
    hser_button_to_left = hser_table.getElementsByTagName('button')[1],
    hser_button_to_left.style.visibility = 'hidden',
    hser_button_to_right = hser_table.getElementsByTagName('button')[0],
    hser_button_to_right.style.visibility = 'visible',

    hser_card = document.getElementsByClassName('hser-slide-right-card')[0],
    hser_card.classList.toggle('hser-card'),
    hser_card.classList.toggle('hser-slide-left-card'),
    hser_card.classList.remove('hser-slide-right-card')
}


/**  @param e evento submit del formulario 
 * Función que busca todos los inputs de la etiqueta FORM
 * para convertirlos en un json que se pasará al servidor*/
getFormInputs = function(e){
    form = e.target;
    var string =    '{';
    for (let i = 0; i < form.length; i++) {
        input = form[i].localName == 'input' || 'select' ? form[i] : false;
        if(input.name == '_token' || input == false){
            
        } else{
            if(input.type == 'file'){
                alert('There\'s a file');
            } else if(input.type == 'checkbox'){

            }
            else {
                string += '"'+ input.name + '" : "' + input.value + '",';
            }
        }
    }
    if (user_id) {
        string += '"id_creator" : "' + user_id + '",';
    }
    string += '"workdays" : "' + getWorkDays() + '",';
    string += '}';
    var obj = removeLastComma(string);
    return obj;
    
}
/**
 * TODO: Crear el array con los dias laborables y agregarlo al json
 */
getWorkDays = function () {
    var workdays = [],
    checkbox = document.getElementsByTagName('input')
    for (let x = 0; x < checkbox.length; x++) {
        if (checkbox[x].type == 'checkbox' && checkbox[x].parentElement.classList[5]) {
            day = checkbox[x].id,
            workdays.push(day)
        }
    }
    str = workdays.toString()
    return str
}

/** @param str string 
 * Función que le remueve la última coma al string
 */
removeLastComma = function(str){
    comma = str.lastIndexOf(','),
    removed = str.substring(0, comma) + '' + str.substring(comma+1)
    return removed
}

getMethodName = function (str) {
    att = str.replace(/['"]+/g, ''),
    arr = att.split(',')
    return arr[1]
}



clearForm = function () {
    form = document.getElementsByClassName('form')[0] ? document.getElementsByClassName('form')[0] : document.createElement('form'),
    button = form.getElementsByTagName('button')[0] ? form.getElementsByTagName('button')[0] : document.getElementsByTagName('button')[11],
    inputs = document.getElementsByTagName('input'),
    selects = document.getElementsByTagName('select'),
    textareas = document.getElementsByTagName('textarea'),
    checkbox = document.getElementsByTagName('input')
    for (let i = 1; i < inputs.length; i++) {
        if (inputs[i].name !== "doctor_id" && inputs[i].name !== "date") {
            inputs[i].value = ''
        }
    }
    for (let x = 0; x < selects.length; x++) {
        selects[x].selectedIndex = 0
    }
    for (let y = 0; y < textareas.length; y++) {
        textareas[y].value = ''
    }
    if (inputs[2]) {
        inputs[2].focus()
    }
    if(checkbox){
        for (let c = 0; c < checkbox.length; c++) {
            checkbox[c].parentElement.classList.remove('is-checked')
        }
    }
    if (button) {
        if (button.parentElement.classList[1] == 'mdl-cell--12-col') {
            button.innerHTML = 'Guardar'
        } else {
            button.innerHTML = 'G<br>u<br>a<br>r<br>d<br>a<br>r'
        }
    }
    backgroundTable = document.getElementById('background-table')
    if (backgroundTable) {
        backgroundTable.rows[1].cells[0].children[0].value = ''
        backgroundTable.rows[1].cells[1].children[0].value = ''
        for (let b = 2; b < backgroundTable.rows.length; b++) {
            backgroundTable.deleteRow(b)
        }
    }
    diagnosisTable = document.getElementById('diagnosis-table')
    if (diagnosisTable) {
        diagnosisTable.rows[1].cells[0].children[0].value = ''
        diagnosisTable.rows[1].cells[1].children[0].value = ''
        for (let b = 2; b < diagnosisTable.rows.length; b++) {
            diagnosisTable.deleteRow(b)
        }
    }
    treatmentTable = document.getElementById('treatment-table')
    if (treatmentTable) {
        treatmentTable.rows[1].cells[0].children[0].value = '1'
        treatmentTable.rows[1].cells[1].children[0].value = ''
        treatmentTable.rows[1].cells[2].children[0].value = ''
        for (let b = 2; b < treatmentTable.rows.length; b++) {
            treatmentTable.deleteRow(b)
        }
    }
    paraclinicTable = document.getElementById('paraclinic-table')
    if (paraclinicTable) {
        paraclinicTable.rows[1].cells[0].children[0].value = ''
        if (paraclinicTable.rows[1].cells[1].children[2]) {
            paraclinicTable.rows[1].cells[1].children[2].innerHTML = ''
            for (let b = 2; b < paraclinicTable.rows.length; b++) {
                paraclinicTable.deleteRow(b)
            }
        }
    }
}

/**
 * Método para mostrar panel con registros de tabla de bbdd
 */
slidePanelLeft = function () {
    panel = document.getElementsByClassName('hser-panel')[0],
    panel.classList.remove('panelRight'),
    panel.classList.toggle('panelLeft')
}

getTrFullname = function (e, input) {
    var fullname,
    columns = e.children
    for (let i = 1; i < columns.length; i++) {
        if (i == 1) {
            fullname = columns[i].textContent
        } else {
            fullname += ', ' + columns[i].textContent
        }
    }
    input.value = fullname,
    input.readOnly = true
}

setInputDate = function (input) {
    document.getElementById(input).valueAsDate = new Date()
}

setInputDoctor = function (input) {
    document.getElementById(input).value = userNames
}
setInputPatient = function (input) {
    document.getElementById(input).value = patient
}

cloneRow = function (e) {
    row = e.parentElement.nextElementSibling.tBodies[0].children[0].cloneNode(true)
    for (let i = 0; i < row.cells.length; i++) {
        row.cells[i].children[0].readOnly = false,
        row.cells[i].children[0].value = ''
    }
    e.parentElement.nextElementSibling.tBodies[0].appendChild(row)
    for (let x = 0; x < illnessField.length; x++) {
        illnessField[x].onfocus = function(e) {
            illnessesPanel(e)
        }
    }
}

deleteRow = function (e) {
    if (e.parentElement.nextElementSibling.tBodies[0].children.length !== 1) {
        row = e.parentElement.nextElementSibling.tBodies[0].lastChild.remove()
    }
}

function getBase64(file) {
    var reader = new FileReader();
    if (file.files.length > 0) {
        reader.readAsDataURL(file.files[0]);
    }
    reader.onload = function () {
      file.nextElementSibling.value = reader.result;
    };
    reader.onerror = function (error) {
      console.log('Error: ', error);
    };
  }

  tableToJson = function (id) {
    table = document.getElementById(id)
    var rows = []
    var header = table.tHead.children[0].cells
    for (let i = 0; i < table.tBodies[0].rows.length; i++) {
        var cells = table.tBodies[0].rows[i].cells
        rows[i] = {}
        for (let x = 0; x < cells.length; x++) {
            if (cells[x].children[0].type == 'file' && cells[x].children[0].files.length > 0){
                getBase64(cells[x].children[0]),
                rows[i][header[x].textContent] =  cells[x].children[0].nextElementSibling.value
            } else {
                if (header[x].textContent == "Enfermedad") {
                    illness_id = getTableField(urlIllnessId, cells[x].children[0].value),
                    rows[i][header[x].textContent] = illness_id
                } else {
                    rows[i][header[x].textContent] = cells[x].children[0].value
                }
            }
        }
    }
    var tableObj = {}
    tableObj = rows
    return JSON.stringify(tableObj)
}

blobToFile = function (blob, filename) {
    blob.lastModifiedDate = new Date(),
    blob.name = filename
    return blob
}

tabFocus = function (e) {
    id = e.hash.substring(1, 5),
    tab = document.getElementById(id),
    input = tab.getElementsByTagName('textarea')[0],
    input.focus()
}

getTableField = function (url, data) {
    field = '{"field": "'+ data +'"}',
    xhttp = new XMLHttpRequest(),
    xhttp.open('POST', url, false),
    xhttp.setRequestHeader('Content-type', 'application/json'),
    xhttp.send(field)
    return xhttp.responseText
}

trackingStore = function (urlTracking, userId, currentURL, action) {
    data = '{"user_id": "'+ user_id +'", "module": "'+ currentURL +'", "action": "'+ action +'"}'
    sendAjaxRequest(urlTracking, data)
}


 function reloj(){
    var today = new Date();
    var hr = today.getHours();
    var min = today.getMinutes();
    var sec = today.getSeconds();
    ap = (hr < 12) ? "<span>AM</span>" : "<span>PM</span>";
    hr = (hr == 0) ? 12 : hr;
    hr = (hr > 12) ? hr - 12 : hr;
    //Add a zero in front of numbers<10
    hr = checkTime(hr);
    min = checkTime(min);
    sec = checkTime(sec);
    document.getElementById("reloj").innerHTML = hr + " : " + min + " : " + sec + " " + ap;
    setTimeout("reloj()",1000);
}

function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}