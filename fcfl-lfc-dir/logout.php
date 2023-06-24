<?php
session_start();
if(isset($_SESSION["lfc_id"])) {
    session_destroy();
    header("Location:index.php");
} 
?>