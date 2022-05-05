<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta charset="utf-8">
	<title>Fredgab Cocktails | Home</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
	 <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>
<?php include "includes/header.php";
session_start();
?>
<div class="container">
	
    <section id="head-section">
    	<h1 class="header">Our Drinks</h1>
    </section>
    
    	<section class="text-center">

		<?php

		include 'database/connection.php';
		$sql="select * from drinks";
		$dbc= mysqli_query($con,$sql);

		if ($dbc) {
		  $count=0;
			foreach ($dbc as $key => $product) {
				
				 if($count%3==0){
					echo "<div class='row my-row' p-3>";
			}
			 echo "<div class='col-md-4 col-8 mt-4'>";
			 echo '<div class="card">';
			 echo '<img src="/pages/admins/'.$product['image'].'" class="img" alt="...">';
			 echo '<div class="card-body">';
			 echo '<h5 class="card-title">'.$product['name'].'</h5>';
				echo '<a href="/pages/users/add-to-cart.php?id='.$product['id'].'"  id="button">Add</a>';
			
			 echo '<div id="price"><b>&#163;'.$product['price'].'</b></div>';
			 echo '<p>'.substr($product['description'],0,50).'..</p>';
			 echo '</div>
			 </div></div>'; 
		$count++;
		if ($count%3==0 && $count!=0) {
			echo "</div>";
		}
		else{
			echo "<div class='mt-5'></div>";
		  }  
	 }
 }
		else{
			echo mysqli_error($con);
		}


		?>
    		
    	</section>
</div>

<?php include "includes/footer.php"?>
</div>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-
beta1/dist/js/bootstrap.bundle.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  
</body>
</html>