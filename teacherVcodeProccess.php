<?php
require './dbconnection.php';

if(isset($_POST["e"])){
    $email = $_POST["e"];

    $vcode_rs = Database::search("SELECT `vcode`,`confimCode`,`email` FROM `teacher` WHERE `email`='".$email."' ");
    $vcode_data = $vcode_rs->fetch_assoc();

    if(!($vcode_data["vcode"]==$vcode_data["confimCode"])){
        echo "yes";
    }else{
        echo "no";
    }
}

?>