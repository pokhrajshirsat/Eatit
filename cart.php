<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Epilogue&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <title>Slider</title>
</head>

<body>
    <div class="topnav" id="myTopnav">
        <a href="menu.php">Menu</a>
        <a href="service.php" id="service ">Service<i class="fas fa-user-friends "></i></a>
        <a href="#about ">About</a>
        <a href="javascript:void(0); " class="icon " onclick="myFunction() ">
            <i class="fa fa-bars "></i>
        </a>
    </div>




<?php
session_start ();
require 'connect.php';
require 'item.php';
if (isset ( $_GET ['id'] ) && !isset($_POST['update'])) {

	$result = mysqli_query ( $con, 'select * from products where id=' . $_GET ['id'] );
	$products = mysqli_fetch_object ( $result );
	$item = new Item();
	$item->id = $products->id;
	$item->name = $products->name;
	$item->price = $products->price;
	$item->quantity = 1;
	// Check product is existing in cart
	$index = - 1;
	if (isset ( $_SESSION ['cart'] )) {
		$cart = unserialize ( serialize ( $_SESSION ['cart'] ) );
		for($i = 0; $i < count ( $cart ); $i ++)
		if ($cart [$i]->id == $_GET ['id']) {
			$index = $i;
			break;
		}
	}
	if ($index == - 1)
	$_SESSION ['cart'] [] = $item;
	else {
		$cart [$index]->quantity ++;
		$_SESSION ['cart'] = $cart;
	}
}

// Delete product in cart
if (isset ( $_GET ['index'] ) && !isset($_POST['update'])) {
	$cart = unserialize ( serialize ( $_SESSION ['cart'] ) );
	unset ( $cart [$_GET ['index']] );
	$cart = array_values ( $cart );
	$_SESSION ['cart'] = $cart;
}

// Update quantity in cart
if(isset($_POST['update'])) {
	$arrQuantity = $_POST['quantity'];

	// Check validate quantity
	$valid = 1;
	for($i=0; $i<count($arrQuantity); $i++)
	if(!is_numeric($arrQuantity[$i]) || $arrQuantity[$i] < 1){
		$valid = 0;
		break;
	}
	if($valid==1){
		$cart = unserialize ( serialize ( $_SESSION ['cart'] ) );
		for($i = 0; $i < count ( $cart ); $i ++) {
			$cart[$i]->quantity = $arrQuantity[$i];
		}
		$_SESSION ['cart'] = $cart;
	}
	else
		$error = 'Quantity is InValid';
}

?>
<?php echo isset($error) ? $error : ''; ?>
<form method="post">
	<table cellpadding="2" cellspacing="2" border="0.75" class="table">
		<tr>
			
			<th>Id</th>
			<th>Name</th>
			<th>Price</th>
			<th>Quantity </th>
			<th>Option</th>
			<th>Sub Total</th>
		</tr>
		<?php
		$cart = unserialize ( serialize ( $_SESSION ['cart'] ) );
		$s = 0;
		$index = 0;
		for($i = 0; $i < count ( $cart ); $i ++) {
			$s += $cart [$i]->price * $cart [$i]->quantity;
			?>
		<tr>
			
			<td><?php echo $cart[$i]->id; ?></td>
			<td><?php echo $cart[$i]->name; ?></td>
			<td>&#8377;<?php echo $cart[$i]->price; ?></td>
			<td><input type="text" value="<?php echo $cart[$i]->quantity; ?>"
				style="width: 50px;" name="quantity[]"></td>
				<td><a href="cart.php?index=<?php echo $index; ?>"
				onclick="return confirm('Are you sure?')"><i class="fa fa-trash fa-2x" ></i></a></td>
			<td>&#8377;<?php echo $cart[$i]->price * $cart[$i]->quantity; ?></td>
			<!-- <?php
				// $total_price += ($cart["price"]*$cart["quantity"]);

?> -->
		</tr>
		<?php
		$index ++;
		}
		?>
		<tr>
			<td colspan="5" align="right">Total</td>
			<td align="left">&#8377;<?php echo $s; ?></td>
		</tr>
	</table>
</form>
<br>

<div class="container_cart">
<a href="menu.php">
<button  id="mybutton">Continue Shopping</button></a><br>
<a href="checkout.php">
<button  id="mybutton" onclick="return confirm('Are you sure?')">Confirm Order</button></a>

</div>



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