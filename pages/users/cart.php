<?php
session_start();


?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta charset="utf-8">
	<title>Fredgab Store | Cart</title>
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
    	<h1 class="header mt-5">Your Cart</h1>
        <section class="mt-5">
   
    <?php
         include '../../database/connection.php';
         session_start();
         
         if(!empty($_SESSION['cart'])){
         ?>
            <table class="table align-middle mb-0 bg-white mt-4">
            <thead class="bg-light">
                <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tbody>
        <?php
         foreach ($_SESSION['cart'] as $key => $cart) {
        ?>
            <tr>
                <td>
                    <div class="d-flex align-items-center">
                    <img
                        src="../admins/<?=$cart['product_image']?>"
                        alt="<?=$cart['product_name']?>"
                        style="width: 45px; height: 45px"
                        class="rounded-circle"
                        />
                    <div class="ms-3">
                        <p class="fw-bold mb-1"><?=$cart['product_name']?></p>
                    </div>
                    </div>
                </td>
                <td>
                <span class="h6">&#163;<?=$cart['product_price']?></span>                             
                </td>
                <td>
                <span class="h6"><?=$cart['qty'] ?></span>                             
                </td>
                <td>
                <span class="h6">&#163;<?=  number_format($cart['totalPrice'], 2) ?></span>                             
                </td>
                <td>
                    <div class="d-flex" style="column-gap:10px">
                    <div>
                    <form method="post" action="update-cart.php">
                        <!-- <label style="margin-top: 10px;"><b>Quantity</b></label><br> -->
                        <input type="number" name="quantity" style="width:70%" min="1" value="<?php  echo $cart['qty']?>" required>
                        <input type="hidden" name="product_id" value="<?php  echo $cart['product_id']?>">
                        <Button type="submit" name="submit" style="background-color: #383838;color:white" class="cart btn btn-sm ml-3 bt"><i class="fa fa-refresh"></i></Button>
                    </form>
                    </div>
                    <div>
                    <Button  class="cart btn btn-sm btn-danger" onclick="remove(<?=$cart['product_id']?>)"><i class="fa fa-trash"></i></Button>
                  
                    </div>

                    </div>
                </td>
              
            </tr>
        <?php
         }
        echo '</tbody>';
        echo "</table>";
        ?>
        <div class="float-right mt-5">
        <hr>
        <h4 style="color:#d33b33">Grand Total : &#163;<?= $_SESSION['total_price']?></h4>
        <hr>
        <a href="checkout.php" style="background-color:#d33b33;color:white" class="btn">Checkout</a>
        <a  href="../../index.php"style="background-color:#383838;color:white" class="btn">Continue Shopping</a>
        </div>
        <?php
        }
         else{
           
            echo '<h3 class="header mt-5">Oops! No item in cart </h3>';
         }
   
    ?>
        	
    </section>
    </section>
   
</div>

</div>

<script src="../../js/jquery.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/cart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-
beta1/dist/js/bootstrap.bundle.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  
</body>
</html>