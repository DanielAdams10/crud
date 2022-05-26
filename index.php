<?php 

        include "auth.php";
        require "navbar.php"; 
        
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- JavaScript Bundle with Popper -->
    
    <style>
        .wrap {
            width: 100%;
            max-width: 600px;

            margin: 100px auto;
        }
    </style>
</head>
<body>
    
    <div class="container ">
        <div class="my-5">
            <?php if(isset($_SESSION['create'])) : ?>
                <div class="alert alert-info">
                    <?php 
                        echo $_SESSION['create'];
                        unset($_SESSION['create']);
                    ?>
                </div>
            <?php endif ?>

            <?php if(isset($_SESSION['delete'])) : ?>
                <div class="alert alert-info">
                    <?php 
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    ?>
                </div>
            <?php endif ?>

            <?php if(isset($_SESSION['edit'])) : ?>
                <div class="alert alert-info">
                    <?php 
                        echo $_SESSION['edit'];
                        unset($_SESSION['edit']);
                    ?>
                </div>
            <?php endif ?>
        </div>
        
        <div class="wrap">
            <div style="height: 70px;" class=" my-4 ">
                <h1 class="float-start">Employees Details</h1>
                <a href="create.php" class="btn btn-success float-end">Add New Employee</a>
                
            </div>
            <div>
                <input type="text" id="search" name="search" class="mb-4 border-secondary rounded-1">
            </div>
            
            <div>
                <?php
                    //open connection
                    include "db.php";


                    //select sql query
                    $sql = "SELECT * FROM employees";

                    //select and check query
                    if ( $result = mysqli_query($link, $sql)) {

                        //check data exists
                        if( mysqli_num_rows($result) > 0 ) {
                            //write html code
                            echo '<table id="table" class="table table-striped table-bordered">';
                            echo '<tr>';
                            echo '<th>No.</th>'; 
                            echo '<th>Name</th>'; 
                            echo '<th>Address</th>'; 
                            echo '<th>Salary</th>';
                            echo '<th>Actions</th>';
                            echo '</tr>';
                            $no = 1;

                            while ($row = mysqli_fetch_array($result)) {
                                echo "<tr id='$row[0]'>";
                                echo '<td>'.$no.'</td>';
                                echo '<td>'.$row[1].'</td>';
                                echo '<td>'.$row[2].'</td>';
                                echo '<td>'.$row[3].'</td>';
                                echo '<td>
                                        <a href="view.php?id='.$row[0].'" class="mx-1" data-bs-toggle="tooltip" title="View Record"><i class="fa fa-eye"></i></a>
                                        <a href="update.php?id='.$row[0].'" class="mx-1" data-bs-toggle="tooltip" title="Edit Record"><i class="fa fa-edit"></i></a>
                                        <a href="delete.php?id='.$row[0].'" class="mx-1" data-bs-toggle="tooltip" title="Delete Record"><i class="fa fa-trash"></i></a>
                                    </td>';
                                    
                                echo '</tr>';
                                $no++; 
                            }
                            

                            echo '</table>';



                            //clear result
                            mysqli_free_result($result);
                            
                            
                        } else {
                            echo "<div class=alert><b><em>No record were found..</em></b></div>";
                        }
                    }  else {
                        echo header('location: error.php');
                    }

                    //close connection
                    mysqli_close($link);


                ?>
            </div>
        </div>
    </div>

        

        

    <!-- script file Bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script type="text/javascript">
        
        
        $(document).ready(function() {
            function tableReload() {
                let TRelements = document.getElementsByTagName("tr");
                
                let TRarr = Array.from(TRelements);
                
                TRarr.forEach(el => el.style.backgroundColor = 'transparent');
            }

            function searchTrue(){
                console.log($(this)); 
            }

            $("#search").keyup(function() {
                let inputValue = document.getElementById("search").value;
                // alert(inputValue);
                $.ajax({
                    type: "post",
                    url: "search.php",
                    data: {
                        search: inputValue,
                    },
                    success: function (response) {
                        let result = JSON.parse(response);
                        console.log(result);
                        // die();
                        let TRelements = document.getElementsByTagName("tr");
                        let TRarr = Array.from(TRelements);

                        //input box
                        if((result.length == 0 ) && (inputValue != '')){
                            
                            //for no result
                            tableReload();
                            document.getElementById("search").style.backgroundColor = 'yellow';
                        }else if((result.length == 0 ) && (inputValue == '')){ 
                            
                            tableReload();
                            document.getElementById("search").style.backgroundColor = 'transparent';
                        }

                         //table
                        if(result.length != 0){

                            //result found
                            tableReload();
                            result.forEach( el => {
                                let searchItem = document.getElementById(el);
                                // alert(searchItem); 
                                searchItem.style.backgroundColor = 'yellow';
                            })
                        }
                        //  error: function(jqXHR, textStatus, errorThrown) {
                        // console.log(textStatus, errorThrown);
                    }
                });
            });
        });

        
    </script>

    <?php include "footer.php" ?>
</body>
</html>