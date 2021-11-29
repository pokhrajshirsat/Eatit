<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'categories');

// Try connecting to the Database
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn-> connect_error) {
      die("connection failed:".$con-> connect_error);
  }

  $insert = false;
if(isset($_POST['category'])){
  $category=$_POST["category"];
  $image=$_POST["image"];

  $sql= "INSERT INTO `categories`.`category`(`category`, `image`) VALUES ('$category', '$image');";
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
header("location: categories.php");
}

?>