<?php
session_start();
require "../dbconnection.php";
if(isset($_SESSION["acOfficer"])){

  $data = $_SESSION["acOfficer"];
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

<?php include "./acOfficerNav.php" ?>


<h1 class="text-decoration-underline text-center fw-bold text-uppercase my-4">my profile</h1>

        <div class="col-12 col-md-4">
            <div class="d-flex flex-column justify-content-center align-items-center border border-dark p-2 rounded">
                <?php 
                  $img_rs = Database::search("SELECT `imgpath` FROM `academicofficer` WHERE `id`='".$data["id"]."'");
                  $img_data = $img_rs->fetch_assoc();
                ?>
                <img src="<?php
                  if(empty($img_data["imgpath"])){
                    echo "./profileImg/userAcoffi.jpg";
                  }else{
                    echo $img_data["imgpath"];
                  }
                ?>" class="rounded w-75 h-75" alt="profile image" id="viewImg">
                <h5><?php echo $data["name"] ?></h5>
                <label for="Ac_profileImg" class="btn btn-primary mt-3 mb-5 w-75 mx-auto" onclick="ChangeProImg();">Set Profile Image</label>
                <input type="file" class="d-none" id="Ac_profileImg" accept="image/*"/>
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
                    <button type="submit" class="btn fw-bold mx-2 btn-primary border border-dark rounded-pill" onclick="updateAccOfficerProfile();">Update</button>
               </div>
            </div>
        </div>
    
    </div>
</div>


    <script src="./acOfficer.js"></script>
    <script src="../bootstrap.js"></script>
    <script src="../bootstrap.bundle.js"></script>

</body>
</html>
  
<?php

}else{
  header("Location:../academicOfficerLogIn.php");
}
?>




