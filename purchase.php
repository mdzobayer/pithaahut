<?php 

session_start();
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


if(isset($_GET['productID'])) {
	$id = (int) $_GET['productID'];
}
if(isset($_GET['qty'])) {
	$qty = (int) $_GET['qty'];
}
if(isset($_GET['price'])) {
	$price = (float) $_GET['price'];
}
if($id && $qty && $price) {
	require './Model/Products.php';
	$products = new Products();
	if($products->addProductToCart($id, $qty, $price)) {
		setcookie('status', 'SUCCESS', time() + 3600, '/');
	}
	else {
		setcookie('status', 'FAILURE', time() + 3600, '/');
	}
}
else {
	setcookie('status', 'UNSET', time() + 3600, '/');
}
header('Location: products.php');
exit;

?>
