$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var _token = $("input[name='_token']").val();

    $(document).on('click', '#submitMsProfile', function () {
        var id = $("#ms-profile-product").val();
        if ($("#measurement_profile_name").val())
        {
            var name = $("#measurement_profile_name").val();
            saveMsProfile(id, name);
        }else{
            $('#measurement_profile_name_error').append('Please enter a profile name.');
        }
    });


    function saveMsProfile(id, name) {
        $('#mobile-load-class').html('');
        $.ajax({
            url: "/custom-shirt/measurement/save-profile",
            type: 'POST',
            data: { _token: _token, id: id, name:name },
            dataType: 'json',
            success: function (response) {
                closeProfile(name);
            }
        });
    }

    function closeProfile(name)
    {
        $('#saveMsModal').modal('toggle');
        $('#product-message-save-name-cover').html('');
        $('#product-message-save-name-cover').append('<p>The measurement profile <span>'+ name +'</span> has been saved. You may use it in the future.</p>');
    }

});