<?php include("include/header.php");
include 'include/db_connection.php';
$conn = OpenCon();
//CloseCon($conn);
?>


<!-- Page preloader-->
    <div class="page">
      <section class="section" style="background-image:URL('images/fly.gif');background-repeat: no-repeat;background-size: contain;background-attachment: fixed;">
      
      <div class="container container-bigger form-request-wrap" id="quote-form">
            <div class="row row-fix justify-content-sm-center justify-content-lg-end">
              <div class="col-lg-12 col-xxl-6">
                <div class="form-request form-request-modern  novi-background" style="background-color:#4f7dd545;">

                  

                  <?php

                    $postData = $valErr = $message = ''; 
                    $status = 'error'; 
 

                    if(isset($_POST['submit_frm'])){  
                        $postData = $_POST;  

                      
                        $type = $_POST["radio"];
                        $departure_airport = $_POST["departure_airport"];
                        $departure_date = $_POST["departure_date"];
                        $arrival_airport = $_POST["arrival_airport"];
                        $arrival_date = $_POST["arrival_date"];
                        $fname = $_POST["fname"];
                        $lname = $_POST["lname"];
                        $email = $_POST["email"];
                        $phone = $_POST["phone"];
                        echo $phone;
                        $pax = $_POST["pax"];
                        $flexibility = $_POST["flexibility"];
                        $note = $_POST["note"];
                        //todays date
                        $date = date("Y-m-d");


                        if(!empty($$departure_date)){
                          if($date > $departure_date){
                            $valErr .= "Departure date must be greater than today's date <br>";
                          }
                        }
                        if(empty($arrival_date)){}
                        else{
                          if($departure_date > $arrival_date){
                            $valErr .= "Arrival date must be greater than departure date <br>";
                          }
                          if($date > $arrival_date){
                            $valErr .= "Arrival date must be greater than today's date <br>";
                          }
                        }


                        if (empty($fname)){
                          $valErr .= "First Name is required <br>";
                        }
                        if (empty($lname)){
                          $valErr .= "Last Name is required <br>";
                        }
                        if (empty($email)){
                          $valErr .= "Please enter an email address <br>";
                        }
                        if (empty($phone)){
                          $valErr .= "Phone Number is required <br>";
                        }


                        if(empty($valErr)){

                          $to = "minhaj@stealthai.net, moon.cse4.bu@gmail.com, jason@firstclassflightforless.com";
                                  $subject = "New Lead from FCFL";
        
                                  $mail = "
                                  <html>
                                  <head>
                                  <title>HTML email</title>
                                  </head>
                                  <body>
                                  <p>A new lead has arrived!</p>
                                  <table>
                                  <tr>
                                  <td>First Name</td>
                                  <td>$fname</td>
                                  </tr>
                                  <tr>
                                  <td>Last Name</td>
                                  <td>$lname</td>
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
                                  <td>Flexibility </td>
                                  <td>$flexibility</td>
                                  </tr>
                                  <tr>
                                  <td>PAX </td>
                                  <td>$pax</td>
                                  </tr>
                                  <tr>
                                  <td>Note </td>
                                  <td>$note</td>
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



                                //Check if the email already exists
                                $sql = "SELECT c.cid, c.first_name, c.last_name, c.phone, c.email, c.lfc_id, l.first_name as lfc_fname
                                FROM clients as c
                                JOIN lfc as l ON c.lfc_id = l.lfc_id
                                WHERE c.email = '$email'";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                  // Client already exists
                                  //Get the client id
                                  $row = mysqli_fetch_assoc($result);
                                  $cid = $row["cid"];
                                  $lfc_name = $row["lfc_fname"];
                                  $lfc_id = $row["lfc_id"];

                                  $postData = '';      

                                  //Insert into quote_request table
                                  $sql = "INSERT INTO quote_request (id, cid, type, departure_airport, departure_date, arrival_airport, arrival_date, pax, flexibility, note, status)
                                  VALUES (NULL, '$cid', '$type', '$departure_airport', '$departure_date', '$arrival_airport', '$arrival_date', '$pax', '$flexibility', '$note', '0')";
                                  if (mysqli_query($conn, $sql)) {
                                    $message .= "Welcome back, $fname! $lfc_name will contact you soon <br>"; 
                                  } else {
                                    $message .= "Error: " . $sql . "<br>" . mysqli_error($conn);
                                  }
                                } else {
                                  // Client does not exist
                                  //Insert into clients table
                                  $sql = "INSERT INTO clients (cid, first_name, last_name, phone, email, lfc_id)
                                  VALUES (NULL, '$fname', '$lname', '$phone', '$email', '1')";
                                  if (mysqli_query($conn, $sql)) {
                                    $cid = mysqli_insert_id($conn);
                                    //Insert into quote_request table
                                    $sql = "INSERT INTO quote_request (id, cid, type, departure_airport, departure_date, arrival_airport, arrival_date, pax, flexibility, note, status)
                                    VALUES (NULL, '$cid', '$type', '$departure_airport', '$departure_date', '$arrival_airport', '$arrival_date', '$pax', '$flexibility', '$note', '0')";
                                    if (mysqli_query($conn, $sql)) {
                                      $message .= "Thanks, $fname! One of or LFC will contact you soon <br>"; 
                                    } else {
                                      $message .= "Error: " . $sql . "<br>" . mysqli_error($conn);
                                    }
                                  } else {
                                    $message .= "Error: " . $sql . "<br>" . mysqli_error($conn);
                                  }
                                }                            

                        } else{
                          $message = $valErr;
                        }


                        CloseCon($conn);
                      }



                        
                        ?>


                  <form style="margin-top: 0%; z-index:3;"  action="" method="post" id="quoteForm" name="quoteForm" >
                    <div class="row row-20 row-fix">
                      <?php if($valErr != ''){ ?>
                          <div class="alert alert-danger" role="alert">
                            <?php echo $valErr; ?>
                          </div>
                      <?php } ?>
                      <?php if($message != ''){ ?>
                          <div class="alert alert-warning" role="alert">
                            <?php echo $message; ?>
                          </div>
                      <?php } ?>
                    <div class="col-sm-12" >
                        <label class="form-label-outside">Trip Type</label>
                        <div class="form-wrap form-wrap-validation" style="margin-left:10%">
                            
                            <label ><input  id="radio1" name="radio" type="radio" value="0" checked>&nbsp &nbsp One Way &nbsp&nbsp</label>
                            
                            <label  ><input  id="radio1" name="radio" type="radio" value="1">&nbsp &nbspRound Trip</label>

                      </div>

                      <div class="row">
                        <div class="col-sm">
                            <div class="form-wrap form-wrap-validation">
                            <input type="text" id="dept_air" name="departure_airport" class="autocomplete form-control" placeholder="City name or airport code" />

                            </div>
                        </div>
                        <div class="col-sm">
                          <div class="form-wrap form-wrap-validation">
                            <input
                              placeholder="Departure Date"
                              name="departure_date"
                              class="form-control"
                              type="text"
                              min="<?php echo date("Y-m-d"); ?>"
                              onfocus="(this.type='date')"
                              id="departure_date" />
                          </div>
                        </div>
                      </div>
                      
                      <div class="row">
                        <div class="col-sm">
                            <div class="form-wrap form-wrap-validation">
                            <input type="text" id="arrv_air" name="arrival_airport" class="autocomplete form-control" placeholder="Arrival City or Code" />

                            </div>
                        </div>
                        <div class="col-sm">
                          <div class="form-wrap form-wrap-validation">
                            <input
                              placeholder="Arrival Date (Optional)"
                              name="arrival_date"
                              class="form-control"
                              type="text"
                              min="<?php echo date("Y-m-d"); ?>"
                              onfocus="(this.type='date')"
                              id="arrival_date" />
                          </div>
                        </div>
                      </div>


                      <div class="row">
                        
                        <div class="col-sm-6">
                        <label class="form-label-outside">Adults</label>
                        <div class="form-wrap form-wrap-modern">
                          <input class="form-control input-append" id="form-element-stepper" type="number" min="0" max="9" value="1" name="pax">

                        </div>
                        </div>
                        <div class="col-sm-6">
                        <label class="form-label-outside">Flexibility</label>
                        <div class="form-wrap form-wrap-modern">
                          <select class="form-control" name="flexibility">
                            <option value="0">Exact Dates</option>
                            <option value="1">+/- 1 Day</option>
                            <option value="2">+/- 2 Days</option>
                            <option value="3">+/- 3 Days</option>
                            <option value="4">+/- Week</option>
                          </select>
                        </div>
                        </div>
                      </div>

                      

                      
                      <div class="col-lg-12">
                        <br>
                        <h4>OR Simply</h4>
                        <p>Type Your Flight Request Here</p>
                        <br>
                        <div class="form-wrap form-wrap-modern">
                          <textarea  class="form-control input-append" rows="3" cols="25" name="note" placeholder="Example: NYC-London me & my wife next weekend for 2 weeks most direct possible"></textarea>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                        <div class="col-sm">
                            <div class="form-wrap form-wrap-validation">
                              <input class="form-control" name="fname" type="text" placeholder="First Name" required>

                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="form-wrap form-wrap-validation">
                              <input class="form-control" name="lname" type="text" placeholder="Last Name" required>

                            </div>
                        </div>
                      </div>
                      <div class="row">

                        <div class="col-sm">
                            <div class="form-wrap form-wrap-validation">
                              <input id="phone" class="form-control" name="phone" type="tel" required>

                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="form-wrap form-wrap-validation">
                              <input class="form-control"  name="email" type="email" placeholder="example@example.com" required>

                            </div>
                        </div>

                        <input type="hidden" name="submit_frm" value="1">


                        <div class="form-wrap form-button">
                  <button class="button button-block button-secondary g-recaptcha" 
    data-sitekey="6Lc_WEQmAAAAABeRxx76nGkFra6n1xsGQaOq12BZ  " 
    data-callback='onSubmit' 
    data-action='submit'>Submit</button>
                    </div>
                        
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
                        <p class="text-spacing-sm">Our team is ready to provide you with unique weekly travel insights that include photos, videos, and articles about untravelled tourist paths. We know everything about the places you've never been to!</p><a class="button button-default-outline button-nina button-sm" href="#">learn more</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div> 
              -->
            </div>
        </div>
      </section>

      <section class="section section-variant-1 bg-default novi-background bg-cover"> 
        <div class="container container-wide">
          <div class="row row-fix justify-content-xl-end row-30 text-center text-xl-left">
            <div class="col-xl-8">
              <div class="parallax-text-wrap">
                <h3>Our Best Deals</h3><span class="parallax-text">Hot tours</span>
              </div>
              <hr class="divider divider-decorate">
            </div>
           <!-- <div class="col-xl-3 text-xl-right"><a class="button button-secondary button-nina" href="#">view all tours</a></div> -->
          </div>
          <div class="row row-50">
            <div class="col-md-6 col-xl-4">
              <article class="event-default-wrap">
                <div class="event-default">
                  <figure class="event-default-image"><img src="images/tour/dubai.jpg" alt="" width="570" height="370"/>
                  </figure>
                  <div class="event-default-caption"><a class="button button-xs button-secondary button-nina" href="#tour_form" onClick="settour('Amsterdam', 'Dubai');">get a quote</a></div>
                </div>
                <div class="event-default-inner">
                  <h5><a class="event-default-title" href="#">Amsterdam to Dubai</a></h5><span class="heading-5">from $1785</span>
                </div>
              </article>
            </div>
            <div class="col-md-6 col-xl-4">
              <article class="event-default-wrap">
                <div class="event-default">
                  <figure class="event-default-image"><img src="images/tour/london.jpg" alt="" width="570" height="370"/>
                  </figure>
                  <div class="event-default-caption"><a class="button button-xs button-secondary button-nina" href="#tour_form" onClick="settour('Hongkong', 'London');">get a quote</a></div>
                </div>
                <div class="event-default-inner">
                  <h5><a class="event-default-title" href="#">Hong Kong to London</a></h5><span class="heading-5">from $2290</span>
                </div>
              </article>
            </div>
            <div class="col-md-6 col-xl-4">
              <article class="event-default-wrap">
                <div class="event-default">
                  <figure class="event-default-image"><img src="images/tour/sydney.jpg" alt="" width="570" height="370"/>
                  </figure>
                  <div class="event-default-caption"><a class="button button-xs button-secondary button-nina" href="#tour_form" onClick="settour('Bangkok', 'Sydney');">get a quote</a></div>
                </div>
                <div class="event-default-inner">
                  <h5><a class="event-default-title" href="#" >Bangkok to Sydney</a></h5><span class="heading-5">from $1198</span>
                </div>
              </article>
            </div>
            <div class="col-md-6 col-xl-4">
              <article class="event-default-wrap">
                <div class="event-default">
                  <figure class="event-default-image"><img src="images/tour/bangkok.jpg" alt="" width="570" height="370"/>
                  </figure>
                  <div class="event-default-caption"><a class="button button-xs button-secondary button-nina" href="#tour_form" onClick="settour('Parish', 'Bangkok');">get a quote</a></div>
                </div>
                <div class="event-default-inner">
                  <h5><a class="event-default-title" href="#" onClick="settour('Parish', 'Bangkok');">Parish to Bangkok</a></h5><span class="heading-5">from $1450</span>
                </div>
              </article>
            </div>
            <div class="col-md-6 col-xl-4">
              <article class="event-default-wrap">
                <div class="event-default">
                  <figure class="event-default-image"><img src="images/tour/los-angeles.jpg" alt="" width="570" height="370"/>
                  </figure>
                  <div class="event-default-caption"><a class="button button-xs button-secondary button-nina" href="#tour_form" onClick="settour('London', 'Los Angeles');">get a quote</a></div>
                </div>
                <div class="event-default-inner">
                  <h5><a class="event-default-title" href="#">London to Los Angeles</a></h5><span class="heading-5">from $2290</span>
                </div>
              </article>
            </div>
            <div class="col-md-6 col-xl-4">
              <article class="event-default-wrap">
                <div class="event-default">
                  <figure class="event-default-image"><img src="images/tour/new-york.jpg" alt="" width="570" height="370"/>
                  </figure>
                  <div class="event-default-caption"><a class="button button-xs button-secondary button-nina" href="#tour_form" onClick="settour('Dubai', 'New York');">get a quote</a></div>
                </div>
                <div class="event-default-inner">
                  <h5><a class="event-default-title" href="#">Dubai to New York</a></h5><span class="heading-5">from $2490</span>
                </div>
              </article>
            </div>
          </div>
        </div>
      </section>

      <!-- our advantages-->
      <!--
      <section class="section section-lg bg-gray-lighter novi-background bg-cover text-center">
        <div class="container container-wide">
          <h3>our services</h3>
          <div class="divider divider-decorate"></div>
          <div class="row row-50 justify-content-sm-center text-left">
            <div class="col-sm-10 col-md-6 col-xl-3">
              <article class="box-minimal box-minimal-border">
                <div class="box-minimal-icon novi-icon mdi mdi-airplane"></div>
                <p class="big box-minimal-title">Air Tickets</p>
                <hr>
                <div class="box-minimal-text text-spacing-sm">At our travel agency, you can book air tickets to any world destination. We also provide online ticket booking via our website in just a couple of steps.</div>
              </article>
            </div>
            <div class="col-sm-10 col-md-6 col-xl-3">
              <article class="box-minimal box-minimal-border">
                <div class="box-minimal-icon novi-icon mdi mdi-map"></div>
                <p class="big box-minimal-title">Voyages & Cruises</p>
                <hr>
                <div class="box-minimal-text text-spacing-sm">Besides regular tours and excursions, we also offer a variety of cruises & sea voyages for different customers looking for awesome experiences.</div>
              </article>
            </div>
            <div class="col-sm-10 col-md-6 col-xl-3">
              <article class="box-minimal box-minimal-border">
                <div class="box-minimal-icon novi-icon mdi mdi-city"></div>
                <p class="big box-minimal-title">Hotel Bookings</p>
                <hr>
                <div class="box-minimal-text text-spacing-sm">We offer a wide selection of hotel ranging from 5-star ones to small properties located worldwide so that you could book a hotel you like.</div>
              </article>
            </div>
            <div class="col-sm-10 col-md-6 col-xl-3">
              <article class="box-minimal box-minimal-border">
                <div class="box-minimal-icon novi-icon mdi mdi-beach"></div>
                <p class="big box-minimal-title">Tailored Summer Tours</p>
                <hr>
                <div class="box-minimal-text text-spacing-sm">Our agency provides varied tours including tailored summer tours for clients who are searching for an exclusive and memorable vacation.</div>
              </article>
            </div>
          </div>
        </div>
      </section>
-->
      <!-- Tips & tricks-->
<!--
      <section class="section section-lg novi-background bg-cover bg-default text-center">
        <div class="container-wide">
          <div class="row row-50">
            <div class="col-sm-12">
              <h3>Latest News</h3>
              <div class="divider divider-decorate"></div>
              <div class="owl-carousel owl-carousel-team owl-carousel-inset" data-items="1" data-md-items="2" data-xl-items="3" data-stage-padding="15" data-loop="true" data-margin="30" data-mouse-drag="false" data-dots="true" data-autoplay="true">
                <article class="post-blog"><a class="post-blog-image" href="#"><img src="images/landing-private-airlines-7-570x415.jpg" alt="" width="570" height="415"/></a>
                  <div class="post-blog-caption">
                    <div class="post-blog-caption-header">
                      <ul class="post-blog-tags">
                        <li><a class="button-tags" href="#">Hotels</a></li>
                      </ul>
                      <ul class="post-blog-meta">
                        <li><span>by</span>&nbsp;<a href="#">Ronald Chen</a></li>
                      </ul>
                    </div>
                    <div class="post-blog-caption-body">
                      <h5><a class="post-blog-title" href="#">Top 10 Hotels to Stay At: Exclusive Rating by Sealine Travel Experts</a></h5>
                    </div>
                    <div class="post-blog-caption-footer">
                      <time datetime="2019">Feb 27, 2019 at 6:53 pm</time><a class="post-comment" href="#"><span class="icon novi-icon icon-md-middle icon-gray-1 mdi mdi-comment"></span><span>12</span></a>
                    </div>
                  </div>
                </article>
                <article class="post-blog"><a class="post-blog-image" href="#"><img src="images/landing-private-airlines-8-570x415.jpg" alt="" width="570" height="415"/></a>
                  <div class="post-blog-caption">
                    <div class="post-blog-caption-header">
                      <ul class="post-blog-tags">
                        <li><a class="button-tags" href="#">Tips</a></li>
                      </ul>
                      <ul class="post-blog-meta">
                        <li><span>by</span>&nbsp;<a href="#">Ronald Chen</a></li>
                      </ul>
                    </div>
                    <div class="post-blog-caption-body">
                      <h5><a class="post-blog-title" href="#">How to Plan Your Vacation in Advance and Why It's Beneficial</a></h5>
                    </div>
                    <div class="post-blog-caption-footer">
                      <time datetime="2019">Feb 27, 2019 at 6:53 pm</time><a class="post-comment" href="#"><span class="icon novi-icon icon-md-middle icon-gray-1 mdi mdi-comment"></span><span>12</span></a>
                    </div>
                  </div>
                </article>
                <article class="post-blog"><a class="post-blog-image" href="#"><img src="images/landing-private-airlines-9-570x415.jpg" alt="" width="570" height="415"/></a>
                  <div class="post-blog-caption">
                    <div class="post-blog-caption-header">
                      <ul class="post-blog-tags">
                        <li><a class="button-tags" href="#">Traveling</a></li>
                      </ul>
                      <ul class="post-blog-meta">
                        <li><span>by</span>&nbsp;<a href="#">Ronald Chen</a></li>
                      </ul>
                    </div>
                    <div class="post-blog-caption-body">
                      <h5><a class="post-blog-title" href="#">Your Personal Guide to 5 Best Places to Visit on Earth</a></h5>
                    </div>
                    <div class="post-blog-caption-footer">
                      <time datetime="2019">Feb 27, 2019 at 6:53 pm</time><a class="post-comment" href="#"><span class="icon novi-icon icon-md-middle icon-gray-1 mdi mdi-comment"></span><span>12</span></a>
                    </div>
                  </div>
                </article>
              </div>
            </div>
            <div class="col-12"><a class="button button-secondary button-nina button-offset-lg" href="#">view all blog posts</a></div>
          </div>
        </div>
      </section>
-->

      <section class="section section-lg text-center bg-gray-lighter novi-background bg-cover">
        <div class="container container-bigger">
          <h3>testimonials</h3>
          <div class="divider divider-decorate"></div>
          <div class="owl-carousel owl-layout-1" data-items="1" data-dots="true" data-nav="true" data-stage-padding="0" data-loop="true" data-margin="30" data-mouse-drag="false" data-autoplay="true">
            <article class="quote-boxed">
              <div class="quote-boxed-aside"><img class="quote-boxed-image" src="images/client/Ann-McMillan.jpg" alt="" width="210" height="210"/>
              </div>
              <div class="quote-boxed-main">
                <div class="quote-boxed-text">
                  <p> Wow. What a service. Last minute flight, to UK, in FIRST! I'll be back to book more tickets. Big thank you to FCFL team, made everything so seamless and worked quickly to get the ticket booked (it was booked literally 5-6 hours before departure!). </p>
                </div>
                <div class="quote-boxed-meta">
                  <p class="quote-boxed-cite">Ann McMillan</p>
                  <p class="quote-boxed-small">Regular Customer</p>
                </div>
              </div>
            </article>
            <article class="quote-boxed">
              <div class="quote-boxed-aside"><img class="quote-boxed-image" src="images/client/Debra-Ortega.jpg" alt="" width="210" height="210"/>
              </div>
              <div class="quote-boxed-main">
                <div class="quote-boxed-text">
                  <p> I used FCFL to fly to Bangkok from NYC.  I secured a biz class seat on a premiere Airline for a very deep discount.  No issues at all.  The LFC I dealth with was extremely professional, responding very quickly to any questions I had.  I will be doing all my business with them in the future </p>
                </div>
                <div class="quote-boxed-meta">
                  <p class="quote-boxed-cite">Debra Ortega</p>
                  <p class="quote-boxed-small">Regular Customer</p>
                </div>
              </div>
            </article>
            <article class="quote-boxed">
              <div class="quote-boxed-aside"><img class="quote-boxed-image" src="images/client/Jason-Drago.jpg" alt="" width="210" height="210"/>
              </div>
              <div class="quote-boxed-main">
                <div class="quote-boxed-text">
                  <p> We have just returned to Australia from a 3 week trip to Ireland for a family wedding. Usually the flight is a nightmare except this time we decided to give the FCFL a go. I have to say from the minute we arrived at the airport it was amazing. We bypassed all the queues and had access to the business and first class lounges in each airport. The flights were perfectly on time with absolutely no problems on either side checking in. All I can say is I will definitely be booking with FCFL again. Business class all the way from now on. </p>
                </div>
                <div class="quote-boxed-meta">
                  <p class="quote-boxed-cite">Jason Drago</p>
                  <p class="quote-boxed-small">Regular Customer</p>
                </div>
              </div>
            </article>
          </div>
        </div>
      </section>

      <section class="section section-md text-center text-md-left bg-gray-700 novi-background bg-cover" >
        <div class="container container-wide">
          <div class="row row-fix row-70 justify-content-md-center">
            <div class="col-xxl-6">
              <div class="box-cta box-cta-inline">
                <div class="box-cta-inner">
                  <h3 class="box-cta-title">The CHEAPEST Business Class Flight</h3>
                  <p>You can get the cheapest business class tour just in a couple of clicks. <br><br></p>
                  
                </div>
                </div>

                <div class="box-cta-inner"></div>
              </div>
            </div>
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

<script>


function settour(dept, arrv){
  var el2 = document.getElementById('dept_air');
  var el3 = document.getElementById('arrv_air');

  el2.value = dept;
  el3.value = arrv;
  return false;
}

</script>
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/intlTelInput.min.js"></script>
<script>

// Vanilla Javascript

var input = document.querySelector("#phone");
  window.intlTelInput(input, {
    utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/utils.js",
  });


function onSubmit(token) {


  var iti = window.intlTelInputGlobals.getInstance(input);
  departure_date = document.getElementById("departure_date").value;
  arrival_date = document.getElementById("arrival_date").value;

  if (iti.isValidNumber() == false) {
      alert("Phone number is not valid");
      event.preventDefault();
      returnToPreviousPage();
  } 

  else if( (new Date(departure_date).getTime() > new Date(arrival_date).getTime()))
  {
    alert("Departure date should be less than Arrival date");
    event.preventDefault();
    returnToPreviousPage();
  }
  else{
    document.getElementById("phone").value = iti.getNumber();
    document.quoteForm.submit();

  }
  // add the country code to the number
  //var text = iti.getSelectedCountryData().dialCode + input.value;

  // set the number with the country code in the input field
 // document.getElementById(  "phone").value = text;

}
  
function number(){
  
  

}


</script>