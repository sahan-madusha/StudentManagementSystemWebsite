<?php
session_start();
require "../dbconnection.php";
$data = $_SESSION["admin"];

if(isset( $_SESSION["admin"])){
$aid = $_GET["aid"];

Database::iud("DELETE FROM `academicofficer` WHERE `id`='".$aid."'");

echo "deleted";
    
}







?>