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

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div><a class="navbar-brand" href="#" style="margin-left:20px;float:left;">YatraKaSaathi</a></div>
    <div class="collapse navbar-collapse flex" id="navbarNavAltMarkup" style="justify-content:space-evenly;">
        <div class="navbar-nav">
            <a class="nav-item nav-link" href="Agency.php">Add New Cars</a>
            <a class="nav-item nav-link" href="showCars.php">Show Available Cars</a>
            <a class="nav-item nav-link" href="viewCars.php">View Cars</a>
        </div>
        <div>
            <form action="logout.php" method="get" style="float:left">
                <button type="submit" class="btn btn-primary">Logout</button>
            </form>
        </div>
    </div>
</nav>

</body>
</html>