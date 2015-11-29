

$('.edit-button').on('click', function(){
    $(".info").removeAttr('disabled');
});

$(function() {
    $( "input[name='birthday']" ).datepicker({
        altFormat: "dd-mm-yyyy",
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
        minDate: new Date(1980, 1 - 1, 1),
        maxDate: "+1m +1w",
        yearRange: "1980:c+1",
        monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ]
    });
});
