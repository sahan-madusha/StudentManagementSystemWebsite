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
    $stream = $_POST["stm"];
    $grade = $_POST["grd"];
    $subject1 = $_POST["sub1"];
    $subject2 = $_POST["sub2"];
    $subject3 = $_POST["sub3"];
    $pass = $_POST["pass"];
    $AcId = $_SESSION["acOfficer"]["id"];


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
    }elseif(empty($stream)){
        echo("please select stream !");
    }elseif(empty($grade)){
        echo("please select grade !");
    }elseif(empty($subject1)){
        echo("please select subject !");
    }elseif(empty($gender)){
        echo("please select gender !");
    }elseif(empty($pass)){
        echo "Please enter your password";
    }elseif(!preg_match("/^.{5,}$/",$pass)){
        echo "password must be between 5 - 20 charactors";
    }else{

        $st_rs = Database::search("SELECT `email`,`nic` FROM `student` WHERE `email`='".$email."' AND `nic`= '".$nic."' ");
        $st_num = $st_rs->num_rows;

        //others
        $user_id = "7";
        $Index = rand(1,100000);

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d");

        if($st_num==1){
            echo "Already add this data";
        }else{

            Database::iud("INSERT INTO `student`
             (`name`, 
             `nic`, 
             `mobile`, 
             `email`, 
             `gender_id`, 
             `stream_id`, 
             `grade_id`, 
             `sub1`, 
             `sub2`, 
             `sub3`, 
             `password`, 
             `indexNum`, 
             `user_id`, 
             `regdate`, 
             `academicofficer_id`) VALUES
              ( '".$name."', 
                '".$nic."', 
                '".$mobile."',
                '".$email."', 
                '".$gender."',
                '".$stream."', 
                '".$grade."', 
                '".$subject1."', 
                '".$subject2."', 
                '".$subject3."', 
                '".$pass."', 
                '".$Index."', 
                '".$user_id."', 
                '".$date."', 
                '".$AcId."')");

                $d = new DateTime();
                $tz = new DateTimeZone("Asia/Colombo");
                $d->setTimezone($tz);
                $date = $d->format("Y-m-d");
                $expireDate=date('Y-m-d', strtotime('+1 month'));



                $stu_rs = Database::search("SELECT `id` FROM `student` WHERE `email`='".$email."'");
                $stu_data = $stu_rs->fetch_assoc();
                $payId = "2";
                Database::iud("INSERT INTO `studentSub` 
                (`subject_id`, 
                 `paymnet_id`, 
                 `student_id`, 
                 `date`, 
                 `exdate`) VALUES 
                ('".$subject1."', 
                 '".$payId."', 
                 '".$stu_data["id"]."', 
                 '".$date."', 
                 '".$expireDate."');
                ");
                Database::iud("INSERT INTO `studentSub` 
                (`subject_id`, 
                 `paymnet_id`, 
                 `student_id`, 
                 `date`, 
                 `exdate`) VALUES 
                ('".$subject2."', 
                 '".$payId."', 
                 '".$stu_data["id"]."', 
                 '".$date."', 
                 '".$expireDate."');
                ");
                Database::iud("INSERT INTO `studentSub` 
                (`subject_id`, 
                 `paymnet_id`, 
                 `student_id`, 
                 `date`, 
                 `exdate`) VALUES 
                ('".$subject2."', 
                 '".$payId."', 
                 '".$stu_data["id"]."', 
                 '".$date."', 
                 '".$expireDate."');
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
                $mail->setFrom($_SESSION["acOfficer"]["email"], 'Notes.lk');
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