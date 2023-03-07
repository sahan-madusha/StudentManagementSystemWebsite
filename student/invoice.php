<?php

session_start();
require "../dbconnection.php";
if(isset($_SESSION["student"])){

$data = $_SESSION["student"];

$sub_id =  $_GET["subId"];
$T_id =  $_GET["tId"];
$fees1 = $_GET["fees"];

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

<div class="container">
    <div class="row">

<?php include "./studebtNavBar.php";

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d");
$expireDate=date('Y-m-d', strtotime('+1 month'));


$inv_rs = Database::search("SELECT `subject`,`name` FROM teacher INNER JOIN subject ON
subject.id = teacher.subject_id WHERE teacher.id='".$T_id."'");
$inv_data = $inv_rs->fetch_assoc();

?>

<div class="border border-dark rounded my-4 py-4 " id="invoice">
        <div class="d-flex flex-column flex-md-row text-center my-3">
            <div class="mt-2 col-12 col-md-6 mt-md-0">
                <h5>INVOICE TO :</h5>
                <p>Name: <?php echo $data["name"]; ?></p>
                <p>Nic:  <?php echo $data["nic"]; ?></p>
                <p>Email:<?php echo $data["email"];?></p>
            </div>
            <div class="mt-2 col-12 col-md-6 mt-md-0">
                <h5>INVOICE FROM :</h5>
                <p>Email: notes.lk</p>
                <p>Tp: 077 1617400</p>
                <p>Date & Time: <?php echo $date;?></p>
            </div>
        </div>


        <div class="d-flex flex-column offset-2 m-5 align-items-center">
            <h5>Class fees = RS:  <span><?php echo $fees1;?></span></h5>
            <h5>Tecaher name : <?php echo $inv_data["name"]; ?> </h5>
            <h5>Subject : <?php echo $inv_data["subject"]; ?> </h5>

            <p>(The membership will be canceled on <span style="color:red;"><?php echo $expireDate ;?></span>)</p>

        </div>

        <div class="container-fluid ">
            <div class="row text-center mt-5 mb-4">
                <div class="invoiceFooter">
                    <p><b>Note:</b>money can not be returned for any reason.</p>
                    <h6>Invoice was created on a computer and is valid without the signature and seal</h6>
                </div>
            </div>
        </div>
</div>

<div class="offset-1">
    <button class="btn btn-primary border border-dark rounded my-4" onclick="printInvoice();">print</button>
</div>



    </div>
</div>


    <script src="./stScript.js"></script>
    <script src="../bootstrap.js"></script>
    <script src="../bootstrap.bundle.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>

</body>
</html>
<?php
}
?>