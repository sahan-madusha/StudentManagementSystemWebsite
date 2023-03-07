<?php
session_start();
require "../dbconnection.php";
$data = $_SESSION["admin"];
   
if(isset( $_SESSION["admin"])){
$search = $_POST["s"];

$student_rs = Database::search("SELECT student.id,name,email,regdate,mobile,indexNum,stream,grade FROM student INNER JOIN stream ON
            student.stream_id = stream.id INNER JOIN grade ON
            student.grade_id = grade.id WHERE `email` LIKE '%".$search."%' ");
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
                <?php


}



?>