<?php
session_start();
if(!isset($_SESSION['auth_admin'])){
  header("Location:/../../auth/admin/login.php");
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta charset="utf-8">
	<title>Fredgab Store | View Product</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
	 <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/style.css">

</head>
<body>
<?php include "../../includes/navbar.php"?>
<div class="container">
	
    <section id="head-section">
    	<h1 class="header mt-5">View Product</h1>
        <section class="mt-5">
    <?php

    include '../../database/connection.php';

    if(isset($_GET['id'])){
        
        $id = $_GET['id'];

        $sql = "select * from drinks where id = '$id'";

        $dbc = mysqli_query($con,$sql);

        if($dbc){
            if($dbc->num_rows){
                while($row = mysqli_fetch_array($dbc)){   
            ?>
            <div class="row">
                <div class="col-md-7">
                <img
                src="<?=$row['image']?>"
                alt="<?=$row['name']?>"
                style="width:100%;height:auto"
                />
                </div>
                <div class="col-md-5" style="text-align:center">
                    <p><b>Name</b>: <?=$row['name']?></p>
                    <b>Description</b>:
                    <p class="text-justify text-center" style="font-size:13px"> <?=$row['description']?></p>
                    <p><b>Price</b>:&#163;<?= number_format($row['price'],2)?></p>
                   
                </div>
            </div>
            <?php
                } 
            }  
            else{
                echo "<h3>Product not found</h3>";
            }
        }     
        else{
            echo mysqli_error($con);
        }

    }

    ?>
        	
    </section>
    </section>
   
</div>

</div>

<script src="../../js/jquery.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-
beta1/dist/js/bootstrap.bundle.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  
</body>
</html>