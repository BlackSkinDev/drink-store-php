<?php
session_start();
if(!isset($_SESSION['auth_user'])){
    $_SESSION['is_checkout'] = 1;
    header("Location:/../../auth/users/login.php");
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta charset="utf-8">
	<title>Fredgab Store | View Order</title>
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
    	<h1 class="header mt-5">View Order</h1>
        <section class="mt-5">
    <?php

    include '../../database/connection.php';

    if(isset($_GET['id'])){
        
        $id = $_GET['id'];

        $sql = "select * from orders where id = '$id'";

        $dbc = mysqli_query($con,$sql);

        while($row = mysqli_fetch_array($dbc)){
            $order_date = $row['date'];
            $order_number = $row['order_no'];
            $order_address = $row['address'];
            $order_contact = $row['contact'];
            $order_amount = $row['total'];
            $order_status = $row['status'];
         }
    
        ?>
        <h4 class="">Order Details</h4>
        <div class="d-flex mt-4" style="column-gap:15px">
        <span><b>Order Number</b> : <?=$order_number?></span>
        <span><b>Date</b> : <?=$order_date?></span>
        <span><b>Address</b> : <?=$order_address?></span>
        <span><b>Contact</b> : <?=$order_contact?></span>
        </div>
    <?php

    }

    ?>

    <h4 class="mt-5">Order Items</h4>
    <?php
         $sql2 = "select * from order_details where order_id = '$id' ";
         $dbc2 = mysqli_query($con,$sql2);
         if($dbc2){
         ?>
          <table class="table align-middle mb-0 bg-white mt-4">
                 <thead class="bg-light">
                     <tr>
                     <th>Product Name</th>
                     <th>Price</th>
                     <th>Quantity</th>
                     <th>Total Price</th>
                     <t>
                     </tr>
                 </thead>
                 <tbody>
         <?php
             while($row2= mysqli_fetch_array($dbc2)){
         ?>
           <tr>
             <td><?=$row2['product_name']?></td>
             <td>&#163;<?=  number_format($row2['price'], 2) ?></td>
             <td><?=$row2['quantity']?></td>
             <td>&#163;<?=  number_format($row2['total_price'], 2) ?></td>
           </tr>
     
         <?php
             }
         }
         ?>
             </tbody>
          </table>
          <div class="float-right mt-5">
        <hr>
        <h4 style="color:#d33b33">Grand Total : &#163;<?= number_format($order_amount,2)?></h4>
        <hr>
      
        <a  href="/pages/users/orders.php" style="background-color:#383838;color:white" class="btn">Back</a>
        </div>
    </section>
    </section>
   
</div>

</div>

<script src="../../js/jquery.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/dispatch-order.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-
beta1/dist/js/bootstrap.bundle.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  
</body>
</html>