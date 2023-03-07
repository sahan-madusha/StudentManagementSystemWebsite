<?php
require "../dbconnection.php";
session_start();
require "../SMTP.php";
require "../PHPMailer.php";
require "../Exception.php";


use PHPMailer\PHPMailer\PHPMailer;

if(isset($_POST["e"])){

    $name = $_POST["n"];
    $nic = $_POST["nic"];
    $mobile = $_POST["mob"];
    $email = $_POST["e"];
    $stream = $_POST["stm"];
    $subject = $_POST["sub"];
    $gender = $_POST["gen"];
    $pass = $_POST["pass"];


    if(empty($name)){
        echo "Please enter your name";
    }elseif(empty($nic)){
        echo("please enter your nic number !");
    }elseif(!preg_match("/^([0-9]{9}[x|X|v|V]|[0-9]{12})$/",$nic)){
        echo("Invalid nic!");
    }elseif(empty($mobile)){
        echo("please enter your mobile !");
    }elseif(empty($email)){
        echo "Please enter your email";
    }elseif(strlen($email)>100){
        echo "Invalid email";
    }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        echo "Invalid Email";
    }elseif(empty($stream)){
        echo("please select stream !");
    }elseif(empty($subject)){
        echo("please select subject !");
    }elseif(empty($gender)){
        echo("please select gender !");
    }elseif(empty($pass)){
        echo "Please enter your password";
    }elseif(!preg_match("/^.{5,}$/",$pass)){
        echo "password must be between 5 - 20 charactors";
    }else{

        $Te_rs = Database::search("SELECT `email`,`nic` FROM `teacher` WHERE `email`='".$email."' AND `nic`= '".$nic."' ");
        $Te_num = $Te_rs->num_rows;

        //others
        $vcode = uniqid();
        $user_id = "6";

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d");

        if($Te_num==1){
            echo "Already add this data";
        }else{

            Database::iud("INSERT INTO `teacher`
            ( `name`,
              `nic`,
              `mobile`,
              `email`,
              `stream_id`,
              `gender_id`,
              `password`,
              `vcode`,
              `subject_id`,
              `user_id`,
              `regdate`)VALUES
            ( '".$name."',
              '".$nic."',
              '".$mobile."',
              '".$email."',
              '".$stream."',
              '".$gender."',
              '".$pass."',
              '".$vcode."',
              '".$subject."',
              '".$user_id."',
              '".$date."')");

              if($gender=="3"){
                $gen = "Mr.";
            }else{
                $gen = "Mrs.";
            }
        
            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'sahanmadusha001@gmail.com';
            $mail->Password = 'bapibucrvdwgogvc';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom($_SESSION["admin"]["email"], 'Notes.lk');
            $mail->addReplyTo(false);
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'notes.lk email Verification Code';
            $bodyContent = '
            
            <div style="text-align: center;">
                <h1>NOTES.LK</h1>
                <h2>Hi '.$gen.' ' .$name.'</h2>
                <ul style="list-style: none;">
                    <li>User name - '.$email.'  </li>
                    <li>Password - '.$pass.' </li>
                    <li>verification code - '.$vcode.'</li>
                </ul>
            </div>
            ';
            $mail->Body    = $bodyContent;
        
            if (!$mail->send()) {
                echo 'Verification code sending failed';
            } else {
                echo 'Success';
            }
        }

    }

}






?>