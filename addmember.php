<?php

require './View/View.php';
$view = new View();
require './Model/Products.php';
require_once "config.php";

//assign defaults
$data = array ('email'		=> 'email',
			   'firstname'	=> 'firstname',
			   'lastname'	=> 'lastname',
			   'address'	=> 'address',
			   'city'		=> 'city',
			   'postcode'	=> 'postcode',
			   'telephone'	=> 'telephone',
			   'dobyear'	=> 0,
			   'dobmonth'	=> 0,
			   'dobday'		=> 0,
			   'country'	=> 'country',
			   'password'	=> 'password',
			   'confirm_password'	=> 'confirm_password',
			   'balance'	=> 'balance',
			   'role'		=> 'user'
);

$defaultRole = 'user';

$error = array ('email'		=> '',
			   'firstname'	=> '',
			   'lastname'	=> '',
			   'address'	=> '',
			   'city'		=> '',
			   'postcode'	=> '',
			   'telephone'	=> '',
			   'dob'		=> '',
			   'country'	=> '',
			   'password'	=> '',
			   'confirm_password'	=> '',
			   'balance'	=> '',
			   'role'		=> ''
);

if(isset($_POST['data']) && $_SERVER["REQUEST_METHOD"] == "POST") {
	$data = $_POST['data'];
	foreach ($data as $key => $value) {
		$data[$key] = strip_tags($value);
	}

	if(isset($data['dobyear']) && isset($data['dobmonth']) && isset($data['dobday'])) {
		try {
			$bdateString = sprintf('%4d-%02d-%02d', $data['dobyear'], $data['dobmonth'], $data['dobday']);
			$bdate = new DateTime($bdateString);
			$today = new DateTime();
			$interval21 = new DateInterval('P15Y');
			$bdate21 = $today->sub($interval21);
			if($bdate > $bdate21)
				$error['dob'] = '<b class="error">Must be at least 15 years old</b>';
		}
		catch (Exception $e) {
			$error['dob'] = '<b class="error">Invalid date 1</b>';
			echo $e->getMessage();
			exit;
		}
	}
	else {
		$error['dob'] = '<b class="error">Invalid date 2</b>';
	}


	if(!preg_match('/^[a-z][a-z0-9._-]+@(\w+\.)+[a-z]{2,6}$/i', $data['email'])) {
		$error['email'] = '<b class="error">Invalid email address</b>';
	}
	if(!preg_match('/^[a-z0-9,. ]+$/i', $data['firstname'])) {
		$error['firstname'] = '<b class="error">Invalid first name</b>';
	}
	if(!preg_match('/^[a-z0-9,. ]+$/i', $data['lastname'])) {
		$error['lastname'] = '<b class="error">Invalid last name</b>';
	}
	if(empty(trim($data['address']))) {
		$error['address'] = '<b class="error">Invalid address</b>';
	}


/*
	if(!preg_match('/^[a-z][0-9][a-z] [0-9][a-z][0-9]$|^/d{5}(-\d{4}}?$/i', $data['postcode'])) {
		$error['postcode'] = '<b class="error">Invalid email address</b>';
	}
*/
/*
	if(!preg_match('/^\+[0-9]{1,3} \d{3}-\d{3}-\d{4}/', $data['telephone'])) {
		$error['telephone'] = '<b class="error">Telephone numbers should be in form </b>';
	}
*/
	// check to see if form valid
	$isValid = TRUE;
	foreach ($error as $value) {
		if($value) {
			$isValid = FALSE;
			break;
		}
	}
	if($isValid) {

		// Define variables and initialize with empty values
		$email = $password = $confirm_password = "";
		$username_err = $password_err = $confirm_password_err = "";

		// Prepare a select statement
		$sql = "SELECT id FROM users WHERE email = ?";
			
		if($stmt = mysqli_prepare($link, $sql)){
			// Bind variables to the prepared statement as parameters
			mysqli_stmt_bind_param($stmt, "s", $param_username);
				
			// Set parameters
			$param_username = trim($data['email']);
				
			// Attempt to execute the prepared statement
			if(mysqli_stmt_execute($stmt)){
				/* store result */
				mysqli_stmt_store_result($stmt);
					
				if(mysqli_stmt_num_rows($stmt) == 1){
					$error['email'] = '<b class="error">This email is already taken</b>';
				} else{
					$email = trim($data['email']);
				}
			} else{
				echo "Oops! Something went wrong. Please try again later.";
			}
			// Close statement
			mysqli_stmt_close($stmt);
			
		}
		

		// Validate password
		if(empty(trim($data["password"]))){
			$error['password'] = '<b class="error">Please enter a password</b>';     
		} elseif(strlen(trim($data["password"])) < 6){
			$error['password'] = '<b class="error">Password must have atleast 6 characters.</b>'; 
		} else{
			$password = trim($data["password"]);
		}

		// Validate confirm password
		if(empty(trim($data["confirm_password"]))){
			$error['confirm_password'] = '<b class="error">Please confirm password</b>';   
		} else{
			$confirm_password = trim($data["confirm_password"]);
			if(empty($password_err) && ($password != $confirm_password)){
				$error['confirm_password'] = '<b class="error">Password did not match.</b>';
			}
		}
		
		// Balance Check
		if(empty(trim($data["balance"]))) {
			$error['balance'] = '<b class="error">Please enter balance</b>';
		}
		elseif(!is_numeric(trim($data['balance']))) {
			$error['balance'] = '<b class="error">Please enter floating point number</b>';
		}

		// Error check before inserting into database

		// echo "<h1>Debug1</h1></br>";
		// echo "<h1>" . $error['email'] . "</h1></br>";
		// echo "<h1>" . $error['firstname'] . "</h1></br>";
		// echo "<h1>" . $error['lastname'] . "</h1></br>";
		// echo "<h1>" . $error['address'] . "</h1></br>";
		// echo "<h1>" . $error['city'] . "</h1></br>";
		// echo "<h1>" . $error['postcode'] . "</h1></br>";
		// echo "<h1>" . $error['telephone'] . "</h1></br>";
		// echo "<h1>" . $error['dob'] . "</h1></br>";
		// echo "<h1>" . $error['country'] . "</h1></br>";
		// echo "<h1>" . $error['password'] . "</h1></br>";
		// echo "<h1>" . $error['confirm_password'] . "</h1></br>";
		// echo "<h1>" . $error['balance'] . "</h1></br>";


		if(empty($error['email']) && empty($error['firstname']) && empty($error['lastname']) && empty($error['address']) && 
		empty($error['city']) && empty($error['postcode']) && empty($error['telephone']) && empty($error['dob']) && 
		empty($error['country']) && empty($error['password']) && empty($error['confirm_password']) && empty($error['balance']) ) {
			
			//echo "<h1>Debug2</h1></br>";

			$fullName = $data['firstname'] . " " . $data['lastname'];
			$sql = "INSERT INTO members (user_id, name, address, city, state_province, postal_code, country, phone, balance, email, password, role) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
			//$sql = "INSERT INTO `members` (`user_id`, `name`, `address`, `city`, `state_province`, `postal_code`, `country`, `phone`, `balance`, `email`, `password`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
			
			
			if($stmt = mysqli_prepare($link, $sql)){
				// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt, "sssssssssss", $fullName, $data['address'], $data['city'], $data['city'],
									$data['postcode'], $data['country'], $data['telephone'], $data['balance'],
									$data['email'], $data['password'], $defaultRole);
				
				
				// Attempt to execute the prepared statement
				if(mysqli_stmt_execute($stmt)){
					// Redirect to login page
					header("location: login.php");
				} else{
					echo "Something went wrong. Please try again later.";
				}
			}
			
			// Close statement
			mysqli_stmt_close($stmt);
		}
			
		// Close statement
		//mysqli_stmt_close($stmt);
	}
}
?>


<!DOCTYPE HTML>
<html>
<head>
<title> Pithaa Hut | Addmember</title>
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
			<a href="login.php" >Login</a> | <a href="members.php" >Our Members</a> | <a href="cart.php" >Shopping Cart</a>
			</b>
			<br />
			Welcome Guest		</div>
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
		
		<h2>Sign Up</h2>
		<br/>
		
		<b>Please enter your information.</b><br/><br/>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			<p>
				<label>Birthdate: </label>
				<select name = "data[dobyear]">
					<?php if($data['dobyear']) {echo '<option>', $data['dobyear'], '</option>'; } ?>
					<?php $year = date('Y'); ?>
					<?php for($x = $year; $x > ($year - 120); --$x) { ?>
						<option> <?php echo $x; ?> </option>
					<?php } ?>
				 </select>
				<select name = "data[dobmonth]">
					<?php 
					$month = array( 1 => 'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
					if($data['dobmonth']) {
						printf('<option value="%02d">%s</option>',
								$data['dobmonth'], $month[(int) $data['dobmonth']]);
					}
					for($x = 1; $x <= 12; $x++) { 
						printf('<option value="%02d">%s</option>', $x, $month[$x]);
						echo PHP_EOL;
					} ?>
				 </select>
				<select name = "data[dobday]"> 
					<?php if($data['dobday']) { echo '<option>', $data['dobday'], '</option>'; } ?>
					<?php for($x = 1; $x < 32; ++$x) { ?>
						<option><?php echo $x; ?></option> <?php echo $x; ?> </option>
					<?php } ?>
				</select>
				<?php if($error['dob']) echo '<p>', $error['dob']; ?>
			</P>
			<p>
				<label>Email: </label>
				<input type="text" name="data[email]" value="" placeholder="Email Address" />
				<?php if($error['email']) echo '<p>', $error['email']; ?>
			<p>
			<p>
				<label>First Name: </label>
				<input type="text" name="data[firstname]" value="" placeholder="Name" />
				<?php if($error['firstname']) echo '<p>', $error['firstname']; ?>
			<p>
			<p>
				<label>Last Name: </label>
				<input type="text" name="data[lastname]" value="" placeholder="Sure Name"  />
				<?php if($error['lastname']) echo '<p>', $error['lastname']; ?>
			<p>
			<p>
				<label>Address: </label>
				<input type="text" name="data[address]" value="" placeholder="Address" />
				<?php if($error['address']) echo '<p>', $error['address']; ?>
			<p>
			<p>
				<label>City: </label>
				<input type="text" name="data[city]" value="" placeholder="City" />
				<?php if($error['city']) echo '<p>', $error['city']; ?>
			<p>
			<p>
				<label>Postcode: </label>
				<input type="text" name="data[postcode]" value="" placeholder="Postal Code" />
			<p>
			<p>
				<label>Country: </label>
				<input type="text" name="data[country]" value="" placeholder="Country" />
			<p>
			<p>
				<label>Telephone: </label>
				<input type="text" name="data[telephone]" value="" placeholder="Phone Number"  />
			<p>
			<p>
				<label>Balance: </label>
				<input type="text" name="data[balance]" value="" placeholder="Amount" />
				<?php if($error['balance']) echo '<p>', $error['balance']; ?>
			<p>
			<p>
				<label>Password: </label>
				<input type="password" name="data[password]" value="" placeholder="Password"  />
			<p>
			<p>
				<label>Confirm Password: </label>
				<input type="password" name="data[confirm_password]" value="" placeholder="Confirm Password"  />
			<p>
			<p>
				<input type="reset" name="data[clear]" value="Clear" class="button"/>
				<input type="submit" name="data[submit]" value="Sign Up" class="button marL10"/>
			<p>
			<p>Already have an account? <a href="login.php">Login here</a>.</p>
		</form>
	</div><!-- product-list -->
</div>
	
</div><!-- maincontent -->

<?php echo $view->displayFooter(); ?><!-- footer -->
	
</div><!-- wrapper -->

</body>
</html>
