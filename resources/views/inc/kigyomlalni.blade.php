
{{-- TODO: Megnézni, hogy melyiket hol használjuk, vagy hogy használja-e valalami és vagy csak oda berakni, vagy (INKÁBB) kiszervezni .js-be a readme.md alapján --}}

<script type="text/javascript">

    function showCrudModal(title, contentUrl, formAction){
        let modalObject = $('#crudModal');
        modalObject.find('.modal-title').html(title);
        //modalObject.find('.modal-dialog').css('max-width', '90%');
        $('#crudModalForm').attr('action', formAction);
        $('#crudModalContent').css('min-height', '200px');
        $('#crudModalContent').attr('src', '');
        $('#crudModalContent').attr('html', '');
        $('#crudModalContent').attr('src', contentUrl);
        modalObject.modal('show');
    }


    function initLocaleSwitch(){
        let $wrapper = $('#locale-switch-wrapper');

        if($wrapper){
            onLocaleChange($wrapper.find('.dropdown-toggle span').html());
            $wrapper.on('click','.dropdown-item',function(){
                $wrapper.find('.dropdown-toggle span').html($(this).data('locale'))
                onLocaleChange($(this).data('locale'))
            });


        }
    }


    function onLocaleChange(locale){
        /*
                $('.translatable').each(function(){
                    if($(this).data('locale') !== locale){
                        $(this).hide();
                    }else{
                        $(this).show();
                    }
                })
        */
    }


    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        initLocaleSwitch();


        $('[data-toggle="popover"]').popover();

    });

</script>
