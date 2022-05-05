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
	<title>Fredgab Store | Checkout</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
	 <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/style.css">
    <link rel="stylesheet" type="text/css" href="../../css/checkout.css">

</head>
<body>
<?php include "../../includes/navbar.php"?>
<div class="container">
	
    <section id="head-section">
    	<h1 class="header mt-5"> Checkout</h1>
        <section class="mt-5">
        <form action="../../pay.php" method="post" id="checkout-form">
        <div class="container" id="">
        
        <?php
            if($error!=''){
            ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <div id="error"><?=$error?></div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <?php }?>
            
            
            <h3>Billing Information.</h3>
            <hr>
            <div class="mt-2">
            <!-- <label for="email"><b>First Name</b></label>
            <input type="text" placeholder="Enter Firstname" name="firsname" id="" value="<?=$_SESSION['auth_user']['firstname'] ?? ''?>" required>
            </div>

            <div class="mt-2">
            <label for="psw"><b>Email</b></label>
            <input type="email" placeholder="Enter Email" name="email" id=""  value="<?=$_SESSION['auth_user']['email'] ?? ''?>">
            </div> -->

            <div class="mt-2">
            <label for="psw"><b>Delivery Address</b></label>
            <input type="text" placeholder="Enter Address" name="address" id=""required>
            </div>

            <div class="mt-2">
            <label for="psw"><b>Phone Number</b></label>
            <input type="number" placeholder="Enter Mobile Number" name="number" id=""required>
            </div>
            <hr>

            
            </div>
            <h5>Sub Total :  &#8358;<?=$_SESSION['total_price']?></h5>
            <hr>
            <h5>Shipping Cost : Free</h5>
            <hr>
            <h5 style="color:#d33b33">Grand Total :  &#8358;<?=$_SESSION['total_price']?></h5>
            <input type="submit" name="submit"  style="background-color:#d33b33;color:white" class="btn" value="Place Order">
      
        </div>
      
        </div>
        
       
        </form>

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