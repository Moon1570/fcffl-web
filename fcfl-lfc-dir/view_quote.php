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
          $lfc_id = $_SESSION["lfc_id"];

          $quote_id = $_GET['quote_id'];

         // $sql = "SELECT * FROM clients";
          $sql = "SELECT * FROM quote_request WHERE id = '$quote_id'";
          $result = mysqli_query($conn, $sql);
          $quote = mysqli_fetch_assoc($result);
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
            <div class="card ">
              <div class="card-header">
                <h4 class="card-title"> Quote Details</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive" >
                    <table class="table">
                        <tr>
                            <th>Time</th>
                            <td><?php echo $quote["timestamp"]; ?></td>
                        </tr>
                        <tr>
                            <th>Type</th>
                            <td>
                              <?php 
                              if($quote["type"]==0){
                                echo "One Way";
                              } else if($quote["type"]==1){
                                echo "Return";
                              } else if($quote["type"]==2){
                                echo "Multi-city";
                              }
                              ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Departure Airport</th>
                            <td><?php echo $quote["departure_airport"]; ?></td>
                        </tr>
                        <tr>
                            <th>Departure Date</th>
                            <td><?php echo $quote["departure_date"]; ?></td>
                        </tr>
                        <tr>
                            <th>Arrival Airport</th>
                            <td><?php echo $quote["arrival_airport"]; ?></td>
                        </tr>
                        <tr>
                            <th>Arrival Date</th>
                            <td><?php echo $quote["arrival_date"]; ?></td>
                        </tr>
                        <tr>
                            <th>Passengers</th>
                            <td><?php echo $quote["pax"]; ?></td>
                        </tr>
                        <tr>
                            <th>Flexibility</th>
                            <td><?php echo $quote["flexibility"]; ?></td>
                        </tr>
                        <tr>
                            <th>Notes</th>
                            <td><?php echo $quote["note"]; ?></td>
                        </tr>
                        <tr>
                            <th>Quote Status</th>
                            <td>
                              <?php 
                              if($quote["status"]==0){
                                echo "Pending";
                              } else if($quote["status"]==1){
                                echo "Accepted";
                              } else if($quote["status"]==2){
                                echo "Rejected";
                              }
                              ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                              <a href="#" class="btn btn-warning">Update</a>
                            </td>
                        </tr>



                    </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
     <?php
        include 'include/lfc-footer.php'; 
     ?>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.js"></script>
  <script>
    $(document).ready(function(){  
            $('#clients_data').DataTable();  
        }); 
  </script>