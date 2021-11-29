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
            header("location: details.php");
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
<link rel="stylesheet" href="wrong.php">
<link rel="stylesheet" href="wrong-login.php">
<link rel="stylesheet" href="login-admin.php">
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<style>
* {box-sizing: border-box}
body {font-family: Verdana, sans-serif, Arial, Helvetica; margin:0}
.mySlides {display: none}
img {vertical-align: middle;}

/* Slideshow container */
.slideshow-container {
  max-width:100%;
  position: relative;
  margin: auto;
 
}

.box {
  position: absolute;
  width: 100%;
  height: 572px;
  
  top: 0px;

  background: linear-gradient(90deg, rgba(0, 0, 0, 0.92) -0.73%, rgba(0, 0, 0, 0.5) 47.89%, rgba(0, 0, 0, 0.5) 64.49%, rgba(0, 0, 0, 0.5) 79.12%, rgba(0, 0, 0, 0.5) 100%);
  z-index: 1;
}


.nav-items  {
  display: flex;
  
  text-align: center;
  justify-content: space-between;
  margin-left: 660px;
  margin-top: 68px;
  margin-right: 560px;
  list-style: none;
}

.nav-items li a {
  
  text-decoration: none;
  color: #ffffff;
  
}

.nav-items li a {
  font-family: Arial;
  font-size: 24px;
  padding: 4px;
  position: relative;
}

.nav-items li a:hover {
  font-weight: bold;
}

.nav-items li a.active::after {
  content: "";
  position: absolute;
  height: 3px;
  width: 100%;
  background: #ffffff ;
  left: 0;
  bottom: -10px;
}








.box .left p {
  font-size: 40px;
  color:#ffffff;
  font-family: Secular one;
}


.box .left h1 {
  font: 24px;
  font-family: sans-serif;
  color: #ffffff;
  
}

.box .left .btn-gs {
  position:absolute;
  background-color: #FF5E5E;
  color: #ffffff;
  box-sizing: border-box;
  border-radius: 50px;
  text-decoration: none;
  padding: 14px 20px;
  font-size: 36px;
  font-family: sans-serif;
  font-weight: bold;
}

.box .left .btn-gs:hover {
  background-color: #FF2828;
  
}

.box .left {
  margin-top: 120px;
  margin-left: 200px;
}

.box .left p {
  animation: fadeIn 800ms forwards;
  opacity: 0;
  animation-delay: 400ms;
}

@keyframes fadeIn{
  to{
    opacity: 1;
  }
}

.box .left h1 {
  animation: fadeToRight 800ms forwards;
  opacity: 0;
  animation-delay: 800ms;
}

@keyframes fadeToRight{
  from{
    opacity: 0;
    transform: translateX(-100px);
  }
  to{
    opacity: 1;
    transform: translateX(0);
  }
}

.box .left .btn-gs {
  animation: fadeIn 1000ms forwards;
  opacity: 0;
  animation-delay: 1400ms;
}

/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -22px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
  z-index: 2;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
}

.logo-hat {
  position: absolute;
  width: 95px;
  height: 105px;
  left: 200px;
  top: -14px;

}


.eatit {
  position: absolute;
  left: 229px;
  top: 53px;
  

}

.forbusiness {
  position: absolute;

  left: 229px;
  top: 93px;
}





/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .prev, .next,.text {font-size: 11px}
  
}

.ellipse1 {
  position: absolute;
  border-radius: 100px;
  height: 120px;
  width: 120px;
  background-color: #FF5E5E;
  top: 680px;
  left: 260px
}

.customer-base {
  position: relative;
  text-align: center;
  top: 10px;
}

.ellipse2 {
  position: absolute;
  border-radius: 100px;
  height: 120px;
  width: 120px;
  background-color: #FF5E5E;
  top: 680px;
  left: 710px;
}

.revenue {
  position: relative;
  text-align: center;
  top: 10px;

}

.ellipse3 {
  position: absolute;
  border-radius: 100px;
  height: 120px;
  width: 120px;
  background-color: #FF5E5E;
  top: 680px;
  left: 1160px;
}

.brand-visibility {
  position: relative;
  text-align: center;
  top: 30px;
}

.ellipse1 p {
  font-family: Roboto;
  color: rgba(0, 0, 0, 0.75);
  font-size: 24px;
 
}

.ellipse2 p {
  font-family: Roboto;
  color: rgba(0, 0, 0, 0.75);
  font-size: 24px;
}

.ellipse3 p {
  font-family: Roboto;
  color: rgba(0, 0, 0, 0.75);
  margin-top: 36px;
  font-size: 24px;
}

.box2 {
  position: absolute;
  width: 100%;
  height: 394px;
  
  top: 980px;
  background: linear-gradient(180deg, rgba(255, 149, 149, 0.21) 0%, #FF5656 100%);
}

.box2 h1 {
  font-family: Secular one;
  font-size: 36px;
  margin-top: 20px;
  margin-left: 540px;
  color: rgba(0, 0, 0, 0.75);
}

.rectangle1 {
  position: absolute;
width: 330px;
height: 392px;
left: 239px;
top: 180px;

background: #FFFFFF;
box-shadow: 0px 4px 4px 4px rgba(0, 0, 0, 0.25);
border-radius: 20px;
}

.rectangle2 {
  position: absolute;
width: 330px;
height: 392px;
left: 605px;
top: 180px;

background: #FFFFFF;
box-shadow: 0px 4px 4px 4px rgba(0, 0, 0, 0.25);
border-radius: 20px;
}

.rectangle3 {
  position: absolute;
width: 330px;
height: 392px;
left: 971px;
top: 180px;

background: #FFFFFF;
box-shadow: 0px 4px 4px 4px rgba(0, 0, 0, 0.25);
border-radius: 20px;
}

.ellipse4 {
  position: absolute;
  border-radius: 100px;
  height: 120px;
  width: 120px;
  background-color: #FF5E5E;
  top: 52px;
  left: 100px;
}

.ellipse5 {
  position: absolute;
  border-radius: 100px;
  height: 120px;
  width: 120px;
  background-color: #FF5E5E;
  top: 52px;
  left: 100px;
}

.ellipse6 {
  position: absolute;
  border-radius: 100px;
  height: 120px;
  width: 120px;
  background-color: #FF5E5E;
  top: 52px;
  left: 100px;
}

.rectangle1 p {
  font-size: 28px;
  font-family: Roboto;
  margin-top: 266px;
  text-align: center;
  color: rgba(0, 0, 0, 0.60);
  line-height: 33px;
  letter-spacing: 0.02em;

}

.ellipse4 p {
  font-size: 36px;
  font-family: Roboto;
  margin-top: 50px;
  text-align: center;
  color: rgba(0, 0, 0, 0.75);

}

.rectangle2 p {
  font-size: 28px;
  font-family: Roboto;
  margin-top: 266px;
  text-align: center;
  color: rgba(0, 0, 0, 0.60);
  line-height: 33px;
  letter-spacing: 0.02em;

}

.ellipse5 p {
  font-size: 36px;
  font-family: Roboto;
  margin-top: 32px;
  text-align: center;
  color: rgba(0, 0, 0, 0.75);

}

.rectangle3 p {
  font-size: 28px;
  font-family: Roboto;
  margin-top: 266px;
  text-align: center;
  color: rgba(0, 0, 0, 0.60);
  line-height: 33px;
  letter-spacing: 0.02em;

}

.ellipse6 p {
  font-size: 36px;
  font-family: Roboto;
  margin-top: 46px;
  text-align: center;
  color: rgba(0, 0, 0, 0.75);

}

.create-page {
  position: relative;
  left: 20px;
  top: 18px;
}

.register {
  position: relative;
  text-align: center;
  top: 10px;
}

.recive-order {
  position: relative;
  text-align: center;
  top: 16px;
}


.box3 {
  position: absolute;
  width: 70%;
  height: 80px;
  top: 1680px;
  left: 234px;
  border: 2px solid #B5B5B5;
  border-radius: 20px;
 
}

.box3 p {
  font-size: 36px;
  font-family: Roboto;
  margin-left: 40px;
  margin-top: 16px;
  color: rgba(0, 0, 0, 0.75);
}

.box3 .btn3 {
  position:absolute;
  background-color: #FF5E5E;
  color: #ffffff;
  box-sizing: border-box;
  border-radius: 50px;
  text-decoration: none;
  padding: 12px 18px;
  font-size: 36px;
  font-family: sans-serif;
  font-weight: bold;
  top: 5px;
  left: 780px;
}

.box3 .btn3:hover {
  color:#FF2828;
}

.one-image {
  position: absolute;
  top: 1880px;
  left: 860px;
}

.some-text p {
  font-size: 24px;
  font-family: Roboto;
  margin-left: 280px;
  margin-top: 1320px;
  color: rgba(0, 0, 0, 0.75);
}

.container body {
  margin: 0;
  padding: 0;
  font-family: 'Hind', sans-serif;
  background: #fff;
  color: #4d5974;
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  min-height: 100vh;
}
.container {
  margin: 0 auto;
  padding: 4rem;
  width: 48rem;
}
.container h2 {
  font-size: 1.75rem;
  color: #FF5E5E;
  padding: 2rem;
  margin: 0;
}
.accordion a {
  position: relative;
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -webkit-flex-direction: column;
  -ms-flex-direction: column;
  flex-direction: column;
  width: 100%;
  padding: 1rem 3rem 1rem 1rem;
  color: #7288a2;
  font-size: 1.15rem;
  font-weight: 400;
  border-bottom: 1px solid #e5e5e5;
}
.accordion a:hover,
.accordion a:hover::after {
  cursor: pointer;
  color: #ff5353;
}
.accordion a:hover::after {
  border: 1px solid #ff5353;
}
.accordion a.active {
  color: #ff5353;
  border-bottom: 1px solid #ff5353;
}
.accordion a::after {
  font-family: 'Ionicons';
  content: '+';
  position: absolute;
  float: right;
  right: 1rem;
  font-size: 1rem;
  color: #7288a2;
  padding: 5px;
  width: 16px;
  height: 16px;
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  border-radius: 50%;
  border: 1px solid #7288a2;
  text-align: center;
}
.accordion a.active::after {
  font-family: 'Ionicons';
  content: '-';
  color: #ff5353;
  border: 1px solid #ff5353;
}
.accordion .content {
  opacity: 0;
  padding: 0 1rem;
  max-height: 0;
  border-bottom: 1px solid #e5e5e5;
  overflow: hidden;
  clear: both;
  -webkit-transition: all 0.2s ease 0.15s;
  -o-transition: all 0.2s ease 0.15s;
  transition: all 0.2s ease 0.15s;
}
.accordion .content p {
  font-size: 1rem;
  font-weight: 300;
}
.accordion .content.active {
  opacity: 1;
  padding: 1rem;
  max-height: 100%;
  -webkit-transition: all 0.35s ease 0.15s;
  -o-transition: all 0.35s ease 0.15s;
  transition: all 0.35s ease 0.15s;
}
 
footer {
  position: absolute;
  width: 100%;
  height: 532px;
  
  background: #FF5E5E;
}

.footer1 .logo-hat {
  position: absolute;
  width: 95px;
  height: 105px;
  left: 200px;
  top: -14px;

}

.footer1 .eatit {
  position: absolute;
  left: 229px;
  top: 53px;
  
}

.footer1 .company {
  position: absolute;
  
  width: 130px;
  height: 100px;
  left: 416px;
  top: 180px;
}

.footer1 .company h1 {
  font-family: Roboto;
font-style: normal;
font-weight: normal;
font-size: 24px;
line-height: 35px;

color: #FFFFFF;
}

.footer1 .company .company-items li {
  justify-content: space-between;
  list-style: none;
}

.footer1 .company .company-items li a {
  font-family: Roboto;
font-style: normal;
font-weight: normal;
font-size: 18px;
margin-left: -38px;
text-decoration: none;
color: #FFFFFF;
}

.footer1 .restaurant {
  position: absolute;
  
  width: 220px;
  height: 100px;
  left: 718px;
  top: 180px;
}

.footer1 .restaurant h2 {
  font-family: Roboto;
font-style: normal;
font-weight: normal;
font-size: 24px;

color: #FFFFFF;
}

.footer1 .restaurant .restaurant-items li {
  justify-content: space-between;
  list-style: none;
}

.footer1 .restaurant .restaurant-items li a {
  font-family: Roboto;
font-style: normal;
font-weight: normal;
font-size: 18px;
margin-left: -38px;
text-decoration: none;
color: #FFFFFF;
}

.footer1 .for-you {
  position: absolute;
  
  width: 140px;
  height: 100px;
  left: 1025px;
  top: 180px;
}

.footer1 .for-you h3 {
  font-family: Roboto;
font-style: normal;
font-weight: normal;
font-size: 24px;

color: #FFFFFF;
}

.footer1 .for-you .foryou-items li {
  justify-content: space-between;
  list-style: none;
}

.footer1 .for-you .foryou-items li a {
  font-family: Roboto;
font-style: normal;
font-weight: normal;
font-size: 18px;
margin-left: -38px;
text-decoration: none;
color: #FFFFFF;
}

.footer1 .line1 {
  position:absolute;
  width: 1040px;
  height: 2px;
  left: 250px;
  top: 360px;
  background-color: #ffffff;

}

.footer1 .social-links {
  position:absolute;
  width: 1040px;
  height: 100px;
  left: 250px;
  top: 380px;
}

.footer1 .social-links h1 {
  font-family: Roboto;
font-style: normal;
font-weight: normal;
font-size: 24px;

color: #FFFFFF;
}

.social-links .social-media {
  display: flex;
  margin-left: 800px;
  margin-top: -60px;
  list-style: none;
}






.popup .content {
  position: absolute;
width: 300px;
height: 450px;
z-index: 2;
left: 50%;
top: 50%;
transform: translate(-50%,-150%) scale(0);
background: #FFFFFF;

border-radius: 20px;
text-align: center;

padding: 20px;
box-shadow: 0px 4px 4px 4px rgba(0, 0, 0, 0.25); 
z-index: 1;

}

.popup .first-button {
  position:absolute;
  top: 9%;
  left: 68%;
  cursor: pointer;
  border: 1px solid #FFFFFF;
  z-index: 1;
  box-sizing: border-box;
  border-radius: 10px;
  color: white;
font-size: 24px;
font-weight: normal;
padding: 3px 8px;
background: rgba(196, 196, 196, 0);
}

.popup .first-button:hover {
  background-color: #FF5E5E ;
}


.popup .content h1 {
 font-weight: 600;
 padding-top: 20px;
 text-align: center;
 font-size: 32px;
 padding-bottom: 10px;
 color: #232323;
}

.popup .content  a {
 font-weight: 600;
 color: #FF5E5E;
}

.popup .input-field .validate {
border: 1px solid #999999;
margin-bottom: 15px;
color: #232323;
background: #ffffff;
padding: 20px;
font-size: 16px;
border-radius: 10px;

outline: none;
}

.popup .second-button {
margin-top: 20px;
padding: 20px 30px;
border-radius: 40px;
border: none;
color: white;
cursor: pointer;
font-size: 18px;
font-weight: 500;
background: #FF5E5E;
box-shadow:  0px 4px 4px 4px rgba(0, 0, 0, 0.25);
transition: box-shadow .35s ease !important;
outline: none;
}

.popup .second-button:hover {
  background-color: rgba(196, 196, 196, 0);
  color: #232323;
}

.popup.second-button:active{
background: linear-gradient(145deg,#222222, #292929);
box-shadow: 0px 4px 4px 4px rgba(0, 0, 0, 0.25);
border: none;
outline: none;
}
.popup .content p{
color: #827E7E;
padding: 20px;
}

.popup.active .content {
transition: all 300ms ease-in-out;
transform: translate(-50%,-50%) scale(1);
}

.popup .close-btn {
 color: #292929;
 font-size: 24px;
 border-radius: 50%;
 background: rgba(196, 196, 196, 0);
 border: 1px solid #292929;
 position: absolute;
 right: 20px;
 top: 20px;
 width: 30px;
 
 height: 30px;
 cursor: pointer;
 }







.popup2 .content {
  position: absolute;
width: 300px;
height: 450px;
z-index: 2;
left: 50%;
top: 50%;
transform: translate(-50%,-150%) scale(0);
background: #FFFFFF;

border-radius: 20px;
text-align: center;

padding: 20px;
box-shadow: 0px 4px 4px 4px rgba(0, 0, 0, 0.25); 
z-index: 1;

}

.popup2 .first-button {
  position:absolute;
  top: 9%;
  left: 1112px;
  cursor: pointer;
  border: 1px solid #FFFFFF;
  z-index: 1;
  box-sizing: border-box;
  border-radius: 10px;
  color: white;
font-size: 24px;
font-weight: normal;
padding: 3px 8px;
background: #FF5E5E;
}

.popup2 .first-button:hover {
  background-color: rgba(196, 196, 196, 0); ;
}


.popup2 .content h1 {
 font-weight: 600;
 padding-top: 6px;
 text-align: center;
 font-size: 32px;
 padding-bottom: 8px;
 color: #232323;
}

.popup2 .content  a {
 font-weight: 600;
 color: #FF5E5E;
}

.popup2 .input-field .validate {
border: 1px solid #999999;
margin-bottom: 10px;
color: #232323;
background: #ffffff;
padding: 16px;
font-size: 16px;
border-radius: 10px;

outline: none;
}

.popup2 .second-button {
margin-top: 20px;
padding: 20px 30px;
border-radius: 40px;
border: none;
color: white;
cursor: pointer;
font-size: 18px;
font-weight: 500;
background: #FF5E5E;
box-shadow:  0px 4px 4px 4px rgba(0, 0, 0, 0.25);
transition: box-shadow .35s ease !important;
outline: none;
}

.popup2 .second-button:hover {
  background-color: rgba(196, 196, 196, 0);
  color: #232323;
}

.popup2 .second-button:active{
background: linear-gradient(145deg,#222222, #292929);
box-shadow: 0px 4px 4px 4px rgba(0, 0, 0, 0.25);
border: none;
outline: none;
}
.popup2.content p{
color: #827E7E;
padding: 20px;
}

.popup2.active .content {
transition: all 300ms ease-in-out;
transform: translate(-50%,-50%) scale(1);
}

.popup2 .close-btn {
 color: #292929;
 font-size: 24px;
 border-radius: 50%;
 background: rgba(196, 196, 196, 0);
 border: 1px solid #292929;
 position: absolute;
 right: 20px;
 top: 20px;
 width: 30px;
 
 height: 30px;
 cursor: pointer;
 }






















</style>
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
          <h1>Get listed <br> India’s smart restaurent <br> customer service platform</h1>
          <a href="#" onclick="togglePopup2()" class="btn-gs">Get Started</a>
        </div>
       

        
       
  </div>

  <div class="popup" id="popup-1">
    <button onclick="togglePopup()" class="first-button">Login</button>
    <div class="content">
     
      <h1>Login</h1> 
      <form action="login-admin.php" method="post">
      <div class="input-field"><input type="text" placeholder="username" name="username" class="validate"></div>
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
      <div class="input-field"><input type="text"  id="input-username"  placeholder="username"  name="username" class="validate"></div>
      <div class="input-field"><input type="password" id="input-password" placeholder="Password" name="password" class="validate"></div>
      <div class="input-field"><input type="password"id="input-password" placeholder="Confirm Password" name="confirm_password" class="validate"></div>
      
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
    <a href="#" onclick="togglePopup2()" class="btn3">Get Started</a>
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

<script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}

    
       
    

</script>

<script>
  function togglePopup() {
document.getElementById("popup-1")
.classList.toggle("active");
}

</script>

<script>
  function togglePopup2() {
document.getElementById("popup-2")
.classList.toggle("active");
}

</script>

<script>
    const items = document.querySelectorAll(".accordion a");
 
 function toggleAccordion(){
   this.classList.toggle('active');
   this.nextElementSibling.classList.toggle('active');
 }
  
 items.forEach(item => item.addEventListener('click', toggleAccordion));
 
 
</script>


</body>
</html> 


