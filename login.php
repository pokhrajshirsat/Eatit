<?php 
 $insert = false;
 if(isset($_POST['guest'])){               
 $servername="localhost";
 $username="root";
 $password="";
 $dbname = "orders";
                    
                    
 // Create connection
 $conn = new mysqli($servername, $username, $password, $dbname);
 // Check connection
 if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
 }
                    
 $TableNumber=  $_POST['TableNumber'];
 $guest = $_POST['guest'];

 $sql = "INSERT INTO `guestenter` (`TableNumber`, `guest`) VALUES ('$TableNumber', '$guest');";

if ($conn->query($sql) == TRUE) {
 
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
header("location: menu.php");
}
?>

<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="newnav.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Epilogue&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="menu.php">
    <title>Welcome | Home</title>
</head>

<body>

    <div class="topnav" id="myTopnav">
        <a href="#home">Home</a>
        <a href="#service" id="service">Service<i class="fas fa-user-friends"></i></a>
        <a href="#about">About</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>
    </div>

    <div style="padding-left:16px">
        <h2>Welcome to Our Restaurant</h2>
        <p></p>
    </div>
    <section>
        <div class="container">
            <div class="box-container">
                <h2>            <i class="fas fa-user-friends"></i>
</h2>
                <p>Customer Details</p>

                <form action="login.php" method="POST">
                    <label for="fname">Table Number</label><br>

                    <select id="TableNumber" name="TableNumber"> 
                        <option value="T_no1">Table no.1</option>
                        <option value="T_no2">Table no.2</option>
                        <option value="T_no3">Table no.3</option>
                        <option value="T_no4">Table no.4</option>
                        <option value="T_no5">Table no.5</option>
                        <option value="T_no6">Table no.6</option>

                        </select><br><br>


                    <label for="fname">Number of Guests</label><br>
                    <input type="numeric" name="guest" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" value=""><br><br><br>
                    <input type="submit" id="submit" value="let's go">
                   

                </form>
                
            </div>
        </div>
    </section>

    <script>
        function myFunction() {
            var x = document.getElementById("myTopnav");
            if (x.className === "topnav") {
                x.className += " responsive";
            } else {
                x.className = "topnav";
            }
        }
    </script>

</body>

</html>
