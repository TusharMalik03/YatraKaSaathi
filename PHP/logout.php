<?php
if (!isset($_SESSION)) {
    session_start();
}
if (session_destroy()) {
    header("location:showCars.php");
    exit;
}
?>