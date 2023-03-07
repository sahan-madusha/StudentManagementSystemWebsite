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
    <div>
      <?php
      $grd2_rs = Database::search("SELECT * FROM `grade`");

      $grd2_num = $grd2_rs->num_rows;
      for($y=0;$y<$grd2_num;$y++){
        $grd2_data = $grd2_rs->fetch_assoc();
        ?>
        
        <div class="mt-4" style="height:50%; overflow: scroll;">
          <h2 class="text-center">Grade - <?php echo $grd2_data["grade"] ?></h2>
          <table class="table table-secondary table-striped w-75 text-center mx-auto">
                <thead>
                  <tr>
                    <th scope="col">id</th>
                    <th scope="col">Student name</th>
                    <th scope="col">E mail</th>
                    <th scope="col">Mobile</th>
                  </tr>
                </thead>
                <tbody>
          <?php
          $st_rs = Database::search("SELECT grade.id,`name`,`sub1`,`sub2`,`sub3`,email,mobile FROM `student` INNER JOIN grade ON 
          grade.id = student.grade_id INNER JOIN stream ON
          stream.id = student.stream_id INNER JOIN subject ON
          subject.id = student.sub1 WHERE `grade`='".$grd2_data["grade"]."' AND 
           `stream_id`='".$_SESSION["teacher"]["stream_id"]."' AND `sub1`='".$_SESSION["teacher"]["subject_id"]."' OR
            `sub2`='".$_SESSION["teacher"]["subject_id"]."' OR `sub3`='".$_SESSION["teacher"]["subject_id"]."'");

            $st_num = $st_rs->num_rows;

            ?>
            <h5 class="text-center">Student count - <?php echo $st_num ?></h5>
            <?php

            for($q=0;$q<$st_num;$q++){
              $st_data = $st_rs->fetch_assoc();
              ?>
              
              
                  <tr>
                    <th scope="row"><?php echo $q+1 ?></th>
                    <td><?php echo $st_data["name"] ?></td>
                    <td><a href="mailto:<?php echo $st_data["email"] ?>"><?php echo $st_data["email"] ?></a></td>
                    <td><a href="tel:<?php echo $st_data["mobile"] ?>"><?php echo $st_data["mobile"] ?></a></td>
                  </tr>
               
              
              <?php
            }
          ?>
           </tbody>
              </table>
        </div>
        <button class="btn btn-primary mt-5 text-center" onclick="window.location ='./assignment.php?id=<?php echo $grd2_data['id']?>&g=<?php echo $grd2_data['grade']?>'">Assignment</button>
        <hr>

        
        <?php
      }

      ?>
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




