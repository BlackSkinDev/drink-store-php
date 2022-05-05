<?php


$error = '';


session_start();

if(isset($_SESSION['auth_user'])){
  header("Location:/../../index.php");
}

if(isset($_POST['submit'])){


include '../../includes/cleanInputs.php';
include '../../database/connection.php';


  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $password = $_POST['password'];
  $email =   $_POST['email'];
  $cpassword = $_POST['cpassword'];

  $_SESSION['firstname'] = $firstname;
  $_SESSION['lastname'] = $lastname;
  $_SESSION['email']= $email;


  if($firstname == ''){
    $error = 'Firstname must not be empty';
  }
  elseif($lastname == ''){
    $error = 'Lastname must not be empty';
  }
  elseif($email == ''){
    $error = 'Email must not be empty';
  }
  elseif($password == ''){
    $error = 'Password must not be empty';
  }
  elseif($cpassword == ''){
    $error = 'Confirm Password ';
  }
  elseif($password!=$cpassword){
    $error = 'Passwords do not match';
  }
  else{
     $cleanFirstname = cleanUserInput($_POST['firstname']);
     $cleanLastname = cleanUserInput($_POST['lastname']);
     $cleanEmail = cleanUserInput($_POST['email']);
     $cleanPassword = sha1(cleanUserInput($_POST['password']));

      $sql = "insert into users (firstname,lastname,email,password) values('$cleanFirstname','$cleanLastname','$cleanEmail','$cleanPassword')";
      $dbc = mysqli_query($con,$sql);
      if($dbc){
        unset($_SESSION['firstname']);
        unset($_SESSION['lastname']);
        unset($_SESSION['email']);
        
        echo "
        <script type=\"text/javascript\">
          alert('Registration success, You are being redirected to Login');
          window.location='login.php'
        </script>";
      }
      else{
        $serverError = mysqli_error($con);
        if (strpos($serverError,'Duplicate') !== false || strpos($serverError,'entry') !== false) {
          $error ='Email is already registered';
        }
        else{
          $error = 'Error encountered, try again later';
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
	<title>Fredgab Store | Register</title>
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
<?php include "../../includes/header.php"?>
<div class="container">
	
    <section id="head-section">
    	<h1 class="header">Register</h1>
    </section>

	
		
<form action="" method="post" id="register-form">
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
    
    
    <p>Please fill in this form to create an account.</p>
    <hr>
    <div>
    <label for="firstname"><b>Firstname</b></label>
    <input type="text" placeholder="Enter First Name" name="firstname" id="firstname" value="<?=$_SESSION['firstname'] ?? '' ?>">
    <div class="text-danger adjusted-input"  id="firstname-err"></div>
    </div>

    <div class="mt-2">
    <label for="lastname"><b>Lastname</b></label>
    <input type="text" placeholder="Enter Last Name" name="lastname" id="lastname" value="<?=$_SESSION['lastname'] ?? '' ?>">
    <div class="text-danger adjusted-input"  id="lastname-err"></div>
    </div>

    <div class="mt-2">
    <label for="email"><b>Email</b></label>
    <input type="email" placeholder="Enter Email" name="email" id="email" value="<?=$_SESSION['email'] ?? ''?>">
    <div class="text-danger adjusted-input"  id="email-err"></div>
    </div>

    <div class="mt-2">
    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" id="password" >
    <div class="text-danger adjusted-input"  id="password-err"></div>
    </div>

    <div class="mt-2">
    <label for="psw-repeat"><b>Confirm Password</b></label>
    <input type="password" placeholder="Repeat Password" name="cpassword" id="cpassword">
    <div class="text-danger adjusted-input"  id="cpassword-err"></div>
    </div>
    <hr>
    <p>By creating an account you agree to our Terms & Privac.</p>

    <button type="submit" id="button-submit" name="submit"  class="registerbtn">Create Account</button>
  </div>
  
  <div class="container signin">
    <p>Already have an account? <a href="login.php">Sign in</a>.</p>
  </div>
</form>

	
	
</div>

<?php include "../../includes/footer.php"?>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/user-register.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-
beta1/dist/js/bootstrap.bundle.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  
</body>
</html>