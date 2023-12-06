
$(document).ready(function () {

    //https://www.jqueryscript.net/form/jQuery-Plugin-For-Tri-state-Toggle-Switch-Candlestick.html
    $('.three-states').candlestick({
        'mode': 'options',
        'on': '1',
        'off': '2',
        'default': '',
        'swipe': false,
        'size': 'md',
        'nc': '',
        'allowManualDefault': true,
    });

});
