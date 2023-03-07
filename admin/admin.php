<?php
session_start();
require "../dbconnection.php";
if(isset($_SESSION["admin"])){
  ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes.lk - admin panel</title>

    <link rel="stylesheet" href="./admin.css">

    <link rel="shortcut icon" href="./adminImg/logo.svg" type="image/x-icon">

    <link rel="stylesheet" href="../bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body class="bg-light">

<?php include './adminNav.php'; ?>

<!-- dash board -->

<div class="container-fluid">
    <div class="row">

        <!--count-->
        <div class="d-flex flex-column bg-light my-3 mx-2">
        <div>
            <h4>Report Summary</h4>
        </div>
        <div>
            <div class="d-flex flex-column flex-lg-row justify-content-around border border-dark rounded p-4 ">
                <div class="p-2 mx-1 my-1">
                    <div class="d-flex flex-row align-items-baseline">

                        <?php
                        $student_rs = Database::search("SELECT `id` FROM `student`");
                        $student_num = $student_rs->num_rows;
                        ?>

                        <h4>Total Student - <?php echo $student_num ?></h4>
                        <div style="background-color:#38ce3c;" class="p-3 border border-0 rounded ms-3">
                            <i class="fa fa-child fs-4" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="p-2 mx-1 my-1">
                    <div class="d-flex flex-row align-items-baseline">
                      <?php
                      $teacher_rs =Database::search("SELECT `id` FROM `teacher`");
                      $teacher_num = $teacher_rs->num_rows;
                      ?>
                        <h4>Total Teacher - <?php echo $teacher_num ?></h4>
                        <div style="background-color:#ff4d6b;" class="p-3 border border-0 rounded ms-3">
                            <i class="fa fa-user-circle fs-4" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="p-2 mx-1 my-1">
                    <div class="d-flex flex-row align-items-baseline">
                      <?php
                      $acOf_rs = Database::search("SELECT `id` FROM `academicofficer`");
                      $acOf_num = $acOf_rs->num_rows;
                      ?>
                        <h4>Total  Academic Officer - <?php echo $acOf_num ?></h4>
                        <div style="background-color:#1bdbe0;" class="p-3 border border-0 rounded ms-3">
                            <i class="fa fa-users fs-4" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        </div>

        <!--summery-->
        <div>
            <!--student-->
            <div class="my-3 ms-0 ms-md-5 border border-dark rounded p-3" >
            <h1 class="text-center">Best</h1>
              <div>
                  <div class="border border-dark rounded p-3 my-5 text-center"style="background-color:#1bdbe0;">
                    <h2 class="mb-5"><i class="fa fa-users fs-5" aria-hidden="true"></i>&nbsp; The academic officer who recruited the most number of students</h2>
                    <?php
                      $ac_rs = Database::search("SELECT MAX(academicofficer_id) , academicofficer.name FROM student INNER JOIN academicofficer ON
                      academicofficer.id = student.academicofficer_id");
                      $ac_data = $ac_rs->fetch_assoc();

                      $count_rs = Database::search("SELECT COUNT(id) FROM student WHERE `academicofficer_id`='".$ac_data["MAX(academicofficer_id)"]."'");
                      $count_data = $count_rs->fetch_assoc();
                    ?>
                    <h5>Name - <?php echo $ac_data["name"] ?></h5>
                    <h5>Number Of Student - <?php echo $count_data["COUNT(id)"] ?></h5>
                  </div>
              </div>

            <!---->

        </div>
    </div>
</div>


    <script src="./admin.js"></script>
    <script src="../bootstrap.js"></script>
    <script src="../bootstrap.bundle.js"></script>

</body>
</html>
  
<?php

}else{
  header("Location:../adminsignIn.php");
}
?>




