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

    if($_SERVER["REQUEST_METHOD"]=='POST' && isset($_POST["submit"])){
    
        $VModel = $_POST["VModel"];
        $VRent = $_POST["VRent"];
        $VSeating = $_POST["VSeating"];
        $Car_id = $_POST["Car_id"];
        $id = $_SESSION["id"];

        $sql = "Update cars Set VModel='$VModel',VRent='$VRent',VSeating='$VSeating' where Agency_id='$id' and Car_id='$Car_id'";
        if ($conn->query($sql) === TRUE){
            $_SESSION["msg"] = "Details Successfully Updated";
            $_SESSION["color"]="success";
            $_SESSION["alert"] ="ok";
        }else{
            $_SESSION["msg"] = "Some Error has been Occured..Try Again..!!";
            $_SESSION["color"]="danger";
            $_SESSION["alert"] ="ok";
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

    <title>Edit Car Details</title>
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

    <div class="container">
        <?php 
            $id = $_SESSION["id"];
            $sql = "Select * from cars where Agency_id='$id' and VStatus='Not Booked'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0){
                while ($row = $result->fetch_assoc()) {
            ?>
                 <div class="card m-4" style="width:25rem;">
                    <form action="" method="POST">
                        <div class="card-body">
                            <div class="card-subtitle mt-2">Car Id is: <?php echo $row["Car_id"]?></div>
                            <div class="card-subtitle mt-2">
                            <p>Model Name is: <?php echo $row["VModel"]?></p>
                            <input type="text" placeholder="Enter New Model Name" value=<?php echo $row["VModel"]?> name="VModel">
                            </div>  
                            <div class="card-subtitle mt-2">
                            <p>Seating Capacity is: <?php echo $row["VSeating"]?></p>
                            <input type="text" placeholder="Enter New Seating Capacity" value=<?php echo $row["VSeating"]?> name="VSeating">
                            </div>
                            <div class="card-subtitle mt-2">
                            <p>Rent Per Day is: <?php echo $row["VRent"]?></p>
                            <input type="text" placeholder="Enter New Rent Per Day" value=<?php echo $row["VRent"]?> name="VRent">
                            </div>
                            <input type="text" style="display:none" name="Car_id" value="<?php echo $row["Car_id"]?>">
                            <input type="submit" class="btn btn-primary mt-2" value="Save Details" name="submit"> 
                        </div>
                    </form>
                 </div>
            <?php
                }
            }
        ?>

    </div>

</body>
</html>