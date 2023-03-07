<?php

require './dbconnection.php';
session_start();

if(isset($_POST["e"])){

    $email = $_POST["e"];
    $vcode = $_POST["c"];
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

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d");

       // data
       $student_rs = Database::search("SELECT * FROM `student` WHERE `email` = '".$email."' AND `password`='".$pass."'");
       $student_num = $student_rs->num_rows;
       


       
       

        if($student_num==1){
            $student_data = $student_rs->fetch_assoc();
            $_SESSION["student"] = $student_data;

            $payId = "2";
            $payment_rs = Database::search("SELECT * FROM `studentsub` WHERE `student_id`='".$student_data["id"]."' AND `paymnet_id`='1' ");
            $payment_data = $payment_rs->fetch_assoc();

                $d = new DateTime();
                $tz = new DateTimeZone("Asia/Colombo");
                $d->setTimezone($tz);
                $date = $d->format("Y-m-d");
            
            if($payment_data["exdate"]==$date){
               Database::iud("UPDATE  `studentsub` SET `paymnet_id`='".$payId."' WHERE `exdate`='2023-02-04' ");
            };

            if($rememberMe=="true"){
                setcookie("semail",$email,time()+(60*60*24*365));
                setcookie("spass",$pass,time()+(60*60*24*365));
            }else{
                setcookie("semail","",-1);
                setcookie("spass","",-1);
            }

            echo "done";
            exit();

        }else{
            echo "invalid user name or password";
        }




       

       
       
          
    }

}

?>