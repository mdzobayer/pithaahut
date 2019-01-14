<?php
// Initialize the session
session_start();


// if(isset($_SESSION['currentPage'])) {
//     $destination = $_SESSION['currentPage'];
// }
// else {
//     $destination = 'index.php';
// }


$destination = $_GET['curr_page'] ?? "index"; 

// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();
 
// Redirect to login page

$nextLocation = 'location: ' . $destination . '.php';

 header($nextLocation);
exit;
?>

Adding the Passw