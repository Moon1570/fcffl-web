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
                      <th>Password</th>  
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

                            $lfc_id = $row["lfc_id"];
                            $fname = $row["first_name"];
                            $lname = $row["last_name"];
                            $email = $row["email"];
                            $phone = $row["phone"];
                            $password = $row["pass"];

                          echo'<tr>  
                                  <td>'.$lfc_id.'</td>  
                                  <td>'.$fname.'</td>  
                                  <td>'.$lname.'</td>  
                                  <td>'.$email.'</td>  
                                  <td>'.$phone.'</td>  
                                  <td>'.$password.'</td>
                                  <td>
                                  <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#updateLFC" onclick="updateModal('.$lfc_id.',\''.$fname.'\',\''.$lname.'\',\''.$phone.'\',\''.$email.'\',\''.$password.'\'); return false;"> Edit</button>
                                  <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#deleteLFC" onclick="deleteModal(\''.$lfc_id.'\'); return false;"> Delete</button>
                                  </td>  
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

                        <tr>
                            <td><p style="color: black;">Password</p></td>
                            <td><input class="form-control" style="color: black;" type="password" id="pass" name="pass" placeholder="Password"></td>
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

    <div class="modal fade" id="updateLFC" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update LFC</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form" action="lfcform.php" method="post">
                    <input type="hidden" name="type" value="update">
                    <input type="hidden" name="lfc_id" id="lfc_id" value="">

                    <table  class="table">

                        <tr >
                            <td><p style="color: black;">First Name</p></td>
                            <td><input class="form-control" style="color: black;" type="text" id="ufname" name="fname" placeholder="First Name"></td>
                        </tr>

                        <tr>
                            <td><p style="color: black;">Last Name</p></td>
                            <td><input class="form-control" style="color: black;" type="text" id="ulname" name="lname" placeholder="Last Name"></td>
                        </tr>

                        <tr>
                            <td><p style="color: black;">Email</p></td>
                            <td><input class="form-control" style="color: black;" type="text" id="uemail" name="email" placeholder="Email"></td>
                        </tr>

                        <tr>
                            <td><p style="color: black;">Phone</p></td>
                            <td><input class="form-control" style="color: black;" type="text" id="uphone" name="phone" placeholder="Phone"></td>
                        </tr>

                        <tr>
                            <td><p style="color: black;">Password</p></td>
                            <td><input class="form-control" style="color: black;" type="text" id="upass" name="pass" placeholder="Password"></td>
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

    <div class="modal fade" id="deleteLFC" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Delete LFC</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form" action="lfcform.php" method="post">
                    <input type="hidden" name="type" value="delete">
                    <input type="hidden" name="lfc_id" id="dlfc_id" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <input type="submit" class="btn btn-warning" value="Delete">
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

<script>
    function updateModal(lfc_id, fname, lname, phone, email, password) {

        console.log(lfc_id);
        document.getElementById("lfc_id").value = lfc_id;
        document.getElementById("ufname").value = fname;
        document.getElementById("ulname").value = lname;
        document.getElementById("uemail").value = email;
        document.getElementById("uphone").value = phone;
        document.getElementById("upass").value = password;
    }
    function deleteModal(lfc_id) {

        console.log(lfc_id);
        document.getElementById("dlfc_id").value = lfc_id;
    }
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

