

/* **********************************************************************
    Formatter functions
   ******************************************************************** */



function currencyToNumber(text) {
    let number = Number(text.replace(/[^0-9.-]+/g,""));
    return number;
}


function numberToCurrency(number, currencyCode) {
console.log('numberToCurrency parameter number: ' + number);
    if (number === '' || number === 0){
        //  console.log('numberToCurrency: number is empty string or zero ');
        return;
    }

    const formatter = new Intl.NumberFormat( 'hu', {
        style: 'currency',
        currency: currencyCode,
        currencyDisplay: 'code',
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    });
    return formatter.format(number).slice(0, -4);
}


function numberFormat(number) {
    if (number === '' || number === 0) {
        console.log('numberFormat: number is empty string or zero ');
        return;
    }
    // TODO az ezres csoportositas millios nagysagrend alatt nem megy: majd numeral.js-re cserelni
    const formatter = new Intl.NumberFormat( 'hu', {
        style: 'decimal'
    });
    number = number.replace(',', '.');
    number = formatter.format(number);
    return number;
}


function numberUnFormat(text) {
    text = text.replace(/[^0-9.,-]+/g, '');
    text = text.replace(',', '.');
    return text;
}



/* **********************************************************************
    onReady
   ******************************************************************** */


$(document).ready(function () {

    numeral.nullFormat('');
    numeral.zeroFormat('');

    $('.currency').each(function (index, item) {
        //  console.log('each: numeral');
        if ($(item).val() !== '') {
            var myNumeral = numeral($(item).val()).format('0,0');
            $(item).val(myNumeral);
        }
    });
    $('.currency').on('keyup', function () {
        var myNumeral = numeral($(this).val()).format('0,0');
        //  console.log('keyup: ' + myNumeral);
        $(this).val(myNumeral);
    });
    /*
    $('.currency-zero-enabled').each(function (index, item) {
        //  console.log('each: numeral');
        if ($(item).val() !== '') {
            var myNumeral = numeral($(item).val()).format('0,0');
            $(item).val(myNumeral);
        }
    });
    $('.currency-zero-enabled').on('keyup', function () {
        var myNumeral = numeral($(this).val()).format('0,0');
        //  console.log('keyup: ' + myNumeral);
        $(this).val(myNumeral);
    });
     */

    // on blur
    /*
    $('.currency').on('blur', function () {
        var myNumeral = numeral($(this).val()).format('0,0.');
        console.log('blur: ' + myNumeral);
        $(this).val(myNumeral);
    });
     */
    //on focus
    /*
    $('.currency').on('focus', function () {
        var myNumeral = numeral($(this).val()).format('0,0');
        console.log('focus: ' + myNumeral);
        $(this).val(myNumeral);
    });
    */

    $('.decimal').each(function (index, item) {
        $(item).val( numberFormat($(item).val()) );
    });

    // on blur
    $('.decimal').on('blur', function () {
        $(this).val( numberFormat($(this).val()) );
    });

    //on focus
    $('.decimal').on('focus', function () {
        $(this).val( numberUnFormat($(this).val()) );
    });


    // form onsubmit clear all formatting
    $('form').on('submit', function () {
        $(this).find('.currency').each(function (index, item) {
            $(item).val( currencyToNumber($(item).val()) );
        });
        $(this).find('.decimal').each(function (index, item) {
            $(item).val( numberUnFormat($(item).val()) );
        });
    });




    // init date selectors...

    $.fn.datepicker.dates['hu'] = {
        days: ["Vasárnap", "Hétfő", "Kedd", "Szerda", "Csütörtök", "Péntek", "Szombat"],
        daysShort: ["Vas", "Hét", "Kedd", "Szer", "Csüt", "Pén", "Szo"],
        daysMin: ["Va", "Hé", "Ke", "Sze", "Cs", "Pé", "Szo"],
        months: ["Január", "Február", "Március", "Április", "Május", "Június", "Július", "Augusztus", "Szeptember", "Október", "November", "December"],
        monthsShort: ["Jan", "Feb", "Már", "Ápr", "Máj", "Jún", "Júl", "Aug", "Szept", "Okt", "Nov", "Dec"],
        today: "Ma",
        clear: "Töröl",
        format: "yyyy-mm-dd",
        titleFormat: "yyyy MM", /* Leverages same syntax as 'format' */
        weekStart: 1
    };


    $('.date').datepicker({
        language: applicationLocale
    });


});


