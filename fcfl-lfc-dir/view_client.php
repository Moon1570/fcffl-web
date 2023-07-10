<?php 
include '../include/db_connection.php'; 
include 'include/lfc-header.php'; 

session_start();

if(!isset($_SESSION["lfc_id"])) {
    header("Location:index.php");
  }

?>

<?php 

if (isset($_GET['action']) && $_GET['action'] == 'view_client') {
    $conn = OpenCon();
    $cid = $_GET['cid'];
    $sql = "SELECT * FROM clients WHERE cid = ".$_GET['cid'];
    $result = mysqli_query($conn, $sql);
    $client = mysqli_fetch_assoc($result);

    $sql = "SELECT * FROM quote_request WHERE cid = '$cid'";
    $result = mysqli_query($conn, $sql);

    CloseCon($conn);

    //header("Location: clients.php");
} else{
    header("Location: myclients.php");
}

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
          <div class="col-12">
            <div class="card card-chart">
              <div class="card-header ">
                <div class="row">
                  <div class="col-sm-6 text-left">
                    <h5 class="card-category">Client Details</h5>
                    <h2 class="card-title"><?php echo $client["first_name"]." ".$client["last_name"]; ?></h2>
                  </div>
                  <div class="col-sm-6">
                    <div class="btn-group btn-group-toggle float-right" data-toggle="buttons">
                      <label class="btn btn-sm btn-success btn-simple active" id="0">
                        <input type="radio" name="options" checked>
                        <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Accounts</span>
                        <span class="d-block d-sm-none">
                          <i class="tim-icons icon-single-02"></i>
                        </span>
                      </label>
                      <label class="btn btn-sm btn-success btn-simple" id="1">
                        <input type="radio" class="d-none d-sm-none" name="options">
                        <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">History</span>
                        <span class="d-block d-sm-none">
                          <i class="tim-icons icon-gift-2"></i>
                        </span>
                      </label>
                      <label class="btn btn-sm btn-success btn-simple" id="2">
                        <input type="radio" class="d-none" name="options">
                        <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Status</span>
                        <span class="d-block d-sm-none">
                          <i class="tim-icons icon-tap-02"></i>
                        </span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="chart-area">
                  <table class="table tablesorter " id="clients_data">
                    <tbody class=" text-primary">
                    <tr>
                      <td>Name</td>
                      <td><?php echo $client["first_name"]." ".$client["last_name"]; ?></td>
                    </tr>
                    <tr>
                      <td>Email</td>
                      <td><?php echo $client["email"]; ?></td>
                    </tr>
                    <tr>
                      <td>Phone</td>
                      <td><?php echo $client["phone"]; ?></td>
                    </tr>
                    </tbody>
                  </table>                  
                  
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-category">Quote</h5>
                <h3 class="card-title"><i class="tim-icons icon-bell-55 text-primary"></i>Client Requests</h3>
              </div>
              <div class="card-body">
                <table class="table table-hover" id="quote_request">
                <thead>
                    <tr>
                        <td>Timestamp</td>
                        <td>Type</td>
                        <td>Status</td>
                        <td>Action</td>
                    </tr>
                    </thead>
                    

                    <?php
                        while($row = mysqli_fetch_array($result))  
                        {  
                          if ($row["type"] == "0") {
                            $type = "One Way";
                          } else if ($row["type"] == "1") {
                            $type = "Round Trip";
                          } else if ($row["type"] == "2") {
                            $type = "Multi-Leg";
                          }

            
                          $status = "";
                          if ($row["status"] == "0") {
                            $status = "Fresh";
                          }
                          else if ($row["status"] == "1") {
                            $status = "Processing";
                          }
                          else if ($row["status"] == "2") {
                            $status = "No flight found";
                          }
                          else if ($row["status"] == "3") {
                            $status = "Missed Call";
                          }
                          else if ($row["status"] == "4") {
                            $status = "Will get back later";
                          }
                          else if ($row["status"] == "5") {
                            $status = "Quote send";
                          }
                          else if ($row["status"] == "6") {
                            $status = "Asking for lower price";
                          }
                          else if ($row["status"] == "7") {
                            $status = "Sold";
                          }
                          else if ($row["status"] == "8") {
                            $status = "Reject";
                          }
                          else if ($row["status"] == "9") {
                            $status = "Found cheaper elsewhere";
                          }
                          else if ($row["status"] == "10") {
                            $status = "Scam";
                          }
                          else if ($row["status"] == "11") {
                            $status = "Unwilling to share CC";
                          }

                            echo '  
                            <tbody>
                            <tr>  
                                <td>'.$row["timestamp"].'</td>  
                                <td>'.$type.'</td>  
                                <td>'.$status.'</td>
                                <td><a href="./view_quote.php?quote_id='.$row["id"].'" class="btn btn-warning btn-sm">View</a></td>
                            </tr>  </tbody>
                            ';  
                        }
                    ?>
                </table>
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

      function updateQuote(var email){
        

      }
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
    //  demo.initDashboardPageCharts();

    });
  </script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.js"></script>
  <script>
    $(document).ready(function(){  
            $('#quote_request').DataTable();  
        }); 
  </script>