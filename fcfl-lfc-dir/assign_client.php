<?php 

session_start();
if (isset($_GET['action']) && $_GET['action'] == 'assign_client') {
    include '../include/db_connection.php';
    $conn = OpenCon();
    $sql = "UPDATE clients SET lfc_id = ".$_SESSION["lfc_id"]." WHERE cid = ".$_GET['cid'];
    $result = mysqli_query($conn, $sql);
    CloseCon($conn);
    header("Location: clients.php");
}

?>