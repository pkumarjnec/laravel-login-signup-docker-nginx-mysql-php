var access_token='';
$( document ).ready(function() {
    profile();
    $('#signup-btn').on('click', function(){
        updateProfile();
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
function profile(){
    //validate mandatory form fields
    var response = $.ajax({
        headers: {
            'Authorization': 'Bearer '+access_token
        },
        type	 : "GET",
        url	     : "/api/profile",
        success: function(response){
            $('#name').val(response.account.name);
            $('#emailid').val(response.account.emailid);
            $('#mobile_no').val(response.account.mobile_no);
            $('#document_name').attr('href',response.account.document);
        },
        error: function (response, exception) {
            $('#search-btn').html('Search');
            $.each(response.responseJSON.errors, function( index, value ) {
                showMessage(value,'invalid');
            });
        }
    });
}
/*
 * Register using input information
 */
function updateProfile(){
    //validate mandatory form fields
    var fieldsValidations = validateFields('frmSignup');
    if(fieldsValidations == true){
        return false;
    }
    var fd          = new FormData();
    var file_data   = $('input[type="file"]');
    $('input[type="file"]').each(function( index ) {
        if($(this)[0].files[0] != undefined) {
            fd.append($(this).attr('name'), $(this)[0].files[0]);
        }
    });
    var other_data = $('form').serializeArray();
    $.each(other_data,function(key,input){
        fd.append(input.name,input.value);
    });
    $('#signup-btn').html('Requesting <span class="mr-2"><i class="fas fa-spinner fa-spin"></i></span>');
    var response1 = $.ajax({
        headers: {
            'Authorization': 'Bearer '+access_token
        },
        type: "POST",
        url: "/api/profile",
        dataType: "json",
        data: fd,
        processData: false,
        contentType: false,
        statusCode: {
            413:function (response) {
                $('#signup-btn').html('Update');
                showMessage('Invalid request','invalid');
            },
        },
        error: function(){
            $('#signup-btn').html('Update');
            showMessage('Invalid request','invalid');
        },
        timeout: 300000,
        success: function(response){
            $('#signup-btn').html('Sign up');
            if(response.status == 'success'){
                showMessage(response.message,'valid');
            }else {
                showMessage(response.message,'invalid');
            }
        }
    });
}