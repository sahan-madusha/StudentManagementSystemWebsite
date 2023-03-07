<?php
session_start();
require "../dbconnection.php";
if(isset($_SESSION["teacher"])){

    $data = $_SESSION["teacher"];
    $pdf =$_GET["pdf"];
    $assi_id = $_GET["AId"];
    $stu_id = $_GET["sId"];
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

        <div class=" my-2 mb-5 d-flex flex-row">
        <?php
            $mark_rs = Database::search("SELECT `mark` FROM mark WHERE `assignment_id`='".$assi_id."' AND `student_id`='".$stu_id."' ");
            $mark_num = $mark_rs->num_rows;
            $mark_data = $mark_rs->fetch_assoc();

            if($mark_num==1){
                $mark =  $mark_data["mark"];
            }else{
                    $mark = "Add mark";
                }
            ?>
            <input type="text"class="form-control w-25 text-center border border-dark" id="Assimark" value="<?php echo $mark ?>">
            
            <button class="btn btn-primary" onclick="addMark('<?php echo $assi_id?>','<?php echo $stu_id?>')" >Mark</button>
        </div>
        <div >
            <iframe src="<?php echo $pdf; ?>" frameborder="0" style="position:absolute;overflow:hidden;height:100%;width:100%" height="500%" width="100%"></iframe>+

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




