<?php 

//Handle get request for client

include '../include/db_connection.php';
$conn = OpenCon();

if(isset($_GET['action']) && $_GET['action'] == 'updateQuote'){
    $email = $_GET['email'];

    $sql = "UPDATE quote_request SET status = 'Quote Sent' WHERE email = '$email'";

}




?>