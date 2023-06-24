<?php 
include '../include/db_connection.php'; 
include 'include/lfc-header.php'; 

session_start();

if(!isset($_SESSION["lfc_id"])) {
    header("Location:index.php");
  }

?>


<?php  
          $conn = OpenCon();
          $sql = "SELECT * FROM lfc WHERE lfc_id = '".$_SESSION["lfc_id"]."'";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_array($result);
          CloseCon($conn);
    ?>

<body class="">
  <div class="wrapper">
    <?php
      include 'include/lfc-sidebar.php'; 
      include 'include/lfc-navbar.php'; 
    ?>
  
      <!-- Navbar -->
      
      <!-- End Navbar -->
      <div class="content">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Edit Profile</h5>
              </div>
              <div class="card-body">
                <form action="userupdate.php" method="post">
                  <div class="row">
                    <div class="col-md-5 pr-md-1">
                      <div class="form-group">
                        <label>Company (disabled)</label>
                        <input type="text" class="form-control" disabled="" placeholder="Company" value="First Class Flight for Less">
                      </div>
                    </div>
                    <div class="col-md-3 px-md-1">
                      <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" placeholder="Username" value="<?php echo $row['username'];?>" name="username">
                      </div>
                    </div>
                    <div class="col-md-4 pl-md-1">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" placeholder="Email" value="<?php echo $row['email'];?>" name="email">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-md-1">
                      <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" placeholder="First Name" value="<?php echo $row['first_name'];?>" name="firstname">
                      </div>
                    </div>
                    <div class="col-md-6 pl-md-1">
                      <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" placeholder="Last Name" value="<?php echo $row['last_name'];?>" name="lastname">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" placeholder="Home Address" value="<?php echo $row['address'];?>" name="address">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 pr-md-1">
                      <div class="form-group">
                        <label>City</label>
                        <input type="text" class="form-control" placeholder="City" value="<?php echo $row['city'];?>" name="city">
                      </div>
                    </div>
                    <div class="col-md-4 px-md-1">
                      <div class="form-group">
                        <label>Country</label>
                        <input type="text" class="form-control" placeholder="Country" value="<?php echo $row['country'];?>" name="country">
                      </div>
                    </div>
                    <div class="col-md-4 pl-md-1">
                      <div class="form-group">
                        <label>Postal Code</label>
                        <input type="text" class="form-control" placeholder="Postal Code" value="<?php echo $row['postal_code'];?>" name="postal_code">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-8">
                      <div class="form-group">
                        <label>About Me</label>
                        <textarea rows="4" cols="80" class="form-control" placeholder="Here can be your description" name="about_me"><?php echo $row['about_me'];?></textarea>
                      </div>
                    </div>
                  </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-fill btn-primary">Save</button>
              </div>
              </form>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-user">
              <div class="card-body">
                <p class="card-text">
                  <div class="author">
                    <div class="block block-one"></div>
                    <div class="block block-two"></div>
                    <div class="block block-three"></div>
                    <div class="block block-four"></div>
                    <a href="javascript:void(0)">
                      <img class="avatar" src="assets/img/emilyz.jpg" alt="...">
                      <h5 class="title"><?php echo $_SESSION['lfc_name'];?></h5>
                    </a>
                    <p class="description">
                      Luxary Flight Consultant
                    </p>
                  </div>
                </p>
                <div class="card-description">
                  Do not be scared of the truth because we need to restart the human foundation in truth And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is...
                </div>
              </div>
              <div class="card-footer">
                <div class="button-container">
                  <button href="javascript:void(0)" class="btn btn-icon btn-round btn-facebook">
                    <i class="fab fa-facebook"></i>
                  </button>
                  <button href="javascript:void(0)" class="btn btn-icon btn-round btn-twitter">
                    <i class="fab fa-twitter"></i>
                  </button>
                  <button href="javascript:void(0)" class="btn btn-icon btn-round btn-google">
                    <i class="fab fa-google-plus"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php
        include 'include/lfc-footer.php'; 
     ?>