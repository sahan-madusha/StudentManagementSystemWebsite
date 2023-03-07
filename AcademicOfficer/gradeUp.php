<?php
session_start();
require "../dbconnection.php";
$data = $_SESSION["acOfficer"];

if(isset( $_SESSION["acOfficer"])){
$c_grade_id = $_GET["cg"];
$u_grade_id = $_GET["ug"];
$mark = $_GET["m"];

if(empty($mark)){
    echo "1";
}elseif(!is_numeric($mark)){
    echo "2";
}else{
    $st_avg_rs = Database::search("SELECT `id` FROM `student` WHERE `grade_id`='".$c_grade_id."'");
    $st_avg_num = $st_avg_rs->num_rows;

    for($x=0;$x<$st_avg_num;$x++){
        $st_avg_data = $st_avg_rs->fetch_assoc();

        $avg_rs = Database::search("SELECT AVG(mark),student_id FROM `mark` WHERE student_id = '".$st_avg_data["id"]."'");
        $avg_num = $avg_rs->num_rows;


        for($z=0;$z<$avg_num;$z++){
            $avg_data = $avg_rs->fetch_assoc();

            if($mark <= $avg_data["AVG(mark)"]){
                Database::iud("UPDATE `student` SET `grade_id`='".$u_grade_id."' WHERE `id`='".$avg_data["student_id"]."' ");
            }
            
        }
    }
}

}
?>