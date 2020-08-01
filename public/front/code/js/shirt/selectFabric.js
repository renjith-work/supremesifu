$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }});

    var _token = $("input[name='_token']").val();

    // loadFabricClassDropDown(); //Load fabric class select drop down

    // function checkScreen(){
    //     if ($(window).width() < 768) {
    //        loadFabricClassDropDown();
    //     }
    //     else {
           
    //     }
    // }

    // loadFabric(class_id, class_name); //Load fabrics using jQuery
    function loadFabric(id, name){

        $('#mobile-load-class').html('');
        $.ajax({
            url: "/fabric/class/find",
            type:'POST',
            data: {_token:_token, id:id},
            dataType: 'json',
            success:function(response){
                $.each(response, function(key,value){
                    $('#mobile-load-class').append('<div class="col-md-3"> <a href="'+value.id+'" class="load-fabric-modal"> <div class="single-fabric-cover"> <div class="single-fabric-image"><img src="/images/product/fabric/'+value.image+'" alt="'+value.name+'"> </div><div class="single-fabric-content"> <div class="single-fabric-name">'+value.name+'</div><div class="single-fabric-price">MYR '+value.price+'/ Meter</div><div class="single-fabric-details">'+value.attributes+'</div></div></div></a></div>');
                });
            }
        });
        setTimeout(function(){
            fabrictiDetailHeight();
        }, 300); 
        
    }

    // Load the fabric modal on click
    $(document).on('click', '.load-fabric-modal', function(event){
	    event.preventDefault();
        var id = $(this).attr('href');
        loadNewFabricDetails(id);
	});


    // Adjust the fabric detail height to even.
    fabrictiDetailHeight();
    function fabrictiDetailHeight(){
        var highestBox = 0;
        $('.single-fabric-details').each(function(){  
        	if($(this).height() > highestBox) {
                highestBox = $(this).height();
            }
            $('.single-fabric-details').height(highestBox); 
        });         
    }

    //Load Fabric Details 
    function loadNewFabricDetails(id) {
        var attr = 1;
        $.ajax({
            url: "/front/api/product/fabric",
            type: 'POST',
            data: { _token: _token, id: id, attr: attr },
            dataType: 'json',
            success: function (response) {
                console.log(response);
                loadNewFabricDetailModal(response);
            }
        });
    }

    function loadNewFabricDetailModal(response)
    {
        $('#modal-fabric-detail-content').html('');
        $('#modal-fabric-detail-image').html('');
        $('#modal-fabric-name').html('');
        $('#modal-fabric-detail-content-select').html('');
        $('#loadFabricDetails').modal('show');
        $('#modal-fabric-detail-image').append('<img src="/images/product/fabric/' + response.image + '" alt="'+ response.name +'"> ');
        $('#modal-fabric-name').append(response.name);
        $.each(response.attributes, function (key, value) {
            $('#modal-fabric-detail-content').append('<div class="modal-fabric-detail-content-item row"> <div class="col-6 col-md-4"> <div class="modal-fabric-detail-content-title"> ' + value.name + ' </div></div><div class="col-6 col-md-8"> <div class="modal-fabric-detail-content-answer"> ' + value.value + ' </div></div></div>');
        });
        $('#modal-fabric-detail-content-select').append('<a href="/custom-shirt/design/' + response.id + '/list" class="mob-next-button">Select Fabric</a>');
        loadProductPrice(response.price.price, response.price.old_price);
    }

    function loadProductPrice(productPrice, productOldPrice) {
        $('#modal-fabric-price').html('');
        $('#modal-fabric-ogPrice').html('');
        $('#modal-fabric-price').append('MYR ' + productPrice);
        if (productOldPrice != null) {
            $('#modal-fabric-ogPrice').append('MYR ' + productOldPrice);
        }
    }

});