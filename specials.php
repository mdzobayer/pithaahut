<?php


require './View/View.php';
$view = new View();
require './Model/Products.php';

$products = new Products(); 

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
	$userName = '<a href="profile.php">'. $_SESSION['data']['name'] . '</a>';
	$signnedin = true;
}
else {
	$userName = 'Guest';
	$signnedin = false;
}

$userName = '<b>' . $userName . '</b>';



$titles = $products->getSpecialTitles();



$maxProducts = count($titles);

$page = (isset($_GET['page'])) ? (int) $_GET['page'] : 0;

$prev = ($page == 0) ? 0 : $page - 1;
$next = $page + 1;
$linesPerPage = 6;

// check status for cookie
if(isset($_COOKIE['status'])) {
	if($_COOKIE['status'] == 'SUCCESS') {
		$message = 'Added item to cart, Thanks!';
	}
	elseif($_COOKIE['status'] == 'UNSET') {
		$message = 'Sorry: either ID, quantity or price was not set!';
	}
	else {
		$message = 'Sorry: Unable to add item to cart!';
	}
}
else {
	$message = '';
}


 ?>
<!DOCTYPE HTML>
<html>
<head>
<title>Pithaa Hut | Specials</title>
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
				  	<a href="logout.php?curr_page=products" > Logout </a>
				  <?php else :?>
				  	<a href="login.php?curr_page=products" >Login</a>
			<?php endif ?>
			 | <a href="members.php" >Our Members</a> | <a href="cart.php" >Shopping Cart</a>
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

<div id="leftnav">
	<div class="search">

		<form name="search" method="get" action="search.php" id="search">
			<input type="text" value="" name="keyword" class="s0" placeholder="keyword" />
			<br />
			<select name="title" class="s2">
			<?php
				sort($titles, SORT_STRING);
				foreach ($titles as $value) {
					printf('<option>%s</option>', $value);
				}
			?>
			</select>
			<br />
			<input type="submit" name="search" value="Search Products" class="button marT5" />
			<input type="hidden" name="page1" value="0" />
		</form>
		<br /><br />
		
		<h3>About Us</h3><br/>
		<p class="width180">Lorem ipsum dolor sit amet consectetuer. Lorem ipsum dolor sit amet consectetuer, Lorem ipsum dolor sit amet consectetuer
	  Lorem ipsum dolor sit amet consectetuer. Lorem ipsum dolor sit amet consectetuer. Lorem ipsum dolor sit amet consectetuer.  <a href="about.php">Read More >> </a></p>
	</div>
</div><!-- leftnav -->


<div id="rightnav">

	<div class="product-list">
		<h2>Our Special Products</h2>
		<a class="pages" href="specials.php?page=<?php echo $prev; ?>">&lt;prev</a>
		&nbsp;|&nbsp;
		<a class="pages" href="specials.php?page=<?php echo $next; ?>">next&gt;</a>
		<?php echo ($message) ? "&nbsp;&nbsp;<b>$message<br />" : ''; ?>
		<ul>
			<?php echo $view->displayProducts($page, $linesPerPage, $maxProducts, $products->getSpecialProducts()); ?>		
		</ul>
	</div><!-- product-list -->
	
	
</div><!-- rightnav -->

<br class="clear-all"/>
</div><!-- content -->
	
	</div><!-- maincontent -->

	<?php echo $view->displayFooter(); ?><!-- footer -->
	
</div><!-- wrapper -->

</body>
</html>

