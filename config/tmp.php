<?php
session_start();
$_SESSION['sa'] = "1";
$_SESSION['loggued_on'] = "1";
header('Location: ../index.php'); 
?>