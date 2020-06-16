$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    tinymce.init({
        selector: '.tiny_body',
        theme: 'modern',
        plugins: 'print preview searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help',
        toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
        image_advtab: true,
    });

    // Initialize Select2 features
    $(function () {
        $('.select2').select2()
    });

    $('#image').change(function () {
        $('#image_preview').html("");
        $('#image_preview').append("<div class='col-md-4 upload-multi-img'><img src='" + URL.createObjectURL(event.target.files[0]) + "'></div>");
    });

    loadFabricAttributes();
    function loadFabricAttributes() {
        $('#attribute_cover').html('');
        $.ajax({
            url: "/admin/fabric/attribute/list",
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                // console.log(response);
                $.each(response, function (key, value) {
                    $('#attribute_cover').append('<div class="form-group">');
                    $('#attribute_cover').append('<label for="attribute">' + value.name + '</label>');
                    $('#attribute_cover').append('<select name="' + value.name + '" id="' + value.name + '" class="form-control"></select>');
                    $('#attribute_cover').append('</div>');
                    $.each(value.values, function (key1, value1) {
                        $('#' + value.name).append('<option value="' + value1.id + '">' + value1.value + '</option>');
                    });

                });
            }
        });
    }

    var j = 1;
    $('#add_price').click(function () {
        j++;
        console.log(j);
        // $('#dynamic-video-cover').append('<div class="row dynamic-added-video" id="video-row-' + j + '"><div class="col-md-10"><textarea name="video[]" class="form-control" rows="1"></textarea></div><div class="col-md-2"><button type="button" name="remove_video" id="' + j + '" class="btn btn-danger remove_video">X</button></div></div>');
    }); 
    function loadPriceItem(){

    }
});