<?php
/*
This file contains database configuration assuming you are running mysql using user "root" and password ""
*/

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'orders');

// Try connecting to the Database
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

//Check the connection
if($conn == false){
    die('Error: Cannot connect');
}

$id=$_GET['id'];
$query = "DELETE FROM products WHERE id = '$id'";
$data=mysqli_query($conn,$query);
if($data){
  header("location: products.php");
}

?>