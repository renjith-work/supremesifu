$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }});

    var _token = $("input[name='_token']").val();


    $(document).on('click', '.load-fabric-modal', function(event){
	    event.preventDefault();
	    var id = $(this).attr('href');
	    loadFabricDetailModal(id);
	});

	loadFabricClass();
    function loadFabricClass(){
    	$('#mobile-load-class').html('');
        $.ajax({
            url: "/api/fabric/class/list",
            type:'GET',
            dataType: 'json',
            success:function(response){
                $.each(response, function(key,value){
                    $('#mobile-load-class').append('<div class="col-6 col-md-3 col-sm-6"> <div class="class-cover"> <input type="radio" name="fabric_class" id="class_'+value.name+'" class="input-hidden fabric_class_select" value="'+value.id+'"/> <label for="class_'+value.name+'" class="section-image"> <img src="/images/fabric/class/'+value.image+'" alt="'+value.name+'"> <div class="select-tick"><i class="fa fa-check" aria-hidden="true"></i></div></label> <div class="class-content-section-cover"> <div class="class-content-title">'+value.name+'</div><div class="class-content-price-range">'+value.price+'</div></div></div></div>');
                });
            }
        });
    }

    fabrictiDetailHeight();
    function fabrictiDetailHeight(){
        var highestBox = 0;
        $('.single-fabric-details').each(function(){  
        	if($(this).height() > highestBox) {
                highestBox = $(this).height();
                console.log(highestBox); 
            }
            $('.single-fabric-details').height(highestBox); 
        });         
    }

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
            	$('#modal-fabric-detail-image').append('<img src="/images/fabric/products/'+response[0].image+'" alt=""> ');
            	$('#modal-fabric-detail-content').append('<div class="modal-fabric-detail-content-item row"> <div class="col-md-4"> <div class="modal-fabric-detail-content-title"> Name </div></div><div class="col-md-8"> <div class="modal-fabric-detail-content-answer"> '+response[0].name+' </div></div></div>');
                $.each(response[0].attributes, function(key,value){
                	$('#modal-fabric-detail-content').append('<div class="modal-fabric-detail-content-item row"> <div class="col-md-4"> <div class="modal-fabric-detail-content-title"> '+value.t1+' </div></div><div class="col-md-8"> <div class="modal-fabric-detail-content-answer"> '+value.t2+' </div></div></div>');
                });
                $('#modal-fabric-detail-content-select').append('<a href="/design/shirt/'+response[0].id+'/design-select" class="mob-next-button">Select Fabric</a>');
            }
        });
	}

 
    function loadFabricClassDropDown(){
    	$('#load-class-dropdown').css("display", "block");
    	$('#classSelect').html('');
    	$.ajax({
            url: "/api/fabric/class/list",
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

    function loadFabric(id, name){

    	$('#mobile-load-class').html('');
        $.ajax({
            url: "/api/fabric/class/find",
            type:'POST',
            data: {_token:_token, id:id},
            dataType: 'json',
            success:function(response){
                console.log(response);
                $.each(response, function(key,value){
                    $('#mobile-load-class').append('<div class="col-md-3"> <a href="'+value.id+'" class="load-fabric-modal"> <div class="single-fabric-cover"> <div class="single-fabric-image"><img src="/images/fabric/products/'+value.image+'" alt="'+value.name+'"> </div><div class="single-fabric-content"> <div class="single-fabric-name">'+value.name+'</div><div class="single-fabric-price">MYR '+value.price+'/ Meter</div><div class="single-fabric-details">'+value.attributes+'</div></div></div></a></div>');
                });
            }
        });
        setTimeout(function(){
            fabrictiDetailHeight();
        }, 300); 
        
    }

    $(document).on('change', 'input[type=radio][name=fabric_class]', function(){
        var cat_id = $("input[name='fabric_class']:checked").val();
        var cat_name = $("input[name='fabric_class']:checked").parent("div").find(".class-content-title").text();
        
        loadFabricClassDropDown(); //Load the fabric class dropwon.
        loadFabric(cat_id, cat_name);
    });

    $(document).on('change', '#classSelect', function(){
        var cat_id = $('#classSelect').val();
        var cat_name = $('#classSelect').parent("div").find(".class-content-title").text();

        loadFabric(cat_id, cat_name);
    });
});