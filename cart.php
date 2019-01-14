<?php


	// // quantity and price
	// $qty1 = 11;
	// $price1 = 1.10;
	// $qty2 = 22;
	// $price2 = 2.20;
	// $qty3 = 33;
	// $price3 = 3.30;
	// $total = ($qty1 * $price1) + ($qty2 * $price2) + ($qty3 * $price3);

//var_dump($_SESSION['cart']);

	
require './Model/Products.php';
$products = new Products();
require './View/View.php';
$view = new View();
$cartList = $products->getShoppingCart();
$totalCost = 0;

	// name, phone, etc.

	$name = 'John';
	$phone = '212-555-1212';
	$fax = '212-777-8888';
	$email = 'doug@blabla.com';


if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
	$userName = '<a href="profile.php">'. $_SESSION['data']['name'] . '</a>';
	$signnedin = true;
}
else {
	$userName = 'Guest';
	$signnedin = false;
}

$userName = '<b>' . $userName . '</b>';


if(isset($_POST['change'])){
	$to_remove = $_POST['remove'];
	// foreach ($to_remove as $item) {
	// 	var_dump($item);
	// }
	// var_dump($to_remove);
	// echo "cart";
	// var_dump($_SESSION);
	$cart = $_SESSION['cart'];
	// var_dump($cart);
	$i = 0;
	// echo 'remove';
	foreach ($cart as $id => $item) {
		if($item['product_id'] === $to_remove[$i]) {
			unset($_SESSION['cart'][$id]);
			++$i;
			continue;
		}
		else {
			continue;
		}
	}
	header("Location: ".$_SERVER["PHP_SELF"]);
}

?>


<!DOCTYPE HTML>
<html>
<head>
<title>Pithaa Hut | Cart</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name ="description" content ="Pithaa Hut">
<meta name="keywords" content="">
<link rel="stylesheet" href="css/main.css" type="text/css">
<link rel="shortcut icon" href="images/favicon.ico?v=2" type="image/x-icon" />
<script>
            var images = ["images/banner10.jpg", "images/banner13.jpg", 
						  "images/banner14.jpg", "images/banner15.jpg", "images/banner16.jpg", "images/banner17.jpg"];

            var links = ["detail.php?id=00000010", "detail.php?id=00000008", "detail.php?id=00000005",
						"detail.php?id=00000016", "detail.php?id=00000015", "detail.php?id=00000011"];

			var i = 0;
            function mySlider() {
                document.getElementById('slid').src= images[i];
				document.getElementById('slideLink').href = links[i];

                if(i < images.length - 1) {
                    ++i;
                }
                else {
                    i = 0;
                }
                setTimeout("mySlider()", 5000);
            }

</script>
</head>
<body>
<div id="wrapper">
	<div id="maincontent">
		
	<div id="header">
		<div id="logo" class="left">
			<a href="index.php"><img src="images/logo.png" alt="PithaaHut.Com"/></a>
		</div>
		<div class="right marT10">
			<b>
			<?php if($signnedin === true) :?>
				  	<a href="logout.php?curr_page=cart" > Logout </a>
				  <?php else :?>
				  	<a href="login.php?curr_page=cart" >Login</a>
			<?php endif ?>
			 | <a href="members.php" >Our Members</a> | <a href="cart.php" class="active" >Shopping Cart</a>
			</b>
			<br />
			Welcome <?php echo $userName; ?>		</div>
		<ul class="topmenu">
		<li><a href="index.php">Home</a></li>
		<li><a href="about.php">About Us</a></li>
		<li><a href="products.php">Products</a></li>
		<li><a href="contact.php">Contact Us</a></li>
		</ul>
		<br>
		<div><p></p>
		<a id="slideLink" href=""><img id="slid" src="" alt="" class="banner" width="850" height="230" /></a>
		<script> mySlider(); </script>
		</div>
		<br class="clear"/>
	</div> <!-- header -->
		
	<div class="content">
<br/>
	<div class="product-list">
		<h2>Shopping Basket</h2>
		<br/>
		<form action="#" method="POST">
		<table>
			<tr>
				<th>Item No.</th><th>Product</th><th width="40%">Name</th><th>Amount</th><th width="10%">Price</th><th width="10%">Extended</th><th>&nbsp;</th>
			</tr>

			<?php echo $view->displayCart($cartList); ?>



		</table>
		
		<br/>
		
		<p align="center">
			<a href="products.php"><input type="button" name="back" value="Back to Shopping" class="button"/> </a>
			<input type="submit" name="change" value="Update" class="button"/>
			<a href='checkout.php'><input type="button" name="checkout" value="Checkout" class="button"/></a>
		<p>
		</form>
	</div>

</div><!-- content -->
	
	</div><!-- maincontent -->

	<?php echo $view->displayFooter(); ?><!-- footer -->
	
</div><!-- wrapper -->

</body>
</html>

