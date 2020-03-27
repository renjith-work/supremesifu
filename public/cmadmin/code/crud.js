$(document).ready(function(){
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

    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }});

    $('#section1N').click(function(e){
        e.preventDefault();
        $('#mainPane').removeClass("active");
        $('#imagePane').addClass("active");

        $('#mainTab').removeClass("active");
        $('#imageTab').addClass("active");

        $('#liMain').removeClass("active");
        $('#liImage').addClass("active");
    });

    $('#section2P').click(function(e){
        e.preventDefault();
        $('#imagePane').removeClass("active");
        $('#mainPane').addClass("active");

        $('#imageTab').removeClass("active");
        $('#mainTab').addClass("active");

        $('#liImage').removeClass("active");
        $('#liMain').addClass("active");
    });

    $('#section2N').click(function(e){
        e.preventDefault();
        $('#imagePane').removeClass("active");
        $('#seoPane').addClass("active");

        $('#imageTab').removeClass("active");
        $('#seoTab').addClass("active");

        $('#liImage').removeClass("active");
        $('#liSeo').addClass("active");
    });

    $('#section3P').click(function(e){
        e.preventDefault();
        $('#seoPane').removeClass("active");
        $('#imagePane').addClass("active");

        $('#seoTab').removeClass("active");
        $('#imageTab').addClass("active");

        $('#liSeo').removeClass("active");
        $('#liImage').addClass("active");
    });

    $("#album").change(function(){
        $('#images_preview').html("");
        var total_file=document.getElementById("album").files.length;
        for(var i=0;i<total_file;i++)
        {
            $('#images_preview').append("<div class='col-md-4 upload-multi-img'><img src='"+URL.createObjectURL(event.target.files[i])+"'></div>");
        }
    });

    $('#image').change(function(){
        $('#image_preview').html("");
        $('#image_preview').append("<div class='col-md-4 upload-multi-img'><img src='"+URL.createObjectURL(event.target.files[0])+"'></div>");
    });

});