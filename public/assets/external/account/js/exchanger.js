var access_token='';
var showFav=true;
function getCountryList(){
    //validate mandatory form fields
    var response = $.ajax({
        headers: {
            'Authorization': 'Bearer '+access_token
        },
        type	 : "GET",
        url	     : "/api/countries",
        success: function(response){
            var html ='';
            $.each(response.countries, function( index, value ) {
                html += '<option value="'+index+'">'+value+'</option>';
            });
            $('#from').html(html);
            $('#to').html(html);
        },
        error: function (response, exception) {
            $('#login-btn').html('Login');
            $.each(response.responseJSON.errors, function( index, value ) {
                showMessage(value,'invalid');
            });
        }
    });
}
function searchRate(){
    //validate mandatory form fields
    $('#search-btn').html('Searching ...');
    var response = $.ajax({
        headers: {
            'Authorization': 'Bearer '+access_token
        },
        type	 : "GET",
        url	     : "/api/rate?from="+$('#from').val()+'&to='+$('#to').val(),
        success: function(response){
            $('#rates').html('Exchange Rate : '+response.rate);
            $('#search-btn').html('Search');
            if (showFav == true) {
                $('#fav').removeClass('d-none')
            } else {
                $('#fav').addClass('d-none')
            }
        },
        error: function (response, exception) {
            $('#search-btn').html('Search');
            $.each(response.responseJSON.errors, function( index, value ) {
                showMessage(value,'invalid');
            });
        }
    });
}

function favorite(){
    //validate mandatory form fields
    var response = $.ajax({
        headers: {
            'Authorization': 'Bearer '+access_token
        },
        type	 : "POST",
        url	     : "/api/favorite",
        data     : "from="+$('#from').val()+'&to='+$('#to').val(),
        dataType: "json",
        success: function(response){
            if(response.status == 'error'){
                showMessage(response.message,'invalid');
            }else {
                myFavorite();
            }
        },
        error: function (response, exception) {
            $('#search-btn').html('Search');
            $.each(response.responseJSON.errors, function( index, value ) {
                showMessage(value,'invalid');
            });
        }
    });
}

function myFavorite(){
    var response = $.ajax({
        headers: {
            'Authorization': 'Bearer '+access_token
        },
        type	 : "GET",
        url	     : "/api/favorite",
        dataType: "json",
        success: function(response){
            if(response.total >= 5){
                showFav = false;
            }
            var html ='';
            $.each(response.rate, function( index, value ) {
                html += '<div class="col-4 form-group"><p>'+value['from']+'</p> </div><div class="col-4 form-group text-center"><p>'+value['to']+'</p></div><div class="col-4 form-group"><p>'+value['rate']+'</p></div>';
            });
            $('#favRate').html(html);

        },
        error: function (response, exception) {
            $('#search-btn').html('Search');
            $.each(response.responseJSON.errors, function( index, value ) {
                showMessage(value,'invalid');
            });
        }
    });
}