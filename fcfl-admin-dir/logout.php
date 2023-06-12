<?php
session_start();
if(isset($_SESSION["aid"])) {
    session_destroy();
    header("Location:index.php");
} 
?>