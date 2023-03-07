<?php

session_start();
require "../dbconnection.php";

if(isset($_POST["mark"])){

    $s_id = $_POST["sid"];
    $assi_id = $_POST["assi"];
    $mark = $_POST["mark"];


   if(empty($mark)){
       echo "please enter mark";
   }elseif(!is_numeric($mark)){
       echo "invalied data";
   }
   else{
       $mark_rs = Database::search("SELECT assignment_id FROM `mark` WHERE `assignment_id`='".$assi_id."' AND `student_id`='".$s_id."' ");
       $mark_num = $mark_rs->num_rows;

      if($mark_num ==1){
       echo "Already added";
      }else{
        Database::iud("INSERT INTO `mark` 
        (`mark`, 
        `assignment_id`, 
        `student_id`) VALUES 
        ('".$mark."', 
         '".$assi_id."', 
         '".$s_id."');");

         echo "added";
       }

        
    }
}else{
    echo "no";
}






?>