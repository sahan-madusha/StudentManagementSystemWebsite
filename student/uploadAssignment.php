<?php

session_start();
require "../dbconnection.php";
if(isset($_FILES["p"])){

  $data = $_SESSION["student"];
  $sub_id = $_POST["s"];
  $lesson = $_POST["l"];
  $assignment = $_FILES["p"];


  if(empty($sub_id)){
    echo "somthing went wrong";
}elseif(empty($lesson)){
    echo "Please enter lesson name";
}else{
    $allowed_pdf_extentions = array("application/pdf");
    $file_ex = $assignment["type"];

    if(!in_array($file_ex,$allowed_pdf_extentions)){
        echo "Please select a valied pdf";
    }else{
        $new_file_extentions;

        if($file_ex == "application/pdf"){
            $new_file_extentions = ".pdf";
        }

        $file_name = "../student/Assignment/".$lesson."-".$data["grade_id"]."-".uniqid().$new_file_extentions;
        move_uploaded_file($assignment["tmp_name"],$file_name);

        $pdf_rs = Database::search("SELECT * FROM `lesson` WHERE `lesson`='".$lesson."'");
        $pdf_data = $pdf_rs->fetch_assoc();

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d");


        $assi_rs = Database::search("SELECT `id`,`lesson` FROM `assignment` WHERE `lesson`='".$lesson."'");
        $assi_num = $assi_rs->num_rows;
        $assi_data = $assi_rs->fetch_assoc();

        if($assi_num==1){
            Database::iud("UPDATE `assignment` SET `pdf`='".$file_name."',`date`='".$date."' WHERE `id`='".$assi_data["id"]."' ");
            echo "update";
        }else{
            Database::iud("INSERT INTO `assignment` 
            (`pdf`, 
            `teacher_id`, 
            `lesson`, 
            `subject_id`,
            `date`,
            `student_id`) VALUES 
            ('".$file_name."', 
             '".$pdf_data["teacher_id"]."', 
             '".$lesson."', 
             '".$sub_id."',
             '".$date."',
            '".$data["id"]."');");

             echo "done";
        }
    }
}

}

?>