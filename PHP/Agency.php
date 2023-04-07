<?php
require_once("config.php");
include_once("AgencyNavbar.php");

if (!isset($_SESSION["isLoggedIn"]) || $_SESSION["isLoggedIn"] !== "true") {
    flush(); // Flush the buffer
    ob_flush();
    header("location:login.php");
    exit;
} else {
    if (isset($_SESSION["type"]) && $_SESSION["type"] == "user") {
        flush(); // Flush the buffer
        ob_flush();
        header("location:logout.php");
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['submit'])) {
    $agencyId = $_SESSION["id"];
    $model = $_POST["model"];
    $number = $_POST["number"];
    $seating = $_POST["seat"];
    $rent = $_POST["rent"];
    $booked = "Not Booked";
    $sql = "Insert into cars(Agency_id,VModel,VNumber,VSeating,VRent,VStatus) VALUES ('$agencyId','$model','$number','$seating','$rent','$booked')";
    if ($conn->query($sql) == TRUE) {
        $_SESSION["msg"] = "Vehicle Successfully Registered..!!";
        $_SESSION["color"]="success";
        $_SESSION["alert"] ="ok";
    } else{
        $_SESSION["msg"] = "Some Error has been Occured..Try Again..!";
        $_SESSION["color"] = "danger";
        $_SESSION["alert"] = "ok";
    }
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

    <title>Document</title>
</head>
<body>

    <?php if(isset($_SESSION["alert"]) && $_SESSION["alert"]=="ok"){?>
            <div class="alert alert-<?php echo $_SESSION["color"];?> alert-dismissible fade show" role="alert">
            <strong><?php if($_SESSION["color"]=="success") echo "Success..!"; else echo "Error..!"; ?></strong><?php $_SESSION["msg"] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
            </div>
     <?php $_SESSION["alert"]="no"; };   
    ?>

    <div id="section" style="width:50vw;margin:auto">
        <form id="formSection" class="m-5"  action="" method="post">
            <div class="form-group m-2">
                <label for="exampleInputModel1">Model</label>
                <input type="text" class="form-control" id="VModel" name="model" placeholder="Enter Vehicle Model">
            </div>
            <div class="form-group m-2">
                <label for="exampleInputNumber1">Vehicle Number</label>
                <input type="text" class="form-control" id="VNumber" name="number" placeholder="Enter Vehicle Number in the format XXXX-XX-XXXX">
            </div>
            <div class="form-group m-2">
                <label for="exampleInputSeating1">Seating Capacity</label>
                <input type="number" class="form-control" id="VSeating" name="seat"
                    placeholder="Enter Seating Capacity">
            </div>
            <div class="form-group m-2">
                <label for="exampleInputRent1">Rent of Vehicle</label>
                <input type="text" class="form-control" id="VRent" name="rent" placeholder="Enter Rent Per Day of Vehicle in Rupees">
            </div>
            <input type="submit" id="btn" name="submit" value="Add Car" class="btn btn-primary m-2"></input>

        </form>
    </div>
</body>

</html>