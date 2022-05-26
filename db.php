<?php
    $link = mysqli_connect('localhost', 'root', '', 'crud');

    //check connection
    if($link === false) {
        header('location: error.php');
    }
?>