$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }});

    var _token = $("input[name='_token']").val();

    $('.measure-learn-link').css('display','block');

    $(window).load(function(){
        loadProductImages(product_id);
    }); 

// Product Images

//Check what this function is form and input details here 

    function destroyCarousel() {
        if ($('.product-details-images').hasClass('slick-initialized')) {
            $('.product-details-images').slick('destroy');
        }   
        if ($('.product-details-thumbs').hasClass('slick-initialized')) {
            $('.product-details-thumbs').slick('destroy');
        }        

    }

//Load the product images on page load.
    
    function loadProductImages(id){
        $('#product_detail_images').html('');
        $('#product_detail_thumbs').html('');
        var _token = $("input[name='_token']").val();
        $.ajax({
            url: "/product/load/images",
            type:'POST',
            data: {_token:_token, id:id},
            dataType: 'json',
            success:function(response){
                $.each(response[0].images, function(key,value){
                    $('#product_detail_images').append('<div class="lg-image"><a href="/images/product/design/'+response[0].folder+'/'+value+'" class="img-poppu"><img src="/images/product/design/'+response[0].folder+'/'+value+'" alt="product image"></a></div>');
                    $('#product_detail_thumbs').append('<div class="sm-image"><img src="/images/product/design/'+response[0].folder+'/'+value+'" alt="product image thumb"></div>');
                });
                destroyCarousel();
                loadSlick();
            }
        });
        
    }

// Loading the slick load since images are being dynamically loaded. 
    function loadSlick(){
         /* Product Details Images Slider */
        $('.product-details-images').each(function(){
            var $this = $(this);
            var $thumb = $this.siblings('.product-details-thumbs');
            $this.slick({
                arrows: false,
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: false,
                autoplaySpeed: 5000,
                dots: false,
                infinite: true,
                centerMode: false,
                centerPadding: 0,
                asNavFor: $thumb,
            });
        });
        $('.product-details-thumbs').each(function(){
            var $this = $(this);
            var $details = $this.siblings('.product-details-images');
            $this.slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: false,
                autoplaySpeed: 5000,
                dots: false,
                infinite: true,
                focusOnSelect: true,
                centerMode: true,
                centerPadding: 0,
                prevArrow: '<span class="slick-prev"><i class="fa fa-angle-left"></i></span>',
                nextArrow: '<span class="slick-next"><i class="fa fa-angle-right"></i></span>',
                asNavFor: $details,
            });
        });

        $('.img-poppu').magnificPopup({
            type: 'image',
            gallery:{
                enabled:true
            }
        });
    }

// Fabric Management

// Load Fabric Details on to the page.
    loadFabricDetails(fabric_id);
    function loadFabricDetails(id){
        $('#fabric_details_body').html('');
        $('#product-detail-fabric-image').html('');
        $('#product_detail_title').html('');
        $('#product_detail_fabric_image').html('');
        var _token = $("input[name='_token']").val();
        $.ajax({
            url: "/fabric/details",
            type:'POST',
            data: {_token:_token, id:id},
            dataType: 'json',
            success:function(response){
                    $('#product_detail_title').append(response[0].name+' '+product_design_name);
                    $('#product_detail_fabric_image').append('<img src="/images/fabric/products/'+response[0].image+'" alt="">')
                    $('#fabric_details_body').append('<div class="row fabric-detail-item"><div class="col-md-5 fabric-detail-head">Name</div><div class="col-md-7 fabric-detail-body">'+response[0].name+'</div></div>');
                    $('#fabric_details_body').append('<div class="row fabric-detail-item"><div class="col-md-5 fabric-detail-head">Class</div><div class="col-md-7 fabric-detail-body">'+response[0].class+'</div></div>');
                    $.each(response[0].attributes, function(key,value){
                        $('#fabric_details_body').append('<div class="row fabric-detail-item"><div class="col-md-5 fabric-detail-head">'+value.t1+'</div><div class="col-md-7 fabric-detail-body">'+value.t2+'</div></div>');
                    });
                    calculatePrice(response[0].id, product_id);
                    fabric_id = response[0].id;
            }
        });
    }

// Calculate the price of the fabric with respect to the product. 
   
    function calculatePrice(fab_id, product_id){
        $('#product_price').html('');
        $('#product_og_price').html('');
        var _token = $("input[name='_token']").val();
        $.ajax({
            url: "/product/price/calculate",
            type:'POST',
            data: {_token:_token, fab_id:fab_id, product_id:product_id},
            dataType: 'json',
            success:function(response){
                $('#product_price').append('MYR '+response.price);
                $('#product_og_price').append('MYR '+response.og_price);
                product_price = response.price;
            }
        });
    }

// Load the change fabric modal from the button click
    $('#loadFabricButton').click(function(event) {
        event.preventDefault();
        $('#loadFabric').modal('show');
        loadClass();
    });

// Loading the class on to the fabric change modal

    function loadClass(){
        $('#class_cover').html('');
        $('#modal_instruction').html('');
        $('#md_ld_fabclass').css({display: 'none'});
        $.ajax({
            url: "/api/fabric/class/list",
            type:'GET',
            dataType: 'json',
            success:function(response){
                $('#modal_instruction').append('<p>To help you find a fabric that best fits you and your budget <b>Supreme Sifu</b> has classified the fabrics in to three sections. Select the section you prefer to view the fabrics of the section -</p>');
                $.each(response, function(key,value){
                    $('#class_cover').append('<div class="col-md-3"> <div class="class-cover"> <input type="radio" name="fabric_class" id="class_'+value.name+'" class="input-hidden fabric_class_select" value="'+value.id+'"/> <label for="class_'+value.name+'" class="section-image"> <img src="/images/fabric/class/'+value.image+'" alt="'+value.name+'"> <div class="select-tick"><i class="fa fa-check" aria-hidden="true"></i></div></label> <div class="class-content-section-cover-modal"> <div class="class-content-title-modal">'+value.name+'</div></div></div></div>');
                });
            }
        });
    }

// Load the fabric from the fabric class selected.
    $(document).on('change', 'input[type=radio][name=fabric_class]', function(){
        var cat_id = $("input[name='fabric_class']:checked").val();
        var cat_name = $("input[name='fabric_class']:checked").parent("div").find(".class-content-title").text();
        var _token = $("input[name='_token']").val();
        $('#class_cover').html('');
        $('#modal_instruction').html('');
        $('#md_ld_fabclass').css({display: 'block'});
        $.ajax({
            url: "/api/fabric/class/find",
            type:'POST',
            data: {_token:_token, id:cat_id},
            dataType: 'json',
            success:function(response){
                $('#modal_instruction').append('<p>Please select from the below premium selection of fabrics.</p>');
                $.each(response, function(key,value){
                    $('#class_cover').append('<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 mt-30"> <div class="single-product-wrap spw-modal"> <div class="product-image pd-image-modal"> <input type="radio" name="fabric_material" id="fabric_'+value.id+'" class="input-hidden front_fabric_list" value="'+value.id+'"/> <label for="fabric_'+value.id+'" class="section-image"> <img src="/images/fabric/products/'+value.image+'" alt="'+value.name+'"> <span class="label-product label-new">'+cat_name+'</span> <div class="select-tick"><i class="fa fa-check" aria-hidden="true"></i></div><div class="product-content-modal"> <h3 class="pdc-h3">'+ value.name +'</h3> <div class="product-price-modal">'+value.price+'/ Meter</div><div class="product-select">SELECT FABRIC</div></div></label> </div></div></div>');
                });
                fabrictiHeight();
            }
        });
    });

// Selecting the fabric from the modal and changing the corresponding fields. 

    $(document).on('change', 'input[type=radio][name=fabric_material]', function(){
        var fabric_id = $("input[name='fabric_material']:checked").val();
        loadFabricDetails(fabric_id);
        $('#loadFabric').modal('hide');
    });

// Set the height of the fabric details bloack with respect to the longest block. 

    function fabrictiHeight(){
        var highestBox = 0;
        $('.product-content-modal').each(function(){  
            $('.pdc-h3', this).each(function(){
                if($(this).height() > highestBox) {
                    highestBox = $(this).height(); 
                }
            });  
            $('.pdc-h3',this).height(highestBox); 
        });         
    }

// Next and close buttons in the fabric change modal. 

    $('#md_ld_fabclass').click(function(event) {
        event.preventDefault();
        loadClass();
    });

    $('#md_ld_close').click(function(event) {
        event.preventDefault();
        $('#loadFabric').modal('hide');
    });


// Measurement Management

// Load the measurement attributes on to the page as input boxes.
// Load the normal measurement attributes
    loadMeasurementAttribute();
    function loadMeasurementAttribute(){
        $('#measurement_attribute_cover').html('');
        $.ajax({
            url: "/api/measurement/attribute/list1",
            type:'GET',
            dataType: 'json',
            success:function(response){
                $.each(response, function(key,value){
                    var tutorialCode ='';
                    if(value.tutorial_id != null){
                        // var tutorialCode = '<div class="measurement-tutorial-link"><a href="'+value.tutorial_id+'" class="mt-link">How to direct measure '+value.name+'!</a></div>';
                        var tutorialCode = '<div class="modal-input-instruction"><a href="'+value.tutorial_id+'" class="mt-link"><span>instruction</span> <i class="fa fa-info-circle"></i></a></div>';
                    }
                    $('#measurement_attribute_cover').append('<div class="col-6 col-md-6"><div class="measurement-head"><div class="modal-input-label">'+value.name+' </div> '+tutorialCode+'</div><div class="measurement-body"><input type="number" name="'+value.code+'" id="'+value.code+'" step="any" class="measurement-input" placeholder="..inches"></div></div>');
                });
            }
        });
    }

// Load the direct measurement attributes
    loadDirectMeasurementAttribute();
    function loadDirectMeasurementAttribute(){
        $('#measurement_ddattribute_cover').html('');
        $.ajax({
            url: "/api/measurement/attribute/list2",
            type:'GET',
            dataType: 'json',
            success:function(response){
                $.each(response, function(key,value){
                    var tutorialCode ='';
                    if(value.tutorial_id != null){
                        var tutorialCode = '<div class="measurement-tutorial-link"><a href="'+value.tutorial_id+'" class="mt-link">How to direct measure '+value.name+'!</a></div>';
                    }
                    $('#measurement_ddattribute_cover').append('<div class="col-md-6"><div class="measurement-head">'+value.name+'</div><div class="measurement-body"><input type="number" name="'+value.code+'" id="'+value.code+'" step="any" class="measurement-input" placeholder="..inches"></div>'+tutorialCode+'</div>');
                });
            }
        });
    }

//on page load load the values of the measurement attributes to the respective input fields. 
    $(window).load(function(){
        loadAttributeValues(measurement_id);
    });    


// On change of measurement profile load the values of the measurement profile. 
    
    $(document).on('change', '#measureProfile', function(){
         var profile_id = $("#measureProfile").val();
         loadAttributeValues(profile_id);
    });

// Load attributes value table
    function loadAttributeValues(id){
        var _token = $("input[name='_token']").val();
        $.ajax({
            url: "/measurement/attributes/values/load",
            type:'POST',
            data: {_token:_token, id:id},
            dataType: 'json',
            success:function(response){
                $.each(response, function(key,value){
                    $("#"+value.code).val(value.value);
                });
            }
        });
    }

    $('#measurement-save-cover').css("display", "none");
    
    saveMeasurementAlert();
    function saveMeasurementAlert(){
        if(mp_name == null){
            $('#measurement-save-cover').css("display", "block");
        }
    }

// Measurement Profile Select - On clicking the measurement profile, load all the measurement profiles.

    // setTimeout(function(){
    //     loadMeasurementProfile(measurement_id);
    // }, 500);  

   // setTimeout(loadMeasurementProfile, 1000, measurement_id);
   // $('#measureProfile').on('click', function(event) {
   //      event.preventDefault();
   //      loadMeasurementProfile(measurement_id);
   //  });

// Load all measurement profiles both common and user profile on page load. 
    // loadMeasurementProfile(measurement_id);

// Load Measurement profile function.
    function loadMeasurementProfile(id){
        $('#measureProfile').html('');
        loadAllMeasurementProfiles(id);
    }

// Loading common measurement profiles
    function loadCommonMeasurement(id){
        $.ajax({
            url: "/measurement/profiles/common",
            type:'GET',
            dataType: 'json',
            success:function(response){
                    $('#measureProfile').append('<option selected="true" disabled="disabled">Standard Measurement Profiles</option>');
                $.each(response, function(key,value){
                    if(value.id == id){
                        $('#measureProfile').append('<option value="'+value.id+'" selected>'+value.name+'</option>');
                    }else{
                        $('#measureProfile').append('<option value="'+value.id+'">'+value.name+'</option>');
                    }
                });
            }
        });
    }

// Load user measurement profiles
    function loadUserMeasurement(id){
       $.ajax({
            url: "/measurement/profiles/user",
            type:'GET',
            dataType: 'json',
            success:function(response){
                if( response.length != 0 ) {
                    $('#measureProfile').append('<option selected="true" disabled="disabled">Saved Measurement Profiles</option>');
                    $.each(response, function(key,value){
                        if(value.id == id){
                            $('#measureProfile').append('<option value="'+value.id+'" selected>'+value.name+'</option>');
                        }else{
                            $('#measureProfile').append('<option value="'+value.id+'">'+value.name+'</option>');
                        }
                    });
                }
            }
        }); 
    }

    loadAllMeasurementProfiles(measurement_id);
    function loadAllMeasurementProfiles(id){
        $.ajax({
            url: "/measurement/profiles/list",
            type:'GET',
            dataType: 'json',
            success:function(response){
                    $('#measureProfile').append('<option selected="true" disabled="disabled">Standard Measurement Profiles</option>');
                    $.each(response[0], function(key1,value1){
                        if(value1.id == id){
                            $('#measureProfile').append('<option value="'+value1.id+'" selected>'+value1.name+'</option>');
                        }else{
                            $('#measureProfile').append('<option value="'+value1.id+'">'+value1.name+'</option>');
                        }
                    });
                    $('#measureProfile').append('<option disabled="disabled">Saved Measurement Profiles</option>');
                    $.each(response[1], function(key2,value2){
                        if(value2.id == id){
                            $('#measureProfile').append('<option value="'+value2.id+'" selected>'+value2.name+'</option>');
                        }else{
                            $('#measureProfile').append('<option value="'+value2.id+'">'+value2.name+'</option>');
                        }
                    });
                }
        }); 
    }

// Load Save Measurement Link
    $(document).on('click', '.mt-link', function(event){
        event.preventDefault();
        var id = $(this).attr('href');
        loadTutorialModal(id);
    });

    function loadTutorialModal(id){
        $('#modalTitle').html('');
        $('#tutorial-image').html('');
        $('#tutorial-video').html('');
        $('#tutorial-body').html('');
        var _token = $("input[name='_token']").val();
        console.log(id);
        $.ajax({
            url: "/guide/load",
            type:'POST',
            data: {_token:_token, id:id},
            dataType: 'json',
            success:function(response){
                $('#loadTutorial').modal('show');
                $('#modalTitle').append(response.title);
                $('#tutorial-image').append('<img src="/images/guide/'+response.image+'" alt="">');
                $('#tutorial-video').append('<iframe class="measurement-tutorial-video" src="'+response.video+'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>');
                $('#tutorial-body').append(response.body);
            }
        });
    }

    $('#ldSMeasurement').on('click', function(event) {
        event.preventDefault();
        $('#saveMeasurementModal').modal('show');
    });

    $('#profile_s').on('click',function(e){
        e.preventDefault();
        saveMeasureProfile();
    });

    function saveMeasureProfile(){
        $('#measurement_profile_name_error').html("");
        if (!$('#measurement_profile_name').val()) {
            $('#measurement_profile_name_error').append('Please provide a name for your measurement profile.')
        }else{
            var profile_name = $('#measurement_profile_name').val();
            saveMProfileName(profile_name, measurement_id)
        }
    }

    function saveMProfileName(name, id){
        var _token = $("input[name='_token']").val();
        $.ajax({
            url: "/measurement/profile/name/save",
            type:'POST',
            data: {_token:_token, id:id, name:name},
            dataType: 'json',
            success:function(response){
                console.log(response);
                $('#measurement-save-cover').css("display", "none");
                $('#saveMeasurementModal').modal('hide');
                loadMeasurementProfile(response.id);
                console.log(response.id);
            }
        });
    }

// Product Attributes Load

// Load Pockets - (Product Attribute)
    loadPockets(product_id);
    function loadPockets(id){
        $('#design_pocket').html('');
        var _token = $("input[name='_token']").val();
        $.ajax({
            url: "/product/front/attribute/pocket/load",
            type:'POST',
            data: {_token:_token, id:id},
            dataType: 'json',
            success:function(response){
                $.each(response, function(key,value){
                    if (value.select == 1) {
                        $('#design_pocket').append(' <div class="col-md-4"><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="shirt-pocket" id="pocket_'+value.id+'" value="'+value.id+'" checked="checked"><label class="form-check-label">'+value.name+'</label></div></div>');
                    }else{
                        $('#design_pocket').append(' <div class="col-md-4"><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="shirt-pocket" id="pocket_'+value.id+'" value="'+value.id+'"><label class="form-check-label">'+value.name+'</label></div></div>');   
                    }
                });
            }
        });
    }

// Monogram Management

// Load the monograms with respect to the product selected once the page is loaded.
    $(window).load(function(){
        loadMonogramValues(product_id);
    }); 

// Load Monogram input fields function
    loadMonograms();
    function loadMonograms(){
        $('#monogram_cover').html('');
        $.ajax({
            url: "/api/product/design/monogram/list",
            type:'GET',
            dataType: 'json',
            success:function(response){
                $.each(response, function(key,value){
                    var tutorialCode ='';
                    if(value.tutorial_id != null){
                        var tutorialCode = '<div class="modal-input-instruction"><a href="'+value.tutorial_id+'" class="mt-link"><span>instruction</span> <i class="fa fa-info-circle"></i></a></div>';
                    }
                    $('#monogram_cover').append('<div class="col-md-6"><div class="monogram-item"><div class="measurement-head"><div class="modal-input-label">'+value.name+' </div> '+tutorialCode+'</div><div class="monogram-body mt--5"><input type="text" id="'+value.code+'" name="'+value.code+'" class="monogram-input" placeholder="Maximum Of '+value.letter+' Letters"></div></div></div>');
                });
            }
        });
    }

// Load the correct monogram values on to the function. 
    function loadMonogramValues(id){
        var _token = $("input[name='_token']").val();
        $.ajax({
            url: "/monogram/product/value",
            type:'POST',
            data: {_token:_token, id:id},
            dataType: 'json',
            success:function(response){
                $.each(response, function(key,value){
                    $("#"+value.code).val(value.value);
                });
            }
        });
    }





    

// Submitting the values.

    var inputObject = {};

    function getMonogramValues(id){
        $.ajax({
            url: "/monogram/product/category",
            type:'POST',
            data: {_token:_token, id:id},
            dataType: 'json',
            success:function(response){
                $.each(response, function(key,value){
                    name = value.code;
                    value = $('#'+value.code+'').val();
                    inputObject[name] = value;
                });
            }
        });
        return inputObject;
    }

    function getMeasurementValues(id){
        $.ajax({
            url: "/measurement/product/category",
            type:'POST',
            data: {_token:_token, id:id},
            dataType: 'json',
            success:function(response){
                $.each(response, function(key,value){
                    name = value.code;
                    value = $('#'+value.code+'').val();
                    inputObject[name] = value;
                });
            }
        });
        return inputObject;
    }

    function getMeasurementProfile(){
        var name = 'measurement_profile';
        var value = $('#measureProfile').val();
        inputObject[name] = value;
    }

    function getProductPrice(){
        var name = 'price';
        var value = product_price;
        inputObject[name] = value;
    }

    function getProductAttributeValues(id){
        $.ajax({
            url: "/product/front/attribute/list",
            type:'POST',
            data: {_token:_token, id:id},
            dataType: 'json',
            success:function(response){
                $.each(response, function(key,value){
                    if($('input[name='+value.code+']:checked').val() != null){
                        name = value.code;
                        value = $('input[name='+value.code+']:checked').val();
                        inputObject[name] = value;
                    }
                });
            }
        });
        return inputObject;
    }

    function getQuantity(){
        name = 'quantity';
        value = $('#quantity').val();
        inputObject[name] = value;
    }

    function goToCart(data){
        $.ajax({
            url: "/design/shirt/buy-now",
            type:'POST',
            data: {_token:_token, data:data, id:product_id},
            dataType: 'json',
            success:function(response){
                window.location.replace('/cart');
            }
        });
    }

    function updateProduct(data){
        $('#addCartName').html('');
        $.ajax({
            url: "/design/shirt/add-to-cart",
            type:'POST',
            data: {_token:_token, data:data, id:product_id},
            dataType: 'json',
            success:function(response){
                console.log(response);
                $('#addCartName').text(response);
                $('#addToCartModal').modal('show');
            }
        });
    }

    $('#confirmOrder').on('click', function(event) {
        event.preventDefault();
        getMonogramValues(product_id);
        getMeasurementValues(product_id);
        getProductAttributeValues(product_id);
        getQuantity();
        getMeasurementProfile();
        getProductPrice()
        setTimeout(function(){
            goToCart(inputObject);
        }, 500);        

    });

    $('#addToCart').on('click', function(event) {
        event.preventDefault();
        getMonogramValues(product_id);
        getMeasurementValues(product_id);
        getProductAttributeValues(product_id);
        getQuantity();
        getMeasurementProfile();
        getProductPrice()
        setTimeout(function(){
            updateProduct(inputObject);
        }, 500);        

    });

    console.log(product_price);
 });

