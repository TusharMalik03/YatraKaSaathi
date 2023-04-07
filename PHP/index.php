<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous" />

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
    crossorigin="anonymous"></script>

  <title>Home Page</title>
</head>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div><a class="navbar-brand" href="#" style="margin-left:20px;float:left;">YatraKaSaathi</a></div>
  <div class="collapse navbar-collapse" style="float:right;" id="navbarNavAltMarkup">
    <div class="navbar-nav" style="display:flex;justify-content:space-evenly;">
      <div></div>
      <div style="display:flex;">
        <a class="nav-item nav-link" style="float: left;" href="showCars.php">Show Available Cars</a>
        <?php
        if(isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"]=="true"){
        ?>
          <a class="nav-item nav-link" style="float: left;" href="logout.php">Logout</a>
        <?php
        if(isset($_SESSION["type"]) && $_SESSION["type"]=="Agency"){
        ?>
          <a class="nav-item nav-link" style="float: left;" href="Agency.php">Agency Portal</a>
        <?php }}
        else{ 
        ?>
        <a class="nav-item nav-link" style="float: left;" href="signin.php">Signin</a>
        <a class="nav-item nav-link" href="login.php">Login</a>
        <?php } ?>
      </div>
    </div>
  </div>
</nav>
</body>

</html>