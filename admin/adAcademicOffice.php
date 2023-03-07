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

<div class="container">
    <div class="row">

        <!--sign up-->
        <div class="border border-dark rounded py-3 m-3">
            <h3 class="fw-bold mb-4 text-decoration-underline text-center">Academic Officer's Registation</h3>

                <label  class="form-label offset-2">Name</label>
                <input type="text" class="form-control w-75 mx-auto mb-3 text-center border border-dark" id="acn">

                <label for="" class="form-label offset-2">NIC</label>
                <input type="text" class="form-control w-75 mx-auto mb-3 text-center border border-dark" id="acnic" >

                <label for="" class="form-label offset-2">Mobile Number</label>
                <input type="text" class="form-control w-75  mx-auto mb-3 text-center border border-dark" id="acm">

                <label for="" class="form-label offset-2">E mail</label>
                <input type="email" class="form-control w-75  mx-auto mb-3 text-center border border-dark" id="ace">

                <label for="" class="form-label offset-2">Gender</label>
                <select class="form-select w-75  mx-auto mb-3 text-center border border-dark" id="acg">
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

                <label class="form-label offset-2">Password</label>
                <div class="input-group mb-3 w-75 mx-auto ">
                    <input type="password" class="form-control w-75  mx-auto  border border-dark" id="acp" >
                    <button class="btn btn-outline-secondary" type="button" ><i class="bi bi-eye-slash-fill"></i></button>
                </div>

               <div class="text-center mt-5">
                    <button type="submit" class="btn fw-bold mx-2 btn-primary border border-dark rounded-pill" onclick="AcOfficerSignup();">Save & Send Invitaion</button>
               </div>

        </div>
        <!--sign up-->

        <!-- Modal -->
<div class="modal fade" id="AcOfficerInvitationModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Send Invitation</h5>
      </div>
      <div class="modal-body">
      <select class="form-select" aria-label="Default select example" id="SendEmailAo">
        <option value="0">--select--</option>
        <?php
        $Ao_email_rs = Database::search("SELECT  `id`,`email` FROM `academicofficer` ");
        $Ao_email_num = $Ao_email_rs->num_rows;

        for($t=0;$t<$Ao_email_num;$t++){
            $Ao_email_data = $Ao_email_rs->fetch_assoc();
            ?>
                <option value="<?php echo $Ao_email_data["id"] ?>"><?php echo $Ao_email_data["email"] ?></option>
            <?php
        }
        ?>
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="sendAcOfficerInvitation();">Send</button>
      </div>
    </div>
  </div>
</div>


        <!--student payment and grade up and result-->
        <div class="m-3 border border-dark rounded p-3" style="height: 80vh; overflow: scroll;" >
                <h2 class="my-3 ">Academic Officer's Summary</h2>
                <div class="input-group w-50 my-4">
                    <input type="text" class="form-control" placeholder="Search">
                    <button class="btn btn-primary" type="button" >Search</button>
                </div>
                    <table class="table table-secondary table-striped w-100 text-center">
                        <thead>
                          <tr>
                            <th scope="col"></th>
                            <th scope="col">Name</th>
                            <th scope="col">E-mail</th>                          
                            <th>reg date</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>

                        <?php
                        $acOff_rs = Database::search("SELECT `id`,`name`,`email`,`rgdate` FROM `academicofficer`");
                        $acOff_num = $acOff_rs->num_rows;

                        for($x=0;$x<$acOff_num;$x++){
                          $acOff_data = $acOff_rs->fetch_assoc();
                          ?>
                            <tr>
                            <td><?php echo $x+1?></td>
                              <th><?php echo $acOff_data["name"] ?></th>
                              <td><?php echo $acOff_data["email"] ?></td>
                              <td><?php echo $acOff_data["rgdate"] ?></td>
                              <td><button class="btn btn-danger" onclick="deleteAccOfficer('<?php echo $acOff_data['id'] ?>')">Delet</button></td>
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