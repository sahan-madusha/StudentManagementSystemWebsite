<!DOCTYPE html>
<html lang="en">
<?php require './dbconnection.php'; ?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes.lk- teacher sign in</title>

    <link rel="stylesheet" href="./style.css">

    <link rel="shortcut icon" href="./logo.svg" type="image/x-icon">

    <link rel="stylesheet" href="./bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body class="bg-light">

   <?php require './nav.php' ?>

    <!---->
    <div class="container-fluid">
        <div class="row">
            <!--sign up-->
            <div class="border border-dark rounded py-3 m-3">
                <h3 class="fw-bold mb-4 text-decoration-underline text-center">TEACHER'S - SIGN IN</h3>

                <?php
               
               $email = "";
               $pass = "";

               if(isset($_COOKIE["Teemail"])){
                $email = $_COOKIE["Teemail"];
               }

               if(isset($_COOKIE["Tepass"])){
                $pass = $_COOKIE["Tepass"];
               }
               ?>
 
                <label  class="form-label offset-2">E-mail</label>
                <input type="text" class="form-control w-75 mx-auto mb-3 text-center border border-dark" id="ten" value="<?php echo $email; ?>"  oninput="TeEmail(this);">

                <div id="VcodeDiv">
                <label for="" class="form-label offset-2">Verification Code</label>
                <input type="text" class="form-control w-75 mx-auto mb-3 text-center border border-dark" id="Tevcode">
                </div>

                <label class="form-label offset-2">Password</label>
                <div class="input-group mb-3 w-75 mx-auto ">
                    <input type="password" class="form-control w-75  mx-auto  border border-dark" id="tep" value="<?php echo $pass ;?>">
                    <button class="btn btn-outline-secondary" type="button"><i  class="bi bi-eye-slash-fill"></i></button>
                </div>

               <div class="text-center mt-5">
                    <button type="submit" class="btn fw-bold mx-2 btn-primary border border-dark rounded-pill" onclick="Teachersignup();">Log In</button>
               </div>
               <div class="text-center mt-3">
                    <input type="checkbox"  class="form-check-input mx-3" id="Terem">
                    <label class="form-check-lable">Remember me</label>
                    <p class="text-center fw-normal text-decoration-underline"><a style="cursor:pointer;" >Forget password ?</a></p>
               </div>
            </div>
            <!--sign up-->
        </div>
    </div>
    <!---->

  <?php require './footer.php' ?>

    <script src="./script.js"></script>
    <script src="./bootstrap.js"></script>
    <script src="./bootstrap.bundle.js"></script>

</body>
</html>