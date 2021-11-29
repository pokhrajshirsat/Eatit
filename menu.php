<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style1.css">
    <script src="script.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Epilogue&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="login.php">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <title>Menu</title>
</head>

<body>
    <div class="topnav" id="myTopnav">
        <a href="cart.php"><i class="fa fa-shopping-cart"></i></a>
        <a href="service.php" id="service ">Service<i class="fas fa-user-friends "></i></a>
        <a href="#about ">About</a>
        <a href="javascript:void(0); " class="icon " onclick="myFunction() ">
            <i class="fa fa-bars "></i>
        </a>
    </div>
    <div class="menutab">Menu</div>



    <?php
	require 'connect.php';

	$result = mysqli_query($con, 'select * from products');
?>



		
	
</div>
	
       <?php while($products = mysqli_fetch_object($result)) { ?>
      
         <div class="swiper">
            
            <div class="slide ">
            <img src="<?php echo $products->image; ?>" width="200" height="200">
            <br><?php echo $products->name; ?>
            <br>&#8377;<?php echo $products->price; ?>
            <br><span><?php echo $products->description; ?></span>
           <br><a href="cart.php?id=<?php echo $products->id; ?>" id="mybutton">Order</a>
           </div>
        
         </div>
         
    
 <div class="tab"></div>


    <?php } ?>

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
<br>
<br>
<br>
<!-- Site footer -->
<footer class="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <h6>About</h6>
                <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt neque voluptas id consequuntur earum, ipsa non quasi explicabo dicta cupiditate laboriosam libero nam ad. Corporis, quas veritatis cum perferendis deserunt expedita repellat
                    nesciunt, consequuntur temporibus atque doloremque voluptas nulla. Ipsum quidem, eveniet minima magni cum atque quo voluptas nulla facilis.</p>
            </div>



            <div class="col-xs-6 col-md-3">
                <h6>Quick Links</h6>
                <ul class="footer-links">
                    <li><a href="newnav.html">About</a></li>
                    <li><a href="service.html">Service</a></li>
                    <li><a href="slider.html">Menu</a></li>
                </ul>
            </div>
        </div>
        <hr>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-6 col-xs-12">
                <p class="copyright-text">Copyright &copy; 2021
                    <a href="#">Mini Project</a>.
                </p>
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12">
                <ul class="social-icons">
                    <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
                    <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

</html>





