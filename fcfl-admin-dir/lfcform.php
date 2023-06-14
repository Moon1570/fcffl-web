<?php 

include '../include/db_connection.php';
$conn = OpenCon();

if(isset($_POST['type'])){  
    if($_POST['type'] == 'add')
    {
        $fname = mysqli_real_escape_string($conn ,$_POST['fname']);
        $lname = mysqli_real_escape_string($conn ,$_POST['lname']);
        $email = mysqli_real_escape_string($conn ,$_POST['email']);
        $phone = mysqli_real_escape_string($conn ,$_POST['phone']);
        $pass = mysqli_real_escape_string($conn ,$_POST['pass']);

        $sqlquery = "INSERT INTO `lfc` (`lfc_id`, `first_name`, `last_name`, `email`, `phone`, `pass`, `timestamp`) 
                                VALUES (NULL, '$fname', '$lname', '$email', '$phone', '$pass', current_timestamp())";

        if ($conn->query($sqlquery) === TRUE) {
            $message="Added Successfully";
            session_start();
            $_SESSION["message"] = $message;
            header("Location: lfc.php");
        } else {
        echo "ERROR: Hush! Sorry $sqlquery. ". mysqli_error($conn);
        }
    }

    if($_POST['type'] == 'update')
    {
        $lfc_id =mysqli_real_escape_string($conn ,$_POST['lfc_id']);
        $fname = mysqli_real_escape_string($conn ,$_POST['fname']);
        $lname = mysqli_real_escape_string($conn ,$_POST['lname']);
        $email = mysqli_real_escape_string($conn ,$_POST['email']);
        $phone = mysqli_real_escape_string($conn ,$_POST['phone']);
        $pass = mysqli_real_escape_string($conn ,$_POST['pass']);

        $sqlquery = "UPDATE `lfc` SET `first_name` = '$fname', `last_name` = '$lname', `email` = '$email', `phone` = '$phone', `pass` = '$pass' WHERE `lfc`.`lfc_id` = '$lfc_id'";    
        if ($conn->query($sqlquery) === TRUE) {
            $message="Updated Successfully";
            session_start();
            $_SESSION["message"] = $message;
            header("Location: lfc.php");
        } else {
            echo "ERROR: Hush! Sorry $sqlquery. ". mysqli_error($conn);
        }
    }

    if($_POST['type'] == 'delete')
    {
        $lfc_id = $_POST['lfc_id'];

        $sqlquery = "DELETE FROM `lfc` WHERE `lfc_id` = '$lfc_id'";

        if ($conn->query($sqlquery) === TRUE) {
            $message="Deleted Successfully".$lfc_id;
            session_start();
            $_SESSION["message"] = $message;
            header("Location: lfc.php");
        } else {
            echo "ERROR: Hush! Sorry $sqlquery. ". mysqli_error($conn);
        }
    }

}

?>