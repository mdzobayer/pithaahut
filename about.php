<?php

require './View/View.php';
$view = new View();
require './Model/Products.php';

$products = new Products(); 

$titles = $products->getTitles();

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
<title>Pithaa Hut | About</title>
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
			<a href="index.php"><img src="images/logo.png" alt="pithaahut.Com"/></a>
		</div>
		<div class="right marT10">
			<b>
			<?php if($signnedin === true) :?>
				  	<a href="logout.php?curr_page=about" > Logout </a>
				  <?php else :?>
				  	<a href="login.php?curr_page=about" >Login</a>
			<?php endif ?>
			 | <a href="members.php" >Our Members</a> | <a href="cart.php" >Shopping Cart</a>
			</b>
			<br />
			Welcome <?php echo $userName; ?>		</div>
		<ul class="topmenu">
		<li><a href="index.php" >Home</a></li>
		<li><a href="products.php" >Products</a></li>
		<li><a href="specials.php" >Specials</a></li>
		<li><a href="contact.php" >Contact Us</a></li>
		</ul>
		<br>
		<div><p></p>
		<a id="slideLink" href=""><img id="slid" src="" alt="" class="banner" width="850" height="230" /></a>
		<script> mySlider(); </script>
		</div>
		<br class="clear"/>
	</div> <!-- header -->
		
	<div class="content">

	<div class="search left">
		<form name="search" method="get" action="search.php" id="search">
			<input type="text" value="" name="keyword" class="s0" placeholder="keyword" />
			<br />
			<select>
			<?php
				sort($titles, SORT_STRING);
				foreach ($titles as $value) {
					printf('<option>%s</option>', $value);
				}
			?>
			</select>
			<input type="submit" name="search" value="Search Products" class="button marT5" />
			<input type="hidden" name="page1" value="0" />
		</form>
		<br /><br />
	</div>
	<div class="intro left">
	  <h3>About Us</h3><br/>
	  <p>Lorem ipsum dolor sit amet consectetuer. Lorem ipsum dolor sit amet consectetuer, Lorem ipsum dolor sit amet consectetuer
	  Lorem ipsum dolor sit amet consectetuer. Lorem ipsum dolor sit amet consectetuer. Lorem ipsum dolor sit amet consectetuer.
	  </p>
	</div>
	<br class="clear"/>
	<br/>
	
	<div class="product-list">
	<table>
 	  <tr>
		<td width="50%">
		<p>
		The lip-smacking Raj Bhog is stuffed with dry fruits and made just like spongy Rasgullas. These yellow spongy soft balls flavoured and coloured with kesar will take you on a trip to heaven!
		</p>
		</td>
		<td width="50%">
		<img src="images/00000009.scale_20.JPG" width="360" height="240" />
		</td>
	  </tr>
	  <tr>
		<td width="50%">
		<img src="images/00000011.scale_20.JPG" width="360" height="240" />
		</td>
		<td width="50%">
		<p>
		Kalo Jaam or Kala Jamun is Gulab Jamun's younger sibling. Made of paneer and khoya, Bengalis have grown up eating it and it can be easily made at home.
		</p>
		</td>
	  </tr>
	</table>
	</div><!-- product-list -->

<br class="clear-all"/>
</div><!-- content -->
	
	</div><!-- maincontent -->

	<?php echo $view->displayFooter(); ?><!-- footer -->
	
</div><!-- wrapper -->

</body>
</html>

