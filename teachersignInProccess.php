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

        $vcode_rs = Database::search("SELECT `vcode`,`confimCode`,`email` FROM `teacher` WHERE `email`='".$email."' ");
        $vcode_data = $vcode_rs->fetch_assoc();
    
        if(empty($vcode_data["confimCode"])){
            if(empty($vcode)){
                echo "please enter Your verification code";
            }else{
                $tev_rs = Database::search("SELECT * FROM `teacher` WHERE `email`='".$email."' AND `password`='".$pass."' AND `vcode`='".$vcode."'");
                $tev_num = $tev_rs->num_rows;

                if($tev_num==1){
                    Database::iud("UPDATE `teacher` SET confimCode = '".$vcode."' WHERE `email`='".$email."'");

                    $tev_data = $tev_rs->fetch_assoc();
                    $_SESSION["teacher"] =$tev_data;

                    if($rememberMe=="true"){
                        setcookie("Teemail",$email,time()+(60*60*24*365));
                        setcookie("Tepass",$pass,time()+(60*60*24*365));
                    }else{
                        setcookie("Teemail","",-1);
                        setcookie("Tepass","",-1);
                    }

                    echo "done";
                    exit();

                }else{
                    echo "invalid user name or password";
                }
            }      
        }else{

        $te_rs = Database::search("SELECT * FROM `teacher` WHERE `email`='".$email."' AND `password`='".$pass."'");
        $te_num = $te_rs->num_rows;

        if($te_num==1){
            $te_data = $te_rs->fetch_assoc();
            $_SESSION["teacher"] =$te_data;

            if($rememberMe=="true"){
                setcookie("Teemail",$email,time()+(60*60*24*365));
                setcookie("Tepass",$pass,time()+(60*60*24*365));
            }else{
                setcookie("Teemail","",-1);
                setcookie("Tepass","",-1);
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