<?php 
include '../include/db_connection.php'; 
include 'include/admin-header.php'; 

session_start();

if(!isset($_SESSION["aid"])) {
    header("Location:index.php");
  }

?>


<?php  
          $conn = OpenCon();
          $sql = "SELECT * FROM lfc";
          $result = mysqli_query($conn, $sql);
?>  

<body class="">
  <div class="wrapper">
    <?php
      include 'include/admin-sidebar.php'; 
      include 'include/admin-navbar.php'; 
    ?>
  
      <!-- Navbar -->

      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card ">
              <div class="card-header">
                <h4 class="card-title"> LFC Table</h4>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addLFC">
                  Add LFC 
                </button>
                <?php

                if(isset($_SESSION["message"])){
                ?>
                <div class="alert alert-success">
                        <?php
                            echo $_SESSION["message"];
                            unset($_SESSION["message"]);
                        ?>
                                    
                </div>
                <?php
                }
            ?>  

              </div>    
              
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table tablesorter " id="clients_data">
                    <thead class=" text-primary">
                    <tr>
                      <th>LFC ID</th>  
                      <th>First Name</th>
                      <th>Last Name</th>  
                      <th>Email</th>    
                      <th>Phone</th>    
                      <th>Time Added</th>
                      <th>Action</th>  
                    </tr>
                    </thead>
                    <tbody>
                    <?php  
                      while($row = mysqli_fetch_array($result))  
                      {  
                          $phn = $row["phone"];
                          $phn = str_replace(' ', '', $phn);
                          $phn = str_replace('(', '', $phn);
                          $phn = str_replace(')', '', $phn);
                          $phn = str_replace('-', '', $phn);

                          echo'<tr>  
                                  <td>'.$row["lfc_id"].'</td>  
                                  <td>'.$row["first_name"].'</td>  
                                  <td>'.$row["last_name"].'</td>  
                                  <td>'.$row["email"].'</td>  
                                  <td>'.$row["phone"].'</td>  
                                  <td>'.$row["timestamp"].'</td>  
                                  <td> <a href="">Edit</a> | <a href="">Delete</a> </td>  
                              </tr>  
                          ';  
                      }  
                  ?>  
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    <div class="modal fade" id="addLFC" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add LFC</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form" action="lfcform.php" method="post">
                    <input type="hidden" name="type" value="add">

                    <table  class="table">

                        <tr >
                            <td><p style="color: black;">First Name</p></td>
                            <td><input class="form-control" style="color: black;" type="text" id="fname" name="fname" placeholder="First Name"></td>
                        </tr>

                        <tr>
                            <td><p style="color: black;">Last Name</p></td>
                            <td><input class="form-control" style="color: black;" type="text" id="lname" name="lname" placeholder="Last Name"></td>
                        </tr>

                        <tr>
                            <td><p style="color: black;">Email</p></td>
                            <td><input class="form-control" style="color: black;" type="text" id="email" name="email" placeholder="Email"></td>
                        </tr>

                        <tr>
                            <td><p style="color: black;">Phone</p></td>
                            <td><input class="form-control" style="color: black;" type="text" id="phone" name="phone" placeholder="Phone"></td>
                        </tr>
                    </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <input type="submit" class="btn btn-success" value="Save changes">
                </form>
            </div>
            </div>
        </div>
    </div>



      <?php
        include 'include/admin-footer.php'; 
     ?>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.js"></script>
  <script>
    $(document).ready(function(){  
            $('#clients_data').DataTable();  
        }); 
  </script>
<script type="text/javascript">

$(document).ready(function () {
 
window.setTimeout(function() {
    $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
        $(this).remove(); 
    });
}, 2500);
 
});
</script>