$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }});

    function delay(callback, ms) {
        var timer = 0;
        return function() {
            var context = this, args = arguments;
            clearTimeout(timer);
            timer = setTimeout(function () {
                callback.apply(context, args);
            }, ms || 0);
        };
    }

    loadClass();
    function loadClass(){
        $('#class_cover').html('');
        $.ajax({
            url: "/api/fabric/class/list",
            type:'GET',
            dataType: 'json',
            success:function(response){
                // console.log(response);
                $.each(response, function(key,value){
                    $('#class_cover').append('<div class="col-md-3"><div class="class-cover">');
                    $('#class_cover').append('<input type="radio" name="fabric_class" id="class_'+value.name+'" class="input-hidden fabric_class_select" value="'+value.id+'" />');
                    $('#class_cover').append('<label for="class_'+value.name+'" class="section-image">');
                    $('#class_cover').append('<img src="/images/fabric/class/'+value.image+'" alt="'+value.name+'">');
                    $('#class_cover').append('<div class="select-tick"><i class="fa fa-check" aria-hidden="true"></i></div>');
                    $('#class_cover').append('</label>');
                    $('#class_cover').append('<div class="class-content-section-cover">');
                    $('#class_cover').append('<div class="class-content-title">'+value.name+'</div>');
                    $('#class_cover').append('</div></div></div>');

                    // console.log(value.values);
                    // $.each(value.values, function(key1,value1){
                    //     $('#'+ value.name).append('<option value="'+value1.id+'">'+value1.value+'</option>');
                    // });

                });
            }
        });
    }

    $('input[type=radio][name=fabric_class]').on('change', function(){
        var cat_id = $("input[name='fabric_class']:checked").val();
        var _token = $("input[name='_token']").val();
        $('#fabrics_listing_cover').css("display", "block");
        $('#design_fabric_list').html("");
        $.ajax({
            url: "/fabrics/shirt/design/list",
            type:'POST',
            data: {_token:_token, id:cat_id},
            dataType: 'json',
            success:function(response){
                $.each(response.data, function(key,value){
                    $('#design_fabric_list').append('<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 mt-30"> <div class="single-product-wrap"> <div class="product-image"> <input type="radio" name="fabric_material" id="fabric_'+value.id+'" class="input-hidden" value="'+value.id+'"/> <label for="fabric_'+value.id+'" class="section-image"> <img src="/images/fabric/products/'+value.image+'" alt="'+value.name+'"> <span class="label-product label-new">'+response.data2.name+'</span> <div class="select-tick"><i class="fa fa-check" aria-hidden="true"></i></div><div class="product-content"> <h3>'+ value.name +'</h3> <div class="product-price">'+response.data2.price+'/ Meter</div><div class="product-select">SELECT FABRIC</div></div></label> </div></div></div>');
                });
            }
        });
    });

    $('#design_fabric_list').on('click', 'input[type=radio][name=fabric_material]', function(e){
        // e.preventDefault();
        var cat_id = $('#design_fabric_list').find("input[type=radio][name=fabric_material]:checked").val();
        var _token = $("input[name='_token']").val();
        $.ajax({
            url: "/fabric/thread/color",
            type:'POST',
            data: {_token:_token, id:cat_id},
            dataType: 'json',
            success:function(response){
                $.each(response, function(key,value){
                    console.log(response);
                    $('#thread_color').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                });
            }
        }); 
    });

    $('#step1c').click(function(e){
        e.preventDefault();
        $('#section1').removeClass("active");
        $('#section2').addClass("active");

        $('#nav_step1').removeClass("active");
        $('#nav_step2').addClass("active");

        styleContentHeight();
        step2Scroll();
    });

    $('#step2c').click(function(e){
        e.preventDefault();
        $('#section2').removeClass("active");
        $('#section3').addClass("active");

        $('#nav_step2').removeClass("active");
        $('#nav_step3').addClass("active");
    });

    $('#step1b').click(function(e){
        e.preventDefault();
        $('#section2').removeClass("active");
        $('#section1').addClass("active");

        $('#nav_step2').removeClass("active");
        $('#nav_step1').addClass("active");

    });

    $('#step2b').click(function(e){
        e.preventDefault();
        $('#section3').removeClass("active");
        $('#section2').addClass("active");

        $('#nav_step3').removeClass("active");
        $('#nav_step2').addClass("active");
    });

    function step2Scroll(){
        // $(window).scrollTop( $("#tabCover").offset().top );
            $('html, body').animate({scrollTop: $('#tabCover').offset().top}, 1000);

             // $("html, body").animate({ scrollTop: $('#pocketSection').position().top }, 1000);
    }

    // $('.nav-pills li a').on('click', function(event) {
    //     event.preventDefault();
    //     $('html, body').animate({scrollTop:0}, 'fast'); 
    //     $(this).tab('show');    
    // });

    function styleContentHeight(){
        var maxHeight = -1;
        $('.style-content').each(function() {
            maxHeight = maxHeight > $(this).height() ? maxHeight : $(this).height();
         });
        $('.style-content').each(function() {
             $(this).height(maxHeight);
        });
    }

    loadMeasurements();
    function loadMeasurements(){
        $.ajax({
            url: "/measurement/shirt/list",
            type:'GET',
            dataType: 'json',
            success:function(response){
                $.each(response, function(key,value){
                    $('#measureProfile').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                });
            }
        }); 
    }

    $("#measureProfile").change(function(e) {
        e.preventDefault();
        var cat_id = $("#measureProfile").val();
        var _token = $("input[name='_token']").val();
        $.ajax({
            url: "/measurement/shirt/list/load",
            type:'POST',
            data: {_token:_token, id:cat_id},
            dataType: 'json',
            success:function(response){
                $("#neck").val(response.neck);
                $("#shoulder").val(response.shoulder);
                $("#front").val(response.front);
                $("#back").val(response.back);
                $("#sleeve").val(response.sleeve);
                $("#chest").val(response.chest);
                $("#waist").val(response.waist);
                $("#hip").val(response.hip);
                $("#elbow").val(response.elbow);
                $("#armhole").val(response.armhole);
                $("#cuff").val(response.cuff);
            }
        });
    });

    // Loading Tutorials

    $('#neck').on("click", function(e){
        e.preventDefault();
        loadTutorial(1);
    });

    $('#chest').on("click", function(e){
        e.preventDefault();
        loadTutorial(2);
    });

    $('#waist').on("click", function(e){
        e.preventDefault();
        loadTutorial(3);
    });

    function loadTutorial(id){
        var cat_id = id;
        var _token = $("input[name='_token']").val();
        $('#measure-instruction-cover').html("");
        $.ajax({
            url: "/measurement/tutorial/find",
            type:'POST',
            data: {_token:_token, id:cat_id},
            dataType: 'json',
            success:function(response){
                console.log(response);
                $('#measure-instruction-cover').append('<div class="dd-measure-img shirt-page-measure-image pt--10"> <div class="measure-instruciton-title"><h2>'+response.title+'</h2> </div><div class="measure-instruciton-body">'+response.body+'</div><div class="measure-instruciton-video">'+response.video+'</div><div class="measure-instruciton-image"><img src="/images/measurement/tutorial/'+response.folder+'/'+response.image+'" alt=""></div></div>');
            }
        });
    }
});



