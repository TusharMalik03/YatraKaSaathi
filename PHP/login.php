<?php
require_once("config.php");

$msg = "";
$color = "";
$alert = "none";
if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['submit'])) {

    $type = $_POST['customRadio'];
    $action = "login";
    $Pass = $_POST["password"];
    // echo $Pass;
    $contact = $_POST['contact'];
    if(strlen($contact)<10 || strlen($contact)>10){
        $msg="Mobile Number must be of 10 digits";
        $alert="ok";
        $color="danger";
    }else if ($action == "login" && $type == "user") {
        $sql = "SELECT * FROM user where contact='$contact'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $_SESSION["isLoggedIn"] = "true";
                    $_SESSION["type"] = "user";
                    $_SESSION["cust_id"] = $row["id"];
                    $_SESSION["msg"] = "Successfully Logged In";
                    $_SESSION["alert"]="ok";
                    $_SESSION["color"]="success"; 
                    header("location:showCars.php");
        }else{
                $msg = "Invalid Credentials..!";
                $color = "danger";
                $alert = "ok";
            }
        } else {
            $contact = $_POST["contact"];
            $sql = "SELECT id FROM agency where contact='$contact' and password='$Pass'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $msg = "Logined Successfully \n";
                    $_SESSION["isLoggedIn"] = "true";
                    $_SESSION["type"] = "Agency";
                    $_SESSION["id"] = $row["id"];    
                    $_SESSION["msg"] = "Successfully Logged In";
                    $_SESSION["alert"]="ok";
                    $_SESSION["color"]="success";
                    header("location:Agency.php");
            } else {
                $msg = "Invalid Credentials..!";
                $color = "danger";
                $alert = "ok";
            }
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

    <title>Login</title>
</head>

<body>
    <?php
    if ($alert == "ok") { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong>
            <?php echo $msg; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
        <?php
    }
    $alert = "none";
    ?>
    <div style="display:flex;justify-content:center">
        <form class="m-5 p-5" style="width: 50%;margin-top:70px;" action="" method="post">
            <div id="radioColumn">Log in as:
                <div class="custom-control custom-radio mt-2">
                    <input type="radio" id="customRadio1" name="customRadio" value="agency"
                        class="custom-control-input" />
                    <label class="custom-control-label" for="customRadio1">Car Rental Agency</label>
                </div>
                <div class="custom-control custom-radio mt-2">
                    <input type="radio" id="customRadio2" name="customRadio" value="user"
                        class="custom-control-input" required />
                    <label class="custom-control-label" for="customRadio2">User</label>
                </div>
                <label style="display:none;color:red" id="radioLabel">Choose One Category..!</label>
            </div>

            <div class="form-group mt-2" style="width: 400px; display: inline-block">
                <input type="number" class="form-control mt-1 disbaled" id="contactColumn" aria-describedby="emailHelp"
                    name="contact" placeholder="Enter Your Contact Number" />
            </div>
            <input type="password" class="form-control mt-2" style="width:400px;" name="password"
                placeholder="Enter Your Password">
            <input type="submit" class="btn btn-primary mt-2" id="btn" name="submit" value="Login" required
                style="margin-left: 3px">



            <label style="color: red;display:none;" id="contactLabel">
                No Such Account Found with Entered Contact Number
            </label>

            <div class="mt-2">
                <p style="display:inline">Don't have account?</p><a href="signin.php">Register here</a>
            </div>
        </form>
    </div>
</body>
</html>