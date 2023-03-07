<?php
session_start();
require "../dbconnection.php";
if(isset($_SESSION["teacher"])){
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

<?php include "./TeacherNavBar.php" ?>

        <div class=" d-flex flex-column">

        <h1 class="text-decoration-underline text-center fw-bold text-uppercase">Add Lesson & Assignment</h1>

        <label for="" class="form-label offset-2">Grade</label>
                <select class="form-select w-75  mx-auto mb-3 text-center border border-dark" id="TeGrd">
                    <option value="0">-- Select --</option>
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
            <label  class="form-label offset-2">Lesson name</label>
            <input type="text" class="form-control w-75 mx-auto mb-3 text-center border border-dark" id="Teless">

            <label  class="form-label offset-2">Link</label>
            <input type="text" class="form-control w-75 mx-auto mb-3 text-center border border-dark" id="Telink">

            <label for="assignmentAdd" class="btn btn-primary mt-3 w-75 mx-auto">assignment Upload</label>
            <input type="file" class="d-none" id="assignmentAdd" accept="application/pdf"/>

        </div>

        <div class="my-5 text-center">
        <button class="btn btn-danger rounded-pill w-25" onclick="UploadLesson();">Upload</button>
        </div>

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




