<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <style>
        .wrap {
            width: 100%;
            max-width: 600px;
            margin: 40px auto;
        }
    </style>
    <?php
        session_start();
        
        if (isset($_REQUEST['id'])) {
            $n=$a=$s='';

            include "validation.php";
            require('db.php');

            //select sql query
            $id = $_REQUEST['id'];
            $sql = "SELECT * FROM employees WHERE id = $id " ;

            if ( $result = mysqli_query($link, $sql)) {
                $row = mysqli_fetch_array($result);
                $n = $row[1];  
                $a = $row[2];  
                $s = $row[3];  
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if($nameErr===0 && $addressErr===0 && $salaryErr===0 ) {
                $name = $_REQUEST['name'];
                $address = $_REQUEST['address'];
                $salary = $_REQUEST['salary'];

                $id = $_REQUEST['id'];

            
                $sqli = "UPDATE employees SET name='$name', address='$address', salary='$salary' WHERE id= $id";
        
                if(mysqli_query($link, $sqli)) {
                    $_SESSION['edit'] = 'Records were updated successfully.';
                    //close connection
                    mysqli_close($link);

                    header('location: index.php');
                } else {
                    echo "ERROR: Could not able to execute $sql.". mysqli_error($link);
                }
            }

        }

        //clear result
        mysqli_free_result($result);

   
    ?>
</head>
<body>
    <div class="container wrap">
        <div class="card-title ">
            <h1>Update Record</h1>
        </div>
        <hr>
        <div class="card-body mb-4">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <div>
                    <label for="name" class="form-label mb-1"><b>Name</b></label>
                    <input type="text" name="name" class="form-control mb-3 <?php if(strlen($nameErr)>1) echo "is-invalid";?>" <?php if($nameErr===0)?> value="<?php echo isset($_POST['name'])?$_POST['name'] : $n; ?>">
                    <span class="error text-danger"> <?php echo $nameErr===0?"": $nameErr;?></span>
                </div>
                     
                    

                <div>
                    <label for="address" class="form-label mb-1"><b>Address</b></label>
                    <textarea name="address" class="form-control mb-3 <?php if(strlen($addressErr)>1) echo "is-invalid";?> "><?php if($addressErr === 0)?><?php echo isset($_POST['address'])?$_POST['address'] : $a; ?></textarea>
                    <span class="error text-danger"><?php echo $addressErr === 0? "":$addressErr;?></span>
                </div>

                <div>
                    <label for="salary" class="form-label mb-1"><b>Salary</b></label>
                    <input type="text" name="salary" class="form-control <?php if(strlen($salaryErr)>1) echo "is-invalid";?> mb-3 " <?php if($salaryErr===0)?> value="<?php echo isset($_POST['salary'])?$_POST['salary'] : $s; ?>">
                    <span class="error text-danger"> <?php echo $salaryErr===0? "":$salaryErr;?></span> 
                </div> 

                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="submit" value="Submit" class="btn btn-primary">
                <a href="index.php" class="btn btn-secondary">Cancel</a>
                
            </form>
        </div>
    </div>

</body>
</html>


