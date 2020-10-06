$(document).ready(function () {
    // Initialize Select2 features
    $(function () {
        $('.select2').select2()
    });

    var designPrice = 0;

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
        }
    });

    var _token = $("input[name='_token']").val();

    // Load product attributes and values when product category is loaded;
    loadPdVals();

    // Load product attributes and values when product category is selected;
    $(document).on('change', '#attributeSet', function () {
        // loadPdVals();   
        var attributeSet = $("#attributeSet").val();
        // loadFabricSection(category); //Load the fabric section if the product category has a fabric associated with it.
        loadProductAttributes(attributeSet);

        setTimeout(function () {
            loadProductAttributeValues(attributeSet);
        }, 1000);
    });

    function loadPdVals() {
        var attributeSet_id = $("#attributeSet").val();

        if (typeof attributeSet_id != 'undefined' && attributeSet_id) {

            loadProductAttributes(attributeSet_id);
            if (typeof design_id != 'undefined' && design_id) {
                setTimeout(function () {
                    loadProductAttributeValuesEdit(attributeSet_id, design_id);
                }, 1000);
            } else {
                setTimeout(function () {
                    loadProductAttributeValues(attributeSet_id);
                }, 1000);
            }
        }
    }

    function loadProductAttributes(id) {
        $('#prd-attr-cover').html('');
        $.ajax({
            url: "/admin/api/product/attribute/load",
            type: 'POST',
            data: { _token: _token, id: id },
            dataType: 'json',
            success: function (response) {
                // console.log(response);
                $.each(response, function (key, value) {
                    $('#prd-attr-cover').append('<div class="form-group"><label for="' + value.code + '">' + value.name + '</label><select id="' + value.code + '" class="form-control custom-select mt-15" name="' + value.code + '"><option selected disabled>Select ' + value.name + ' Style</option></select></div>');
                });
            }
        });
    }

    function loadProductAttributeValues(id) {
        $.ajax({
            url: "/admin/api/product/attribute/load",
            type: 'POST',
            data: { _token: _token, id: id },
            dataType: 'json',
            success: function (response) {
                $.each(response, function (key, value) {
                    $.each(value.values, function (key1, value1) {
                        $('#' + value.code + '').append('<option value="' + value1.attribute_value_id + '">' + value1.attribute_value_name + '</option>');
                    });
                });
            }
        });
    }

    function loadProductAttributeValuesEdit(attrbuteSet_id1, design_id1) {
        $.ajax({
            url: "/admin/api/product/attribute/loadDesignEdit",
            type: 'POST',
            data: { _token: _token, attributeSet_id: attrbuteSet_id1, design_id: design_id1 },
            dataType: 'json',
            success: function (response) {
                $.each(response, function (key, value) {
                    $.each(value.values, function (key1, value1) {
                        if (value1.select == 1) {
                            $('#' + value.code + '').append('<option value="' + value1.attribute_value_id + '" selected>' + value1.attribute_value_name + '</option>');
                        } else {
                            $('#' + value.code + '').append('<option value="' + value1.attribute_value_id + '">' + value1.attribute_value_name + '</option>');
                        }

                    });
                });
            }
        });
    }

    // Image Upload
    $("#album").change(function () {
        $('#images_preview').html("");
        var total_file = document.getElementById("album").files.length;
        for (var i = 0; i < total_file; i++) {
            $('#images_preview').append("<div class='col-md-4 upload-multi-img'><img src='" + URL.createObjectURL(event.target.files[i]) + "'></div>");
        }
    });

    $('#p_image').change(function () {
        $('#p_image_preview').html("");
        $('#p_image_preview').append("<div class='col-md-4 upload-multi-img'><img src='" + URL.createObjectURL(event.target.files[0]) + "'></div>");
    });

    $('#s_image').change(function () {
        $('#s_image_preview').html("");
        $('#s_image_preview').append("<div class='col-md-4 upload-multi-img'><img src='" + URL.createObjectURL(event.target.files[0]) + "'></div>");
    });

    // Add More Button

    var j = 1;
    $('#add_video').click(function () {
        j++;
        $('#dynamic-video-cover').append('<div class="row dynamic-added-video" id="video-row-' + j + '"><div class="col-md-10"><textarea name="video[]" class="form-control" rows="1"></textarea></div><div class="col-md-2"><button type="button" name="remove_video" id="' + j + '" class="btn btn-danger remove_video">X</button></div></div>');
    });
    $(document).on('click', '.remove_video', function () {
        var rmv_button_id = $(this).attr("id");
        $('#video-row-' + rmv_button_id + '').remove();
    });

    // Scrolling To Top
    function scrollToTop() {
        window.scrollTo(0, 0);
    }

    // Price Calculation
    loadPrice(designPrice);
    function loadPrice(price)
    {
        $('#price').val(price);
    }

    // Switching Between Tabs

    $('#section1N').click(function (e) {
        e.preventDefault();
        $('#mainPane').removeClass("active");
        $('#attrPane').addClass("active");

        $('#mainTab').removeClass("active");
        $('#attrTab').addClass("active");

        $('#liMain').removeClass("active");
        $('#liAttr').addClass("active");
        scrollToTop()
    })

    $('#section2P').click(function (e) {
        e.preventDefault();
        $('#attrPane').removeClass("active");
        $('#mainPane').addClass("active");

        $('#attrTab').removeClass("active");
        $('#mainTab').addClass("active");

        $('#liAttr').removeClass("active");
        $('#liMain').addClass("active");
        scrollToTop()
    })

    $('#section2N').click(function (e) {
        e.preventDefault();
        $('#attrPane').removeClass("active");
        $('#imagePane').addClass("active");

        $('#attrTab').removeClass("active");
        $('#imageTab').addClass("active");

        $('#liAttr').removeClass("active");
        $('#liImage').addClass("active");
        scrollToTop()
    })

    $('#section3P').click(function (e) {
        e.preventDefault();
        $('#pricePane').removeClass("active");
        $('#attrPane').addClass("active");

        $('#priceTab').removeClass("active");
        $('#attrTab').addClass("active");

        $('#liPrice').removeClass("active");
        $('#liAttr').addClass("active");
        scrollToTop()
    })

    $('#section3N').click(function (e) {
        e.preventDefault();
        $('#pricePane').removeClass("active");
        $('#imagePane').addClass("active");

        $('#priceTab').removeClass("active");
        $('#imageTab').addClass("active");

        $('#liPrice').removeClass("active");
        $('#liImage').addClass("active");
        scrollToTop()
    })

    $('#section5P').click(function (e) {
        e.preventDefault();
        $('#imagePane').removeClass("active");
        $('#attrPane').addClass("active");

        $('#imageTab').removeClass("active");
        $('#attrTab').addClass("active");

        $('#liImage').removeClass("active");
        $('#liAttr').addClass("active");
        scrollToTop()
    })

    $('#section5N').click(function (e) {
        e.preventDefault();
        $('#imagePane').removeClass("active");
        $('#seoPane').addClass("active");

        $('#imageTab').removeClass("active");
        $('#seoTab').addClass("active");

        $('#liImage').removeClass("active");
        $('#liSeo').addClass("active");
        scrollToTop()
    })

    $('#section6P').click(function (e) {
        e.preventDefault();
        $('#seoPane').removeClass("active");
        $('#imagePane').addClass("active");

        $('#seoTab').removeClass("active");
        $('#imageTab').addClass("active");

        $('#liSeo').removeClass("active");
        $('#liImage').addClass("active");
        scrollToTop()
    })

});