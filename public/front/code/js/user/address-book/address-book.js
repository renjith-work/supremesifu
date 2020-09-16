$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var _token = $("input[name='_token']").val();

    // Loading the zones from selecting the country
    $(document).on('change', '#country', function () {
        var country_id = $("#country").val();
        loadZones(country_id);
    });

    function loadZones(id)
    {
        $('#zone').html('');
        $.ajax({
            url: "/user/country",
            type: 'POST',
            data: { _token: _token, id: id },
            dataType: 'json',
            success: function (response) {
               $('#zone').append('<option>Please select a zone..</option>')
                $.each(response, function (key, value) {
                    $('#zone').append('<option value="' + value.id + '">' + value.name +'</option>');
                });
            }
        });
    }

    loadZonesEdit(country_id, zone_id);
    function loadZonesEdit(country, zone) {
        if(country != '')
        {
            $('#zone').html('');
            $.ajax({
                url: "/user/country",
                type: 'POST',
                data: { _token: _token, id: country},
                dataType: 'json',
                success: function (response) {
                    $('#zone').append('<option>Please select a zone..</option>')
                    $.each(response, function (key, value) {
                        if(value.id == zone)
                        {
                            $('#zone').append('<option value="' + value.id + '" selected>' + value.name + '</option>');
                        }else{
                            $('#zone').append('<option value="' + value.id + '">' + value.name + '</option>');
                        }
                    });
                }
            });
        }
    }

});