<?php
error_reporting(E_ALL & ~E_NOTICE);
 session_start();
?>
<nav class="navbar navbar-expand-lg navbar-light bg-dark fixed-top" >
  <a class="navbar-brand" href="/">Fredgab Cocktails </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      
     
      <?php
      if(isset($_SESSION['auth_user'])){
        echo ' <a class="nav-item nav-link active" href="/">Home <span class="sr-only">(current)</span></a>';
        echo ' <a class="nav-item nav-link " href="/auth/users/logout.php">Logout</a>';
      }
      elseif(isset($_SESSION['auth_admin'])){
          echo '<a class="nav-item nav-link active" href="/pages/admins/dashboard.php">Home <span class="sr-only">(current)</span></a>';
          echo ' <a class="nav-item nav-link " href="/auth/admin/logout.php">Logout</a>';
      }
      else{
          echo ' <a class="nav-item nav-link " href="/auth/users/login.php">Login</a>';
      }
      ?>
    </div>
  </div>
   <div class=" ml-auto" id="navbarNavAltMarkup">
    <div class="navbar-nav">
     <?php if(!isset($_SESSION['auth_admin'])){?>
      <div id="cart-button" class="mr-4">
      	<a class="nav-item nav-link " href="/../pages/users/cart.php">
      		<i class="fa fa-shopping-cart mr-2"></i>
      		Cart 
      		 <span class="cart-badge">
             <?php
                if(isset($_SESSION['total_items'])  && $_SESSION['total_items']!=''){
                  echo $_SESSION['total_items'];
                }
                else{
                  echo 0;
                }
             ?>
           </span>
      	</a>
      </div>
      <?php }
      if(isset($_SESSION['auth_user'])){
        echo ' <a class="nav-item nav-link " href="#">Howdy '. $_SESSION['auth_user']['firstname'] . '</a>';
        echo ' <a class="nav-item nav-link " href="/pages/users/orders.php">My Orders</a>';
       
      }
      if(isset($_SESSION['auth_admin'])){
        echo ' <a class="nav-item nav-link " href="#">Howdy '. $_SESSION['auth_admin']['username'] . '</a>';
        echo ' <a class="nav-item nav-link " href="/../pages/admins/create-product.php">Add Product</a>';
        echo ' <a class="nav-item nav-link " href="/pages/admins/orders.php">Orders</a>';
       
    }
      ?>
     
   
    </div>
  </div>
</nav>