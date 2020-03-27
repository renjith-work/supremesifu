$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }});

    var _token = $("input[name='_token']").val();

    // Initialize Select2 features
    $(function () {
        $('.select2').select2()
    });

    tinymce.init({
        selector: '.wysiwyg',
        theme: 'modern',
        plugins: 'print preview searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help',
        toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
        image_advtab: true,
    });

    $('#image').change(function(){
        $('#image_preview').html("");
        $('#image_preview').append("<div class='col-md-4 upload-multi-img'><img src='"+URL.createObjectURL(event.target.files[0])+"'></div>");
    });
});