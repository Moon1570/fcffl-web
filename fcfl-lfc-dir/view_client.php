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
    $sql = "SELECT * FROM clients WHERE cid = ".$_GET['cid'];
    $result = mysqli_query($conn, $sql);
    $client = mysqli_fetch_assoc($result);

    $email = $client["email"];
    $sql = "SELECT * FROM quote_request WHERE email = '$email'";
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
                <h3 class="card-title"><i class="tim-icons icon-bell-55 text-primary"></i> Client Requests</h3>
              </div>
              <div class="card-body">
                <table class="table table-bordered" id="quote_request">
                    <tr>
                        <td>Type</td>
                        <td>Dept. Airport</td>
                        <td>Date</td>
                        <td>Arr. Airport</td>
                        <td>Date</td>
                        <td>Passengers</td>
                        <td>Note</td>
                        <td>Timestamp</td>
                    </tr>

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
                            echo '  
                            <tr>  
                                <td>'.$type.'</td>  
                                <td>'.$row["departure_airport"].'</td>  
                                <td>'.$row["departure_date"].'</td>  
                                <td>'.$row["arrival_airport"].'</td>  
                                <td>'.$row["arrival_date"].'</td>  
                                <td>'.$row["pax"].'</td>  
                                <td>'.$row["note"].'</td>  
                                <td>'.$row["timestamp"].'</td>  
                            </tr>  
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
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
    //  demo.initDashboardPageCharts();

    });
  </script>