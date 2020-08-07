generateReport = function(e){
    ajaxReport(e.cells[0].textContent, urlGenerateReport)
}

ajaxReport = function (data, url) {
    xhttp = new XMLHttpRequest(),
    xhttp.responseType = 'json',
    xhttp.open('POST', url, true),
    xhttp.setRequestHeader('Content-type', 'application/json'),
    xhttp.send(data)
}