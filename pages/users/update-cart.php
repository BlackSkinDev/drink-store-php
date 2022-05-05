<?php
session_start();
if(isset($_POST['submit'])){
    $id= $_POST['product_id'];
    $qty=$_POST['quantity'];
    

   
    foreach ($_SESSION['cart'] as $item=>$singleItem) {
        if($singleItem['product_id']==$id){       
           // remove from session total_price,total_items
           $_SESSION['total_price']=$_SESSION['total_price'] - $_SESSION['cart'][$item]['totalPrice'];
           
       
       
           $totalPrice = $_SESSION['cart'][$item]['product_price']* $qty;
          $_SESSION['total_price']=$_SESSION['total_price']+$totalPrice;
          
       

           $_SESSION['cart'][$item]['totalPrice']=$totalPrice;
           $_SESSION['cart'][$item]['qty']=$qty;
           
        }
    }

    // print_r($_SESSION['cart']);
    // print_r($_SESSION['total_price']);

    // die();

    header("Location:cart.php");
   
}


?>