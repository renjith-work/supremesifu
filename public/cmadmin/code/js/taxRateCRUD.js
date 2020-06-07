$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var _token = $("input[name='_token']").val();

    // Initialize Select2 features
    $(function () {
        $('.select2').select2()
    });

    tinymce.init({
        selector: '.wysiwyg',
        theme: 'modern',
        plugins: 'print preview searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help',
        toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
        image_advtab: true,
    });


    
    // On Change country function 
    $(document).on('change', '#country', function () {
        var country = $("#country").val();
        taxZoneLoad(country);
    });


    // Loading Zone Function.
    function taxZoneLoad(id) {
        $('#zone').html('');
        $.ajax({
            url: "/admin/api/settings/country/zones",
            type: 'POST',
            data: { _token: _token, id: id },
            dataType: 'json',
            success: function (response) {
                console.log(response);
                $('#zone').append('<option disabled selected>Select a zone</option>');
                $.each(response, function (key, value) {
                    $('#zone').append('<option value="' + value.id + '">' + value.name + '</option>');
                });
            }
        });
    }

    selectTaxZone();

    function selectTaxZone() {
        if (typeof country_id != 'undefined' && country_id) {
            taxZoneLoadEdit(country_id);
        }
    }

    // Loading Zone Function.
    function taxZoneLoadEdit(id) {
        console.log(id);
        $('#zone').html('');
        $.ajax({
            url: "/admin/api/settings/country/zones",
            type: 'POST',
            data: { _token: _token, id: id},
            dataType: 'json',
            success: function (response) {
                console.log(response);
                $('#zone').append('<option disabled selected>Select a zone</option>');
                $.each(response, function (key, value) {
                    if(value.id == zone_id){
                        $('#zone').append('<option value="' + value.id + '" selected>' + value.name + '</option>');
                    }else{
                        $('#zone').append('<option value="' + value.id + '">' + value.name + '</option>');
                    }
                });
            }
        });
    }

});