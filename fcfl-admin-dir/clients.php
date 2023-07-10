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
          $sql = "SELECT clients.*,lfc.first_name AS lfname, lfc.last_name AS llname FROM clients LEFT JOIN lfc ON lfc.lfc_id=clients.lfc_id";
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
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#changeLFC">
                  Change LFC for Clients 
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
                      <th>Client ID</th>  
                      <th>First Name</th>
                      <th>Last Name</th>  
                      <th>Email</th>    
                      <th>Phone</th>    
                      <th>Action</th>
                      <th>LFC name</th>
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
                                  <td>'.$row["lfname"]." ".$row["llname"].'</td>  
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

      <div class="modal fade" id="changeLFC" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change LFC</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form" action="" method="post">
                    <input type="hidden" name="type" value="add">

                    <table  class="table">

                        <tr >
                            <td><p style="color: black;">Client's Email</p></td>
                            <td><input type="text" style="color: black;" class="form-control" list="datalistOptions" name="cemail" placeholder="LFC Name">
                    <datalist id="datalistOptions">
                      <?php
                      while($row = mysqli_fetch_array($result)) {
                        echo "<option value='".trim($row['email'])."'>";
                      }
                      ?>
                    </datalist></td>
                        </tr>

                        <tr>
                            <td><p style="color: black;">LFC Name</p></td>
                            <td><input type="text" style="color: black;" class="form-control" list="datalistOptions1" name="lfc" placeholder="LFC Name">
                    <datalist id="datalistOptions1">
                      <?php
                      while($row = mysqli_fetch_array($result)) {
                        echo "<option value='".trim($row['lfname'])." ".trim($row['llname']).">";
                      }
                      ?>
                    </datalist></td>
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
  <script type='text/javascript'>

/* If function used, sends new data from input field to the
   server, then gets response from server if any. */

function modifySession (newValue) {

    /* You could always check the newValue here before making
       the request so you know if its set or needs filtered. */

    var xhttp = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            usedData = this.responseText; //response from php script
            console.log(usedData);
        }
    };

xhttp.open("GET", "include/modifySession.php?newData="+newValue, true);
xhttp.send(); 
}
</script>