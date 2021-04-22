$( document ).ready(function() {
    $('#signup-btn').on('click', function(){
        signup();
    });
    $('#login-btn').on('click', function(){
        login();
    });
    $('form').keydown( function( event ) {
        if ( event.which === 13 ) {
            var formSubmitted = $(this).attr('name');
            if (formSubmitted == 'frmLogin') {
                login();
            } else if (formSubmitted == 'frmSignup') {
                signup();
            }
        }
    });
});
/*
 * Login with username & password
 */
function login(){
    //validate mandatory form fields
    var fieldsValidations = validateFields('frmLogin');
    if(fieldsValidations == true){
        return false;
    }
    $('#login-btn').html('Requesting <span class="mr-2"><i class="fas fa-spinner fa-spin"></i></span>');
    var response = $.ajax({
        type	 : "POST",
        url	     : "/api/login",
        data	 : $('.frmLogin').serialize(),
        success: function(response){
            $('#login-btn').html('Login');
            if(response.status == 'success'){
                showMessage(response.message,'valid');
                $('#login-btn').html('Redirecting <span class="mr-2"><i class="fas fa-spinner fa-spin"></i></span>');
                setTimeout(function(){
                    window.location.href = response.redirectUrl;
                }, 1000);
            }else {
                showMessage(response.message,'invalid');
            }
        },
        error: function (response, exception) {
            $('#login-btn').html('Login');
            $.each(response.responseJSON.errors, function( index, value ) {
                showMessage(value,'invalid');
            });
        }
    });
}
/*
 * Register using input information
 */
function signup(){
    //validate mandatory form fields
    var fieldsValidations = validateFields('frmSignup');
    if(fieldsValidations == true){
        return false;
    }
    var fd          = new FormData();
    var file_data   = $('input[type="file"]');
    $('input[type="file"]').each(function( index ) {
        fd.append($(this).attr('name'),$(this)[0].files[0]);
    });
    var other_data = $('form').serializeArray();
    $.each(other_data,function(key,input){
        fd.append(input.name,input.value);
    });
    $('#signup-btn').html('Requesting <span class="mr-2"><i class="fas fa-spinner fa-spin"></i></span>');
    var response1 = $.ajax({
        type: "POST",
        url: "/api/register",
        dataType: "json",
        data: fd,
        processData: false,
        contentType: false,
        statusCode: {
            413:function (response) {
                $('#signup-btn').html('Sign up');
                showMessage('Invalid request','invalid');
            },
        },
        error: function(){
            $('#signup-btn').html('Sign up');
            showMessage('Invalid request','invalid');
        },
        timeout: 300000,
        success: function(response){
            $('#signup-btn').html('Sign up');
            if(response.status == 'success'){
                showMessage(response.message,'valid');
                $('#signup-btn').html('Redirecting <span class="mr-2"><i class="fas fa-spinner fa-spin"></i></span>');
                setTimeout(function(){
                    window.location.href = response.redirectUrl;
                }, 1000);
            }else {
                showMessage(response.message,'invalid');
            }
        }
    });
}