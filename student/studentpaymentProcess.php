<?php
require "../dbconnection.php";
session_start();


if(isset($_SESSION["student"])){

    $data = $_SESSION["student"];
    $sub = $_POST["s"];
    $fees = $_POST["f"];

    $te_rs = Database::search("SELECT teacher.id,`name`,`email`,`subject` FROM teacher INNER JOIN subject ON
        teacher.subject_id = subject.id
      WHERE `subject_id`='".$sub."' AND `fees`='".$fees."' ");
    $te_num = $te_rs->num_rows;

    if($te_num==1){

        $te_data = $te_rs->fetch_assoc();
        $array;

        $array["fees"]=$fees;
        $array["sub_id"]=$sub;
        $array["teacherId"]= $te_data["id"];
        $array["teacherName"]= $te_data["name"];
        $array["teacherSub"]= $te_data["subject"];
        $array["student_id"] = $data["id"];
        $array["student_name"] = $data["name"];
        $array["student_email"] = $data["email"];
        $array["student_nic"] = $data["nic"];
        $array["student_mobile"] = $data["mobile"];


        echo json_encode($array);
    }

   //echo $sub;
   //echo $fees;

}else{
    echo ("somthing went wrong");
}
?>