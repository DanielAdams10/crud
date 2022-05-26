<?php
    session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

</head>
<body>

    
    <div class="container" style="width: 100%; max-width: 570px; margin: 40px auto;">
        <?php if(isset($_SESSION["success_register"])) : ?>
            <div class="alert alert-info">
                <?php 
                    echo $_SESSION["success_register"];
                    unset($_SESSION["success_register"]);
                ?>
            </div>
        <?php endif ?>
        
        <?php if(isset($_SESSION['fail_login'])) : ?>
            <div class="alert alert-danger">
                <?php 
                    echo $_SESSION['fail_login'];
                    unset($_SESSION['fail_login']);
                ?>
            </div>
        <?php endif ?>
        
        <div class="card-title mb-3" style="height: 70px;">
            <h1>Login</h1>
        </div>
        <div class="card-subtitle text-muted">
            <p>Please fill your credentials to login.</p>
        </div>
        <div class="card-body">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
            <div>
                <label for="username" class="form-label mb-1"><b>Username:*</b></label>
                <input type="text" name="username" class="form-control mb-3" placeholder="Enter your username..." >
                
            </div>
            
            
            <div>
                <label for="password" class="form-label mb-1"><b>Password:*</b></label>
                <input type="password" name="password" class="form-control mb-3" placeholder="Enter your password...">
            </div>


            <div class="mb-2">
            <input type="submit" class="btn btn-success" value="Submit">
            </div>
                
            </form>
            <div>
                <p>Don't you have an account? <a href="register.php" class="text-decoration-none"> Sign up now </a></p>
            </div>
        </div>
    

    </div>
</body>
</html>

<?php
    require("db.php");

    $usernameErr = $passwordErr = "";
    $username = $password = "";
        
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    #check request method
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        #validate username 
        if (empty($_POST["username"])) {
            $usernameErr = "Please enter the username.";
        } else {
            $username = test_input($_POST["username"]);
            if(!preg_match("/^[a-zA-Z0-9]*[a-zA-Z0-9]*$/",$username)) {
                $usernameErr = "Only letters and number allowed";
            } 
        }

        #validate password
        if (empty($_POST['password'])) {
            $passwordErr = 'Please enter a password.';
        } elseif (strlen($_POST['password']) < 6) {
            $passwordErr = 'Password must have at least 6 characters.';
        } else {
            $password = test_input($_POST['password']);
        }

        if(isset($_POST['username'])) {
            $username = $_POST['username'];
            $password = md5($_POST['password']);
    
            //check query 
            $sql = "SELECT * FROM users WHERE name = '$username' AND password = '$password' ";
                
            $result = mysqli_query($link, $sql);
            // print_r($result);
            // die();
            $row = mysqli_num_rows($result);
                
            if( $row == 1 ) {
                $_SESSION["username"] = $username;
                // die($_SESSION["username"]);
                    
                $_SESSION['success_login'] = "Login Successfully...";
                header('location: index.php');
            } else {
                
                $_SESSION['fail_login'] = "Username or password is not correct! Please try again...";
                header('location: login.php');
            }
    
            mysqli_close($link);
        }
    
    }

        


?>