<?php
session_start();

$id = isset($_POST['id']) ? $_POST['id'] : null;

foreach ($_SESSION['cart'] as $item=>$singleItem) {
        	
    if($singleItem['product_id']==$id){

        $_SESSION['total_price']=$_SESSION['total_price']-$singleItem['totalPrice'];
        

        unset($_SESSION['cart'][$item]);
        
        $_SESSION['total_items']= $_SESSION['total_items']-1;
    
        
    }
    
}

echo json_encode("Item removed from cart!");

?>