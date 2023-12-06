

/* **********************************************************************
    Form panel expand-collapse functions
   ******************************************************************** */

function formPanelExpander(button) {
    $('.collapse').addClass('show');
}

function formPanelCollapser(button) {
    $('.collapse').removeClass('show');
}


/* **********************************************************************
    onReady
   ******************************************************************** */


$(document).ready(function () {


    $('#formPanelExpanderButton').on('click', function () {
        formPanelExpander($(this));
        $(this).blur();
    });

    $('#formPanelCollapserButton').on('click', function () {
        formPanelCollapser($(this));
        $(this).blur();
    });


});


