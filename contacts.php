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

<div class="row">

    <!--Grid column-->
    <div class="col-md-9 mb-md-0 mb-5">
        <form id="contact-form" name="contact-form" action="mail.php" method="POST">

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
            <a class="btn btn-block btn-primary" onclick="validateForm();">Send</a>

        </div>
        <div class="status"></div>
    </div>
    <!--Grid column-->

    <!--Grid column-->
    <div class="col-md-3 text-center">
        <ul class="list-unstyled mb-0">
            <li><i class="fas fa-map-marker-alt fa-2x"></i>
                <p>San Francisco, CA 94126, USA</p>
            </li>

            <li><i class="fas fa-phone mt-4 fa-2x"></i>
                <p>+ 01 234 567 89</p>
            </li>

            <li><i class="fas fa-envelope mt-4 fa-2x"></i>
                <p>contact@mdbootstrap.com</p>
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
        }
</script>

<script>

document.getElementById('status').innerHTML = "Sending...";
formData = {
  'name': $('input[name=name]').val(),
  'email': $('input[name=email]').val(),
  'subject': $('input[name=subject]').val(),
  'message': $('textarea[name=message]').val()
};


$.ajax({
  url: "mail.php",
  type: "POST",
  data: formData,
  success: function (data, textStatus, jqXHR) {

    $('#status').text(data.message);
    if (data.code) //If mail was sent successfully, reset the form.
      $('#contact-form').closest('form').find("input[type=text], textarea").val("");
  },
  error: function (jqXHR, textStatus, errorThrown) {
    $('#status').text(jqXHR);
  }
});

</script>
<?php include("include/footer.php");?>
