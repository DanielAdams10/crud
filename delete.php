<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>
    <div class="container" style="width: 550px; margin: 40px auto;">
        <div class="card-title my-4">
            <h1>Delete Record</h1>
        </div>
        <hr>
        <div >
            <div class="alert alert-warning mt-5">
                <p class="mb-2"> Do you want to delete this employee?</p>
                <form action="#" method="post" >
                    <input type="submit" value="Yes" class="btn btn-danger">
                    <a href="index.php" type="reset" class="btn btn-secondary">No</a>
                </form>
            </div>
            
        </div>
    </div>

</body>
</html>

<?php
    session_start();
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require('db.php');


        //select sql query
        $id = $_REQUEST['id'];
        $sql = "DELETE FROM employees WHERE id = $id " ;
       

        //select and check query
        if (mysqli_query($link, $sql)) {
            $_SESSION['delete'] = "The Selected record is successfully deleted...";
            header('location: index.php');
                    
        } else {
            echo "ERROR: Could not able to execute $sql.".mysqli_error($link);
        }
            


        //clear result
        mysqli_free_result($result);

        //close connection
        mysqli_close($link);

    }

?> 