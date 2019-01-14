<?php



require './Model/Products.php';
$products = new Products();
require './View/View.php';
$view = new View();
$cartList = $products->getShoppingCart();

$totalCost = 0;
// Include config file
require_once "config.php";

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
	$userName = '<a href="profile.php">'. $_SESSION['data']['name'] . '</a>';
	$signnedin = true;

	if($_SERVER["REQUEST_METHOD"] == "POST") {
		
		if($link === false){ 
			die("ERROR: Could not connect. "  
						. mysqli_connect_error()); 
			exit;
		} 
		
		$newBalance = ($_SESSION['data']['balance'] - $_SESSION['cart']['total']);

		$_SESSION['data']['balance'] = $newBalance;

		//$sql = "SELECT * FROM members WHERE email = ?";
		$sql = "UPDATE members SET balance = " . $newBalance ." WHERE user_id = " . $_SESSION['data']['user_id'];
		
		if(mysqli_query($link, $sql)){ 
			unset($_SESSION['cart']);
			$_SESSION['paymentSuccess'] = true;
			header("location: thanks.php"); 
		} else { 
			echo "ERROR: Could not able to execute $sql. "  
									. mysqli_error($link); 
		}  
		mysqli_close($link); 

	}
	

}
else {
	header('location: login.php');
	$userName = 'Guest';
	$signnedin = false;
	exit;
}

$userName = '<b>' . $userName . '</b>';




?>



<!DOCTYPE HTML>
<html>
<head>
<title> Pithaa Hut | Checkout</title>
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
				  	<a href="logout.php?curr_page=checkout" > Logout </a>
				  <?php else :?>
				  	<a href="login.php?curr_page=checkout" >Login</a>
			<?php endif ?>
			 | <a href="members.php" >Our Members</a> | <a href="cart.php" class="active" >Shopping Cart</a>
			</b>
			<br />
			Welcome <?php echo $userName; ?>	</div>
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
		<p align="center">
		
		<?php 
		
			$availableBalance = $_SESSION['data']['balance'];
			$totalCost = $_SESSION['cart']['total'];

			//echo '<h1>' . $availableBalance . '</h1><br>';
			//echo '<h1>' . $totalCost . '</h1><br>';

			if($totalCost > $availableBalance) {
				echo '<p><b>Sorry! You don\'t have sufficent Balance<br>';
				echo 'Please Recharge $ ' . ($totalCost - $availableBalance) . '</b></p>';
			}
			else {
				$output = '';
				$output .= '<!-- PayPal Buy Now Button -->';
				$output .= '<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">';
				$output .= '<input type="hidden" name="cmd" value="_s-xclick">';
				$output .= '<input type="hidden" name="hosted_button_id" value="BUTTON_ID">';
				$output .= '<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">';
				$output .= '<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">';
				$output .= '<input type="hidden" name="amount" value="23.30" />';
				$output .= '<input type="hidden" name="shipping" value="2.33" />';
				$output .= '<input type="hidden" name="tax" value="2.33" />';
				$output .= '<input type="hidden" name="tax" value="2.33" />';
				$output .= '<input type="hidden" name="return" value="thanks.php" />';
				$output .= '</form>';
				echo $output;
			}

		?>

		<a href="products.php"><input type="button" name="back" value="Back to Shopping" class="button"/></a>
		<p>
			
			
		
		</form>
	</div>

</div><!-- content -->
	
	</div><!-- maincontent -->

	<?php echo $view->displayFooter(); ?><!-- footer -->
	
</div><!-- wrapper -->

</body>
</html>

