<?php

session_start();
if(!isset($_SESSION['auth_admin'])){
  header("Location:/../../auth/admin/login.php");
}
include '../../database/connection.php';

$id = isset($_POST['id']) ? $_POST['id'] : null;

$sql = "update orders set status=1 where  id = '$id'";

$dbc = mysqli_query($con,$sql);

if($dbc){
    echo json_encode("Mark as delivered");
}


?>