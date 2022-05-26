<?php
require("db.php");

$search_key = $_POST['search'];
// die($search_key);

if(trim($search_key) != ''){
    $sql="SELECT id FROM employees WHERE LOWER(name) LIKE LOWER('$search_key%')";

    $result = mysqli_query($link,$sql);
    $row = mysqli_fetch_all($result);
    // print_r($row);
    // die('yyyyy');
    echo  json_encode($row,0);
}else{
    echo  json_encode([]);
}