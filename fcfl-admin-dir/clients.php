<?php 
include '../include/db_connection.php'; 
session_start();

if(!isset($_SESSION["aid"])) {
    header("Location:index.php");
  }

?>
<!DOCTYPE html>  
<html>  
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>How to use Jquery DataTables in PHP?- Nicesnippets.com</title>  
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.css"/>
</head>
<body>  
    <?php  
          $conn = OpenCon();
          $sql = "SELECT * FROM clients";
          $result = mysqli_query($conn, $sql);
    ?>  
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center text-white" style="background: #1867ab;">
                        <h3>How to use Jquery DataTables in PHP? - Nicesnippets.com</h3>  
                    </div>
                    <div class="card-body">  
                        <table id="employee_data" class="table table-bordered table-striped">  
                            <thead>  
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
                                        echo'<tr>  
                                                <td>'.$row["cid"].'</td>  
                                                <td>'.$row["first_name"].'</td>  
                                                <td>'.$row["last_name"].'</td>  
                                                <td>'.$row["email"].'</td>  
                                                <td>'.$row["phone"].'</td>  
                                                <td>Call || Mail</td>  
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

    <!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.js"></script>
    <script>  
        $(document).ready(function(){  
            $('#employee_data').DataTable();  
        });  
    </script>
</body>  
</html> 