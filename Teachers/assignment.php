<?php
session_start();
require "../dbconnection.php";
$grade_id = $_GET["id"];
$grade = $_GET["g"];
if(isset($_SESSION["teacher"])){

    $data = $_SESSION["teacher"];
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

<?php include "./TeacherNavBar.php";?>

<h2 class="text-center mb-4 mt-2 text-decoration-underline text-uppercase">Grade - <?php echo $grade?></h2>

<?php
   $less_rs = Database::search("SELECT `lesson` FROM `lesson` WHERE `teacher_id`='".$data["id"]."' AND `grade_id`='".$grade_id."' ORDER BY `id` DESC ");
   $less_num = $less_rs->num_rows;

   for($x=0;$x<$less_num;$x++){
    $less_data = $less_rs->fetch_assoc();
    ?>

    <div style="overflow-y: scroll;">
        <h3 class="offset-2 text-decoration-underline"><?php echo $less_data["lesson"] ?></h3>
            <table class="table table-secondary table-striped w-100 text-center mx-auto">
                <thead>
                  <tr>
                    <th scope="col">id</th>
                    <th scope="col">Student name</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">Assignment</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                    $student_rs = Database::search("SELECT assignment.id AS Aid ,student.id,assignment.teacher_id,lesson,student.id, student.name,student.mobile,assignment.pdf,lesson
                    FROM `assignment` INNER JOIN `teacher` ON
                    assignment.teacher_id = teacher.id INNER JOIN `student` ON
                    assignment.student_id = student.id 
                    WHERE `teacher_id` = '".$data["id"]."' AND `grade_id` ='".$grade_id."' AND lesson = '".$less_data["lesson"]."' ");
    
                    $student_num = $student_rs->num_rows;
    
                    for($q=0;$q<$student_num;$q++){
                        $student_data = $student_rs->fetch_assoc();
                        ?>
                        
                         <tr>
                          <td><?php echo $x+1 ?></td>
                          <td><?php echo $student_data["name"];?></td>
                          <td><a href="tel:<?php echo $student_data["mobile"];?>"><?php echo $student_data["mobile"];?></a></td>
                          <td><a 
                          <?php
                            $mark_rs = Database::search("SELECT `mark` FROM mark WHERE `assignment_id`='".$student_data["Aid"]."' AND `student_id`='".$student_data["id"]."' ");
                            $mark_num = $mark_rs->num_rows;
                            $mark_data = $mark_rs->fetch_assoc();

                            if($mark_num==1){
                              $mark = $mark_data["mark"];
                                echo 'style="color: red !important;"';
                            }else{
                              $mark = "No Added";
                              echo 'style="color: black !important;"';
                                }
                            ?>
                          href="./assignmentView.php?pdf=<?php echo $student_data["pdf"]?>&AId=<?php echo $student_data["Aid"]?>&sId=<?php echo $student_data["id"]?>" target="_blanck"><?php echo $student_data["lesson"];?> -- <?php echo $mark;?></a></td>
                        </tr>
                        <?php
                    }
    
                    ?>
                </tbody>
            </table>
    </div>



    <?php
   }
  




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




