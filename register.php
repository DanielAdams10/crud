<?php
    

    require("db.php");
   
    $usernameErr = $passwordErr = $cpwdErr = "";
    $username = $password = $cpwd = "";
    
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

        #validate confirm password
        if (empty($_POST['cpwd'])) {
            $cpwdErr = 'Please confirm password.';
        } else {
            $cpwd =  $_POST['cpwd'];
            if ($password != $cpwd) {
                $cpwdErr = 'Password did not match.';
            }
        }

        

        if(empty($usernameErr) && empty($passwordErr) && empty($cpwdErr)) {
            $username = $_POST['username'];
            $password = md5($_POST['password']);
            $cpwd = md5($_POST['cpwd']);
            
            $users = "INSERT INTO users (name, password, created_at) VALUES ('$username','$password', NOW())";

            // $result = mysqli_query($link, $users);
            if(mysqli_query($link, $users)) {
                $_SESSION["success_register"] = "Your account is successfully created... Now Login to your account";
                header('location: login.php');
            } else {
                header('location: error.php');
            }
        }

        mysqli_close($link);
    }

    
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
    <style>
        .error {color: #FF0000;}
    </style>

</head>
<body>
    <div class="container" style="width: 100%; max-width: 570px; margin: 40px auto;">
        
        <div class="card-title mb-3" style="height: 70px;">
            <h1>Sign Up</h1>
        </div>
        <div class="card-subtitle text-muted">
            <p>Please fill this form to create an account.</p>
        </div>
        <div class="card-body">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
            <div>
                <label for="username" class="form-label mb-1"><b>Username:*</b></label>
                <input type="text" name="username" class="form-control mb-3" placeholder ="Create your Username..." value="<?php $username = isset($username) ? $username : '' ; ?>">
                <span class="error"><?php echo $usernameErr;?></span>
                
            </div>
            
            
            <div>
                <label for="password" class="form-label mb-1"><b>Password*</b></label>
                <input type="password" name="password" class="form-control mb-3" placeholder="Create your password...">
                <span class="error"><?php echo $passwordErr;?></span>
            </div>

            <div>
                <label for="cpwd" class="form-label mb-1"><b>Comfirm Password:*</b></label>
                <input type="password" name="cpwd" class="form-control mb-3" placeholder="Comfirm your password..." >
                <span class="error"><?php echo $cpwdErr;?></span>
            </div>

            <div class="mb-2">
                <input type="submit" class="btn btn-success" value="Submit">
                <input type="reset" value="Reset" class="btn btn-warning">
            </div>
                
            </form>
            <div>
                <p>Already have an account? <a href="login.php" class="text-decoration-none"> Login here </a></p>
            </div>
        </div>
    

    </div>
</body>
</html>

