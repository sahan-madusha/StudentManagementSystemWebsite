<?php

session_start();

if(isset($_SESSION["acOfficer"])){

    $_SESSION["acOfficer"] = null;
    session_destroy();

    echo ("done");

}

?>