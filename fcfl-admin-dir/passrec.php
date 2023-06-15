<?php
include '../include/db_connection.php';
session_start();

if(!isset($_SESSION["aid"])) {
    header("Location:index.php");
  }
$conn = OpenCon();
$sql = "UPDATE admin SET username='".$_POST['username']."', email='".$_POST['email']."', firstname='".$_POST['firstname']."', lastname='".$_POST['lastname']."', address='".$_POST['address']."', city='".$_POST['city']."', country='".$_POST['country']."', postal_code='".$_POST['postal_code']."', about_me='".$_POST['about_me']."' WHERE aid = '".$_SESSION["aid"]."'";
$result = mysqli_query($conn, $sql);
if($result) {
    header("Location:user.php");
} else {
    echo "Error updating record: " . mysqli_error($conn);
}
CloseCon($conn); 
?>