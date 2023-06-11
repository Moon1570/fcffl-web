<?php 

include '../include/db_connection.php';
$conn = OpenCon();

if(isset($_POST['type'])){  
    if($_POST['type'] == 'add')
    {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $sqlquery = "INSERT INTO `lfc` (`lfc_id`, `first_name`, `last_name`, `email`, `phone`, `timestamp`) 
                                VALUES (NULL, '$fname', '$lname', '$email', '$phone', current_timestamp())";
                                
        
                                if ($conn->query($sqlquery) === TRUE) {
                                    $message="Added Successfully";
                                    session_start();
                                    $_SESSION["message"] = $message;
                                    header("Location: lfc.php");
                                } else {
                                  echo "ERROR: Hush! Sorry $sqlquery. ". mysqli_error($conn);
                                }
    }

}

?>