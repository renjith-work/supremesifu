$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var _token = $("input[name='_token']").val();

    $('.measure-learn-link').css('display', 'block');

    loginCheckMessage();
    function loginCheckMessage() {
        if (AuthUser == '') {
            $('#login-check-message').removeClass("hide_content");
        }
    }

    function loadProductPrice(productPrice, productOldPrice) {
        $('#product_price').html('');
        $('#product_og_price').html('');
        $('#product_price').append('MYR ' + productPrice);
        if (productOldPrice != null) {
            $('#product_og_price').append('MYR ' + productOldPrice);
        }
    }

    function loadProductFabricDetails(productFabric) {
        $('#fabric_details_body').html('');
        $('#product-detail-fabric-image').html('');
        $('#fabric_details_body').append('<div class="row fabric-detail-item"><div class="col-md-5 fabric-detail-head">Name</div><div class="col-md-7 fabric-detail-body">' + productFabric.name + '</div></div>');
        $('#fabric_details_body').append('<div class="row fabric-detail-item"><div class="col-md-5 fabric-detail-head">Class</div><div class="col-md-7 fabric-detail-body">' + productFabric.class + '</div></div>');
        loadFabricDetailsAttributes(productFabric.attributes);
        loadFabricImage(productFabric.image);
    }

    function loadFabricDetailsAttributes(fabricAttributes) {
        $.each(fabricAttributes, function (key, value) {
            $('#fabric_details_body').append('<div class="row fabric-detail-item"><div class="col-md-5 fabric-detail-head">' + value.name + '</div><div class="col-md-7 fabric-detail-body">' + value.value + '</div></div>');
        });
    }

    function loadFabricImage(productFabricImage) {
        $('#product_detail_fabric_image').html(' ');
        $('#product_detail_fabric_image').append('<img src="/images/product/fabric/' + productFabricImage + '" alt="">')
    }


    // Load the change fabric modal from the button click
    $('#loadFabricButton').click(function (event) {
        event.preventDefault();
        $('#loadFabric').modal('show');
        loadClass();
    });

    // Loading the class on to the fabric change modal

    function loadClass() {
        $('#class_cover').html('');
        $('#modal_instruction').html('');
        $('#md_ld_fabclass').css({ display: 'none' });
        $.ajax({
            url: "/front/fabric/class/list",
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                $('#modal_instruction').append('<p>To help you find a fabric that best fits you and your budget <b>Supreme Sifu</b> has classified the fabrics in to three sections. Select the section you prefer to view the fabrics of the section -</p>');
                $.each(response, function (key, value) {
                    $('#class_cover').append('<div class="col-md-3"> <div class="class-cover"> <input type="radio" name="fabric_class" id="class_' + value.name + '" class="input-hidden fabric_class_select" value="' + value.id + '"/> <label for="class_' + value.name + '" class="section-image"> <img src="/images/product/fabric/' + value.image + '" alt="' + value.name + '"> <div class="select-tick"><i class="fa fa-check" aria-hidden="true"></i></div></label> <div class="class-content-section-cover-modal"> <div class="class-content-title-modal">' + value.name + '</div></div></div></div>');
                });
            }
        });
    }

    // Load the fabric from the fabric class selected.
    $(document).on('change', 'input[type=radio][name=fabric_class]', function () {
        var cat_id = $("input[name='fabric_class']:checked").val();
        var cat_name = $("input[name='fabric_class']:checked").parent("div").find(".class-content-title").text();
        var _token = $("input[name='_token']").val();
        $('#class_cover').html('');
        $('#modal_instruction').html('');
        $('#md_ld_fabclass').css({ display: 'block' });
        $.ajax({
            url: "/front/fabric/class/find",
            type: 'POST',
            data: { _token: _token, id: cat_id },
            dataType: 'json',
            success: function (response) {
                $('#modal_instruction').append('<p>Please select from the below premium selection of fabrics.</p>');
                $.each(response, function (key, value) {
                    $('#class_cover').append('<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 mt-30"> <div class="single-product-wrap spw-modal"> <div class="product-image pd-image-modal"> <input type="radio" name="fabric_material" id="fabric_' + value.id + '" class="input-hidden front_fabric_list" value="' + value.id + '"/> <label for="fabric_' + value.id + '" class="section-image"> <img src="/images/product/fabric/' + value.image + '" alt="' + value.name + '"> <span class="label-product label-new">' + cat_name + '</span> <div class="select-tick"><i class="fa fa-check" aria-hidden="true"></i></div><div class="product-content-modal"> <h3 class="pdc-h3">' + value.name + '</h3> <div class="product-price-modal">' + value.price + '/ Meter</div><div class="product-select">SELECT FABRIC</div></div></label> </div></div></div>');
                });
                fabrictiHeight();
            }
        });
    });

    // Selecting the fabric from the modal and changing the corresponding fields. 

    $(document).on('change', 'input[type=radio][name=fabric_material]', function () {
        var fabric_id = $("input[name='fabric_material']:checked").val();
        loadNewFabricDetails(fabric_id, product_attr_set_id);
        $('#loadFabric').modal('hide');
    });

    function loadNewFabricDetails(id, attr) {
        $.ajax({
            url: "/front/api/product/fabric",
            type: 'POST',
            data: { _token: _token, id: id, attr: attr },
            dataType: 'json',
            success: function (response) {
                loadProductFabricDetails(response);
                loadProductPrice(response.price.price, response.price.old_price);
                // Feeding Global Variables
                currentProduct_fabric_id = response.id;
                currentProduct_price = response.price.price;
            }
        });
    }

    // Set the height of the fabric details bloack with respect to the longest block. 

    function fabrictiHeight() {
        var highestBox = 0;
        $('.product-content-modal').each(function () {
            $('.pdc-h3', this).each(function () {
                if ($(this).height() > highestBox) {
                    highestBox = $(this).height();
                }
            });
            $('.pdc-h3', this).height(highestBox);
        });
    }

    // Next and close buttons in the fabric change modal. 

    $('#md_ld_fabclass').click(function (event) {
        event.preventDefault();
        loadClass();
    });

    $('#md_ld_close').click(function (event) {
        event.preventDefault();
        $('#loadFabric').modal('hide');
    });

    // On change of measurement profile load the values of the measurement profile. 

    $(document).on('change', '#measureProfile', function () {
        var profile_id = $("#measureProfile").val();
        loadAttributeValues(profile_id);
    });

    // Load attributes value table
    function loadAttributeValues(id) {
        var _token = $("input[name='_token']").val();
        $.ajax({
            url: "/measurement/attributes/values/load",
            type: 'POST',
            data: { _token: _token, id: id },
            dataType: 'json',
            success: function (response) {
                $.each(response, function (key, value) {
                    $("#" + value.code).val(value.value);
                });
            }
        });
    }


    // Load Tutorials
    $(document).on('click', '.mt-link', function (event) {
        event.preventDefault();
        var id = $(this).attr('href');
        loadTutorialModal(id);
    });

    function loadTutorialModal(id) {
        $('#modalTitle').html('');
        $('#tutorial-image').html('');
        $('#tutorial-video').html('');
        $('#tutorial-body').html('');
        var _token = $("input[name='_token']").val();
        $.ajax({
            url: "/admin/guide/load",
            type: 'POST',
            data: { _token: _token, id: id },
            dataType: 'json',
            success: function (response) {
                $('#loadTutorial').modal('show');
                $('#modalTitle').append(response.title);
                $('#tutorial-image').append('<img src="/images/post/' + response.image + '" alt="">');
                $('#tutorial-video').append('<iframe class="measurement-tutorial-video" src="' + response.video + '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>');
                $('#tutorial-body').append(response.bodyH);
            }
        });
    }


    // Submitting the values.

    var inputObject = {};

    $('#addToCart').on('click', function (event) {
        event.preventDefault();
        if (AuthUser != '') {
            var mval = validateMeasurementInput();
            if (mval == 1) {
                getCurrentProduct(currentProduct_id);
                getCurrentFabric(currentProduct_fabric_id);
                getCurrentPrice(currentProduct_price);
                getMonogramValues(currentProduct_id);
                getMeasurementValues(currentProduct_id);
                getMeasurementProfile();
                getQuantity();
                getPocket();
                setTimeout(function () {
                    updateProduct(inputObject);
                }, 500);
            }
        } else {
            loginAlert();
        }

    });

    function loginAlert() {
        $('#login-error-instruction').removeClass("hide_content");
    }

    function validateMeasurementInput() {
        var value = $('.measurement-input').filter(function () {
            return this.value != '';
        });
        if (value.length <= 0) {
            event.preventDefault();
            $('#measurement-error-instruction').removeClass("hide_content");
            return 0;
        } else {
            $('#measurement-error-instruction').addClass("hide_content");
            return 1;
        }
    }

    function getCurrentProduct(id) {
        inputObject['product'] = id;
        return inputObject;
    }

    function getCurrentFabric(id) {
        inputObject['fabric'] = id;
        return inputObject;
    }

    function getCurrentPrice(price) {
        inputObject['price'] = price;
        return inputObject;
    }

    function getMonogramValues(id) {
        $.ajax({
            url: "/front/api/monogram/list",
            type: 'POST',
            data: { _token: _token, id: id },
            dataType: 'json',
            success: function (response) {
                $.each(response, function (key, value) {
                    name = value.code;
                    value = $('#' + value.code + '').val();
                    inputObject[name] = value;
                });
            }
        });
        return inputObject;
    }

    function getMeasurementValues(id) {
        $.ajax({
            url: "/front/api/measurement/product/attributes",
            type: 'POST',
            data: { _token: _token, id: id },
            dataType: 'json',
            success: function (response) {
                $.each(response, function (key, value) {
                    name = value.code;
                    value = $('#' + value.code + '').val();
                    inputObject[name] = value;
                });
            }
        });
        return inputObject;
    }

    function getMeasurementProfile() {
        var name = 'measurement_profile';
        var value = $('#measureProfile').val();
        inputObject[name] = value;
    }

    function getQuantity() {
        name = 'quantity';
        value = $('#quantity').val();
        inputObject[name] = value;
    }

    function getPocket() {
        var name = 'shirt-pocket';
        var value = $('input[name="shirt-pocket"]:checked').val();
        inputObject[name] = value;
    }

    function goToCart(data) {
        $.ajax({
            url: "/design/shirt/buy-now",
            type: 'POST',
            data: { _token: _token, data: data, id: product_id },
            dataType: 'json',
            success: function (response) {
                console.log(response);
                window.location.replace('/cart');
            }
        });
    }
    function updateProduct(data)
    {
        $.ajax({
            url: "/front/product/custom-shirt/edit",
            type: 'POST',
            data: { _token: _token, data: data },
            dataType: 'json',
            beforeSend: function () {
                $("#loading-overlay").show();
            },
            success: function (response) {
                console.log(response);
                $("#loading-overlay").hide();
                if (response.measurementResponse == 0)
                {
                    redirectUrl = '/cart';
                }else{
                    redirectUrl = '/product/shirt/update-measurement/' + response.product.id + '/' + response.measurementResponse + '/'; 
                }
                window.location.href = redirectUrl;
            }
        });
    }
    function createProduct(data) {
        //  $("#loading-overlay").show();
        $.ajax({
            url: "/front/product/custom-shirt/create",
            type: 'POST',
            data: { _token: _token, data: data },
            dataType: 'json',
            beforeSend: function () {
                $("#loading-overlay").show();
            },
            success: function (response) {
                $("#loading-overlay").hide();
                redirectUrl = '/product/shirt/save-measurement/' + response.product.id + '/' + response.measurementResponse + '/';
                console.log(redirectUrl);
                window.location.href = redirectUrl;
            }
        });
    }


});

