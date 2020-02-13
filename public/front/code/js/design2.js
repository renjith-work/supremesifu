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
                    $('#class_cover').append('<div class="col-md-3"> <div class="class-cover"> <input type="radio" name="fabric_class" id="class_'+value.name+'" class="input-hidden fabric_class_select" value="'+value.id+'"/> <label for="class_'+value.name+'" class="section-image"> <img src="/images/fabric/class/'+value.image+'" alt="'+value.name+'"> <div class="select-tick"><i class="fa fa-check" aria-hidden="true"></i></div></label> <div class="class-content-section-cover"> <div class="class-content-title">'+value.name+'</div><div class="class-content-price-range">'+value.price+'</div></div></div></div>');
                });
            }
        });
    }

    $('#classCompareButton').click(function(event) {
        event.preventDefault();
        $('#classCompare').modal('show');
        loadClassCompare();
    });

    function loadClassCompare(){
        $('#bodyClassCompare').html('');
        $.ajax({
            url: "/api/fabric/class/list",
            type:'GET',
            dataType: 'json',
            success:function(response){
                console.log(response);
                $.each(response, function(key,value){
                    $('#bodyClassCompare').append('<div class="col-md-3"><div class="class-cover"><div class="section-image"><img src="/images/fabric/class/'+value.image+'"></div><div class="class-content-cover"><div class="modal-compare-class-head">'+value.name+'</div><div class="modal-compare-content">'+value.description.split(" ",15).join(" ")+' ...</div><div class="section-features"><ul><li><div class="section-features-title">Price Range</div><div class="modal-compare-content">'+value.price+'</div></li><li><div class="section-features-title">Cotton Grade</div><div class="modal-compare-content">'+loadStars(value.grade)+'</div></li></ul></div></div></div></div>');
                });
            }
        });
    }
    function loadStars(id){
        var result = '';
        for (var i = 1; i <= (id); i++) { result += ' <i class="fa fa-star"></i>';}
        for (var i = 1; i <= (5-id); i++) { result += ' <i class="fa fa-star-o"></i>';}
        return result;
    }

    $(document).on('change', 'input[type=radio][name=fabric_class]', function(){
        var cat_id = $("input[name='fabric_class']:checked").val();
        var cat_name = $("input[name='fabric_class']:checked").parent("div").find(".class-content-title").text();
        var _token = $("input[name='_token']").val();
        $('#fabrics_listing_cover').css("display", "block");
        $('#fabric_list').html("");
        $.ajax({
            url: "/api/fabric/class/find",
            type:'POST',
            data: {_token:_token, id:cat_id},
            dataType: 'json',
            success:function(response){
                $.each(response, function(key,value){
                    $('#fabric_list').append('<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 mt-30"> <div class="single-product-wrap"> <div class="product-image"> <input type="radio" name="fabric_material" id="fabric_'+value.id+'" class="input-hidden front_fabric_list" value="'+value.id+'"/> <label for="fabric_'+value.id+'" class="section-image"> <img src="/images/fabric/products/'+value.image+'" alt="'+value.name+'"> <span class="label-product label-new">'+cat_name+'</span> <div class="select-tick"><i class="fa fa-check" aria-hidden="true"></i></div><div class="product-content"> <h3>'+ value.name +'</h3> <div class="product-price">'+value.price+'/ Meter</div><div class="product-select">SELECT FABRIC</div></div></label> </div></div></div>');
                });
            }
        });
    });

    loadDesigns(3);
    function loadDesigns(id){
        var _token = $("input[name='_token']").val();
        $.ajax({
            url: "/api/product/design/list",
            type:'POST',
            data: {_token:_token, id:id},
            dataType: 'json',
            success:function(response){
                 $.each(response, function(key,value){
                    $('#product-design-cover').append('<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 mt-30"><div class="style-cover mb--60"><div class="style-content-item"><input type="radio" name="product_design" id="class_'+value.name+'" class="input-hidden product_design_item" value="'+value.id+'" /><label for="class_'+value.name+'" class="style-image"><img src="/images/product/design/'+value.folder+'/'+value.p_image+'" alt="Gold Class"><div class="select-tick"><i class="fa fa-check" aria-hidden="true"></i></div><div class="style-content"><div class="style-name"><h3><a href="#">'+value.name+'</a></h3></div><div class="style-body">'+value.summary+'</div></div></label></div></div></div>');
                });
            }
        });
    }

    loadMonograms();
    function loadMonograms(){
        $('#monogram_cover').html('');
        $.ajax({
            url: "/api/product/design/monogram/list",
            type:'GET',
            dataType: 'json',
            success:function(response){
                $.each(response, function(key,value){
                    $('#monogram_cover').append('<div class="col-md-4"><div class="monogram-item"><div class="measurement-head">'+value.name+' - <span>(The '+value.name+' can be only a maximum of '+value.letter+' characters.)</span></div><div class="monogram-body mt--30"><input type="text" id="'+value.code+'" name="'+value.code+'" class="monogram-input" placeholder="Maximum Of '+value.letter+' Letters"><div class="monogram-learn-link"><a href="#">What is a '+value.name+'?</a></div></div></div></div>');
                });
            }
        });
    }

    loadPockets();
    function loadPockets(){
        $('#design_pocket').html('');
        $.ajax({
            url: "/api/product/design/shirt/pocket/list",
            type:'GET',
            dataType: 'json',
            success:function(response){
                $.each(response, function(key,value){
                    if (value.value == "One Pocket") {
                        $('#design_pocket').append(' <div class="col-md-3"><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="shirt-pocket" id="pocket_'+value.id+'" value="'+value.id+'" checked="checked"><label class="form-check-label">'+value.value+'</label></div></div>');
                    }else{
                        $('#design_pocket').append(' <div class="col-md-3"><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="shirt-pocket" id="pocket_'+value.id+'" value="'+value.id+'"><label class="form-check-label">'+value.value+'</label></div></div>');   
                    }
                });
            }
        });
    }

    loadMeasurementProfile();
    function loadMeasurementProfile(){
        $('#measureProfile').html('');
        loadUserMeasurement();
    }

    function loadCommonMeasurement(){
        $.ajax({
            url: "/measurement/profiles/common",
            type:'GET',
            dataType: 'json',
            success:function(response){
                    $('#measureProfile').append('<option selected="true" disabled="disabled">Select a standard measurement profile..</option>');
                $.each(response, function(key,value){
                    $('#measureProfile').append('<option value="'+value.id+'">'+value.name+'</option>');
                });
            }
        });
    }

    function loadUserMeasurement(){
       $.ajax({
            url: "/measurement/profiles/user",
            type:'GET',
            dataType: 'json',
            success:function(response){
                if( response.length != 0 ) {
                    $('#measureProfile').append('<option selected="true" disabled="disabled">Select from your previously saved profiles.</option>');
                    $.each(response, function(key,value){
                        $('#measureProfile').append('<option value="'+value.id+'">'+value.name+'</option>');
                    });
                }
            }
        }); 
       loadCommonMeasurement()
    }

    loadMeasurementAttribute();
    function loadMeasurementAttribute(){
        $('#measurement_attribute_cover').html('');
        $.ajax({
            url: "/api/measurement/attribute/list1",
            type:'GET',
            dataType: 'json',
            success:function(response){
                $.each(response, function(key,value){
                    $('#measurement_attribute_cover').append('<div class="col-md-6"><div class="measurement-head">'+value.name+'</div><div class="measurement-body"><input type="number" name="'+value.code+'" id="'+value.code+'" step="any" class="measurement-input" placeholder="..inches"></div><div class="measure-learn-link"><a href="#">How to measure!</a></div></div>');
                });
            }
        });
    }

    loadDirectMeasurementAttribute();
    function loadDirectMeasurementAttribute(){
        $('#measurement_ddattribute_cover').html('');
        $.ajax({
            url: "/api/measurement/attribute/list2",
            type:'GET',
            dataType: 'json',
            success:function(response){
                $.each(response, function(key,value){
                    $('#measurement_ddattribute_cover').append('<div class="col-md-6"><div class="measurement-head">'+value.name+' - Direct Measurement</div><div class="measurement-body"><input type="number" name="'+value.code+'" id="'+value.code+'" class="measurement-input2" placeholder="..inches"></div><div class="measure-learn-link"><a href="#">How to measure!</a></div></div>');
                });
            }
        });
    }

    $(document).on('change', '#measureProfile', function(){
         var profile_id = $("#measureProfile").val();
         loadAttributeValues(profile_id);
    });

    function loadAttributeValues(id){
        var _token = $("input[name='_token']").val();
        $.ajax({
            url: "/api/measurement/attribute/value/find",
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

    $(document).on('change', '#measureProfile', function(){
        $('#measure-instruction-cover').html('');
        $('#measure-instruction-cover').append('<div class="dd-measure-img shirt-page-measure-image pt--10"><img src="/front/assets/images/ss-shirt/shirt-measurement.jpg" alt=""></div>');
    });

    $(document).on('click', '.measurement-input', function(){
        var id = $(this).attr('id');
        var ld_tutorial = $('#measure_tutorial_id').text();
        var mattrid = loadMattrDetails(id);
        if(ld_tutorial != mattrid){
            $('#measure-instruction-cover').html('');
            loadTutorial(id);
        }
    });

    function loadTutorial(id){
        var _token = $("input[name='_token']").val();
        $.ajax({
            url: "/api/guides/measurement/find",
            type:'POST',
            data: {_token:_token, id:id},
            dataType: 'json',
            success:function(response){
                $('#measure-instruction-cover').append('<div id="measure_tutorial_id" style="color:#d4d4d4; size: 1px;">'+response.id+'</div><div id="measure_tutorial_head_id" class="measurement-tutorial-head">'+response.title+'</div><div class="measurement-tutorial-body"><div class="measurement-tutorial-image"><img src="/images/guide/'+response.image+'" alt=""></div><div class="measurement-tutorial-text">'+response.body+'</div><div class="measurement-tutorial-video-container"><iframe class="measurement-tutorial-video" src="'+response.video+'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div></div>');      
            }
        });
    }

    function loadMattrDetails(id){
        var _token = $("input[name='_token']").val();
        var result = $.parseJSON($.ajax({
                        url: "/api/measurement/attribute/find",
                        type:'POST',
                        data: {_token:_token, id:id},
                        dataType: 'json', 
                        async: false
                    }).responseText);
        return result.tutorial_id;

    }

    $('#step1c').click(function(e){
        e.preventDefault();
        var material_id = $("input[name='fabric_material']:checked").val();
        if(material_id == null){
            $('#instr1').css({display: 'block'});
        }else{
            $('#instr1').css({display: 'none'});

            $('#section1').removeClass("active");
            $('#section2').addClass("active");

            $('#nav_step1').removeClass("active");
            $('#nav_step2').addClass("active");
            loadSection();
        }
    });

    $('#step2c').click(function(e){
        e.preventDefault();
        $('#section2').removeClass("active");
        $('#section3').addClass("active");

        $('#nav_step2').removeClass("active");
        $('#nav_step3').addClass("active");
        loadSection();
    });

    $('#step1b').click(function(e){
        e.preventDefault();
        $('#section2').removeClass("active");
        $('#section1').addClass("active");

        $('#nav_step2').removeClass("active");
        $('#nav_step1').addClass("active");
        loadSection();

    });

    $('#step2b').click(function(e){
        e.preventDefault();
        $('#section3').removeClass("active");
        $('#section2').addClass("active");

        $('#nav_step3').removeClass("active");
        $('#nav_step2').addClass("active");
        loadSection();
    });

    $('#step1c').addClass("disabled");
    $('#instr1').addClass("hide_content");
    $('#fabric_list').on('change', '.front_fabric_list', function(){
        $('#step1c').removeClass("disabled");
        $('#instr1').addClass("hide_content");
    });

    $('#section2BCover').on('click',function(e){
        if( $('#step1c').hasClass('disabled') ){
            e.preventDefault();
            $('#instr1').removeClass("hide_content");
        }else{
            $('#instr1').addClass("hide_content");
        }
    });

    $('#step2c').addClass("disabled");
    $('#instr2').addClass("hide_content");
    $('#product-design-cover').on('change', '.product_design_item', function(){
        $('#step2c').removeClass("disabled");
        $('#instr2').addClass("hide_content");
    });

    $('#section3BCover').on('click',function(e){
        if( $('#step2c').hasClass('disabled') ){
            e.preventDefault();
            $('#instr2').removeClass("hide_content");
        }else{
            $('#instr2').addClass("hide_content");
        }
    });

    $('#instr3').addClass("hide_content");
    $('#formSubmit').on('click', function () {
        validateMeasurementInput();
        // checkMeasurementProfile();
    });

    function loadSection(){
        $('html, body').animate({
            scrollTop: $("#tabCover").offset().top -70
        }, 500);
    }

    function validateMeasurementInput(){
        var value = $('.measurement-input').filter(function () {
            return this.value != '';
        });
        if (value.length<=0) {
            event.preventDefault();
            $('#instr3').removeClass("hide_content");
        }
    }

    // function checkMeasurementProfile(){
    //     event.preventDefault();
    //     var mp_id = $("#measureProfile").val();
    //     getMeasurementAttr(mp_id);
    // }

    // function getMeasurementAttr(id){
    //     var _token = $("input[name='_token']").val();
    //     var measure_array = [];
    //     $.ajax({
    //         url: "/api/measurement/attribute/value/find",
    //         type:'POST',
    //         data: {_token:_token, id:id},
    //         dataType: 'json',
    //         success:function(response){
    //             $.each(response, function(key,value){
    //                 if ($("#"+value.code).val() != value.value){
    //                     measure_array.push(value.id);
    //                 }
    //             });

    //             if (typeof measure_array !== 'undefined' && measure_array.length > 0) {
    //                 console.log("Change in measurement attributes");
    //                 loadMeasurementSaveModal();
    //             }
    //         }
    //     });
    // }

    
    // function loadMeasurementSaveModal(){
    //     $('#saveMeasurementModal').modal('show');
    //     $('#modal-measurement-attribute-list').html("");
    //     $.ajax({
    //         url: "/api/measurement/attribute/list",
    //         type:'GET',
    //         dataType: 'json',
    //         success:function(response){
    //             $.each(response, function(key,value){
    //                 var in_val = $('#'+value.code+'').val();
    //                 $('#modal-measurement-attribute-list').append('<div class="col-md-4"><div class="modal-mattribute-item row"><div class="col-md-7 col-sm-6"><div class="modal-mattribute-item-head">'+value.name+' &nbsp; - </div></div><div class="col-md-5 col-sm-6"><div class="modal-mattribute-item-body">'+in_val+'</div></div></div></div>');
    //             });
    //         }
    //     });
    // }

    // $('#profile_s').on('click',function(e){
    //     e.preventDefault();
    //     saveMeasureProfile();
    // });

    // function saveMeasureProfile(){
    //     $('#measurement_profile_name_error').html("");
    //     if (!$('#measurement_profile_name').val()) {
    //         $('#measurement_profile_name_error').append('Please provde a name for your measurement profile.')
    //     }else{
    //         loadMeasuremntValues();
    //     }
    // }
    
    // function loadMeasuremntValues(){
    //     var object = {};
    //     $.ajax({
    //         url: "/api/measurement/attribute/list",
    //         type:'GET',
    //         dataType: 'json',
    //         success:function(response){
    //             $.each(response, function(key,value){
    //                 if ($('#'+value.code+'').val()) {
    //                     ms_code = value.code;
    //                     ms_value = $('#'+value.code+'').val();
    //                     object[ms_code] = ms_value;
    //                 }
    //             });
    //             var _token = $("input[name='_token']").val();
    //             object["_token"] = _token;
    //             var userProfileName = $('#measurement_profile_name').val();
    //             object["name"] = userProfileName;
    //             // object["user_id"] = ;
    //             object["category_id"] = 3;
    //             $.ajax({
    //                 url: "/measurement/user/standard",
    //                 type:'POST',
    //                 data: object,
    //                 success:function(response){
    //                     console.log(response);
    //                 }
    //             });
    //         }
    //     });
    // }

    // $('#testLoad').on('click',function(event){
    //     event.preventDefault();
    //     if(user_id === undefined || user_id === null){
    //         console.log('please login');
    //     }else{
    //         loadUserId();            
    //     }
        
    // });

    // function loadUserId(){
    //     var _token = $("input[name='_token']").val();
    //     var object = {};
    //     object["_token"] = _token;
    //     object["user_id"] = user_id;
    //     $.ajax({
    //         url: "/api/get/token",
    //         type:'POST',
    //         data: object,
    //         success:function(response){
    //             console.log(response);
    //         }
    //     });
    // }

});
