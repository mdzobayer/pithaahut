



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


var_dump($_GET['keyword']);
var_dump($_GET['title']);

?>

<!DOCTYPE HTML>
<html>
<head>
<title>Pithaa Hut | Search</title>
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
				  	<a href="logout.php?curr_page=search" > Logout </a>
				  <?php else :?>
				  	<a href="login.php?curr_page=search" >Login</a>
			<?php endif ?>
			 | <a href="members.php" >Our Members</a> | <a href="cart.php" >Shopping Cart</a>
			</b>
			<br />
			Welcome <?php echo $userName; ?>		</div>
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
			<input type="text" value="keywords" name="keyword" class="s0" />
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
			<input type="hidden" name="page" value="search" />
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
		<a class="pages" href="products.php">&lt;prev</a>
		&nbsp;|&nbsp;
		<a class="pages" href="products.php">next&gt;</a>
			<ul>
				<li>
					<div class="image">
						<a href="detail.php">
						<img src="images/167_2835774.scale_20.JPG" alt=" Ambrosia Salad" width="190" height="130"/>
						</a>
					</div>
					<div class="detail">
						<p class="name"><a href="detail.php"> Ambrosia Salad</a></p>
						<p class="view"><a href="detail.php">purchase</a> | <a href="detail.php">view details >></a></p>
					</div>
				</li>
				<li>
					<div class="image">
						<a href="detail.php">
						<img src="images/167_2835774.scale_20.JPG" alt=" Apple Pie a la Mode" width="190" height="130"/>
						</a>
					</div>
					<div class="detail">
						<p class="name"><a href="detail.php"> Apple Pie a la Mode</a></p>
						<p class="view"><a href="detail.php">purchase</a> | <a href="detail.php">view details >></a></p>
					</div>
				</li>
				<li>
					<div class="image">
						<a href="detail.php">
						<img src="images/430_3151480.scale_20.JPG" alt=" Apple Turnover" width="190" height="130"/>
						</a>
					</div>
					<div class="detail">
						<p class="name"><a href="detail.php"> Apple Turnover</a></p>
						<p class="view"><a href="detail.php">purchase</a> | <a href="detail.php">view details >></a></p>
					</div>
				</li>
				<li>
					<div class="image">
						<a href="detail.php">
						<img src="images/430_3150132.scale_20.JPG" alt=" Baked Alaska" width="190" height="130"/>
						</a>
					</div>
					<div class="detail">
						<p class="name"><a href="detail.php"> Baked Alaska</a></p>
						<p class="view"><a href="detail.php">purchase</a> | <a href="detail.php">view details >></a></p>
					</div>
				</li>
				<li>
					<div class="image">
						<a href="detail.php">
						<img src="images/700_3473780.scale_20.JPG" alt=" Baklava" width="190" height="130"/>
						</a>
					</div>
					<div class="detail">
						<p class="name"><a href="detail.php"> Baklava</a></p>
						<p class="view"><a href="detail.php">purchase</a> | <a href="detail.php">view details >></a></p>
					</div>
				</li>
				<li>
					<div class="image">
						<a href="detail.php">
						<img src="images/430_3151480.scale_20.JPG" alt=" Banana Bread" width="190" height="130"/>
						</a>
					</div>
					<div class="detail">
						<p class="name"><a href="detail.php"> Banana Bread</a></p>
						<p class="view"><a href="detail.php">purchase</a> | <a href="detail.php">view details >></a></p>
					</div>
				</li>
				<li>
					<div class="image">
						<a href="detail.php">
						<img src="images/430_3150132.scale_20.JPG" alt=" Banana Pudding" width="190" height="130"/>
						</a>
					</div>
					<div class="detail">
						<p class="name"><a href="detail.php"> Banana Pudding</a></p>
						<p class="view"><a href="detail.php">purchase</a> | <a href="detail.php">view details >></a></p>
					</div>
				</li>
				<li>
					<div class="image">
						<a href="detail.php">
						<img src="images/167_2835774.scale_20.JPG" alt=" Banana Split" width="190" height="130"/>
						</a>
					</div>
					<div class="detail">
						<p class="name"><a href="detail.php"> Banana Split</a></p>
						<p class="view"><a href="detail.php">purchase</a> | <a href="detail.php">view details >></a></p>
					</div>
				</li>
				<li>
					<div class="image">
						<a href="detail.php">
						<img src="images/167_2835774.scale_20.JPG" alt=" Black Forest Cake" width="190" height="130"/>
						</a>
					</div>
					<div class="detail">
						<p class="name"><a href="detail.php"> Black Forest Cake</a></p>
						<p class="view"><a href="detail.php">purchase</a> | <a href="detail.php">view details >></a></p>
					</div>
				</li>
		</ul>
	</div><!-- product-list -->
	
	
</div><!-- rightnav -->

<br class="clear-all"/>
</div><!-- content -->
	
	</div><!-- maincontent -->

	<div id="footer">
		<div class="footer">
			Copyright &copy; 2012 sweetsbazar.com. All rights reserved. <br/>
		<a href="home.php">Home</a> | <a href="about.php">About Us</a> | <a href="specials.php">Specials</a> | <a href="contact.php">Contact Us</a> 		<br />
			<span class="contact">Tel: +44-1234567890&nbsp;
			Fax: +44-1234567891&nbsp;
			Email:sales@sweetsbazar.com</span>
		</div>
	div><!-- footer -->
	
</div><!-- wrapper -->

</body>
</html>
