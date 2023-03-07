<?php

require './dbconnection.php';
session_start();

if(isset($_POST["e"])){

    $email = $_POST["e"];
    $pass = $_POST["p"];
    $rememberMe = $_POST["r"];

    if(empty($email)){
        echo "Please enter your email";
    }elseif(strlen($email)>100){
        echo "Invalid email";
    }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        echo "Invalid Email";
    }elseif(empty($pass)){
        echo "Please enter your password";
    }elseif(!preg_match("/^.{5,}$/",$pass)){
        echo "password must be between 5 - 20 charactors";
    }else{

        $admin_rs = Database::search("SELECT *FROM `admin` WHERE `email` = '".$email."' AND `password`='".$pass."'");
        $admin_num = $admin_rs->num_rows;

        if($admin_num==1){
            $admin_data = $admin_rs->fetch_assoc();
            $_SESSION["admin"] =$admin_data;

            if($rememberMe=="true"){
                setcookie("email",$email,time()+(60*60*24*365));
                setcookie("pass",$pass,time()+(60*60*24*365));
            }else{
                setcookie("email","",-1);
                setcookie("pass","",-1);
            }

            echo "done";
            exit();

        }else{
            echo "invalid user name or password";
        }

        
    }




}

?>