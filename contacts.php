<?php include("include/header.php");
//CloseCon($conn);
$message = "";
?>


<div class="container">

    
<!--Section: Contact v.2-->
<section class="mb-4">

<!--Section heading-->
<h2 class="h1-responsive font-weight-bold text-center my-4">Contact us</h2>
<!--Section description-->
<p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to contact us directly. Our team will come back to you within
    a matter of hours to help you.</p>

    <?php
                    if(isset($_POST['SubmitButton'])){

                      $captcha = $_POST['googlerecaptcha'];

                      $request_url = 'https://www.google.com/recaptcha/api/siteverify';
                      
                      $request_data = [
                          'secret' => '6Lc_WEQmAAAAAEmytEqkIU28ptUDo1gh23IunIPq',
                          'response' => $captcha
                      ];
                      
                      $ch = curl_init();
                      curl_setopt($ch, CURLOPT_URL, $request_url);
                      curl_setopt($ch, CURLOPT_POST, 1);
                      curl_setopt($ch, CURLOPT_POSTFIELDS, $request_data);
                      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                      
                      $response_body = curl_exec($ch);
                      
                      curl_close ($ch);
                      
                      $response_data = json_decode($response_body, true);
                      
                      if ($response_data['success'] == false) {
                          // return back with error that captcha is invalid
                          $message = "Please verify that you are not a robot!".  $_POST["name"];
                      } else {
                        $name = $_POST["name"];
                        $email = $_POST["email"];
                        $subject = $_POST["subject"];
                        $message = $_POST["message"];

                        if($conn === false){
                          die("ERROR: Could not connect. "
                              . mysqli_connect_error());
                        }
                       

                        $sqlquery = "INSERT INTO `contact_form` (`msg_id`, `name`, `email`, `subject`, `message`, `timestamp`) 
                        VALUES (NULL, '$name', '$email', '$subject', '$message', current_timestamp())";
                        

                        if ($conn->query($sqlquery) === TRUE) {
                          $to = "minhaj@stealthai.net, moon.cse4.bu@gmail.com, tanzil@fortmedia.net";
                          $subject = "New contact from FCFL";

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
                          <td>Subject </td>
                          <td>$subject</td>
                          </tr>
                          <tr>
                          <td>Message</td>
                          <td>$message</td>
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
                      }



                        
                        ?>

<div class="row">

    <!--Grid column-->
    <div class="col-md-9 mb-md-0 mb-5">
        <form id="contact-form" name="contact-form" action="" method="POST">

            <!--Grid row-->
            <div class="row">

                <!--Grid column-->
                <div class="col-md-6">
                    <div class="md-form mb-0">
                        <input type="text" id="name" name="name" class="form-control">
                        <label for="name" class="">Your name</label>
                    </div>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-md-6">
                    <div class="md-form mb-0">
                        <input type="text" id="email" name="email" class="form-control">
                        <label for="email" class="">Your email</label>
                    </div>
                </div>
                <!--Grid column-->

            </div>
            <!--Grid row-->

            <!--Grid row-->
            <div class="row">
                <div class="col-md-12">
                    <div class="md-form mb-0">
                        <input type="text" id="subject" name="subject" class="form-control">
                        <label for="subject" class="">Subject</label>
                    </div>
                </div>
            </div>
            <!--Grid row-->

            <!--Grid row-->
            <div class="row">

                <!--Grid column-->
                <div class="col-md-12">

                    <div class="md-form">
                        <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
                        <label for="message">Your message</label>
                    </div>

                </div>
            </div>
            <!--Grid row-->

        </form>

        <div class="text-center text-md-left">
            <button  class="btn btn-outline-warning btn-block" name="SubmitButton" type="submit" onclick="validateForm();">Send Message</button>
        </div>
        <div class="status"></div>
    </div>
    <!--Grid column-->

    <!--Grid column-->
    <div class="col-md-3 text-center">
        <ul class="list-unstyled mb-0">
            <li><i class="fas fa-map-marker-alt fa-2x"></i>
                <p>71-75 Shelton Street, Covent Garden, London WC2H 9JQ, UK</p>
            </li>

            <li><i class="fas fa-phone mt-4 fa-2x"></i>
                <p>+44 748 8818564 </p>
            </li>

            <li><i class="fas fa-envelope mt-4 fa-2x"></i>
                <p>jason@firstclassflightforless.com</p>
            </li>
        </ul>
    </div>
    <!--Grid column-->

</div>

</section>
<!--Section: Contact v.2-->

</div>

<script>
    function validateForm() {
        var name =  document.getElementById('name').value;
        if (name == "") {
            document.querySelector('.status').innerHTML = "Name cannot be empty";
            return false;
        }
        var email =  document.getElementById('email').value;
        if (email == "") {
            document.querySelector('.status').innerHTML = "Email cannot be empty";
            return false;
        } else {
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if(!re.test(email)){
                document.querySelector('.status').innerHTML = "Email format invalid";
                return false;
            }
        }
        var subject =  document.getElementById('subject').value;
        if (subject == "") {
            document.querySelector('.status').innerHTML = "Subject cannot be empty";
            return false;
        }
        var message =  document.getElementById('message').value;
        if (message == "") {
            document.querySelector('.status').innerHTML = "Message cannot be empty";
            return false;
        }
        document.querySelector('.status').innerHTML = "Sending...";

        grecaptcha.ready(function() {
                grecaptcha.execute('6Lc_WEQmAAAAABeRxx76nGkFra6n1xsGQaOq12BZ', {action: 'submit'}).then(function(token) {
                    $('#googlerecaptcha').val(token);
                    console.log(token);
                    $('#contact-form').submit();
                });
            });


        }
</script>

<?php include("include/footer.php");?>
