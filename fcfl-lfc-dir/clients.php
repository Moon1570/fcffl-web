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
          $sql = "SELECT * FROM clients";
          $result = mysqli_query($conn, $sql);
    ?>  

<body class="">
  <div class="wrapper">
    <?php
      include 'include/admin-sidebar.php'; 
      include 'include/admin-navbar.php'; 
    ?>
  
      <!-- Navbar -->
      
      <!-- End Navbar -->
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card ">
              <div class="card-header">
                <h4 class="card-title"> Clients Table</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table tablesorter " id="clients_data">
                    <thead class=" text-primary">
                    <tr>
                      <th>Client ID</th>  
                      <th>First Name</th>
                      <th>Last Name</th>  
                      <th>Email</th>    
                      <th>Phone</th>    
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
                                  <td>'.$row["cid"].'</td>  
                                  <td>'.$row["first_name"].'</td>  
                                  <td>'.$row["last_name"].'</td>  
                                  <td>'.$row["email"].'</td>  
                                  <td>'.$row["phone"].'</td>  
                                  <td><a href=tel:'.$phn.'>Call</a> || Mail</td>  
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