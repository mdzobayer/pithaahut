<?php

session_start();
$_SESSION['currentPage'] = 'members.php';

require './View/View.php';
$view = new View();
require './Model/Products.php';
require './Model/Members.php';

$members = new Members(); 


$maxMembers = count($members->getMembers());

$page = (isset($_GET['page'])) ? (int) $_GET['page'] : 0;

$prev = ($page == 0) ? 0 : $page - 1;
$next = $page + 1;
$linesPerPage = 6;

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
<title>Pithaa Hut | Members</title>
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
				  	<a href="logout.php?curr_page=members" > Logout </a>
				  <?php else :?>
				  	<a href="login.php?curr_page=members" >Login</a>
			<?php endif ?>
			 | <a href="members.php" class="active.php" >Our Members</a> | <a href="cart.php" >Shopping Cart</a>
			</b>
			<br />
			Welcome <?php echo $userName; ?>		</div>
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
	<h2>Our Members</h2>
	<br/>
		<form name="search" method="get" action="members.php" id="search">
			<input type="text" value="" name="keyword" class="s0" placeholder="keyword" />	
			<input type="submit" name="search" value="Search Members" class="button marL10" />
			<input type="hidden" name="page1" value="members" />
		</form>
	<br/><br/>
	<a class="pages" href="members.php?page=<?php echo $prev; ?>">&lt;prev</a>
	&nbsp;|&nbsp;
	<a class="pages" href="members.php?page=<?php echo $next; ?>">next&gt;</a>
	<table>
		<tr>
			<th>Member ID</th><th>Name</th><th>City</th><th>Email</th>
		</tr>
		<?php echo $view->displayMembers($page, $linesPerPage, $maxMembers, $members->getMembers()); ?>
	</table>
	<br/>
	<a href="addmember.php" class="abutton">&nbsp;&nbsp;&nbsp;Member Sign Up&nbsp;&nbsp;&nbsp;</a>

</div>
<br class="clear-all"/>
</div><!-- content -->
	
	</div><!-- maincontent -->

	<?php echo $view->displayFooter(); ?><!-- footer -->
	
</div><!-- wrapper -->

</body>
</html>

