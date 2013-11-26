<?php

error_reporting(E_ALL &~ E_NOTICE);

    // Start the session
session_start();

	    // If the session vars aren't set, try to set them with a cookie
if (!isset($_SESSION['user_id'])) {
	if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
		$_SESSION['user_id'] = $_COOKIE['user_id'];
		$_SESSION['username'] = $_COOKIE['username'];
	}
}

echo $_SESSION['user_id'];

// Make sure the browser is transmitting in UTF-8
header('Content-type: text/html; charset=utf-8');

// Clear the error message
$error_msg = "";

// Connecting, selecting database
$dbc = mysqli_connect('localhost', 'root', 'root', 'help_me_be_healthy') or die("Error " . mysqli_error($dbc));
mysqli_set_charset($dbc, "utf8");


if(isset($_POST['submit_1'])){

	  $_POST['submit_1'] = implode(', ', $_POST['submit_1']); //Converts an array into a single string

	  $submit_1 = $_POST['submit_1'];

	  $query = "UPDATE users SET recipes_saved = (SELECT recipe_name FROM carbohydrates WHERE recipe_id = 1) WHERE user_id = '" . $_SESSION['user_id'] . "'";

	  $data= mysqli_query($dbc,$query) or die("Error " . mysqli_error($data));

	  echo 'Recipe Successfully saved to your profile';



	} elseif (isset($_POST['submit_2'])){

     $_POST['submit_2'] = implode(', ', $_POST['submit_2']); //Converts an array into a single string

     $submit_2 = $_POST['submit_2'];

     $query = "UPDATE users SET recipes_saved = (SELECT recipe_name FROM carbohydrates WHERE recipe_id = 2) WHERE user_id = '" . $_SESSION['user_id'] . "'";

     $data= mysqli_query($dbc,$query) or die("Error " . mysqli_error($data));

     echo 'Recipe Successfully saved to your profile';
 }

 ?>

 <html>
 <ul>
 	<li><a href="viewprofile.php">Back to Your Profile</a></li>
 	<li><a href="../index.php">Back to Homepage</a></li>
 </ul>
 </html>
</body> 
</html>