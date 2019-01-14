<?php

require './View/View.php';
$view = new View();
require './Model/Products.php';
require_once "config.php";

$products = new Products(); 

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION['data']['role'] === 'admin') {
	$userName = '<a href="profile.php">'. $_SESSION['data']['name'] . '</a>';
	$signnedin = true;
}
else {
	$userName = 'Guest';
	$signnedin = false;

}

$userName = '<b>' . $userName . '</b>';

$flag = true;

$isSpecial = isset($_POST['isSpecial']) ? 1 : 0;

if(isset($_POST['pTitle'])) {
	$pTitle =  $_POST['pTitle'];
}
else {
	$pTitle = 'unknownFileName';
	//var_dump($pTitle . "<br/>");
	$flag = false;
}

if(isset($_POST['pCode'])) {
	$pCode =  $_POST['pCode'];
}
else {
	$pCode = 'Empty product code';
	//var_dump($pCode . "<br/>");
	$flag = false;
}

if(isset($_POST['pDes'])) {
	$pDes =  $_POST['pDes'];
}
else {
	$pDes = 'empty Description';
	//var_dump($pDes . "<br/>");
	$flag = false;
}

if(isset($_POST['price'])) {
	$price =  $_POST['price'];
}
else {
	$price = 'empty Price';
	//var_dump($price . "<br/>");
	$flag = false;
}

$last_id = 'unknown';

if(isset($_FILES['image']) && $flag){


	//INSERT INTO `products` (`product_id`, `sku`, `title`, `description`, `price`, `special`, `link`) VALUES (NULL, 'T12', 'Test Product12', 'same test', '1.20', '1', NULL);
	$sql = 'INSERT INTO `products` (`product_id`, `sku`, `title`, `description`, `price`, `special`, `link`) VALUES (NULL, ?, ?, ?, ?, ?, NULL);';

	if($stmt = mysqli_prepare($link, $sql)){
		// Bind variables to the prepared statement as parameters
		mysqli_stmt_bind_param($stmt, "sssss", $pCode, $pTitle, $pDes, $price, $isSpecial);
		
		
		// Attempt to execute the prepared statement
		if(mysqli_stmt_execute($stmt)){
			// Redirect to login page
			echo 'Successfully added';
		} else{
			echo "Something went wrong. Please try again later.";
		}
	}
	

	$last_id = mysqli_insert_id($link);
	//SELECT product_id FROM `products` WHERE title = 'Test Product12';
	// $sql = 'SELECT product_id FROM `products` WHERE title = ?';

	// if($stmt = mysqli_prepare($link, $sql)) {
	// 	mysqli_stmt_bind_param($stmt, "s", $pTitle);

	// 	// Execute
	// 	mysqli_stmt_execute($stmt);

	// 	//Store Result
	// 	mysqli_stmt_store_result($stmt);

	// 	mysqli_stmt_bind_result($stmt, $last_id);

	// 	mysqli_stmt_fetch($stmt);



	// }
	
// var_dump($last_id . '<br/>');
      
    $file_name = $_FILES['image']['name'];
    $file_size =$_FILES['image']['size'];
    $file_tmp =$_FILES['image']['tmp_name'];
    $file_type=$_FILES['image']['type'];
    $exp = explode('.',$file_name);
    $file_ext=strtolower(end($exp));
    
    $expensions= array("jpeg","jpg","png");
    
    if(in_array($file_ext,$expensions) === false){
       $errors[]="extension not allowed, please choose a JPEG or PNG file.";
    }
    
    if($file_size > 2097152){
       $errors[]='File size must be exactly 2 MB';
    }
	
	$file_name = "product_".$last_id."." . $file_ext;

    if(empty($errors)==true){
       move_uploaded_file($file_tmp,"./images/".$file_name);
	   //echo "Success";
	   //header('location: addproducts.php');
    }else{
       print_r($errors);
	}
	
	//UPDATE `products` SET `link` = '26' WHERE `products`.`product_id` = 00000026;

	$sql = "UPDATE products SET link = 'product_". $last_id ."' WHERE product_id ='000000".$last_id."'";

	if (mysqli_query($link, $sql)) {
    // echo "Record updated successfully";
} else {
    // echo "Error updating record: " . mysqli_error($link);
}

var_dump($sql);



	//$sql = 'INSERT INTO `products` (`product_id`, `sku`, `title`, `description`, `price`, `special`, `link`) VALUES (NULL, ?, ?, ?, ?, ?, NULL);';

	//if($stmt = mysqli_prepare($link, $sql)){
		// Bind variables to the prepared statement as parameters
		//mysqli_stmt_bind_param($stmt, "sssss", $pCode, $pTitle, $pDes, $price, $isSpecial);
		
		
		// Attempt to execute the prepared statement
		//mysqli_stmt_execute($stmt);
		// if(mysqli_stmt_execute($stmt)){
		// 	// Redirect to login page
		// 	echo 'Successfully added';
		// } else{
		// 	echo "Something went wrong. Please try again later.";
		// }
	//}



















 }


?>


<!DOCTYPE HTML>
<html>
<head>
<title> Pithaa Hut | Add Products</title>
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
<style>
.error { color: red; }
</style>
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
		
		<h2>Add New Products</h2>
		<br/>
		
		<b>Please enter your information.</b><br/><br/>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
			
			<p>
				<label>Title: </label>
				<input type="text" name="pTitle" value="" placeholder="Product Title" />
			<p>
			<p>
				<label>Product Code: </label>
				<input type="text" name="pCode" value="" placeholder="Product Code" />
			<p>
			<p>
				<label>Description: </label>
				<input type="text-area" name="pDes" value="" placeholder="Description"  />
			<p>
			<p>
				<label>Price: </label>
				<input type="text" name="price" value="" placeholder="Price" />
			<p>
			<p>
				<label>Special: </label>
				<input type="checkbox" name="isSpecial" />
			<p>
            <p>
				<label>Images: </label>
				<input type="file" name="image" value="" placeholder="City" />
			<p>
            <p>
				<input type="submit" name="submitButton" value="Add Products" class="button marL10"/>
			<p>

        </form>
	</div><!-- product-list -->
</div>
	
</div><!-- maincontent -->

<?php echo $view->displayFooter(); ?><!-- footer -->
	
</div><!-- wrapper -->

</body>
</html>
