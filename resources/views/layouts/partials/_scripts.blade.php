<!-- Custom Scripts -->
<!-- TinyMCE -->
<script src="{{ url('vendor/tinymce/tinymce.min.js') }}"></script>
<script>
    var stdEditorConfig = {
        'path_absolute': '',
        'selector': 'textarea.tm_std',
        'plugins': [
            "advlist autolink lists link charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime nonbreaking save table contextmenu directionality",
            "paste textcolor colorpicker textpattern"
        ],
        //'toolbar': "",
        //'height': 129,
    };
    tinymce.init(stdEditorConfig);

    var commentEditorConfig = {
        'path_absolute': '',
        'selector': 'textarea.tm_comment',
        'plugins': [
            "wordcount",
            "emoticons",
        ],
        'menu': "none",
    };
    tinymce.init(commentEditorConfig);
</script>

<script src="{{ asset('js/app.js') }}"></script>