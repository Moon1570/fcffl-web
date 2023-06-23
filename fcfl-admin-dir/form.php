<?php 
include '../include/db_connection.php';
$conn = OpenCon();
$sql = "SELECT aid,username,email,password FROM admin";
$result = mysqli_query($conn, $sql);
session_start();
if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    if($_POST['email']==$row["email"] && $_POST['password']==$row["password"]){
        $_SESSION["aid"] = $row['aid'];
        $_SESSION["username"] = $row['username'];
        $_SESSION["email"] = $row['email'];
        $_SESSION["password"] = $row['password'];
        $_SESSION['sidebar-color'] = "blue";
        header("Location: dashboard.php");
    } 
    else {
      $_SESSION["err"] = true;
      header("Location: index.php");
    }
  }
}
else {
  echo "0 results";
}
CloseCon($conn);
?>