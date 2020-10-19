$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }});

    var _token = $("input[name='_token']").val();

    $(document).on('click', '.load-design-modal', function(event){
        event.preventDefault();
        var id = $(this).attr('href');
        loadDesignModal(id, fabric_id);
    });

    function loadDesignModal(id, fabric){
        console.log(id);
        console.log(fabric);
        $.ajax({
            url: "/design/load",
            type:'POST',
            data: {_token:_token, id:id, fabric:fabric},
            dataType: 'json',
            success:function(response){
                console.log(response);
                $('#loadDesignDetails').modal('show');
                design_id = response.id;
                $('#productDesign').val(design_id);
                $('#productFabric').val(fabric_id);
                loadDesignName(response.name);
                loadFabricPrice(price, old_price);
                loadDesignPockets(response.pockets);
                loadDesignMonograms(response.monograms);
                loadDesignImages(response.images);
            }
        });
    }

    function loadDesignName(name)
    {
        $('#modal-design-name').html('');
        $('#modal-design-name').append(name);
    }

    function loadFabricPrice(price, old_price)
    {
        $('#modal-design-price').html('');
        var design_oldPrice = '';
        if (old_price != null) {
            design_oldPrice = '<span>MYR' + old_price + '</span>';
        }
        $('#formFabricPrice').val(price); //Set the fabric price.
        $('#modal-design-price').append('MYR ' + price + ' ' + design_oldPrice);
    }

    function loadDesignPrice(price)
    {
        $('#modal-design-price').html('');
        var design_oldPrice = '';
        if (price.old_price != null) {
            design_oldPrice = '<span>MYR' + price.old_price + '</span>';
        }
        $('#modal-design-price').append('MYR ' + price.price + ' ' + design_oldPrice);
    }

    function loadDesignPockets(pockets)
    {
        $('#design_pocket').html('');
        $.each(pockets, function (key, value) {
            if (value.select == 1) {
                $('#design_pocket').append(' <div class="col-md-6"><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="shirt-pocket" id="pocket_' + value.id + '" value="' + value.id + '" checked="checked"><label class="form-check-label modal-pocket-label">' + value.value + '</label></div></div>');
            } else {
                $('#design_pocket').append(' <div class="col-md-6"><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="shirt-pocket" id="pocket_' + value.id + '" value="' + value.id + '"><label class="form-check-label modal-pocket-label">' + value.value + '</label></div></div>');
            }
        });
    }

    function loadDesignMonograms(monograms)
    {
        $('#modal-monogram-cover').html('');
        $.each(monograms, function (key, value) {
            $('#modal-monogram-cover').append('<div class="monogram-item"><div class="measurement-head"><div class="modal-input-label">' + value.name + ' </div> <div class="modal-input-instruction"><a href="#"><span>instruction</span> <i class="fa fa-info-circle"></i></a></div></div><div class="modal-monogram-body"><input type="text" id="' + value.code + '" name="' + value.code + '" class="monogram-input" placeholder="Maximum Of ' + value.letter + ' Letters"></div></div>');
        });
    }

    function loadDesignImages(images)
    {
        $('#product_detail_images').html('');
        $('#product_detail_thumbs').html('');
        // Load Primary Image
        $('#product_detail_images').append('<div class="lg-image"><img src="/images/product/design/' + images.primary + '" alt="' + images.primary + '"></div>');
        $('#product_detail_thumbs').append('<div class="sm-image"><img src="/images/product/design/' + images.primary + '" alt="' + images.primary +'"></div>');
        // Load Secondary Image
        $('#product_detail_images').append('<div class="lg-image"><img src="/images/product/design/' + images.secondary + '" alt="' + images.secondary + '"></div>');
        $('#product_detail_thumbs').append('<div class="sm-image"><img src="/images/product/design/' + images.secondary + '" alt="' + images.secondary + '"></div>');
        // Load Album Images
        $.each(images.album, function (key, value) {
            $('#product_detail_images').append('<div class="lg-image"><img src="/images/product/design/' + value + '" alt="' + value + '"></div>');
            $('#product_detail_thumbs').append('<div class="sm-image"><img src="/images/product/design/' + value + '" alt="' + value + '"></div>');
        });
        setTimeout(function () {
            destroyCarousel();
            loadSlick();
        }, 200);        
    }

    //Check what this function is form and input details here 

    function destroyCarousel() {
        if ($('.product-details-images').hasClass('slick-initialized')) {
            $('.product-details-images').slick('destroy');
        }   
        if ($('.product-details-thumbs').hasClass('slick-initialized')) {
            $('.product-details-thumbs').slick('destroy');
        }        
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
                enabled:false
            }
        });
    }

    // Adjust the fabric detail height to even.
    // designHeight();
    function designHeight(){
        var highestBox = 0;
        var highestTitle = 0;

        $(".product-design-description").each(function() {
            if ($(this).height() > highestBox) {
                highestBox = $(this).height();
            }
        }).height(highestBox);

        $(".product-design-name").each(function() {
            if ($(this).height() > highestTitle) {
                highestTitle = $(this).height();
            }
        }).height(highestTitle);

    }

    setTimeout(function(){
        designHeight();
    }, 200); 

});