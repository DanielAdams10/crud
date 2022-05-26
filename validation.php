<?php
    $nameErr = $addressErr = $salaryErr = "";
    $name = $address = $salary = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $nameErr = "*Please enter a name.";
        } else {
            $name = test_input($_POST["name"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/",$name) || empty($name) ) {
            $nameErr = "Only letters and white space allowed";
            }   else $nameErr=0;
            
        }

        if (empty($_POST["address"])) {
            $addressErr = "*Please enter an address.";
        } else {
            $address = test_input($_POST["address"]);
             // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/",$address)|| empty($address)) {
            $addressErr = "Only letters,numbers and white space allowed";
            } else $addressErr=0;
        }

        if (empty($_POST["salary"])) {
            $salaryErr = "*Please enter the salary amount.";
        } else {
            $salary = test_input($_POST["salary"]);
             // check if name only contains letters and whitespace
            if (!is_numeric($salary)||  empty($salary) || $salary<0) {
            $salaryErr = "Only positive numbers allowed";
            } else $salaryErr=0;
        }
    }

    

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>