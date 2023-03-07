<?php
session_start();
require "../dbconnection.php";


if(isset($_FILES["as"])){

    $Te_name = $_SESSION["teacher"]["name"];
    $sub = $_SESSION["teacher"]["subject_id"];
    $stream = $_SESSION["teacher"]["stream_id"];
    $te_id = $_SESSION["teacher"]["id"];
    $grade = $_POST["g"];
    $lesson = $_POST["le"];
    $link = $_POST["li"];
    $assignment = $_FILES["as"];
    
    
    if(empty($grade)){
        echo "Please select grade";
    }elseif(empty($lesson)){
        echo "Please enter lesson name";
    }elseif(empty($link)){
        echo "Please enter lesson link";
    }elseif(empty($assignment)){
        echo "Please upload assignment or note";
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

            $file_name = "../Teachers/Assignment/".$lesson."-".$grade."-".uniqid().$new_file_extentions;
            move_uploaded_file($assignment["tmp_name"],$file_name);

            Database::iud("INSERT INTO `lesson` 
                    (`lesson`, 
                     `subject_id`, 
                     `grade_id`, 
                     `stream_id`, 
                     `teacher_id`, 
                     `link`, 
                     `pdf`) VALUES 
                    ('".$lesson."', 
                     '".$sub."', 
                     '".$grade."', 
                     '".$stream."', 
                     '".$te_id."', 
                     '".$link."', 
                     '".$file_name."');");

                  echo "upload";
        }
    }
}else{
    echo "somthing went wrong Please Try again !";
}

?>