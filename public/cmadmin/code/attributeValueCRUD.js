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

    $(document).on('change', '#category', function(){
        var category = $("#category").val();
        loadAttributes(category);
    });

    
    loadAttrIfCat();
    function loadAttrIfCat(){
        if (typeof category_id != 'undefined' && category_id)
        {
            loadAttributesSelect(category_id);        
        }
    }

    // oad all attributes while creating.

    function loadAttributes(id){
        $('#attribute').html('');
        $.ajax({
            url: "/admin/product/attribute/load",
            type:'POST',
            data: {_token:_token, id:id},
            dataType: 'json',
            success:function(response){
                $('#attribute').append( '<option disabled selected>Select product attribute</option>' );
                $.each(response, function(key,value){
                    $('#attribute').append( '<option value="'+value.id+'">'+value.name+'</option>' );
                });
            }
        });
    }

    // Load Selected attribute while editing.

    function loadAttributesSelect(id){
        $('#attribute').html('');
        $.ajax({
            url: "/admin/product/attribute/load",
            type:'POST',
            data: {_token:_token, id:id},
            dataType: 'json',
            success:function(response){
                $('#attribute').append( '<option disabled selected>Select product attribute</option>' );
                $.each(response, function(key,value){
                    if(value.id == attribute_id){
                        $('#attribute').append( '<option value="'+value.id+'" selected>'+value.name+'</option>' );
                        console.log(attribute_id);
                    }
                    else{
                        $('#attribute').append( '<option value="'+value.id+'">'+value.name+'</option>' );
                    }
                });
            }
        });
    }




    $('#d_image').change(function(){
        $('#d_image_preview').html("");
        $('#d_image_preview').append("<div class='col-md-4 upload-multi-img'><img src='"+URL.createObjectURL(event.target.files[0])+"'></div>");
    });

    $('#d_drawing').change(function(){
        $('#d_drawing_preview').html("");
        $('#d_drawing_preview').append("<div class='col-md-4 upload-multi-img'><img src='"+URL.createObjectURL(event.target.files[0])+"'></div>");
    });

    $('#c_image').change(function(){
        $('#c_image_preview').html("");
        $('#c_image_preview').append("<div class='col-md-4 upload-multi-img'><img src='"+URL.createObjectURL(event.target.files[0])+"'></div>");
    });
});