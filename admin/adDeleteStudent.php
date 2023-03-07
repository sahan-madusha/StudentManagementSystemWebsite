<?php
session_start();
require "../dbconnection.php";
$data = $_SESSION["admin"];

if(isset( $_SESSION["admin"])){
$sid = $_GET["sid"];

Database::iud("DELETE FROM `student` WHERE `id`='".$sid."'");

echo "deleted";
    
}







?>