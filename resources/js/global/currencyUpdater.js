/*
    A class="devisaupdater" -el rendelkező elemek értékét frissíti a #price_currency_id legördülő értéke alapján
 */

$(document).ready(function () {

    if( $('#price_currency_id').val() === '') {
        //  a php kódban is statikusan hivatkozik az 1-es értékre:
        $('#price_currency_id').find('option[value=1]').attr('selected','selected');
    }

    $('#price_currency_id').change(function () {
        console.log('currency labels must be updated now');
        // csak akkor váltson, ha van kiválasztva érték
        if($(this).val() !== '') {
            window.actual_currency = $("#price_currency_id option:selected").text();
            $('.devisaupdater').each(function () {
                $(this).text(window.actual_currency);
            });
        }
    });

});
