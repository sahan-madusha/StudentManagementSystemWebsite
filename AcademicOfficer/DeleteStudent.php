<?php
session_start();
require "../dbconnection.php";
$data = $_SESSION["acOfficer"];

if(isset( $_SESSION["acOfficer"])){
$sid = $_GET["sid"];

Database::iud("DELETE FROM `student` WHERE `id`='".$sid."'");

echo "deleted";
    
}







?>