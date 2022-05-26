<?php

    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $db = mysqli_connect('localhost', 'root', '', 'crud');

        if( $db === false ) {
            header('location: error.php');
        }

        $username = $_POST['username'];
        $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
        $cpwd = password_hash($_POST['cpwd'],PASSWORD_DEFAULT);
        
        $users = "INSERT INTO user (name, password, comfirm_password, created_at) VALUES ('$username','$password', '$cpwd', NOW())";

        if(mysqli_query($db,$users)) {
            $_SESSION['success_signup'] = "Your account is successfully created.";
            header('location: ../login.php');
        } else {
            header('location: error.php');
        }
    }

?>