<?php
if(!isset($_SESSION)) {
    session_start();
}


if(isset($_SESSION["isLoggedIn"]) && isset($_SESSION["type"]) && isset($_SESSION["count"]) && isset($_SESSION["id"])){
    if(isset($_SESSION["type"]) && $_SESSION["type"]=="user"){
        header("location:showCars.php");
        exit;
    }
    if(isset($_SESSION["type"]) && $_SESSION["type"]=="Agency"){
        header("location:Agency.php");
        exit;
    }
}

?>