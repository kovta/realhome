<script>
    tinymce.init({
        selector: '.wysiwyg',
        plugins: "code, fullscreen, wordcount",
        toolbar: 'wordcount | undo redo | fullscreen | styleselect | bold italic | link image | alignleft aligncenter alignright alignjustify | outdent indent | code | myButton',
        menubar: false,
        language: '{{ App::getLocale().'_'.strtoupper(App::getLocale()) }}',
        language_url: '/lang/tinymce/{{ App::getLocale().'_'.strtoupper(App::getLocale()) }}.js',
        setup: function (editor) {
            editor.ui.registry.addSplitButton('myButton', {
                text: 'My Button',
                onAction: function () {
                    //     editor.insertContent('<p>You clicked the main button</p>');
                },
                onItemAction: function (api, value) {
                    editor.insertContent(value);
                },
                fetch: function (callback) {
                    var items = [
                        {
                            type: 'choiceitem',
                            text: 'Menu item 1',
                            value: '&nbsp;<em>You clicked menu item 1!</em>'
                        },
                        {
                            type: 'choiceitem',
                            text: 'Menu item 2',
                            value: '&nbsp;<em>You clicked menu item 2!</em>'
                        }
                    ];
                    callback(items);
                }
            });
        }
    });
</script>
