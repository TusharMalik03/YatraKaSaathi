<?php
include("index.php");
require_once "config.php";

$msg = "";
$alert = "none";
$color = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $name = $_POST['name'];
    $action = "signin";
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $type = $_POST['customRadio'];
    $confirmPass = $_POST["confirm_password"];
    $Pass = $_POST["password"];
    if(strlen($Pass)<6){
        $msg = "Password must be of atleast 6 characters..!";
        $alert = "ok";
        $color = "danger";
    }else if((strlen($contact)<10 || strlen($contact)>10)){
        $msg = "Mobile Number must be of 10 digits..!";
        $alert="ok";
        $color="danger";
    }
     else {
        if ($action == "signin" && $type == "agency") {
            $sql1 = "SELECT * FROM agency where contact='$contact'";
            $sql2 = "SELECT * FROM user where contact='$contact'";
            $result = $conn->query($sql1);
            $result1 = $conn->query($sql2);
            if ($result->num_rows > 0 || $result1->num_rows>0) {
                $msg = "Account Already Exists";
                $color = "danger";
                $alert = "ok";
            } else {
                $sql = "Insert into agency(name,email,contact,password) VALUES ('$name','$email','$contact','$Pass')";
                if ($conn->query($sql) == TRUE) {
                    $msg = "Agency Successfully Registered";
                    $color = "success";
                    $alert = "ok";
                } else {
                    $msg = "Some Error has been occured Try Again..!";
                    $color = "danger";
                    $alert = "ok";
                }
            }
        } else if ($action == "signin" && $type == "user") {
            $sql1 = "SELECT * FROM agency where contact='$contact'";
            $sql2 = "SELECT * FROM user where contact='$contact'";
            $result = $conn->query($sql1);
            $result1 = $conn->query($sql2);
            if ($result->num_rows > 0 || $result1->num_rows>0) {
                $msg = "Account Already Exists";
                $color = "danger";
                $alert = "ok";
            } else {
                $sql = "Insert into user(name,email,contact,password) VALUES ('$name','$email','$contact','$Pass')";
                if ($conn->query($sql) == TRUE) {
                    $msg = "User Successfully Registered";
                    $color = "success";
                    $alert = "ok";
                } else {
                    $msg = "Some Error has been occured.Try Again..!";
                    $color = "danger";
                    $alert = "ok";
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignIn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
        crossorigin="anonymous"></script>


</head>

<body>

    <?php if ($alert == "ok") { ?>
        <div class="alert alert-<?php echo $color; ?> alert-dismissible fade show" role="alert">
            <strong>
                <?php if($color=="success") echo "Success"; else echo "Error" ?>
            </strong>
            <?php echo $msg; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
    <?php }
    $alert = "none"; ?>
    <div style="display:flex;justify-content:center">
        <form style="width:50vw;margin-top:70px" action="" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" class="form-control" name="name" id="exampleInputName1" aria-describedby="emailHelp"
                    placeholder="Enter Your Name" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" name="email" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder="Enter email" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Contact</label>
                <input type="number" class="form-control" name="contact" id="exampleContact1"
                    aria-describedby="emailHelp" placeholder="Enter Contact Number" required>
            </div>
           
            <div style="display:inline" id="radioColumn">Sign in as:
                <div class="custom-control custom-radio mt-2">
                    <input type="radio" id="customRadio1" name="customRadio" value="agency"
                        class="custom-control-input" required>
                    <label class="custom-control-label" for="customRadio1">Car Rental Agency</label>
                </div>
                <div class="custom-control custom-radio mt-2">
                    <input type="radio" id="customRadio2" name="customRadio" value="user" class="custom-control-input">
                    <label class="custom-control-label" for="customRadio2">User</label>
                </div>
            </div>
            <input type="password" name="password" class="form-control"
                placeholder="Create Password it must be of length 6" required>
            <input type="password" name="confirm_password" class="form-control mt-2" placeholder="Reconfirm Password"
                required>
            <input type="submit" class="btn btn-primary mt-2" id="btn" name="submit" value="SignIn"></input>
            <div>
                <p style="display:inline">Already have an Account?</p><a href="login.php">Login Here</a>
            </div>
        </form>
    </div>

    

</body>

</html>