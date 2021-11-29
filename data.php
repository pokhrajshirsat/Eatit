<?php
   $server = "localhost";
   $email = "root";
   $password = "";
   
   $con = mysqli_connect($server, $email, $password);

   if(!$con){
       die("connecttion to the database failed due to" . mysqli_connect_error());
   }
   //echo "sucess connecting";

   $email = $_POST['email'];
   $password =  $_POST['password'];
   $sql = "INSERT INTO `account list` (`email`, `password`, `date`) VALUES (' $email', ' $password', current_timestamp());";
   echo $sql;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&family=Sarala&family=Secular+One&display=swap" rel="stylesheet">
<link rel="stylesheet" href="data-style.css">

</head>

<body>

    <div class="pizza">
        <img src="image/Pizza@2.jpg" style="width: 100%;height: 340px;">
        <div class="logo-hat">
             <img src="image/—Pngtree—blue chef hat vector stick_4493881 2.svg" alt="">
        </div>
        <div class="eatit">
             <img src="image/Eatit.svg" alt="">
        </div>
        <div class="left">
            <p>Partner with Eatit</p>
            <h1>Get listed India’s smart restaurent customer service platform</h1>
            
          </div>
    </div>
    <form action=" " method="post">
    <div class="box4">
      <h1>Basic Info</h1>
      <div class="input-restaurant">
        <p>Restaurant name*</p>
        <input placeholder="Restaurant Name" class="validate">
      </div>
      <div class="input-phone-number">
        <p>Phone number*</p>
        <input placeholder="Phone Number" class="validate">
      </div>
      <div class="input-city">
        <p>City*</p>
        <input placeholder="City" class="validate">
      </div>
      <div class="input-seating-capacity">
        <p>Seating capacity*</p>
        <input placeholder="Seating Capacity" class="validate">
      </div>
    </div>

    <div class="box5">
      <h1>Location</h1>
      <div class="input-location">
        <p>Address/Landmark*</p>
        <input placeholder="Address/Landmark" class="validate">
      </div>  
      <div class="map-coordinates">
        <p>Map coordinates*</p>
      </div>
    </div>

    <div class="box6">
      <h1>Contact Information</h1>
      <div class="input-restaurant-email">
        <p>Restaurant email*</p>
        <input placeholder="Restaurant Email" class="validate">
      </div>  
      <div class="input-restaurant-website">
        <p>Restaurent website*</p>
        <input placeholder="Restaurant Website" class="validate">
      </div>    
    </div>

    <div class="btn-space">
    <button class="btn">Submit</button>
  </div>
    </form>

    <!-- INSERT INTO `users_data` (`sno`, `restaurant_name`, `phone_number`, `city`, `seating_capacity`, `address`, `restaurant_email`, `restaurent_website`, `date`) VALUES ('1', 'Golden Tulip', '7635539746', 'Jalpaiguri', '100', 'Kadamtola,Jalpaiguri', 'goldentulip456@gmail.com', 'https://www.tripadvisor.in/Hotel_Review-g1549815-d12287853-Reviews-Hotel_Golden_Tulip-Jalpaiguri_Jalpaiguri_District_West_Bengal.html', current_timestamp()); -->
</body>
</html>