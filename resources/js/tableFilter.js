/**
 * Szuro panel ertekeinek szoveges osszegzese.
 */
function updateTableFilterSummary() {

    if ($('#h_tableFilterChanged').val() == 1) return;

    let summary = $('.card-header').find('.admin-list-filterbox-summary');
    let summaryElements = [];
    $('.card-body').find('.form-group').each(function (index) {
        let label = $(this).find('label').html();
        let control = $(this).find('.table-filter');
        let value = $(control).val();
        let controlType = $(control).prop('tagName');
        //console.log(controlType);
        if (controlType == 'INPUT'){
            //console.log(label, value);
            if (value) { summaryElements.push(label + '="' + value + '"'); }
        } else if (controlType == 'SELECT'){
            if ($(control).find(":selected").val()) { summaryElements.push(label + '="' + $(control).find(":selected").text() + '"'); }
        } else if (controlType == 'DIV'){
            if ($(control).find('.selectpicker') && $(control).find(".selectpicker-fix").attr('title') != 'Choose one or many') {
                summaryElements.push(label + ' in [' + $(control).find(".selectpicker-fix").attr('title') + ']'); }
        }
    });
    console.log(summaryElements.length);
    summary.html( (summaryElements.length > 0) ? summaryElements.join('; ') : '' );
    summary.toggle();
}




$(document).ready(function () {

    $('[aria-controls=filter-collapse]').on('click', function () {
        //updateTableFilterSummary();
    });


    $('.table-filter').on('change', function () {
        $('#h_tableFilterChanged').val(1);
    });

});
