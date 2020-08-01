$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }});

    var _token = $("input[name='_token']").val();

// Loading the measurement fields and the respected tutorial fields.
    loadMeasurementAttribute();
    function loadMeasurementAttribute(){
        $('#measurement_attribute_cover').html('');
        $.ajax({
            url: "/measurement/attribute/list1",
            type:'GET',
            dataType: 'json',
            success:function(response){
                console.log(response);
                $.each(response, function(key,value){
                    var tutorial_link = '<a href="'+ value.tutorial_id +'">How to measure!</a>';
                    $('#measurement_attribute_cover').append('<div class="col-6 col-md-6"><div class="measurement-head">' + value.name + ' <a href="' + value.tutorial_id +'" class="mt-mb-link"><span>instruction <i class="fa fa-info-circle"></i></span></a></div><div class="measurement-body"><input type="number" name="'+value.code+'" id="'+value.code+'" step="any" class="measurement-input" placeholder="..inches"><div class="input_tutorial_link">'+value.tutorial_id+'</div></div></div><div class="measure-learn-link mob-measure-instr">'+ tutorial_link+'</div></div>');
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
                    var tutorial_link = '<a href="' + value.tutorial_id + '">How to measure!</a>';
                    $('#measurement_ddattribute_cover').append('<div class="col-md-6"><div class="measurement-head">' + value.name + ' - Direct Measurement <a href="' + value.tutorial_id +'" class="mt-mb-link"><span>instruction <i class="fa fa-info-circle"></i></span></a></div><div class="measurement-body"><input type="number" name="' + value.code + '" id="' + value.code + '" class="measurement-input2" placeholder="..inches"></div><div class="measure-learn-link mob-measure-instr">' + tutorial_link +'</div></div>');
                });     
            }
        });
    }

// Loading the measurement values to the corresponding attributes on slecting the profile.
    $(document).on('change', '#measureProfile', function () {
        var profile_id = $("#measureProfile").val();
        loadAttributeValues(profile_id);
    });

    // Load attributes value table
    function loadAttributeValues(id) {
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

// Load Tutorials in mobile view
    // Load Tutorials
    $(document).on('click', '.mt-mb-link', function (event) {
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
                $('#tutorial-image').append('<img src="/images/post/' + response.image + '" alt="' + response.title + '">');
                $('#tutorial-video').append('<iframe class="measurement-tutorial-video" src="' + response.video + '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>');
                $('#tutorial-body').append(response.bodyH);
            }
        });
    }

    $(document).on('change', '#measureProfile', function(){
        $('#measure-instruction-cover').html('');
        $('#measure-instruction-cover').append('<div class="dd-measure-img shirt-page-measure-image pt--10"><img src="/front/assets/images/ss-shirt/shirt-measurement.jpg" alt=""></div>');
    });

    // Load tutorials on the side
    
    $(document).on('click', '.measurement-input', function(){
        var tutorial_id = $('.input_tutorial_link', $(this).parent('div:first')).text();
        loadTutorialDetails(tutorial_id);
    });

    function loadTutorialDetails(id)
    {
        $('#measure-instruction-cover').html('');
        $.ajax({
            url: "/admin/guide/load",
            type: 'POST',
            data: { _token: _token, id: id },
            dataType: 'json',
            success: function (response) {
                $('#measure-instruction-cover').append('<div id="measure_tutorial_head_id" class="measurement-tutorial-head">' + response.title + '</div><div class="measurement-tutorial-body"><div class="measurement-tutorial-image"><img src="/images/post/' + response.image + '" alt="' + response.title + '"></div><div class="measurement-tutorial-text">' + response.bodyH + '</div><div class="measurement-tutorial-video-container"><iframe class="measurement-tutorial-video" src="' + response.video + '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div></div>');
            }
        });
    }

});