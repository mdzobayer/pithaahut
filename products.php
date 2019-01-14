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


/*
$titles = array(
	'Fudge',
	'Sugar Cookies',
	'Chocolate Angelfood Cupcakes',
	'Peanut Brittle',
	'Toasted Marshmallows',
	'Fruit Salad',
	'Cheesecake',
	'Glazed Doughnut',
	'Fortune Cookies',
	'Devils Food Cake',
	'Peanut Butter Cups',
	'Crispy Rice Treats',
	'Cherry Pie',
	'Apple Turnover',
	'Napoleon',
	'Chocolate Chip Cookies',
	'Chocolate Soufflé',
	'Walnut Brownies',
	'Ambrosia Salad',
	'Peach Cobbler',
	'Chocolate Eclair',
	'Chocolate Toaster Tarts',
	'Candied Ginger',
	'Spice Cake',
	'Tapioca Pudding',
	'Banana Pudding',
	'Vanilla Cream Pie   ',
	'Peanut Butter Cookies',
	'Oatmeal Raisin Cookies',
	'Chocolate Mousse',
	'Baklava',
	'Chocolate Fondue',
	'Strawberry Shortcake',
	'Apple Pie a la Mode',
	'Neapolitan Ice Cream',
	'Cinnamon Roll',
	'Gingerbread Cookies',
	'Gingerbread Dude',
	'Bread Pudding   ',
	'Coconut Custard Pie',
	'Coconut Macaroon',
	'Ice Cream Cone',
	'Mint Chocolate Milk Shake',
	'Pecan Pie',
	'Smores',
	'Black Forest Cake',
	'Fruit Cake',
	'Pumpkin Nut Bread',
	'Pumpkin Pie',
	'Pumpkin Ice Cream',
	'Rhubarb Crumble',
	'Carrot Cake',
	'Ice Cream Cake',
	'Baked Alaska',
	'Ice Cream Sandwich',
	'Hot Fudge Sundae',
	'Pecan Praline Ice Cream',
	'Banana Split',
	'Boston Cream Pie',
	'Banana Bread',
	'Chocolate Layer Cake',
	'Shortbread Cookies',
	'Oreo Cookies',
	'Pop Tarts',
);
*/

$titles = $products->getTitles();

// product details 
/*
$products = array(
	array('id' => 1, 'title' => 'Fudge', 'link' => '95_2542284'),
	array('id' => 2, 'title' => 'Sugar Cookies', 'link' => '167_2835774'),
	array('id' => 3, 'title' => 'Chocolate Angelfood Cupcakes', 'link' => '430_3150132'),
	array('id' => 4, 'title' => 'Peanut Brittle', 'link' => '700_3473780'),
	array('id' => 5, 'title' => 'Toasted Marshmallows', 'link' => '167_2835774'),
	array('id' => 6, 'title' => 'Fruit Salad', 'link' => '167_2835774'),
	array('id' => 7, 'title' => 'Cheesecake', 'link' => '430_3151480'),
	array('id' => 8, 'title' => 'Glazed Doughnut', 'link' => '167_2835774'),
	array('id' => 9, 'title' => 'Fortune Cookies', 'link' => '167_2835774'),
	array('id' => 10, 'title' => 'Devils Food Cake', 'link' => '430_3151480'),
	array('id' => 11, 'title' => 'Peanut Butter Cups', 'link' => '326_2841738'),
	array('id' => 12, 'title' => 'Crispy Rice Treats', 'link' => '326_2841738'),
	array('id' => 13, 'title' => 'Cherry Pie', 'link' => '430_3151480'),
	array('id' => 14, 'title' => 'Apple Turnover', 'link' => '430_3151480'),
	array('id' => 15, 'title' => 'Napoleon', 'link' => '430_3151480'),
	array('id' => 16, 'title' => 'Chocolate Chip Cookies', 'link' => '326_2841738'),
	array('id' => 17, 'title' => 'Chocolate Soufflé', 'link' => '430_3150132'),
	array('id' => 18, 'title' => 'Walnut Brownies', 'link' => '700_3473780'),
	array('id' => 19, 'title' => 'Ambrosia Salad', 'link' => '167_2835774'),
	array('id' => 20, 'title' => 'Peach Cobbler', 'link' => '430_3151480'),
	array('id' => 21, 'title' => 'Chocolate Eclair', 'link' => '430_3150132'),
	array('id' => 22, 'title' => 'Chocolate Toaster Tarts', 'link' => '95_2542284'),
	array('id' => 23, 'title' => 'Candied Ginger', 'link' => '700_3473780'),
	array('id' => 24, 'title' => 'Spice Cake', 'link' => '430_3151480'),
	array('id' => 25, 'title' => 'Tapioca Pudding', 'link' => '430_3150132'),
	array('id' => 26, 'title' => 'Banana Pudding', 'link' => '430_3150132'),
	array('id' => 27, 'title' => 'Vanilla Cream Pie   ', 'link' => '430_3151480'),
	array('id' => 28, 'title' => 'Peanut Butter Cookies', 'link' => '95_2542284'),
	array('id' => 29, 'title' => 'Oatmeal Raisin Cookies', 'link' => '95_2542284'),
	array('id' => 30, 'title' => 'Chocolate Mousse', 'link' => '430_3150132'),
	array('id' => 31, 'title' => 'Baklava', 'link' => '700_3473780'),
	array('id' => 32, 'title' => 'Chocolate Fondue', 'link' => '430_3150132'),
	array('id' => 33, 'title' => 'Strawberry Shortcake', 'link' => '185_2577502'),
	array('id' => 34, 'title' => 'Apple Pie a la Mode', 'link' => '167_2835774'),
	array('id' => 35, 'title' => 'Neapolitan Ice Cream', 'link' => '185_2577502'),
	array('id' => 36, 'title' => 'Cinnamon Roll', 'link' => '185_2577502'),
	array('id' => 37, 'title' => 'Gingerbread Cookies', 'link' => '430_3151480'),
	array('id' => 38, 'title' => 'Gingerbread Dude', 'link' => '430_3151480'),
	array('id' => 39, 'title' => 'Bread Pudding   ', 'link' => '430_3151480'),
	array('id' => 40, 'title' => 'Coconut Custard Pie', 'link' => '430_3151480'),
	array('id' => 41, 'title' => 'Coconut Macaroon', 'link' => '326_2841738'),
	array('id' => 42, 'title' => 'Ice Cream Cone', 'link' => '700_3473780'),
	array('id' => 43, 'title' => 'Mint Chocolate Milk Shake', 'link' => '700_3473780'),
	array('id' => 44, 'title' => 'Pecan Pie', 'link' => '185_2577502'),
	array('id' => 45, 'title' => 'Smores', 'link' => '167_2835774'),
	array('id' => 46, 'title' => 'Black Forest Cake', 'link' => '167_2835774'),
	array('id' => 47, 'title' => 'Fruit Cake', 'link' => '326_2841738'),
	array('id' => 48, 'title' => 'Pumpkin Nut Bread', 'link' => '430_3150132'),
	array('id' => 49, 'title' => 'Pumpkin Pie', 'link' => '700_3473780'),
	array('id' => 50, 'title' => 'Pumpkin Ice Cream', 'link' => '700_3473780'),
	array('id' => 51, 'title' => 'Rhubarb Crumble', 'link' => '430_3151480'),
	array('id' => 52, 'title' => 'Carrot Cake', 'link' => '167_2835774'),
	array('id' => 53, 'title' => 'Ice Cream Cake', 'link' => '700_3473780'),
	array('id' => 54, 'title' => 'Baked Alaska', 'link' => '430_3150132'),
	array('id' => 55, 'title' => 'Ice Cream Sandwich', 'link' => '326_2841738'),
	array('id' => 56, 'title' => 'Hot Fudge Sundae', 'link' => '430_3151480'),
	array('id' => 57, 'title' => 'Pecan Praline Ice Cream', 'link' => '95_2542284'),
	array('id' => 58, 'title' => 'Banana Split', 'link' => '167_2835774'),
	array('id' => 59, 'title' => 'Boston Cream Pie', 'link' => '430_3151480'),
	array('id' => 60, 'title' => 'Banana Bread', 'link' => '430_3151480'),
	array('id' => 61, 'title' => 'Chocolate Layer Cake', 'link' => '326_2841738'),
	array('id' => 62, 'title' => 'Shortbread Cookies', 'link' => '185_2577502'),
	array('id' => 63, 'title' => 'Oreo Cookies', 'link' => '326_2841738'),
	array('id' => 64, 'title' => 'Pop Tarts', 'link' => '430_3151480'),
);
*/


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
<title>Pithaa Hut | Products</title>
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
			Welcome <?php echo $userName; ?> <br />
			
			<?php 
				$flag = false;
				if(isset($_SESSION["loggedin"])) {
					if($_SESSION['data']['role'] === 'admin') {
						echo '<br/><a href="addproducts.php"><b>Add New Products</b></a>';
						$flag = true;
					}
				}
			?>
			
		</div>
		<?php echo ($flag) ? '<br />' : '' ?>
		
		<ul class="topmenu">
		<li><a href="index.php">Home</a></li>
		<li><a href="about.php">About Us</a></li>
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
		<h2>Our Products</h2>
		<a class="pages" href="products.php?page=<?php echo $prev; ?>">&lt;prev</a>
		&nbsp;|&nbsp;
		<a class="pages" href="products.php?page=<?php echo $next; ?>">next&gt;</a>
		<?php echo ($message) ? "&nbsp;&nbsp;<b>$message<br />" : ''; ?>
		<ul>
			<?php echo $view->displayProducts($page, $linesPerPage, $maxProducts, $products->getProducts()); ?>		
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

