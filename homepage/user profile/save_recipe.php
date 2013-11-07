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

echo gfgfd;

// Make sure the browser is transmitting in UTF-8
header('Content-type: text/html; charset=utf-8');

// Clear the error message
$error_msg = "";


$dbc = mysqli_connect('localhost', 'root', 'root', 'help_me_be_healthy') or die("Error " . mysqli_error($dbc));
mysqli_set_charset($dbc, "utf8");

//$query = "SELECT `recipe_1_name`, `recipe_2_name` FROM `carbohydrates`";
//$data= mysqli_query($dbc,$query);


if(isset($_POST['submit']))
{
		//$recipe_name = mysqli_result(mysqli_query("SELECT `recipe_1_name`, `recipe_2_name` FROM `carbohydrates`");

		          //"SELECT `recipe_1_name` OR `recipe_2_name` FROM `carbohydrates` WHERE `user_id` = '" . $_SESSION['user_id'] . "'";
	$query = "SELECT `recipe_1_name`, `recipe_2_name` FROM `carbohydrates`";
	$query = "UPDATE `users` SET `recipes_saved` = $query WHERE `user_id` = '" . $_SESSION['user_id'] . "'";
	$data= mysqli_query($dbc,$query);

	echo $query;
	);

}
?>