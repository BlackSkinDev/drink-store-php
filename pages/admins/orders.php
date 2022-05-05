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
	<title>Fredgab Store | Orders</title>
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
    	<h1 class="header mt-5">Manage Orders</h1>
    </section>
    <section class="mt-5">
        <div class="text-center text-success" id="success" style="font-size:20px;display:none">
            
        </div>
    <?php

        include '../../database/connection.php';

        $sql = 'select * from orders';

        $dbc = mysqli_query($con,$sql);

        if($dbc){
            if($dbc->num_rows){
        ?>
         <table class="table align-middle mb-0 bg-white mt-4">
            <thead class="bg-light">
                <tr>
                <th>Order No</th>
                <th>Customer Name</th>
                <th>Amount Paid</th>
                <th>Date</th>
                <th>status</h>  
                <th>Action</th>
                <t>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($row = mysqli_fetch_array($dbc)){  
                    
                ?>
                <tr>
                   <td><?=$row['order_no']?></td>
                   <td><?=$row['firstname']?></td>
                   <td>&#163;<?=  number_format($row['total'], 2) ?></td>
                   <td><?=$row['date']?></td>
                   <td>
                       <?php
                            if($row['status'] ==1 ){
                                echo "<div class='badge badge-success'>Delivered</div>";
                            }
                            else{
                                echo "<div class='badge badge-warning'>Pending</div>";
                            }
                       ?>
                   </td>
                    <td>
                        <div style="display:flex;column-gap:12px;">
                            <a href="view-order.php?id=<?=$row['id']?>" style="color:black" ><i class="fa fa-eye"></i></a>
                        
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
               echo "<h1>No orders</h1>";
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