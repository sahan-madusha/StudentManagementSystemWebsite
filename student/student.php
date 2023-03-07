<?php
session_start();
require "../dbconnection.php";
if(isset($_SESSION["student"])){

  $data = $_SESSION["student"];
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

<?php include "./studebtNavBar.php" ?>


<h1 class="text-decoration-underline text-center fw-bold text-uppercase my-4">my profile</h1>

        <div class="col-12 col-md-4">
            <div class="d-flex flex-column justify-content-center align-items-center border border-dark p-2 rounded">
                <?php 
                  $img_rs = Database::search("SELECT `imgpath` FROM `student` WHERE `id`='".$data["id"]."'");
                  $img_data = $img_rs->fetch_assoc();
                ?>
                <img src="<?php
                  if(empty($img_data["imgpath"])){
                    echo "./profileImg/userStudent.jpg";
                  }else{
                    echo $img_data["imgpath"];
                  }
                ?>" class="rounded w-75 h-75" alt="profile image" id="viewImg">
                <h5><?php echo $data["name"] ?></h5>
                <label for="S_profileImg" class="btn btn-primary mt-3 mb-5 w-75 mx-auto" onclick="ChangeProImg();">Set Profile Image</label>
                <input type="file" class="d-none" id="S_profileImg" accept="image/*"/>
            </div>
        </div>

        <div class="col-12 col-md-8">
            <div>
                <label  class="form-label offset-2">Name</label>
                <input type="text" class="form-control w-75 mx-auto mb-3 text-center border border-dark" id="usn" value="<?php echo $data["name"] ?>">

                <label for="" class="form-label offset-2">Mobile Number</label>
                <input type="text" class="form-control w-75  mx-auto mb-3 text-center border border-dark" id="usm" value="<?php echo $data["mobile"] ?>">

                <label class="form-label offset-2">Change Password</label>
                <div class="input-group mb-3 w-75 mx-auto ">
                    <input type="password" class="form-control w-75  mx-auto  border border-dark" id="usp" value="<?php echo $data["password"] ?>" >
                    <button class="btn btn-outline-secondary" type="button" ><i class="bi bi-eye-slash-fill"></i></button>
                </div>

               <div class="text-center mt-5">
                    <button type="submit" class="btn fw-bold mx-2 btn-primary border border-dark rounded-pill" onclick="updateStudentProfile();">Update</button>
               </div>

               <h1 class="mt-5 text-decoration-underline text-center fw-bold text-uppercase">Class Fees</h1>

                    <div class="d-flex flex-column justify-content-center align-items-center mt-4 text-center">
                      <?php
                      $sub_rs = Database::search("SELECT subject,subject.id  FROM student INNER JOIN subject ON
                      student.sub1 = subject.id OR  student.sub2 = subject.id OR student.sub3 = subject.id WHERE student.id = '".$data["id"]."'");
                      $sub_num = $sub_rs->num_rows;

                      for($w=0;$w<$sub_num;$w++){
                        $sub_data = $sub_rs->fetch_assoc();

                        $pay_rs = Database::search("SELECT fees FROM teacher WHERE `subject_id`='".$sub_data["id"]."'");
                        $pay_data = $pay_rs->fetch_assoc();
                        ?>
                          <button id="payhere-payment" class="btn btn-primary px-3  rounded fw-bold" onclick="studentpay('<?php echo $sub_data['id'] ?>','<?php echo $pay_data['fees'] ?>')"><?php echo $sub_data["subject"]?> - pay - <?php echo $pay_data["fees"] ?></button>
                          <?php
                          $date_rs = Database::search("SELECT exdate FROM `studentsub` WHERE `subject_id`='".$sub_data["id"]."' AND `student_id`='".$data["id"]."' ");
                          $date_data = $date_rs->fetch_assoc();
                          ?>
                          <p class="mb-5 fw-bold">next date - <?php echo $date_data["exdate"] ?> </p>
                        <?php
                      }
                      ?>
                    </div>
                  </div>
            </div>
        </div>

    </div>
</div>


    <script src="./stScript.js"></script>
    <script src="../bootstrap.js"></script>
    <script src="../bootstrap.bundle.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>

</body>
</html>
  
<?php

}else{
  header("Location:../academicOfficerLogIn.php");
}
?>




