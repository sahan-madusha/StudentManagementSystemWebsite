<?php
require "../dbconnection.php";
session_start();

if(isset($_SESSION["student"])){
    
    $data = $_SESSION["student"];
    $subId = $_GET["subId"];


     $pay_rs = Database::search("SELECT * FROM `studentsub` WHERE `student_id`='".$data["id"]."' AND `subject_id`='".$subId."' ");
     $pay_num = $pay_rs->num_rows;
     
     $payId = "1";

     $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d");
    $expireDate = date('Y-m-d', strtotime('+1 month'));
     
     if($pay_num==1){
         Database::iud("UPDATE `studentsub` SET `paymnet_id`='".$payId."',`date`='".$date."',`exdate`='".$expireDate."' WHERE `student_id`='".$data["id"]."' AND `subject_id`='".$subId."'");

         echo "success";
     }


}
?>