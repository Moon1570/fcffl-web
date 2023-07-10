<?php
// echo $_POST['first_name'];
include '../include/db_connection.php'; 
function concat($str1, $str2){
    $str1 = trim($str1);
    $str2 = trim($str2);
    $str1 = ucfirst($str1);
    $str2 = ucfirst($str2);
    return $str1." ".$str2;
  }
    $first_name= $_POST['first_name'];
    //echo $first_name;
    $last_name= $_POST['last_name'];
    $email= $_POST['email'];
    $phone1= $_POST['phone1'];
    $phone2= $_POST['phone2'];
    $conn = OpenCon();
    $sqll="SELECT * FROM lfc";
    $resultt = mysqli_query($conn, $sqll);
    CloseCon($conn);
    while($rows=mysqli_fetch_array($resultt)){
        $name=concat($rows['first_name'],$rows['last_name']);
        //echo $name;
          if($name==$_POST['lfc']){
            $lfc_id= $rows['lfc_id'];
             //echo $lfc_id;
            break;
          }
        }
    $connn = OpenCon();
    $sql = "INSERT INTO `clients` (`first_name`, `last_name`, `email`, `phone`, `phone2`, `lfc_id`) VALUES ('".$first_name."', '".$last_name."', '".$email."', '".$phone1."', '".$phone2."', '".$lfc_id."')";
    //echo $sql;
    $res=mysqli_query($connn, $sql);
    echo $res;
    if ($res) {
      echo "<script>alert('Client Added Successfully');</script>";
     sleep(5);
     header("Location: dashboard.php#clients");
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    CloseCon($connn);
?>