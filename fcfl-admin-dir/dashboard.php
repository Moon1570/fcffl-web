
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
          $sql = "SELECT q.departure_airport, q.departure_date, q.arrival_airport, q.arrival_date, q.flexibility, q.note, q.pax, q.status, q.type, q.timestamp, c.first_name, c.last_name, c.email, c.phone  FROM quote_request as q
          JOIN clients as c ON q.cid=c.cid";
          $quote_requests = mysqli_query($conn, $sql);
          CloseCon($conn);
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
          <div class="col-12">
            <div class="card card-chart">
              <div class="card-header ">
                <div class="row">
                  <div class="col-sm-6 text-left">
                    <h5 class="card-category">Total Shipments</h5>
                    <h2 class="card-title">Performance</h2>
                  </div>
                  <div class="col-sm-6">
                    <div class="btn-group btn-group-toggle float-right" data-toggle="buttons">
                      <label class="btn btn-sm btn-primary btn-simple active" id="0">
                        <input type="radio" name="options" checked>
                        <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Accounts</span>
                        <span class="d-block d-sm-none">
                          <i class="tim-icons icon-single-02"></i>
                        </span>
                      </label>
                      <label class="btn btn-sm btn-primary btn-simple" id="1">
                        <input type="radio" class="d-none d-sm-none" name="options">
                        <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Purchases</span>
                        <span class="d-block d-sm-none">
                          <i class="tim-icons icon-gift-2"></i>
                        </span>
                      </label>
                      <label class="btn btn-sm btn-primary btn-simple" id="2">
                        <input type="radio" class="d-none" name="options">
                        <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Sessions</span>
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
                  <canvas id="chartBig1"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4">
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-category">Total Shipments</h5>
                <h3 class="card-title"><i class="tim-icons icon-bell-55 text-primary"></i> 763,215</h3>
              </div>
              <div class="card-body">
                <div class="chart-area">
                  <canvas id="chartLinePurple"></canvas>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-category">Daily Sales</h5>
                <h3 class="card-title"><i class="tim-icons icon-delivery-fast text-info"></i> 3,500€</h3>
              </div>
              <div class="card-body">
                <div class="chart-area">
                  <canvas id="CountryChart"></canvas>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-category">Completed Tasks</h5>
                <h3 class="card-title"><i class="tim-icons icon-send text-success"></i> 12,100K</h3>
              </div>
              <div class="card-body">
                <div class="chart-area">
                  <canvas id="chartLineGreen"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- <div class="col-lg-6 col-md-12">
            <div class="card card-tasks">
              <div class="card-header ">
                <h6 class="title d-inline">Tasks(5)</h6>
                <p class="card-category d-inline">today</p>
                <div class="dropdown">
                  <button type="button" class="btn btn-link dropdown-toggle btn-icon" data-toggle="dropdown">
                    <i class="tim-icons icon-settings-gear-63"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="#pablo">Action</a>
                    <a class="dropdown-item" href="#pablo">Another action</a>
                    <a class="dropdown-item" href="#pablo">Something else</a>
                  </div>
                </div>
              </div>
              <div class="card-body ">
                <div class="table-full-width table-responsive">
                  <table class="table">
                    <tbody>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="">
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>
                          <p class="title">Update the Documentation</p>
                          <p class="text-muted">Dwuamish Head, Seattle, WA 8:47 AM</p>
                        </td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="" class="btn btn-link" data-original-title="Edit Task">
                            <i class="tim-icons icon-pencil"></i>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked="">
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>
                          <p class="title">GDPR Compliance</p>
                          <p class="text-muted">The GDPR is a regulation that requires businesses to protect the personal data and privacy of Europe citizens for transactions that occur within EU member states.</p>
                        </td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="" class="btn btn-link" data-original-title="Edit Task">
                            <i class="tim-icons icon-pencil"></i>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="">
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>
                          <p class="title">Solve the issues</p>
                          <p class="text-muted">Fifty percent of all respondents said they would be more likely to shop at a company </p>
                        </td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="" class="btn btn-link" data-original-title="Edit Task">
                            <i class="tim-icons icon-pencil"></i>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="">
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>
                          <p class="title">Release v2.0.0</p>
                          <p class="text-muted">Ra Ave SW, Seattle, WA 98116, SUA 11:19 AM</p>
                        </td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="" class="btn btn-link" data-original-title="Edit Task">
                            <i class="tim-icons icon-pencil"></i>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="">
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>
                          <p class="title">Export the processed files</p>
                          <p class="text-muted">The report also shows that consumers will not easily forgive a company once a breach exposing their personal data occurs. </p>
                        </td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="" class="btn btn-link" data-original-title="Edit Task">
                            <i class="tim-icons icon-pencil"></i>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="">
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>
                          <p class="title">Arival at export process</p>
                          <p class="text-muted">Capitol Hill, Seattle, WA 12:34 AM</p>
                        </td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="" class="btn btn-link" data-original-title="Edit Task">
                            <i class="tim-icons icon-pencil"></i>
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div> -->
          <div class="col-lg-12 col-md-12 d-flex align-items-stretch">
            <div class="card ">
              <div class="card-header">
                <h4 class="card-title"> Quote Table</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table tablesorter " id="">
                    <thead class=" text-primary">
                      <tr>
                        <th>
                          Name
                        </th>
                        <th>
                          Email
                        </th>
                        <th>
                          Phone
                        </th>
                        <th>
                          Departure Airport
                        </th>
                        <th>
                          Arrival Airport
                        </th>
                        <th>
                          Arrival Date
                        </th>
                        <th>
                          PAX
                        </th>
                        <th>
                          Type
                        </th>
                        <th>
                          Note
                        </th>
                        <th>
                          Time Received
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <?php
                        while($rows = mysqli_fetch_array($quote_requests))
                        {
                          echo "<tr>";
                          echo "<td>" . $rows['first_name'] ." ".$rows['last_name']. "</td>";
                          echo " <td>" . $rows['email'] . "</td>";
                          echo "<td>" . $rows['phone'] . "</td>";
                          echo "<td>" . $rows['departure_airport'] . "</td>";
                          echo "<td>" . $rows['arrival_airport'] . "</td>";
                          echo "<td>" . $rows['arrival_date'] . "</td>";
                          echo "<td>" . $rows['pax'] . "</td>";
                          if($rows['type'] == 0){
                            echo "<td> One Way </td>";
                          }else if($rows['type'] == 1){
                            echo "<td> Round Trip </td>";
                          }else if($rows['type'] == 2){
                            echo "<td> Multi City </td>";
                          }
                          echo '<td><p>' . $rows['note'] . '</p></td>';
                          $datetime_1 = $rows['timestamp'];  
                          $datetime_2 = date("Y-m-d H:i:s");
                          $start_datetime = new DateTime($datetime_1); 
                          $diff = $start_datetime->diff(new DateTime($datetime_2)); 
                          echo "<td>" . $diff->days . " days ".$diff->h." hours ".$diff->i." minutes</td>";
                          echo "</tr>";
                        }
                        ?>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-12 d-flex align-items-stretch" id="LFC">
            <div class="card ">
              <div class="card-header">
                <h4 class="card-title"> Add LFC to Clients</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <form action="assign_lfc.php" method="post">
                    <label for="AssignLFC" class="form-label">Starting Row Number</label>
                    <input type="number" class="form-control" name="from" placeholder="From">
                    <label for="AssignLFC" class="form-label">Number of Rows</label>
                    <input type="number" class="form-control" name="to" placeholder="To">
                    <label for="AssignLFC" class="form-label">LFC Name</label><br>
                    <input type="text" class="form-control" list="datalistOptions" name="lfc" placeholder="LFC Name">
                    <datalist id="datalistOptions">
                      <?php
                      while($row = mysqli_fetch_array($result)) {
                        echo "<option value='".trim($row['first_name'])." ".trim($row['last_name'])."'>";
                      }
                      ?>
                    </datalist>
                    <input type="submit" class="btn btn-primary" name="submit" value="Assign">
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-12 d-flex align-items-stretch" id="clients">
            <div class="card ">
              <div class="card-header">
                <h4 class="card-title"> Add Clients</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <form action="add_Clients.php" method="post">
                    <label for="AddClients" class="form-label">First Name</label>
                    <input type="text" class="form-control" name="first_name" placeholder="first name" required>
                    <label for="AddClients" class="form-label">Last Name</label>
                    <input type="text" class="form-control" name="last_name" placeholder="last name" required>
                    <label for="AddClients" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                    <label for="AddClients" class="form-label">Contact Number</label>
                    <input type="text" class="form-control" name="phone1" placeholder="Phone Number">
                    <label for="AddClients" class="form-label">Secondary Contact Number</label>
                    <input type="text" class="form-control" name="phone2" placeholder="Phone Number">
                    <label for="AddClients" class="form-label">LFC Name</label><br>
                    <input type="text" class="form-control" list="datalistOptions" name="lfc" placeholder="LFC Name">
                    <datalist id="datalistOptions">
                      <?php
                      while($row = mysqli_fetch_array($result)) {
                        echo "<option value='".trim($row['first_name'])." ".trim($row['last_name'])."'>";
                      }
                      ?>
                    </datalist>
                    <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 row-lg-6 col-md-12 d-flex align-items-stretch" id="QR">
            <div class="card ">
              <div class="card-header">
                <h4 class="card-title"> Add Quote Request</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <form action="add_quote.php" method="post">
                    <label for="AddQuotes" class="form-label">First Name</label>
                    <input type="text" class="form-control" name="first_name" placeholder="first name" required>
                    <label for="AddQuotes" class="form-label">Last Name</label>
                    <input type="text" class="form-control" name="last_name" placeholder="last name" required>
                    <label for="AddQuotes" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                    <label for="AddQuotes" class="form-label">Contact Number</label>
                    <input type="text" class="form-control" name="phone1" placeholder="Phone Number">
                    <label for="AddQuotes" class="form-label">Departure Airport</label>
                    <input type="text" id="dept_air" name="arrival_airport" class="autocomplete form-control" placeholder="City name or airport code" />                    
                    <label for="AddQuotes" class="form-label">Departure Date</label>
                    <input placeholder="Departure Date" name="departure_date" class="form-control" type="text" min="<?php echo date("Y-m-d"); ?>" onfocus="(this.type='date')" id="departure_date" />
                    <label for="AddQuotes" class="form-label">Arrival Airport</label>
                    <input type="text" id="arrv_air" name="arrival_airport" class="autocomplete form-control" placeholder="City name or airport code" />
                    <label for="AddQuotes" class="form-label">Arrival Date</label>
                    <input placeholder="Arrival Date (Optional)" name="arrival_date" class="form-control" type="text" min="<?php echo date("Y-m-d"); ?>" onfocus="(this.type='date')" id="arrival_date"/>
                    <label for="AddQuotes" class="form-label">PAX</label>
                    <input type="number" class="form-control" name="pax">
                    <label for="AddQuotes" class="form-label">Type</label>
                    <input type="number" class="form-control" name="type">
                    <label for="AddQuotes" class="form-label">Notes</label><br>
                    <textarea class="form-control" name="note"></textarea>
                    <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php
        include 'include/admin-footer.php'; 
     ?>



     <script src="../js/air-port-codes-api-min.js"></script>
     
<script>
$(function() {
    $( '.autocomplete' ).each(function () {
        var apca = new apc('autocomplete', {
            key : 'fa3f138fb7', 
            secret : 'a2a3e99d878ac73 ', // Your API Secret Key: use this if you are not connecting from a web server
            limit : 7
        });
 
        var dataObj = {
            source: function( request, response ) {
                // make the request
                apca.request( request.term );
 
                // this builds each line of the autocomplete
                itemObj = function (airport, isChild) {
                    var label;
                    if (isChild) { // format children labels
                        label = '&rdsh;' + airport.iata + ' - ' + airport.name;
                    } else { // format labels
                        label = airport.city;
                        if (airport.state.abbr) {
                            label += ', ' + airport.state.abbr;
                        }
                        label += ', ' + airport.country.name;                            
                        label += ' (' + airport.iata + ' - ' + airport.name + ')';
                    }
                    return {
                        label: label,
                        value: airport.iata + ' - ' + airport.name,
                        code: airport.iata
                    };
                };
 
                // this deals with the successful response data
                apca.onSuccess = function (data) {
                    var listAry = [],
                        thisAirport;
                    if (data.status) { // success
                        for (var i = 0, len = data.airports.length; i < len; i++) {
                            thisAirport = data.airports[i];
                            listAry.push(itemObj(thisAirport));
                            if (thisAirport.children) {
                                for (var j = 0, jLen = thisAirport.children.length; j < jLen; j++) {
                                    listAry.push(itemObj(thisAirport.children[j], true));
                                }
                            }
                        }
                        response(listAry);
                    } else { // no results
                        response();
                    }
                };
                apca.onError = function (data) {
                    response();
                    console.log(data.message);
                };
            },
            select: function( event, ui ) {
                // do something for click event
                console.log(ui.item.code);
            }
        }
 
        // this is necessary to allow html entities to display properly in the jqueryUI labels
        $(this).autocomplete(dataObj).data("ui-autocomplete")._renderItem = function( ul, item) {
            return $('<li class="form-control col-lg-4 text-white bg-dark" ></li>').data('item.autocomplete', item ).html( item.label ).appendTo( ul );               
        };
    });
});

 
</script>


<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/intlTelInput.min.js"></script>