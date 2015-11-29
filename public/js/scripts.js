

$('.edit-button').on('click', function(){
    $("#form-info input").removeAttr('disabled');
});

$('.edit-grade-button').on('click', function(){
    $('.form-grade[data-id="'+ $(this).attr('data-id') +'"] input').removeAttr('disabled');
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

    $('.datepicker').datepicker({
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
