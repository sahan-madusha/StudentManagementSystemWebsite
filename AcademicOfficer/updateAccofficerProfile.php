<?php
session_start();
require "../dbconnection.php";
$data = $_SESSION["acOfficer"];

if(isset($_POST["n"])){

    $name = $_POST["n"];
    $mobile = $_POST["m"];
    $pass = $_POST["p"];
    

    if(isset($_FILES["i"])){
        $img = $_FILES["i"];

        $allowed_img_extentions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");
        $file_ex = $img["type"];

        if(!in_array($file_ex , $allowed_img_extentions)){
            echo ("Please select a valid image.");
        }else{
            $new_file_extention;

            if ($file_ex == "image/jpg") {
                $new_file_extention = ".jpg";
            } else if ($file_ex == "image/jpeg") {
                $new_file_extention = ".jpeg";
            } else if ($file_ex == "image/png") {
                $new_file_extention = ".png";
            } else if ($file_ex == "image/svg+xml") {
                $new_file_extention = ".svg";
            }

            $file_name = "profileImg/".$data["name"]."-".uniqid().$new_file_extention;
            move_uploaded_file($img["tmp_name"],$file_name);

            Database::iud("UPDATE `academicofficer` SET `imgpath`='".$file_name."' WHERE `email`='".$data["email"]."' ");
        }
    }

    if(empty($name)){
        echo "please enter your name ";
    }elseif(empty($mobile)){
        echo("please enter your mobile !");
    }elseif(!preg_match("/^.{5,}$/",$pass)){
        echo "password must be between 5 - 20 charactors";
    }else{
        Database::iud("UPDATE `academicofficer` SET `name`='".$name."', `mobile`='".$mobile."',`password`='".$pass."'
         WHERE `email`='".$data["email"]."' ");

          echo "done";
    }
    
}







?>