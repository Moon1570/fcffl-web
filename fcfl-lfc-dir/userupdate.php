<?php
include '../include/db_connection.php';
session_start();

if(!isset($_SESSION["lfc_id"])) {
    header("Location:index.php");
  }
$conn = OpenCon();
    $sql = "UPDATE lfc SET username='".$_POST['username']."', email='".$_POST['email']."', first_name='".$_POST['firstname']."', last_name='".$_POST['lastname']."', address='".$_POST['address']."', city='".$_POST['city']."', country='".$_POST['country']."', postal_code='".$_POST['postal_code']."', about_me='".$_POST['about_me']."' WHERE lfc_id = '".$_SESSION["lfc_id"]."'";
    $result = mysqli_query($conn, $sql);
if($result) {
    header("Location:user.php");
} else {
    echo "Error updating record: " . mysqli_error($conn);
}
CloseCon($conn); 
?>