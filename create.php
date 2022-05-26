<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    
</head>
<body>
<?php
        session_start();
        
        include "validation.php";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if($nameErr === 0 && $addressErr === 0 && $salaryErr === 0) {
           require("db.php");
    
            $name = $_REQUEST['name'];
            $address = $_REQUEST['address'];
            $salary = $_REQUEST['salary'];
        
            //insert value
            $sql = "INSERT INTO employees (name, address, salary) VALUES ('$name', '$address', '$salary')";
    
        
    
            //execute and check query
            if (mysqli_query($link, $sql)) {
                $_SESSION['create'] = "The new record is added...";
                
                header('location: index.php');
            } else {
                echo "Couldn't add your record. Please try again...". mysqli_error($link);
            }
    
                 //clear result
                mysqli_free_result($result);
    
                //close connection
                mysqli_close($link);
        }
        //open connection
       
    }

        
?>
    <div class="container" style="width: 100%; max-width: 570px; margin: 40px auto;">
        
            <div class="card-title mb-3" style="height: 70px;">
                <h1>Create Record</h1>
            </div>
            <div class="card-subtitle text-muted">
                <p>Please fill this form and submit to add employee record to the database.</p>
            </div>
            <div class="card-body">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="was validated" >
                <div>
                    <label for="name" class="form-label mb-1"><b>Name</b></label>
                    <input type="text" name="name" class="form-control mb-3 <?php if(strlen($nameErr)>1) echo "is-invalid";?>" <?php if($nameErr===0)?>>
                    <span class="error text-danger"> <?php echo $nameErr===0?"": $nameErr;?></span>
                </div>

                <div>
                    <label for="address" class="form-label mb-1"><b>Address</b></label>
                    <textarea name="address" class="form-control mb-3 <?php if(strlen($addressErr)>1) echo "is-invalid";?> "><?php if($addressErr === 0)?></textarea>
                    <span class="error text-danger"><?php echo $addressErr === 0? "":$addressErr;?></span>
                </div>

                <div>
                    <label for="salary" class="form-label mb-1"><b>Salary</b></label>
                    <input type="text" name="salary" class="form-control <?php if(strlen($salaryErr)>1) echo "is-invalid";?> mb-3 " <?php if($salaryErr===0)?> >
                    <span class="error text-danger"> <?php echo $salaryErr===0? "":$salaryErr;?></span> 
                </div>

                    <input type="submit" value="Submit" class="btn btn-primary">
                    <a href="index.php" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        

    </div>
</body>
</html>

