<?php include("include/header.php");
include 'include/db_connection.php';
$conn = OpenCon();
//CloseCon($conn);
$message = "";
?>


    <!-- Breadcrumbs-->
        <section class="breadcrumbs-custom" style="background: url('images/how-it-works.jpg'); background-size: cover;">
          <div class="container">
            <p class="breadcrumbs-custom-subtitle" style="color:wheat;">Get your discounted flight</p>
            <h1 class="heading-1 breadcrumbs-custom-title">How It Works</h1>
            <ul class="breadcrumbs-custom-path">
              <li><a href="index.html">Home</a></li>
              <li class="active">Typography</li>
            </ul>
          </div>
        </section>

    <!-- Image Left-->
    <section class="section section-lg bg-default">
        <div class="container">
          <div class="row row-fix d-flex justify-content-center">
            <div class="col-lg-10 col-xl-8 center-block">
                    
              <div class="row row-30">
                <div class="col-md-5 center-block"><img src="images/tour plan.gif" alt="" width="770" height="480"/>
                </div>
                <div class="col-md-5 center-block">
                    <div class="box-minimal-header">
                      <div class="box-minimal-icon fl-bigmug-line-ink12"></div>
                      <h6 class="box-minimal-title">Send Your Travel Plans</h6>
                    </div>
                  <p>Submit your trip details and one of our Flight Consultant will be in touch as soon as possible. They will discuss your preferences and our in-house flight search team will start finding options. If you would like immediate service, please call us. We are available 24/7.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Image Right-->
      <section class="section section-lg bg-default">
        <div class="container">
          <div class="row d-flex justify-content-center">
            <div class="col-lg-10 col-xl-8 ">
                <div class="box-minimal-header">
                      <div class="box-minimal-icon fl-bigmug-line-gear30"></div>
                      <h6 class="box-minimal-title">We will search for options</h6>
                </div>
              <div class="row row-30 flex-md-row-reverse">
                <div class="col-md-6"><img src="images/search1.gif" alt="" width="200" height=""/>
                </div>
                <div class="col-md-6">
                  <p>Our EXPERT flight searching team will search for the lowest possible fare that matches your preferences like non-stop, new dreamliner etc. You can set preferences as you wish in the note section of the form.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      
      <!-- Image Left-->
    <section class="section section-lg bg-default">
        <div class="container">
          <div class="row row-fix d-flex justify-content-center">
            <div class="col-lg-10 col-xl-8">
                
              <div class="row row-30">
                <div class="col-md-6"><img src="images/fly.gif" alt="" width="770" height="480"/>
                </div>
                <div class="col-md-6">
                <div class="box-minimal-header">
                      <div class="box-minimal-icon fl-bigmug-line-airplane86"></div>
                      <h6 class="box-minimal-title">Relax and Enjoy the flight</h6>
                </div>
                  <p>No need to worry, we’ll act as your personal travel concierge for your entire trip, with staff available 24/7 in case of issue.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="section" style="background-image:URL('images/flight2.gif');background-repeat: no-repeat;background-size: contain;background-attachment: fixed;">
      
      <div class="container container-bigger form-request-wrap" id="quote-form">
            <div class="row row-fix justify-content-sm-center justify-content-lg-end">
              <div class="col-lg-12 col-xxl-5">
                <div class="form-request form-request-modern bg-gray-lighter novi-background">
                  <h4>Find your Tour</h4>
                  <!-- RD Mailform-->
                  

                  <?php
                    if(isset($_POST['SubmitButton'])){
                        $type = $_POST["radio"];
                        $departure_airport = $_POST["departure_airport"];
                        $departure_date = $_POST["departure_date"];
                        $arrival_airport = $_POST["arrival_airport"];
                        $arrival_date = $_POST["arrival_date"];
                        $name = $_POST["name"];
                        $email = $_POST["email"];
                        $phone = $_POST["phone"];
                        $pax = $_POST["pax"];
                        $note = $_POST["note"];

                        if($conn === false){
                          die("ERROR: Could not connect. "
                              . mysqli_connect_error());
                        }
                       

                        $sqlquery = "INSERT INTO `quote_request` (`id`, `name`, `email`, `phone`, `departure_airport`, `departure_date`, `arrival_airport`, `arrival_date`, `pax`, `type`, `note`, `timestamp`) 
                        VALUES (NULL, '$name', '$email', '$phone', '$departure_airport', '$departure_date', '$arrival_airport', '$arrival_date', '$pax', '$type', '$note', current_timestamp())";
                        

                        if ($conn->query($sqlquery) === TRUE) {
                          $to = "minhaj@stealthai.net, moon.cse4.bu@gmail.com";
                          $subject = "Testing Emails";

                          $mail = "
                          <html>
                          <head>
                          <title>HTML email</title>
                          </head>
                          <body>
                          <p>A new lead has arrived!</p>
                          <table>
                          <tr>
                          <td>Name</td>
                          <td>$name</td>
                          </tr>
                          <tr>
                          <td>Email </td>
                          <td>$email</td>
                          </tr>
                          <tr>
                          <td>Phone </td>
                          <td>$phone</td>
                          </tr>
                          <tr>
                          <td>Departure Airport </td>
                          <td>$departure_airport</td>
                          </tr>
                          <tr>
                          <td>Departure Date </td>
                          <td>$departure_date</td>
                          </tr>
                          <tr>
                          <td>Arrival Airport </td>
                          <td>$arrival_airport</td>
                          </tr>
                          <tr>
                          <td>Arrival Date </td>
                          <td>$arrival_date</td>
                          </tr>
                          <tr>
                          <td>Type </td>
                          <td>$type</td>
                          </tr>
                          <tr>
                          <td>PAX </td>
                          <td>$pax</td>
                          </tr>
                          </table>
                          </body>
                          </html>
                          ";

                          // Always set content-type when sending HTML email
                          $headers = "MIME-Version: 1.0" . "\r\n";
                          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                          // More headers
                          $headers .= 'From: <reception@firstclassflightforless.com>' . "\r\n";
                          $headers .= 'Cc: tanzilrimu@gmail.com ' . "\r\n";

                          mail($to,$subject,$mail,$headers);

                          $message = "Request has been sent! Our team will contact you soon!";
                        } else {
                          echo "ERROR: Hush! Sorry $sqlquery. ". mysqli_error($conn);
                        }

                        

                    }
                    
                    CloseCon($conn);
                        ?>


                  <form style="margin-top: 10%; z-index:3;" class="" action="" method="post" >
                    <div class="row row-20 row-fix">
                    <div class="col-sm-12" >
                        <label class="form-label-outside">Trip Type</label>
                        <div class="form-wrap form-wrap-validation" style="margin-left:10%">
                            
                            <label ><input  id="radio1" name="radio" type="radio" value="0" checked>&nbsp &nbsp One Way &nbsp&nbsp</label>
                            
                            <label  ><input  id="radio1" name="radio" type="radio" value="1">&nbsp &nbspRound Trip</label>

                      </div>

                      <div class="row">
                        <div class="col-sm">
                          <label class="form-label-outside">From</label>
                            <div class="form-wrap form-wrap-validation">
                            <input type="text" id="dept_air" name="departure_airport" class="autocomplete form-control" placeholder="City name or airport code" required/>

                            </div>
                        </div>
                      </div>
                      

                      <div class="col-sm-12 col-lg-6">
                        <label class="form-label-outside">Departure Date</label>
                        <div class="form-wrap form-wrap-validation">
                          <input class="form-input" id="dateForm" name="departure_date" type="text" data-time-picker="date" required>
                          <label class="form-label" for="dateForm">Choose the date</label>

                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm">
                          <label class="form-label-outside">To</label>
                            <div class="form-wrap form-wrap-validation">
                            <input type="text" id="arrv_air" name="arrival_airport" class="autocomplete form-control" placeholder="City name or airport code" required/>

                            </div>
                        </div>
                      </div>

                      <div class="col-sm-12 col-lg-6">
                        <label class="form-label-outside">Arrival Date</label>
                        <div class="form-wrap form-wrap-validation">
                          <input class="form-input" id="dateForm" name="arrival_date" type="text" data-time-picker="date">
                          <label class="form-label" for="dateForm">Choose the date</label>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm">
                          <label class="form-label-outside">Name</label>
                            <div class="form-wrap form-wrap-validation">
                              <input class="form-input" name="name" type="text" required>

                            </div>
                        </div>
                        <div class="col-sm">
                          <label class="form-label-outside">Phone</label>
                            <div class="form-wrap form-wrap-validation">
                              <input class="form-input" name="phone" type="tel" required>

                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm">
                          <label class="form-label-outside">Email</label>
                            <div class="form-wrap form-wrap-validation">
                              <input class="form-input"  name="email" type="email" require>

                            </div>
                        </div>
                        <div class="col-sm">
                        <label class="form-label-outside">Adults</label>
                        <div class="form-wrap form-wrap-modern">
                          <input class="form-input input-append" id="form-element-stepper" type="number" min="0" max="300" value="1" name="pax">
                        </div>
                        </div>
                      </div>

                      <div class="col-lg-12">
                        <label class="form-label-outside">Notes</label>
                        <div class="form-wrap form-wrap-modern">
                          <textarea  class="form-input input-append" rows="1" cols="25" name="note">My Note: </textarea>
                        </div>
                      </div>
                    </div>
                    <div class="form-wrap form-button">
                      <button  class="button button-block button-secondary" name="SubmitButton" type="submit">Get a Quote</button>
                    </div>
                  </form> 
                  <p>        <?php echo $message; ?></p>
                </div>
              </div>
            </div>
          </div>

        
              <!--
              <div class="swiper-slide" data-slide-bg="images/swiper-slide-3.jpg">
                <div class="swiper-slide-caption">
                  <div class="container container-bigger swiper-main-section">
                    <div class="row row-fix justify-content-sm-center justify-content-md-start">
                      <div class="col-md-6 col-lg-5 col-xl-4 col-xxl-5">
                        <h3>unique Travel Insights</h3>
                        <div class="divider divider-decorate"></div>
                        <p class="text-spacing-sm">Our team is ready to provide you with unique weekly travel insights that include photos, videos, and articles about untravelled tourist paths. We know everything about the places you’ve never been to!</p><a class="button button-default-outline button-nina button-sm" href="#">learn more</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div> 
              -->
            </div>
        </div>
      </section>

<?php include("include/footer.php");?>
<script src="js/air-port-codes-api-min.js"></script>
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