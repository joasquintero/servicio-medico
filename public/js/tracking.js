onload = function(){
    erase = function(e){
        alertify.confirm("¿Desea eliminar este registro?",
        function () {
            try {
                console.log(e.cells[0].textContent),
                id = e.cells[0].textContent
            } catch (error) {
                id = e.target.parentElement.cells.id.textContent
            }
            data = '{"id":"'+ id +'"}',
            sendAjaxRequest(urlDeleteTracking, data, e)
        },
        function() {
        })
    }
}