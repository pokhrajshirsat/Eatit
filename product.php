<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'orders');

// Try connecting to the Database
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn-> connect_error) {
      die("connection failed:".$con-> connect_error);
  }

  $insert = false;
if(isset($_POST['name'])){ 
    $id=$_POST["id"];
  $name=$_POST["name"];

  $image=$_POST["image"];
  $price=$_POST["price"];
  $description=$_POST["description"];
  $sql= "INSERT INTO `orders`.`products`(`id`, `name`, `image`, `price`, `description`) VALUES ('$id', '$name', '$image', '$price', '$description');";
  if($conn->query($sql) == true){
    // echo "Successfully inserted";

    // Flag for successful insertion
    $insert = true;
}
else{
    echo "ERROR: $sql <br> $conn->error";
}

// Close the database connection
$conn->close();
header("location: products.php");
}

?>