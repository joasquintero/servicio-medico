onload = function(){
    tfield = [
        'id',
        'names',
        'family_names',
        'id_number',
        'email'
    ];
    var tr;
    clearForm();
    if (document.getElementsByTagName('rol')) {
        setRol = function (e) {
            role = e.parentElement.parentElement.cells[2].children[0].value,
            console.log(e.parentElement.parentElement.cells[2].children[0]);
            id = e.parentElement.parentElement.cells[0].textContent,
            alertify.confirm("¿Desea cambiar el rol a "+ role +"?",
            function () {
                data = '{"id":"'+ id +'", "role":"'+ role +'"}',
                xhttp = new XMLHttpRequest(),
                xhttp.responseType = 'json',
                xhttp.open('POST', urlsetRol, true),
                xhttp.setRequestHeader('Content-type', 'application/json'),
                xhttp.send(data),
                xhttp.onload = function () {
                    e.parentElement.parentElement.remove();
                    alertify.success('Cambio de rol exitoso');
                }
            },
            function() {
            })
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
            sendAjaxRequest(urlStoreUser, data, method)
        } else {
            sendAjaxRequest(urlUpdateUser, data, method)
        }
    }

    getRecordInfo = function (e) {
        id = '{'
            +'"id" : "' + getRecordId(e) + '"'
            +'}',
        storeTR(e),
        sendAjaxRequest(urlInfoUser, id)
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
            sendAjaxRequest(urlDeleteUser, data, e)
        },
        function() {
        })
    }
}


/**
 * @todo Buscar la condición OR en ORM y agregar eventos onclick/ondblclick a fila de tabla
 */