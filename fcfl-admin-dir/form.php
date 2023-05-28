<?php 
include '../include/db_connection.php'; 
$conn = OpenCon();
$sql = "SELECT aid,name,email,password FROM admin";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    if($_POST['email']==$row["email"] && $_POST['password']==$row["password"]){
        echo "Login Successful";
        header("Location: admin.php");
} else {
  echo "0 results";
}
  }}
CloseCon($conn);
?>