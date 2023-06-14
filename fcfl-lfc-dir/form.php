<?php 
include '../include/db_connection.php';
$conn = OpenCon();
$sql = "SELECT * FROM lfc";
$result = mysqli_query($conn, $sql);
session_start();
$email = $_POST['email'];
echo "<script>alert('$email hnh')</script>";

//define concat function
function concat($str1, $str2){
    $str1 = trim($str1);
    $str2 = trim($str2);
    $str1 = ucfirst($str1);
    $str2 = ucfirst($str2);
    return $str1." ".$str2;
}

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    if($_POST['email']==$row["email"] && $_POST['password']==$row["pass"]){
        $_SESSION["lfc_id"] = $row['lfc_id'];
        $_SESSION["lfc_name"] = concat($row['first_name'], $row['last_name']);
        header("Location: dashboard.php");
    } 
    else {
      $_SESSION["err"] = true;
      header("Location: index.php");
    }
  }
}
else {
  echo "No LFC found with this credential";
}
CloseCon($conn);
?>