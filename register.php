<?php
require_once "config.php";

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Username cannot be blank";
        header("location: wrong.php");
    }
    else{
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt)
        {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set the value of param username
            $param_username = trim($_POST['username']);

            // Try to execute this statement
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $username_err = "This username is already taken"; 
                }
                else{
                    $username = trim($_POST['username']);
                }
            }
            else{
              header("location: wrong.php");
            }
           
        }
        else{
          header("location: wrong.php");
        }

    }

    mysqli_stmt_close($stmt);


// Check for password
if(empty(trim($_POST['password']))){
    $password_err = "Password cannot be blank";
    header("location: wrong.php");
}
elseif(strlen(trim($_POST['password'])) < 5){
    $password_err = "Password cannot be less than 5 characters";
    header("location: wrong.php");
}
else{
    $password = trim($_POST['password']);
}


// Check for confirm password field
if(trim($_POST['password']) !=  trim($_POST['confirm_password'])){
    $password_err = "Passwords should match";
    header("location: wrong.php");
}


// If there were no errors, go ahead and insert into the database
if(empty($username_err) && empty($password_err) && empty($confirm_password_err))
{
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt)
    {
        mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

        // Set these parameters
        $param_username = $username;
        $param_password = password_hash($password, PASSWORD_DEFAULT);

        // Try to execute the query
        if (mysqli_stmt_execute($stmt))
        {
            header("location:details.php");
        }
        else{
          
            header("location: wrong.php");
          
        }
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}
?>







<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&family=Sarala&family=Secular+One&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="wrong.php">
<link rel="stylesheet" href="wrong-login.php">
<link rel="stylesheet" href="login.php">
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
</head>
<body>

  <div class="box">
    
      <nav>
      <ul class="nav-items">
         <li>
           <a href="#" class="active">Home</a>
         </li>
         <li>
           <a href="#">Contact</a>
         </li>
         
      </ul>
     
       
      </nav>
    
        <div class="logo-hat">
          <img src="image/hat.svg" style="width: 95px;height: 105px;">
        </div>
        <div class="eatit">
          <img src="image/Eatit.svg" style="width: 130px;height: 50px;">
        </div>
        <div class="forbusiness">
          <img src="image/for business.svg" style="width: 123px;height: 23px;">
        </div> 
        <div class="left">
          <p>Partner with Eatit</p>
          <h1>Get listed <br> India's smart restaurent <br> customer service platform</h1>
          <a href="#" class="btn-gs">Get Started</a>
        </div>
       

        
       
  </div>

  <div class="popup" id="popup-1">
    
    <button onclick="togglePopup()" class="first-button">Login</button>
    
    <div class="content">
     
      <h1>Login</h1> 
      <form action="login.php" method="post">
      <div class="input-field"><input type="text" placeholder="Username" name="username" class="validate"></div>
      <div class="input-field"><input type="password" placeholder="Password" name="password" class="validate"></div>
      
       <button class="second-button">Login</button>
     
      </form>
   <p>Don't have an account? <a href="#"  onclick="togglePopup2()">Sign Up</a></p>
   <div class="close-btn" onclick="togglePopup()">
    ×</div>
     </div>
     
  </div>
  
  <div class="popup2" id="popup-2">
    <button onclick="togglePopup2()" class="first-button">Create Account</button>
    <div class="content">
     
      <h1>Sign Up</h1> 
      <form action=" " method="post">
      <div class="input-field"><input type="text" id="input-username" placeholder="Username" name="username" class="validate"></div>
      <div class="input-field"><input type="password" id="input-password" placeholder="Password" name="password" class="validate"></div>
      <div class="input-field"><input type="password" id="input-password" placeholder="Confirm Password" name="confirm_password" class="validate"></div>
       
          <button class="second-button" >Create Account</button>
        
      </form>
   <p>Already have an account? <a href="#" onclick="togglePopup()">Login</a></p>
   <div class="close-btn" onclick="togglePopup2()">
    ×</div>
     </div>
     
  </div>

  
 
 
  

<div class="slideshow-container">
  

<div class="mySlides fade">
  
  <img src="image/image1.jpg" style="width:100%">
  
</div>

<div class="mySlides fade">
 
  <img src="image/image@2.jpg" style="width:100%">
    
 
</div>

<div class="mySlides fade">
  
  <img src="image/image4.jpg" style="width:100%">
  
</div>

<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>



</div>






<div class="header">
    <div class="ellipse1">
        <div class="customer-base">
          <img src="image/customer base 1.png" alt="">
          <p>Reach out <br> to a large <br> customer <br> base</p>
          
        </div>
    </div>
    <div class="ellipse2">
        <div class="revenue">
           <img src="image/increase revenue 1.png" style="width: 100px;height:100px;">
           <p>Increase your <br> revenue</p>
          
        </div>
    </div>
    <div class="ellipse3">
      <div class="brand-visibility">
         <img src="image/Visiblity 1.png" alt="">
         <p>Increase <br> your brand <br> visibility</p>
        
      </div>
  </div>
  
  
</div>

<div class="box2">
   <h1>Get started in 3 easy steps</h1>
   <div class="rectangle1">
      <div class="ellipse4">
        <div class="create-page">
          <img src="image/create page 1.png" alt="">
        </div>
        <p>Step-1</p>
      </div>
      <p>Create your <br> account on Eatit</p>
   </div>
   <div class="rectangle2">
    <div class="ellipse5">
      <div class="register">
           <img src="image/register 1.png" alt="">
      </div>
      <p>Step-2</p>
    </div> 
    <p> Register & set up <br> for online ordering</p>
   </div>
  
   <div class="rectangle3">
    <div class="ellipse6">
      <div class="recive-order">
            <img src="image/order-food 1.png" alt="">
      </div>
      <p>Step-3</p>
    </div>
    <p>Start receiving <br> orders online</p>
  </div>
</div>

<div class="box3">
    <p>Become a Eatit partner today</p>
    <a href="#" class="btn3">Get Started</a>
</div>

<div class="some-text">
  <div class="one-image">
        <img src="image/laptop@1.png" style="width: 400px;height:240px;">
  </div>
  <p>............................................................ <br> ............................................................ <br> ............................................................ <br> ............................................................ <br> ............................................................ <br> ............................................................ </p>
</div>

<div class="container">
 
  <h2>Frequently Asked Questions</h2>
 
  <div class="accordion">
    <div class="accordion-item">
      <a>What are the mandatory documents needed to list my restaurent on Eatit ?</a>
      <div class="content">
        <p>-  
          FSSAI Licence OR FSSAI Acknowledgement
          <br> -  
           Pan Card
          <br> -  
          GSTIN Certificate
          <br> -  
          Cancelled Cheque OR bank Passbook
          <br> -  
          Menu</p>
      </div>
    </div>
    <div class="accordion-item">
      <a>How much commision will I be charged by Eatit ?</a>
      <div class="content">
        <p>The commission charges vary for different cities. </p>
      </div>
    </div>
    <div class="accordion-item">
      <a>I don’t have an FSSAI lisence for my restaurent, can I register?</a>
      <div class="content">
        <p>FSSAI licence is a mandatory requirement according to the government’s policies. However, if you are yet to receive the licence at the time of onboarding, you can proceed with the acknowledgement number which you will have received from FSSAI for your registration.</p>
      </div>
    </div>
    <div class="accordion-item">
      <a>Is it Cloud Kitchen allowed on Eatit?</a>
      <div class="content">
        <p>No.</p>
      </div>
    </div>
    
  </div>
  
</div>


<footer class="footer1">
  <div class="logo-hat">
    <img src="image/hat.svg" style="width: 95px;height: 105px;">
  </div>
  <div class="eatit">
    <img src="image/Eatit.svg" style="width: 130px;height: 50px;">
  </div>
   <div class="company">
    <h1>COMPANY</h1>
    <ul class="company-items">
      <li>
          <a href="#">About Us</a>
      </li>
      <li>
          <a href="#">Team</a>
      </li>
      <li>
          <a href="#">Blog</a>
      </li>
    </ul>
  </div>
  <div class="restaurant">
    <h2>FOR RESTAURANTS</h2>
    <ul class="restaurant-items">
      <li>
          <a href="#">Add Restaurant</a>
      </li>
    </ul>
  </div>
  <div class="for-you">
    <h3>FOR YOU</h3>
    <ul class="foryou-items">
      <li>
          <a href="#">Privacy</a>
      </li>
      <li>
          <a href="#">Terms</a>
      </li>
      <li>
          <a href="#">Security</a>
      </li>
    </ul>
  </div>

  <div class="line1"></div>

  <div class="social-links">
    <h1>Social links :</h1>
    <ul class="social-media">
      <li>
        <a href="#">
       <img src="image/fb.logo.png" alt="">
        </a>
      </li>
      <li>
        <a href="#">
       <img src="image/instragram.logo.png" alt="">
        </a>
      </li>
      <li>
        <a href="#">
       <img src="image/twiter.logo@1 (2).png" alt="">
        </a>
      </li>
    </ul>
  </div>

</footer>


  





<script  src="main.js"></script>




</body>
</html> 
