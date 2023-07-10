<!DOCTYPE html>
<html class="wide wow-animation" lang="en"> 
  <head>
    <!-- Site Title-->
    <title>Home</title>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Oswald:200,400%7CLato:300,400,300italic,700%7CMontserrat:900">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/fonts.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/css/intlTelInput.css">

	  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <script src="https://www.google.com/recaptcha/api.js"></script>


		<!--[if lt IE 10]>
    <div style="background: #212121; padding: 10px 0; box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3); clear: both; text-align:center; position: relative; z-index:1;"><a href="http://windows.microsoft.com/en-US/internet-explorer/"><img src="images/ie8-panel/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
    <script src="js/html5shiv.min.js"> </script>
		<![endif]--> 
<style>

  </style>
  </head>
  <body>
  <input type="text" id="dept_air" name="arrival_airport" class="autocomplete form-control" placeholder="City name or airport code" />
  </body>
</html>
<script src="../js/core.min.js"></script>
    <script src="../js/script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>
<script src="../js/air-port-codes-api-min.js"></script>
<script>
$(function() {
    $( '.autocomplete' ).each(function () {
        var apca = new apc('autocomplete', {
            key : 'fa3f138fb7', 
            secret : 'a2a3e99d878ac73 ', // Your API Secret Key: use this if you are not connecting from a web server
            limit : 7
        });
 
        var dataObj = {
            source: function( request, response ) {
                // make the request
                apca.request( request.term );
 
                // this builds each line of the autocomplete
                itemObj = function (airport, isChild) {
                    var label;
                    if (isChild) { // format children labels
                        label = '&rdsh;' + airport.iata + ' - ' + airport.name;
                    } else { // format labels
                        label = airport.city;
                        if (airport.state.abbr) {
                            label += ', ' + airport.state.abbr;
                        }
                        label += ', ' + airport.country.name;                            
                        label += ' (' + airport.iata + ' - ' + airport.name + ')';
                    }
                    return {
                        label: label,
                        value: airport.iata + ' - ' + airport.name,
                        code: airport.iata
                    };
                };
 
                // this deals with the successful response data
                apca.onSuccess = function (data) {
                    var listAry = [],
                        thisAirport;
                    if (data.status) { // success
                        for (var i = 0, len = data.airports.length; i < len; i++) {
                            thisAirport = data.airports[i];
                            listAry.push(itemObj(thisAirport));
                            if (thisAirport.children) {
                                for (var j = 0, jLen = thisAirport.children.length; j < jLen; j++) {
                                    listAry.push(itemObj(thisAirport.children[j], true));
                                }
                            }
                        }
                        response(listAry);
                    } else { // no results
                        response();
                    }
                };
                apca.onError = function (data) {
                    response();
                    console.log(data.message);
                };
            },
            select: function( event, ui ) {
                // do something for click event
                console.log(ui.item.code);
            }
        }
 
        // this is necessary to allow html entities to display properly in the jqueryUI labels
        $(this).autocomplete(dataObj).data("ui-autocomplete")._renderItem = function( ul, item) {
            return $('<li style="background: white;color: darkblue; "></li>').data('item.autocomplete', item ).html( item.label ).appendTo( ul );               
        };
    });
});
 
</script>

<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/intlTelInput.min.js"></script>