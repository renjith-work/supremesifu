$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }});

    var _token = $("input[name='_token']").val();

    // loadFabricClassDropDown(); //Load fabric class select drop down

    function checkScreen(){
        if ($(window).width() < 768) {
           loadFabricClassDropDown();
        }
        else {
           
        }
    }

    loadFabric(class_id, class_name); //Load fabrics using jQuery
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
	    loadFabricDetailModal(id);
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

    // Fabric loading function.
	function loadFabricDetailModal(id){
		$('#modal-fabric-detail-content').html('');
		$('#modal-fabric-detail-image').html('');
		$('#modal-fabric-detail-content-select').html('');
		$.ajax({
            url: "/fabric/details",
            type:'POST',
            data: {_token:_token, id:id},
            dataType: 'json',
            success:function(response){
            	console.log(response);
            	$('#loadFabricDetails').modal('show');
            	$('#modal-fabric-detail-image').append('<img src="/images/product/fabric/'+response[0].image+'" alt=""> ');
            	$('#modal-fabric-detail-content').append('<div class="modal-fabric-detail-content-item row"> <div class="col-md-4"> <div class="modal-fabric-detail-content-title"> Name </div></div><div class="col-md-8"> <div class="modal-fabric-detail-content-answer"> '+response[0].name+' </div></div></div>');
                $.each(response[0].attributes, function(key,value){
                	$('#modal-fabric-detail-content').append('<div class="modal-fabric-detail-content-item row"> <div class="col-md-4"> <div class="modal-fabric-detail-content-title"> '+value.t1+' </div></div><div class="col-md-8"> <div class="modal-fabric-detail-content-answer"> '+value.t2+' </div></div></div>');
                });
                $('#modal-fabric-detail-content-select').append('<a href="/custom-shirt/design/'+response[0].id+'/list" class="mob-next-button">Select Fabric</a>');
            }
        });
	}

    // Fabric class dropdown function. 
    function loadFabricClassDropDown(){
    	$('#load-class-dropdown').css("display", "block");
    	$('#classSelect').html('');
    	$.ajax({
            url: "/fabric/class/list",
            type:'GET',
            dataType: 'json',
            success:function(response){
                $('#classSelect').append('<option value="">Select Class</option>');
                $.each(response, function(key,value){
                    $('#classSelect').append('<option value="'+value.id+'">'+value.name+'</option>');
                });
            }
        });
    }

    // 
    // $(document).on('change', 'input[type=radio][name=fabric_class]', function(){
    //     var cat_id = $("input[name='fabric_class']:checked").val();
    //     var cat_name = $("input[name='fabric_class']:checked").parent("div").find(".class-content-title").text();
        
    //     loadFabricClassDropDown(); //Load the fabric class dropwon.
    //     loadFabric(cat_id, cat_name);
    // });

    $(document).on('change', '#classSelect', function(){
        var cat_id = $('#classSelect').val();
        var cat_name = $('#classSelect').parent("div").find(".class-content-title").text();

        loadFabric(cat_id, cat_name);
    });
});