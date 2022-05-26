<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="fontawesome-free-6.1.1-web/css/all.min.css">
</head>
<body>
    <div class="container">
        <nav class="navbar fixed-top bg-success" >
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php"><img src="company_logo.png" alt="Company Logo" width="100px" height="35px" class="d-inline-block align-text-top"><em class="fst-italic h4 text-white mx-2">Welcome to Brycen Myanmar!</em></a>
                <div class = "dropdown">
                    <button class="btn btn-success dropdown-toggle" type ="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa-solid fa-user"></i>
                        <?php echo $_SESSION["username"]; ?>
                    </button>    
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item " id="logoutBtn"  href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a>
                    </div>
                </div>
                
            </div>
        </nav>
    </div>
</body>
</html>