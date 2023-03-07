<?php
session_start();
require "../dbconnection.php";
if(isset($_SESSION["student"])){

  $data = $_SESSION["student"];
  $subId = $_GET["id"];
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

<?php include "./studebtNavBar.php";
$less_rs = Database::search("SELECT * FROM lesson WHERE `subject_id`='".$subId."' AND `grade_id`='".$data["grade_id"]."' AND `stream_id`='".$data["stream_id"]."'");
$less_num = $less_rs->num_rows;

$pay_rs = Database::search("SELECT * FROM `studentsub` WHERE `student_id`='".$data["id"]."' AND `subject_id`='".$subId."' AND `paymnet_id`='1' ");
$pay_num = $pay_rs->num_rows;

if($pay_num==1){
    ?>
    <div class="col-12 col-md-2">
                <div class="d-flex justify-content-center align-align-items-center flex-column">
                    <h4 class="text-center mt-4 fw-bold text-uppercase">Lesson summary</h4>
                    <table class="table table-secondary table-striped w-100 text-center">
                        <thead>
                          <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Lesson</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php
                                for($x=0;$x<$less_num;$x++){
                                    $less_data = $less_rs->fetch_assoc();

                                        $te_id = $less_data["teacher_id"];
                                        $lesson_name = $less_data["lesson"];
                                        $assi_id = $less_data["id"];
                                    ?>
                                    <tr>
                                      <th scope="row"><?php echo $x+1 ?></th>
                                      <?php 
                                      $mark_rs = Database::search("SELECT `mark` FROM mark INNER JOIN assignment ON 
                                      mark.assignment_id = assignment.id WHERE subject_id = '".$subId."' AND mark.student_id = '".$data["id"]."' AND lesson = '".$less_data['lesson']."' ");
                                      $mark_num = $mark_rs->num_rows;
                                      
                                      ?>
                                      <th><a href="#" onclick="LessonLink('<?php echo $less_data['link'] ?>','<?php echo $less_data['pdf'] ?>','<?php echo $less_data['lesson'] ?>',
                                      '<?php if($mark_num==1){$mark_data = $mark_rs->fetch_assoc();echo $less_data['lesson'].' mark '.$mark_data['mark'].'%';}else{echo 'Not marked';} ?>')"><?php echo $less_data["lesson"]?></a></th>
                                    </tr>
                                    <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-12 col-md-10 mx-auto ">
                <div class="d-none" id="assi_download">
                    <a href="#" id="ClassAssignment" target="_blank" class="btn btn-danger">
                        <h5 class="fw-bold text-uppercase"><span id="lessName" class=" me-4"></span> Download Assignment</h5>
                    </a>
                    <div class="input-group w-100 d-flex flex-row justify-content-center align-items-baseline mt-3 mt-md-0">
                        <label for="assignmentUp" class="border rounded fw-bold text-uppercase mx-2 p-2">assignment Upload</label>
                        <input type="file" class="d-none" id="assignmentUp" accept="application/pdf"/>
                        <button class="btn btn-primary" type="button"
                          onclick="UploadAssignment('<?php echo $subId ?>');">Upload</button>
                    </div>
                    <h3 id="Assmark" class=" text-center mx-auto mt-5 mt-md-0"></h3>
                </div>
                
                <iframe id="ClassIframe" class="w-100" style="height: 75vh;" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
    <?php
}else{
  ?>
  <div class="d-flex justify-content-center mt-5 align-items-baseline">
    <h1 class="text-center fw-bold fs-3">Expire Your membership</h1>
    <button class="btn btn-primary ms-5 rounded" onclick="window.location = './student.php' ">pay now</button>
  </div>
  <?php
}
?>

    </div>
</div>


    <script src="./stScript.js"></script>
    <script src="../bootstrap.js"></script>
    <script src="../bootstrap.bundle.js"></script>

</body>
</html>
  
<?php

}else{
  header("Location:../academicOfficerLogIn.php");
}
?>




