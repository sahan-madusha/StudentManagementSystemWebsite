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

        $vcode_rs = Database::search("SELECT `vcode`,`confimCode`,`email` FROM `academicofficer` WHERE `email`='".$email."' ");
        $vcode_data = $vcode_rs->fetch_assoc();

        if(empty($vcode_data["confimCode"])){
            if(empty($vcode)){
                echo "please enter Your verification code";
            }else{
                $acOffv_rs = Database::search("SELECT * FROM `academicofficer` WHERE `email`='".$email."' AND `password`='".$pass."' AND `vcode`='".$vcode."'");
                $acOffv_num = $acOffv_rs->num_rows;

                    Database::iud("UPDATE `academicofficer` SET confimCode = '".$vcode."'  WHERE `email`='".$email."' ");

                if($acOffv_num==1){
                    $acOffv_data = $acOffv_rs->fetch_assoc();
                    $_SESSION["acOfficer"] =$acOffv_data;

                    if($rememberMe=="true"){
                        setcookie("AcOffemail",$email,time()+(60*60*24*365));
                        setcookie("AcOffpass",$pass,time()+(60*60*24*365));
                    }else{
                        setcookie("AcOffemail","",-1);
                        setcookie("AcOffpass","",-1);
                    }

                    echo "done";
                    exit();

                }else{
                    echo "invalid user name or password";
                }

            }
        }else{
            $acOff_rs = Database::search("SELECT * FROM `academicofficer` WHERE `email`='".$email."' AND `password`='".$pass."'");
            $acOff_num = $acOff_rs->num_rows;

            if($acOff_num==1){
                $acOff_data = $acOff_rs->fetch_assoc();
                $_SESSION["acOfficer"] =$acOff_data;

                if($rememberMe=="true"){
                    setcookie("AcOffemail",$email,time()+(60*60*24*365));
                    setcookie("AcOffpass",$pass,time()+(60*60*24*365));
                }else{
                    setcookie("AcOffemail","",-1);
                    setcookie("AcOffpass","",-1);
                }

                echo "done";
                exit();

            }else{
                echo "invalid user name or password";
            }
        }
        
    }

}

?>