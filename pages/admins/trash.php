<?php
session_start();
if(!isset($_SESSION['auth_admin'])){
  header("Location:/../../auth/admin/login.php");
}
include '../../database/connection.php';

$id = isset($_POST['id']) ? $_POST['id'] : null;

$sql = "delete  from drinks where id = '$id'";

$dbc = mysqli_query($con,$sql);

if($dbc){
    echo json_encode("Product deleted!");
}

?>