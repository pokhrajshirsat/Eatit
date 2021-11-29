<?php
include("delete-config.php");

$id=$_GET['id'];
$query = "DELETE FROM category WHERE id = '$id'";
$data=mysqli_query($conn,$query);
if($data){
  header("location: categories.php");
}
?>