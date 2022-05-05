<?php
    session_start();
   

    if(!isset($_SESSION['auth_user'])){
        header("Location:/../../auth/users/login.php");
    }
    
    if (isset($_POST['submit'])) {
        include '../../database/connection.php';
       
        $product_id= $_POST['product_id'];
        $qty=$_POST['quantity'];
       
    
            $sql= "select * from drinks where id='$product_id' ";
    
            // fetch product info from db
            $dbc=mysqli_query($con,$sql);
            while ($row=mysqli_fetch_array($dbc)) {
                $product_id= $row['id'];
                $product_image=$row['image'];
                $product_name=$row['name'];
                $product_price=$row['price'];
            }

          
    
         //cart doesn't exist, create cart
            if (!isset($_SESSION['cart'])) {
                //create a new cart array in session
                $_SESSION['cart']=[];
    
                // session variable for total item in cart
                $_SESSION['total_items']=0;
    
                // session variable for total price of items in cart
                $_SESSION['total_price']=0;
    
    
                //get total price of item
                $totalPrice= $product_price*$qty;
                  
                // store product in session cart array
                  array_push($_SESSION['cart'],array(
                    'product_id'=>$product_id,
                    'product_name'=>$product_name,
                    'product_image'=>$product_image,
                    'product_price'=>$product_price,
                    'totalPrice'=>$totalPrice,
                    'qty'=>$qty
                ));
    
                  // increment total amount of items in cart and total items picked
                $_SESSION['total_price']= $totalPrice;
                $_SESSION['total_items']= 1;
                //  redirect to shop
                header("Location:../../index.php");
                // echo "
                // <script type=\"text/javascript\">
                //   alert('Product added to cart');
                //   window.location='../../index.php'
                // </script>";
              
            } // e
    
            // add new item to existing cart
            else {
    
                //get total price of item
                $totalPrice= $product_price*$qty;
    
                $CartIds= [];
    
                foreach ($_SESSION['cart'] as $item=>$singleItem) {
                    
                    if ($singleItem['product_id']==$product_id) {
                        $CartIds[]= $item;
                    }
    
                }
    
                if (empty($CartIds)) {
                    array_push($_SESSION['cart'],array(
                    'product_id'=>$product_id,
                    'product_name'=>$product_name,
                    'product_image'=>$product_image,
                  
                    'product_price'=>$product_price,
                    'totalPrice'=>$totalPrice,
                    'qty'=>$qty
                    ));
    
                    $_SESSION['total_price']= $_SESSION['total_price'] + $totalPrice;
                    $_SESSION['total_items']= $_SESSION['total_items']+1;
                    header("Location:../../index.php");
                    // echo "
                    // <script type=\"text/javascript\">
                    //   alert('Product added to cart');
                    //   window.location='../../index.php'
                    // </script>";
                }
                else{
                    $item= $CartIds[0];
                    $_SESSION['cart'][$item]['qty']+=$qty;
                    $_SESSION['cart'][$item]['totalPrice']+=$totalPrice;
                    $_SESSION['total_price']+= $totalPrice;
                    header("Location:../../index.php");
                    // echo "
                    // <script type=\"text/javascript\">
                    //   alert('Product added to cart');
                    //   window.location='../../index.php'
                    // </script>";
                   
                }
                  
        }
    }
   

?>