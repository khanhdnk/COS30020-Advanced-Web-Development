<?php
session_start(); // start the session // copy the value to a variable
$num = $_SESSION["number"];
 $num++; // increment the value
 $_SESSION["number"] = $num; // update the session variable
 header("location:number.php"); // redirect to number.php
?>