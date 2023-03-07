<?php
session_start();
require "../dbconnection.php";
if(isset($_SESSION["acOfficer"])){
  ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes.lk - admin panel</title>


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


<!--sign up-->
<div class="border border-dark rounded py-3 m-3">
            <h3 class="fw-bold mb-4 text-decoration-underline text-center">Student's Registation</h3>

                <label  class="form-label offset-2">Name</label>
                <input type="text" class="form-control w-75 mx-auto mb-3 text-center border border-dark" id="sn">

                <label for="" class="form-label offset-2">NIC</label>
                <input type="text" class="form-control w-75 mx-auto mb-3 text-center border border-dark" id="snic" >

                <label for="" class="form-label offset-2">Mobile Number</label>
                <input type="text" class="form-control w-75  mx-auto mb-3 text-center border border-dark" id="sm">

                <label for="" class="form-label offset-2">E mail</label>
                <input type="email" class="form-control w-75  mx-auto mb-3 text-center border border-dark" id="se">

                <label for="" class="form-label offset-2">Gender</label>
                <select class="form-select w-75  mx-auto mb-3 text-center border border-dark" id="sg">
                    <?php
                    $gen_rs = Database::search("SELECT * FROM `gender`");
                    $gen_num = $gen_rs->num_rows;

                    for($x=0;$x<$gen_num;$x++){
                        $gen_data = $gen_rs->fetch_assoc();
                        ?>
                        <option value="<?php echo $gen_data["id"] ?>"><?php echo $gen_data["gender"] ?></option>
                        <?php
                    }
                    ?>
                </select>

                <label for="" class="form-label offset-2">Stream</label>
                <select class="form-select w-75  mx-auto mb-3 text-center border border-dark" id="sstrm">
                    <?php
                    $strm_rs = Database::search("SELECT * FROM `stream`");
                    $strm_num = $strm_rs->num_rows;

                    for($x=0;$x<$strm_num;$x++){
                        $strm_data = $strm_rs->fetch_assoc();
                        ?>
                        <option value="<?php echo $strm_data["id"] ?>"><?php echo $strm_data["stream"] ?></option>
                        <?php
                    }
                    ?>
                </select>

                <label for="" class="form-label offset-2">Grade</label>
                <select class="form-select w-75  mx-auto mb-3 text-center border border-dark" id="sgrd">
                    <?php
                    $grd_rs = Database::search("SELECT * FROM `grade`");
                    $grd_num = $grd_rs->num_rows;

                    for($x=0;$x<$grd_num;$x++){
                        $grd_data = $grd_rs->fetch_assoc();
                        ?>
                        <option value="<?php echo $grd_data["id"] ?>"><?php echo $grd_data["grade"] ?></option>
                        <?php
                    }
                    ?>
                </select>

                <label for="" class="form-label offset-2">subject - 1</label>
                <select class="form-select w-75  mx-auto mb-3 text-center border border-dark" id="ssbjct1">
                <option value="0">--subject -1 --</option>
                    <?php
                    $sub1_rs = Database::search("SELECT * FROM `subject`");
                    $sub1_num = $sub1_rs->num_rows;

                    for($x=0;$x<$sub1_num;$x++){
                        $sub1_data = $sub1_rs->fetch_assoc();
                        ?>
                        <option value="<?php echo $sub1_data["id"] ?>"><?php echo $sub1_data["subject"] ?></option>
                        <?php
                    }
                    ?>
                </select>

                <label for="" class="form-label offset-2">subject - 2</label>
                <select class="form-select w-75  mx-auto mb-3 text-center border border-dark" id="ssbjct2">
                <option value="0">--subject -2 --</option>
                    <?php
                    $sub2_rs = Database::search("SELECT * FROM `subject`");
                    $sub2_num = $sub2_rs->num_rows;

                    for($x=0;$x<$sub2_num;$x++){
                        $sub2_data = $sub2_rs->fetch_assoc();
                        ?>
                        <option value="<?php echo $sub2_data["id"] ?>"><?php echo $sub2_data["subject"] ?></option>
                        <?php
                    }
                    ?>
                </select>

                <label for="" class="form-label offset-2">subject - 3</label>
                <select class="form-select w-75  mx-auto mb-3 text-center border border-dark" id="ssbjct3">
                    <option value="0">--subject -3 --</option>
                    <?php
                    $sub3_rs = Database::search("SELECT * FROM `subject`");
                    $sub3_num = $sub3_rs->num_rows;

                    for($x=0;$x<$sub3_num;$x++){
                        $sub3_data = $sub3_rs->fetch_assoc();
                        ?>
                        <option value="<?php echo $sub3_data["id"] ?>"><?php echo $sub3_data["subject"] ?></option>
                        <?php
                    }
                    ?>
                </select>


                <label class="form-label offset-2">Password</label>
                <div class="input-group mb-3 w-75 mx-auto ">
                    <input type="password" class="form-control w-75  mx-auto  border border-dark" id="sp" >
                    <button class="btn btn-outline-secondary" type="button" ><i class="bi bi-eye-slash-fill"></i></button>
                </div>

               <div class="text-center mt-5">
                    <button type="submit" class="btn fw-bold mx-2 btn-primary border border-dark rounded-pill" onclick="StudentSignup(); sendVfEmail();">Save & Send Email</button>
               </div>

        </div>
        <!--sign up-->

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




