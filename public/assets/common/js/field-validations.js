iziToast.settings({
    timeout: 6000,
    close: true,
    progressBar: true,
    progressBarEasing: 'ease',
    position:'bottomLeft',
    theme: 'light',
    maxWidth:300,
    animateInside:true
});
//Show Message
function showMessage(message,msgType){
    if(msgType == 'valid'){
        iziToast.show({
            id: 'success',
            message: message,
            transitionIn: 'bounceInLeft',
            color: 'green'
        });
    }else {
        iziToast.show({
            id: 'warning',
            message: message,
            transitionIn: 'bounceInLeft',
            color: 'red'
        });
    }
}
function validateFields(formName){
    var inputs          = $('.'+formName+' input');
    var textarea        = $('.'+formName+' textarea');
    var invalidFields   = false;
    for(var i=0; i<inputs.length; i++) {
        if(validate(inputs[i]) == true){
            invalidFields = true;
        }
    }
    for(var i=0; i<textarea.length; i++) {
        if(validate(textarea[i]) == true){
            invalidFields = true;
        }
    }
    return invalidFields;
}

function validate (input) {
    if($(input).attr('data-skip') != undefined && $(input).attr('data-skip') == 1){
        return false;
    }
    if($(input).hasClass('select2-search__field')){
        return false;
    }
    if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
        if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,7}|[0-9]{1,7})(\]?)$/) == null) {
            showMessage('Email is required','invalid');
            $(input).focus();
            return true;
        }
    } else if($(input).val().trim() == ''){
        if($(input).attr('data-name') != undefined){
            showMessage($(input).attr('data-name')+' is required','invalid');
        }else{
            if($(input).attr('name') != undefined) {
                showMessage(capitalizeFirst($(input).attr('name')) + ' is required', 'invalid');
            }
        }
        $(input).focus();
        return true;
    }
    return false;
}
function capitalizeFirst(str){
    str = str.toLowerCase().replace(/^[\u00C0-\u1FFF\u2C00-\uD7FF\w]|\s[\u00C0-\u1FFF\u2C00-\uD7FF\w]/g, function(letter) {
        return letter.toUpperCase();
    });
    return str;
}