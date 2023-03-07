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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body class="bg-light">

<?php include './adminNav.php'; ?>

<!-- dash board -->

<div class="container">
    <div class="row">
 <!--student payment and grade up and result-->
 <div class="m-3 border border-dark rounded p-3" style="height: 80vh; overflow: scroll;" >
    <h2 class="my-3 ">Student Summary</h2>
    <div class="input-group w-50 my-4">
        <input type="text" class="form-control" placeholder="Search" id="stSearch">
        <button class="btn btn-primary" type="button" onclick="stSearch()" >Search</button>
    </div>
        <table class="table table-secondary table-striped w-100 text-center" >
            <thead>
              <tr>
                <th scope="col"></th>
                <th scope="col">Index Number</th>
                <th scope="col">Name</th>
                <th scope="col">Stream</th>
                <th scope="col">Grade</th>
                <th>reg date</th>
                <th>mobile</th>
                <th>average</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="table">
            <?php
            $student_rs = Database::search("SELECT student.id,name,email,regdate,mobile,indexNum,stream,grade FROM student INNER JOIN stream ON
            student.stream_id = stream.id INNER JOIN grade ON
            student.grade_id = grade.id");
            $student_num = $student_rs->num_rows;

            for($x=0;$x<$student_num;$x++){
              $student_data = $student_rs->fetch_assoc();

              $mark_rs = Database::search("SELECT AVG(mark) FROM `mark` WHERE student_id = '".$student_data["id"]."'");
              $mark_data = $mark_rs->fetch_assoc();

            ?>
            <tr>
                <th><?php echo $x+1 ?></th>
                <td><?php echo $student_data["indexNum"];?></td>
                <td><?php echo $student_data["name"];?></td>
                <td><?php echo $student_data["stream"];?></td>
                <td><?php echo $student_data["grade"];?></td>
                <td><?php echo $student_data["regdate"];?></td>
                <td><a href="tel:<?php echo $student_data["mobile"];?>"><?php echo $student_data["mobile"];?></a></td>
                <td><?php echo $mark_data["AVG(mark)"];?></td>
                <td><button class="btn btn-danger" onclick="deleteStudent('<?php echo $student_data['id'] ?>')">Delete</button></td>
              </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
  </div>
        <!---->




    </div>
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