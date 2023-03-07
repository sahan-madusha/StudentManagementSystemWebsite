<?php
session_start();
require "../dbconnection.php";
$data = $_SESSION["admin"];

if(isset( $_SESSION["admin"])){
$tid = $_GET["tid"];

Database::iud("DELETE FROM `teacher` WHERE `id`='".$tid."'");

echo "deleted";
    
}







?>