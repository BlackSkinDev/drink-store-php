<?php
session_start();
unset($_SESSION['auth_admin']);
header('Location:login.php');
?>