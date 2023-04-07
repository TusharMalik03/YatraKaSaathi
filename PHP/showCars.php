<?php
include("index.php");
require_once("config.php");

$msg="";
$alert="none";
$color="";
if($_SERVER["REQUEST_METHOD"]=='POST' && isset($_POST["submit"])){
    if(isset($_SESSION["type"]) && $_SESSION["type"]=="Agency"){
        $msg = "Only Customers(Users) can Rent Vehicles, Agencies Can't...!";
        $color= "danger";
        $alert="ok";
    }
    else{
        $Agent_id=$_POST["id"] ;
        $Cust_id = $_SESSION["cust_id"];
        $Days = $_POST["days"];
        $date = $dob = date('Y-m-d', strtotime($_POST['date']));
        $VNumber = $_POST["VNumber"];

        $sql = "Insert into booking(Agency_id,Customer_id,NumberofDays,Starting_Date,VNumber) VALUES ('$Agent_id','$Cust_id','$Days','$date','$VNumber')";
        if($conn->query($sql) == TRUE){
            $sql1 = "Update cars Set VStatus='Booked' where Agency_id='$Agent_id' && VNumber='$VNumber'";
            if ($conn->query($sql1) === TRUE){
                $msg = "Booking Confirmed";
                $color="success";
            }else{
                $msg = "Some Error has been Occured..Try Again..!!";
                $color ="danger";
            }
        }else{
            $msg = "Some Error has been Occured..Try Again..!!";
            $color = "danger";
        }
        $alert="ok";
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>

    <title>Home Page</title>
</head>

<body>

    <?php if($alert=="ok"){?>
    <div class="alert alert-<?php echo $color; ?> alert-dismissible fade show" id="label" role="alert">
        <strong><?php if($color=="success") echo "Success..!"; else echo "Error..!"; ?></strong>
        <?php echo $msg;?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        </button>
    </div>
    <?php } $alert="none;"?>

    <div class="alert alert-warning alert-dismissible fade show" style="display:none;" id="label" role="alert">
        <strong>Error!</strong>
        You Need to Login First In Order to Book a Vehicle..!!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="container">
        <?php
        $sql = "Select * from cars where VStatus='Not Booked'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        ?>
        <?php
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="card m-4" style="width:25rem;">
                    <form action="" method="POST">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php echo $row["VModel"] ?>
                            </h5>
                            <p class="card-subtitle pt-1">Vehicle Number:
                                <?php echo $row["VNumber"] ?>
                            </p>
                            <p class="card-subtitle pt-1">Seating Capacity:
                                <?php echo $row["VSeating"] ?>
                            </p>
                            <p class="card-subtitle pt-1 ">Rent Per Day:
                                <?php echo $row["VRent"] ?>
                            </p>
                            <?php
                            if(isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"] == "true") {
                            ?>
                                <div style="display:inline;">Choose Number of Days: </div>
                                <select name="days" style="width:8.8rem;margin-left:3px;" required>
                                    <?php for ($i = 1; $i <= 10; $i++) { ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php } ?>
                                </select>
                                <p class="card-subtitle mr-1">Choose Starting Date:
                                    <input type="date" name="date" style="margin-left:24px;margin-top:17px;" required>
                                </p>
                                <input type="text" name="id" value=<?php echo $row["Agency_id"] ?> style="display:none;">
                                <input type="text" name="carId" value=<?php echo $row["Car_id"] ?> style="display:none;">
                                <input type="text" name="VNumber" value=<?php echo $row["VNumber"]?> style="display:none;">
                                <input type="submit" class="btn btn-primary" id="btn" name="submit" value="Rent Vehicle">
                            <?php }else{?>
                            <input type="button" class="btn btn-primary" id="btn" name="submit" onclick=btnClicked() value="Book Vehicle">
                            <?php } ?>
                        </div>
                    </form>
                </div>
                <?php
            }?>
        <?php }else{
        ?>
            <div style="display:flex;justify-content:center;margin-auto">Right Now At this Particular Moment There are No Vehicles Available for Rent</div>
        <?php
        }
        ?>
    </div>
</body>
<script>

    const btnClicked = () => {
        label.style.display = "block";
    }

    const removeLabel = () => {
        console.log("Removing");
        label.style.display = "none";
    }

    const bookVehicle = () => {
        console.log("Booking Vehicle");
    }

    let btn = document.getElementById('btn');
    let label = document.getElementById('label');
</script>

</html>