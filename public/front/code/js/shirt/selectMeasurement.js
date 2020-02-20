$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }});

    var _token = $("input[name='_token']").val();

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
            url: "/measurement/attribute/list1",
            type:'GET',
            dataType: 'json',
            success:function(response){
                $.each(response, function(key,value){
                    $('#measurement_attribute_cover').append('<div class="col-6 col-md-6"><div class="measurement-head">'+value.name+' <span>instruction <i class="fa fa-info-circle"></i></span></div><div class="measurement-body"><input type="number" name="'+value.code+'" id="'+value.code+'" step="any" class="measurement-input" placeholder="..inches"></div><div class="measure-learn-link mob-measure-instr"><a href="#">How to measure!</a></div></div>');
                });
            }
        });
    }

    loadDirectMeasurementAttribute();
    function loadDirectMeasurementAttribute(){
        $('#measurement_ddattribute_cover').html('');
        $.ajax({
            url: "/measurement/attribute/list2",
            type:'GET',
            dataType: 'json',
            success:function(response){
                $.each(response, function(key,value){
                    $('#measurement_ddattribute_cover').append('<div class="col-md-6"><div class="measurement-head">'+value.name+' - Direct Measurement <span>instruction <i class="fa fa-info-circle"></i></span></div><div class="measurement-body"><input type="number" name="'+value.code+'" id="'+value.code+'" class="measurement-input2" placeholder="..inches"></div><div class="measure-learn-link mob-measure-instr"><a href="#">How to measure!</a></div></div>');
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
            url: "/measurement/attribute/value/find",
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
            url: "/guides/measurement/find",
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
                        url: "/measurement/attribute/find",
                        type:'POST',
                        data: {_token:_token, id:id},
                        dataType: 'json', 
                        async: false
                    }).responseText);
        return result.tutorial_id;

    }

});