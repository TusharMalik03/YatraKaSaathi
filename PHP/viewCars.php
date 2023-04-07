<?php
include_once("config.php");
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once("AgencyNavbar.php");
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
    <?php
    $Agent_id = $_SESSION["id"];
    $sql = "Select * from booking where Agency_id='$Agent_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        ?>
        <div style="display:flex;justify-content:center">Booked Cars:</div>
        <div class="grid grid-cols-3">
        <?php
        while ($row = $result->fetch_assoc()) {
            ?>
                <div class="card m-4" style="width:25rem;">
                    <div class="card-body">
                        <p class="card-subtitle pt-1">Vehicle Number:
                            <?php echo $row["VNumber"] ?>
                        </p>
                        <p class="card-subtitle pt-1">Customer Id:
                            <?php echo $row["Customer_id"] ?>
                        </p>
                        <p class="card-subtitle pt-1 ">Starting Date:
                            <?php echo $row["Starting_Date"] ?>
                        </p>
                        <p class="card-subtitle pt-1 ">Number of Days:
                            <?php echo $row["NumberOfDays"] ?>
                        </p>
                    </div>
                </div>
                <?php }
    } ?>
    </div>
</body>

</html>