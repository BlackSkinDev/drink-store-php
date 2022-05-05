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
	<title>Fredgab Store | Dashboard</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
	 <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/style.css">
    <link rel="stylesheet" type="text/css" href="../../css/register.css">

</head>
<body>
<?php include "../../includes/navbar.php"?>
<div class="container">
	
    <section id="head-section">
    	<h1 class="header mt-5">Manage Products</h1>
    </section>
    <section class="mt-5">
        <div class="text-center text-success" id="success" style="font-size:20px;display:none">
            
        </div>
    <?php

        include '../../database/connection.php';

        $sql = 'select * from drinks';

        $dbc = mysqli_query($con,$sql);

        if($dbc){
            if($dbc->num_rows){
        ?>
         <table class="table align-middle mb-0 bg-white mt-4">
            <thead class="bg-light">
                <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($row = mysqli_fetch_array($dbc)){      
                ?>
                    <tr id="row<?=$row['id']?>">
                    <td>
                        <div class="d-flex align-items-center">
                        <img
                            src="<?=$row['image']?>"
                            alt="<?=$row['name']?>"
                            style="width: 45px; height: 45px"
                            class="rounded-circle"
                            />
                        <div class="ms-3">
                        <a href="view-product.php?id=<?=$row['id']?>" style="text-decoration:none;color:black">
                         <p class="fw-bold mb-1"><?=$row['name']?></p>
                        </a>
                        </div>
                        </div>
                    </td>
                    <td>
                        <p class="fw-normal mb-1"><?= substr($row['description'],0,50).'...'?></p>
                    </td>
                    <td>
                        <p class="fw-normal mb-1">&#163;<?=$row['price']?></p>
                    </td>
                   
                    <td>
                        <div style="display:flex;column-gap:12px;">
                            <a href="view-product.php?id=<?=$row['id']?>" style="color:black" ><i class="fa fa-eye"></i></a>
                            <a href="edit-product.php?id=<?=$row['id']?>" style="color:black"><i class="fa fa-edit"></i></a>
                            <a href="#" onclick="trash(<?=$row['id']?>)" style="color:black"><i class="fa fa-trash"></i></a>
                       <div>
                    </td>
                </tr>


                <?php
                   
                }
                
                ?>
            </tbody>
         </table>
        <?php
            }
            else{
               echo "<h1>No drinks available in stock</h1>";
            }
        }
        else{
            echo mysqli_error($con);
        }

    ?>
        	
    </section>
</div>

</div>

<script src="../../js/jquery.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/delete-product.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-
beta1/dist/js/bootstrap.bundle.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  
</body>
</html>