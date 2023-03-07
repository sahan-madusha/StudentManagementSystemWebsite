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
    }elseif(empty($gender)){
        echo("please select gender !");
    }elseif(empty($pass)){
        echo "Please enter your password";
    }elseif(!preg_match("/^.{5,}$/",$pass)){
        echo "password must be between 5 - 20 charactors";
    }else{

        $acOff_rs = Database::search("SELECT `email`,`nic` FROM `academicofficer` WHERE `email`='".$email."' AND `nic`= '".$nic."' ");
        $acOff_num = $acOff_rs->num_rows;

        //others
        $vcode = uniqid();
        $user_id = "8";

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d");

        if($acOff_num==1){
            echo "Already add this data";
        }else{

            Database::iud("INSERT INTO `academicofficer`
            (`name`,
             `email`,
             `gender_id`,
             `nic`,
             `mobile`,
             `password`,
             `vcode`,
             `user_id`,
             `rgdate`) VALUES
            ('".$name."',
             '".$email."',
             '".$gender."',
             '".$nic."',
             '".$mobile."',
             '".$pass."',
             '".$vcode."',
             '".$user_id."',
             '".$date."')
 
              ");


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
            $mail->setFrom($_SESSION["admin"]["emaiil"], 'Notes.lk');
            $mail->addReplyTo(false);
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'notes.lk email Verification Code';
            $bodyContent = '
            
            <div style="text-align: center;">
                <h1>NOTES.LK</h1>
                <h2>Hi '.$gen.' ' .$name.'</h2>
                <ul style="list-style: none;">
                    <li>User name - '.$name.'  </li>
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