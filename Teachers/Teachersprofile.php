<?php
session_start();
require "../dbconnection.php";
if(isset($_SESSION["teacher"])){

    $Tdata = $_SESSION["teacher"];
  ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes.lk</title>


    <link rel="stylesheet" href="../style.css">
    <link rel="shortcut icon" href="./logo.svg" type="image/x-icon">

    <link rel="stylesheet" href="../bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body class="bg-light">
<!-- dash board -->

<div class="container-fluid">
    <div class="row">

<?php include "./TeacherNavBar.php";
$data_rs = Database::search("SELECT * FROM `teacher` WHERE `id`='".$Tdata["id"]."' ");
 $data = $data_rs->fetch_assoc();
?>

<h1 class="text-decoration-underline text-center fw-bold text-uppercase my-4">my profile</h1>

        <div class="col-12 col-md-4">
            <div class="d-flex flex-column justify-content-center align-items-center border border-dark p-2 rounded">
                <img src="<?php if(empty($data["imgpath"])){
                    echo "./profileImg/userTecher.jpg";
                }else{
                    echo $data["imgpath"];
                }
                 ?>" class="rounded w-75 h-75" alt="profile image" id="viewImg">
                <h5><?php echo $data["name"] ?></h5>
                <label for="Te_profileImg" class="btn btn-primary mt-3 mb-5 w-75 mx-auto" onclick="ChangeProImg();">Set Profile Image</label>
                <input type="file" class="d-none" id="Te_profileImg" accept="image/*"/>
            </div>
        </div>

        <div class="col-12 col-md-8">
            <div>
                <label  class="form-label offset-2">Name</label>
                <input type="text" class="form-control w-75 mx-auto mb-3 text-center border border-dark" id="utn" value="<?php echo $data["name"] ?>">

                <label for="" class="form-label offset-2">Mobile Number</label>
                <input type="text" class="form-control w-75  mx-auto mb-3 text-center border border-dark" id="utm" value="<?php echo $data["mobile"] ?>">

                <label for="" class="form-label offset-2">E mail</label>
                <input type="text" class="form-control w-75  mx-auto mb-3 text-center border border-dark"  value="<?php echo $data["email"] ?>" disabled>

                <label for="" class="form-label offset-2">Class Fee</label>
                <input type="text" class="form-control w-75  mx-auto mb-3 text-center border border-dark" id="uclzfees" value="<?php echo $data["fees"];?>">

                <label class="form-label offset-2">Change Password</label>
                <div class="input-group mb-3 w-75 mx-auto ">
                    <input type="password" class="form-control w-75  mx-auto  border border-dark" id="utp" value="<?php echo $data["password"] ?>" >
                    <button class="btn btn-outline-secondary" type="button" ><i class="bi bi-eye-slash-fill"></i></button>
                </div>

               <div class="text-center mt-5">
                    <button type="submit" class="btn fw-bold mx-2 btn-primary border border-dark rounded-pill" onclick="updateTechersProfile();">Update</button>
               </div>
            </div>
        </div>


        <h1 class="text-decoration-underline text-center fw-bold text-uppercase my-5">payment details</h1>

        <?php
         $thisMonth = date("m");

         $date_rs = Database::search("SELECT * FROM `studentsub` WHERE `subject_id`='".$Tdata["subject_id"]."'");
         
         $date_num = $date_rs->num_rows;
         $date_data = $date_rs->fetch_assoc();
         $splitMoth = explode("-",$date_data["date"]);


        $student_rs = Database::search("SELECT name,email FROM `studentsub` INNER JOIN student ON
        student.id = studentsub.student_id WHERE  MONTH(DATE)='".$thisMonth."' AND `subject_id`= '".$Tdata["subject_id"]."' ");
        $student_num = $student_rs->num_rows;

        ?>
        
        <div class="d-flex justify-content-center align-items-center flex-column">
            <h2>Count - <?php echo $student_num ?> </h2>
            <h2>Total - <?php echo ($student_num*$Tdata["fees"]) ?></h2>
            <ul >
                <?php
                for($x=0;$x<$student_num;$x++){
                    $student_data = $student_rs->fetch_assoc();
                    ?>
                    <li><?php echo $student_data["name"]?> - <?php echo $student_data["email"]?> </li>
                    <?php
                }
                ?>
            </ul>
        </div>

        <?php
        ?>
        

    </div>
</div>


    <script src="./teScript.js"></script>
    <script src="../bootstrap.js"></script>
    <script src="../bootstrap.bundle.js"></script>

</body>
</html>
  
<?php

}else{
  header("Location:../academicOfficerLogIn.php");
}
?>




