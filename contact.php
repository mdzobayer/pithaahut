<?php
require './Model/Products.php';
$products = new Products();
require './View/View.php';
$view = new View();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
	$userName = '<a href="profile.php">'. $_SESSION['data']['name'] . '</a>';
	$signnedin = true;
}
else {
	$userName = 'Guest';
	$signnedin = false;
}

$userName = '<b>' . $userName . '</b>';

?>


<!DOCTYPE HTML>
<!-- this file has the overall look and feel of the website -->
<html>
<head>
<title>Pithaa Hut | Contact</title>
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
				  	<a href="logout.php?curr_page=contact" > Logout </a>
				  <?php else :?>
				  	<a href="login.php?curr_page=contact" >Login</a>
			<?php endif ?>
			 | <a href="members.php" >Our Members</a> | <a href="cart.php" >Shopping Cart</a>
			</b>
			<br />
			Welcome <?php echo $userName; ?>	</div>
		<ul class="topmenu">
		<li><a href="index.php">Home</a></li>
		<li><a href="about.php">About Us</a></li>
		<li><a href="products.php">Products</a></li>
		<li><a href="specials.php">Specials</a></li>
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
		
		<h2>Contact</h2>
		<br/>
		
		<b>Please use this form to contact us.</b><br/><br/>
		<form>
			<p>
				<label>Name: </label>
				<input type="text" name="name"/>
			<p>
			<p>
				<label>Email Address: </label>
				<input type="text" name="email"/>
			<p>
			<p>
				<label>Comments / Questions: </label>
				<textarea name="comments">I love your products!</textarea>
			<p>
			<p>
				<input type="reset" name="clear" value="Clear" class="button"/>
				<input type="submit" name="submit" value="Submit" class="button marL10"/>
			<p>
		</form>
	</div><!-- product-list -->

<br class="clear-all"/>
</div><!-- content -->

</div><!-- maincontent -->
	
	</div><!-- maincontent -->

	<?php echo $view->displayFooter(); ?><!-- footer -->
	
</div><!-- wrapper -->

</body>
</html>

