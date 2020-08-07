onload = function(){
    tfield = [
        'id',
        'name'
    ];
    var tr;
    clearForm();
/**
 * 
 */
    sendForm = document.getElementsByClassName('form')[0],
    sendForm.onsubmit = function (e) {
        e.preventDefault(),
        data = getFormInputs(e),
        method = getFormMethod(e.target)
        if(method == 'guardar'){
            sendAjaxRequest(urlStorePermission, data, method)
        } else {
            sendAjaxRequest(urlUpdatePermission, data, method)
        }
    }

    getRecordInfo = function (e) {
        id = '{'
            +'"id" : "' + getRecordId(e) + '"'
            +'}',
        storeTR(e),
        sendAjaxRequest(urlInfoPermission, id)
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
            sendAjaxRequest(urlDeletePermission, data, e)
        },
        function() {
        })
    }
}


/**
 * @todo Buscar la condición OR en ORM y agregar eventos onclick/ondblclick a fila de tabla
 */