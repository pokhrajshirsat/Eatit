<?php
$insert = false;
if(isset($_POST['restaurant_name'])){
    // Set connection variables
    $server = "localhost";
    $username = "root";
    $password = "";

    // Create a database connection
    $con = mysqli_connect($server, $username, $password);

    // Check for connection success
    if(!$con){
        die("connection to this database failed due to" . mysqli_connect_error());
    }
    // echo "Success connecting to the db";

    // Collect post variables
    $restaurant_name = $_POST['restaurant_name'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $seat = $_POST['seat'];
    $sub = $_POST['sub'];
    $open = $_POST['open'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $website = $_POST['website'];
    $lisence = $_FILES['lisence'];
    $pan = $_FILES['pan'];
    $fssai = $_FILES['fssai'];
    $sql = "INSERT INTO `users_details`.`users_details` (`restaurant_name`, `phone`, `city`, `seat`, `sub`, `open`, `address`, `email`, `website`, `lisence`, `pan`, `fssai`, `date`) VALUES ('$restaurant_name', '$phone', '$city', '$seat', '$sub', '$open', '$address', '$email', '$website', '$lisence', '$pan', '$fssai', current_timestamp());";
   
    // echo $sql;

    // Execute the query
    if($con->query($sql) == true){
        // echo "Successfully inserted";

        // Flag for successful insertion
        $insert = true;
    }
    else{
        echo "ERROR: $sql <br> $con->error";
    }

    // Close the database connection
    $con->close();
    header("location: index.php");
}
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
             <img src="image/hat.svg" alt="">
        </div>
        <div class="eatit">
             <img src="image/Eatit.svg" alt="">
        </div>
        <div class="left">
            <p>Partner with Eatit</p>
            <h1>Get listed India’s smart restaurent customer service platform</h1>
            
          </div>
    </div>
    <form action=" " method="post" enctype="multipart/form-data">
    <div class="box4">
      <h1>Basic Info</h1>
      <div class="input-restaurant">
        <p>Restaurant name <span class="star">*</span></p>
        <input type="text" name="restaurant_name" placeholder="Restaurant Name" class="validate">
      </div>
      <div class="input-phone-number">
        <p>Phone number <span class="star">*</span></p>
        <input type="number" name="phone" placeholder="Phone Number" class="validate">
      </div>
      <div class="input-city">
        <p>City <span class="star">*</span></p>
        <input type="text" name="city" placeholder="City" class="validate">
      </div>
      <div class="input-seating-capacity">
        <p>Seating capacity <span class="star">*</span></p>
        <input type="number" name="seat" placeholder="Seating Capacity" class="validate">
      </div>
      <div class="manager">
        <p>Are you the owner or manager of this place? <span class="star">*</span></p>
        <p><input type="radio" id="checkbox" name="sub" value="not-manager">I’m not the owner/manager</p>
        <p><input type="radio" id="checkbox" name="sub" value="manager">I’m the owner/manager</p>
      </div>
      <div class="opening-status">
        <p>Opening status <span class="star">*</span></p>
        <p><input type="radio" id="checkbox" name="open" value="open">This place is already open</p>
        <p><input type="radio" id="checkbox" name="open" value="not-open">This place is opening soon</p>
        
      </div>
    </div>

    <div class="box5">
      <h1>Location</h1>
      <div class="input-location">
        <p>Address/Landmark <span class="star">*</span></p>
        <input type="text" name="address" placeholder="Address/Landmark" class="validate">
      </div>  
      <div class="map-coordinates">
        <p>Map coordinates <span class="star">*</span></p>
      </div>
    </div>

    <div class="box6">
      <h1>Contact Information</h1>
      <div class="input-restaurant-email">
        <p>Restaurant email <span class="star">*</span></p>
        <input type="email" name="email" placeholder="Restaurant Email" class="validate">
      </div>  
      <div class="input-restaurant-website">
        <p>Restaurent website <span class="star">*</span></p>
        <input type="text" name="website" placeholder="Restaurant Website" class="validate">
      </div>    
    </div>
     <div class="box7">
       <h1>Documents</h1>
       <div class="lisencelabel">
         <p>Shop Lisence <span class="star">*</span></p>
       <input type="file" name="lisence" class="lisence" id="lisence" value="lisence">
      </div>
       <div class="panlabel">
       <p>GSTIN/PAN <span class="star">*</span></p>
       <input type="file" name="pan" class="pan" id="pan" value="pan">
      </div>
       <div class="fssailabel">
         <p>FSSAI <span class="star">*</span></p>
       <input type="file" name="fssai" class="fssai" id="fssai" value="fssai">
      </div>
     </div>
    <div class="btn-space">
    <button class="btn" type="submit">Submit</button>
  </div>
    </form>

    
</body>
</html>