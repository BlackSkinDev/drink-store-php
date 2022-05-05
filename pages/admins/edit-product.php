<?php
session_start();
if(!isset($_SESSION['auth_admin'])){
  header("Location:/../../auth/admin/login.php");
}

$error = '';
$successMessage='';
$isFileSelected = false;

if(isset($_POST['submit'])){


include '../../includes/cleanInputs.php';
include '../../database/connection.php';

  $product_id = isset($_GET['id']) ? $_GET['id'] : null;
  if($product_id){
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    
    $imageName = basename($_FILES['image']['name'] )?? '' ;

    
    if($imageName !=''){
        $isFileSelected = true;
    }

    $imageTmp = $_FILES['image']['tmp_name'] ?? '';
    $imageSize = $_FILES['image']['size'] ?? '';
    $extension = pathinfo($imageName, PATHINFO_EXTENSION) ?? '';
    $imagePath = "uploads/".$imageName;
    $exts = ['png', 'jpg', 'jpeg'];

    $_SESSION['name']= $name;
    $_SESSION['description']= $description;
    $_SESSION['price']= $price;




  if($name == ''){
    $error = 'Product name must not be empty';
  }
  elseif($description == ''){
    $error = 'Product description must not be empty';
  }
  elseif($price == ''){
      $error = 'Product price must not be empty';
  }
  elseif($imageName != '' && $extension!='' && !in_array($extension,$exts)){
    $error ='Only png, jpeg and jpg images are supported';
  }
  elseif($imageName != '' && $imageSize > 3000000){
    $error ='Image cannot exceed 3mb';
  }

  else{

    

     $cleanName = cleanUserInput($_POST['name']);
     $cleanDescription = cleanUserInput($_POST['description']);
     $cleanPrice= cleanUserInput($_POST['price']);
    
     
        if($isFileSelected){
            $sql = "update drinks 
            set name ='$cleanName',
            description ='$cleanDescription',
            price ='$cleanPrice',
            image = '$imagePath'
            where id='$product_id'";
        }
        else{

            $sql = "update drinks 
            set name ='$cleanName',
            description ='$cleanDescription',
            price ='$cleanPrice'
            where id='$product_id'";

        }


        $dbc = mysqli_query($con,$sql);
        if($dbc){
            if($isFileSelected){
                move_uploaded_file($imageTmp, "uploads/" .$imageName) ;
            }
            unset($_SESSION['name']);
            unset($_SESSION['description']);
            unset($_SESSION['price']);
            $successMessage = 'Product updated successfully';
        } 
      else{
        $error = mysqli_error($con);
        ;
      }
      

    
  }
  
  }
  
  
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta charset="utf-8">
	<title>Fredgab Store | Edit Product</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
	 <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/style.css">
    <link rel="stylesheet" type="text/css" href="../../css/edit.css">


</head>
<body>
<?php include "../../includes/navbar.php"?>
<div class="container">
	
    <section id="head-section">
    	<h1 class="header mt-5">Edit Product</h1>
        <section class="mt-2">
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
 <form action="" method="post" id="product-form" enctype="multipart/form-data">
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
    <?php }
    
    if($successMessage!=''){
    ?>
     <div class="alert alert-success alert-dismissible fade show" role="alert">
      <div id="success"><?=$successMessage?></div>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <?php }
    ?>
    
    <p>Please update product information.</p>
    <hr>
    <div class="">
    <label for="email"><b>Product Name <span id="indicator">*</span></b></label>
    <input type="text" placeholder="Enter Product Name" name="name" id="name" value="<?=!empty($_SESSION['name']) ? $_SESSION['name'] : $row['name']?>">
    <div class="text-danger adjusted-input"  id="name-err"></div>
    </div>
    
    <div class="mt-4">
    <label for="email"><b>Product Description <span id="indicator">*</span></b></label>
    <textarea placeholder="Enter Product Description" cols="40" rows="5" name="description" id="description"><?=$_SESSION['description'] ?? $row['description']?></textarea>
    <div class="text-danger adjusted-input"  id="description-err"></div>
    </div>

    <div class="mt-4">
    <label for="email"><b>Product Price <span id="indicator">*</span></b></label>
    <input type="number" placeholder="Enter Product price" name="price" id="price" value="<?=$_SESSION['price'] ??$row['price'] ?>">
    <div class="text-danger adjusted-input"  id="price-err"></div>
    </div>
    
    <div class="mt-4">
    <label for="email"><b>Product Image</b></label>
    <input type="file" name="image" id="file">
    <div class="text-danger adjusted-input"  id="file-err"></div>
    </div>
    </div>


    <hr>
   
    <button type="submit" id="button-submit" name="submit"  class="registerbtn">Update</button>
  </div>
  
 
</form>


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
<script src="../../js/edit-product.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-
beta1/dist/js/bootstrap.bundle.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  
</body>
</html>