<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <style>
        .wrap {
            width: 100%;
            max-width: 600px;
            margin: 40px auto;
        }
    </style>
</head>
<body>
    <div class="container wrap">
        <div class="card-title ">
            <h1>View Record</h1>
        </div>
        <hr>
        <div class="card-body mb-4">
        <?php
            session_start();

            //open connection
            require('db.php');


            //select sql query
            $id = $_REQUEST['id'];
            $sql = "SELECT * FROM employees WHERE id = $id " ;

            //select and check query
            if ( $result = mysqli_query($link, $sql)) {
                $row = mysqli_fetch_array($result);
               
                echo '<ul class="list-group mb-4">';
                echo '<li class="list-group-item"><b>Name: </b>'.$row[1].'</li>';
                echo '<li class="list-group-item"><b>Address: </b>'.$row[2].'</li>';
                echo '<li class="list-group-item"><b>Salary: </b>'.$row[3].'</li>';
                echo '</ul>';

                //clear result
                mysqli_free_result($result);

                
    
            }
              else {
                echo "ERROR: Could not able to execute $sql.".mysqli_error($link);
                }

            echo '<a href="index.php" class="btn btn-primary">Back</a>';
            echo '<a href="delete.php?id='.$row[0].'" class="btn btn-danger mx-3">Delete</a>';

            //close connection
            mysqli_close($link);


        ?>
        </div>
    </div>

</body>
</html>