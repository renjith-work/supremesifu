$(document).ready(function() {
    $.ajaxSetup({
    	headers: {
        	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }});

    // $('.input').keypress(function (e) {
    //   if (e.which == 13) {
    //     $('form#login').submit();
    //     return false;    //<---- Add this line
    //   }
    // });
    document.addEventListener('keydown', function(event) {
        if (event.keyCode == 13) {// enter
            $('form#login').submit();
            return false;    //<---- Add this line
        }
    });

    $('#modal-login-btn').click(function(event) {
    	event.preventDefault();
    	var _token = $("input[name='_token']").val();
    	var email = $('#modal-email').val();
    	var password = $('#modal-password').val();
    	var object = {};
    	object["_token"] = _token;
    	object["email"] = email;
    	object["password"] = 'passmenow';
    	console.log(object);
    	$.ajax({
            url: "/api/login",
            type:'POST',
            data: object,
            success:function(response){
                console.log(response);
            }
        });
    });

});