<?php
    include '../include/db_connection.php'; 
    // session_start();
    // if(!isset($_SESSION["lfc_id"])) {
        // header("Location:index.php");
    // }
    function concat($str1, $str2){
        $str1 = trim($str1);
        $str2 = trim($str2);
        $str1 = ucfirst($str1);
        $str2 = ucfirst($str2);
        return $str1." ".$str2;
    }
    //   echo $_POST['lfc'];
    $conn = OpenCon();
    $sqll="SELECT * FROM lfc";
    $resultt = mysqli_query($conn, $sqll);
    CloseCon($conn);
    while($rows=mysqli_fetch_array($resultt)){
        $name=concat($rows['first_name'],$rows['last_name']);
        // echo $name;
          if($name==$_POST['lfc']){
            $lfc_id= $rows['lfc_id'];
            // echo $lfc_id;
            break;
          }
        }
        // echo var_dump($_POST['from']);
        $connn = OpenCon();
        $sql2="UPDATE clients SET lfc_id = ".$lfc_id." WHERE cid IN (SELECT cid FROM ( select cid from clients order by cid asc limit ".$_POST['from'].",".$_POST['to'].")l)";
        // echo $sql2;
        $res=mysqli_query($connn, $sql2);
        // echo $res;
        if($res) {
            header("Location:dashboard.php#LFC");
            // echo "Success";
        } else {
            echo "Error updating record: " . mysqli_error($connn);
        }
        CloseCon($connn);
    
?>