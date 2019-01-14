
<?php

session_start();
require './View/View.php';
$view = new View();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
	$guestUser = false;
	$userName = $_SESSION['data']['name'];
}
else {
	header('location: login.php');
}

?>




<!DOCTYPE HTML>
<html>
<head>
<title>Pithaa Hut | Recharge</title>
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
			<a href="logout.php?curr_page=profile" > Logout </a> | <a href="members.php" >Our Members</a> | <a href="cart.php" >Shopping Cart</a>
			</b>
			<br />
			Welcome <a href="profile.php"><b><?php echo $_SESSION['data']['name'] ?></b></a>		</div>
		<ul class="topmenu">
		<li><a href="index.php">Home</a></li>
		<li><a href="products.php">Products</a></li>
		<li><a href="specials.php">Specials</a></li>
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
		
		<h2>Recharge Balance</h2>
		<br/>

        <b>Please Enter information.</b><br/><br/>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			<p>
				<label>Method: </label>
                <select>
                    <option>bKash</option>
                    <option>EasyCash</option>
                    <option>SureCash</option>
                    <option>DBBL Mobile-Banking</option>
                    <option>mCash</option>
                </select>
			<p>
			<p>
				<label>Amount: </label>
				<input type="number" name="amount" /> <br>
			<p>
            <p>
				<label>Transaction ID: </label>
				<input type="text" name="amount" /> <br>
			<p>
            <p>
				<input type="submit" name="verify" value="Verify" class="button"/>
		    <p>
		</form>

		
	</div><!-- product-list -->
</div>
	
	</div><!-- maincontent -->

	<?php echo $view->displayFooter(); ?><!-- footer -->
	
</div><!-- wrapper -->

</body>
</html>
