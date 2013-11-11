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

// Make sure the browser is transmitting in UTF-8
header('Content-type: text/html; charset=utf-8');

// Clear the error message
$error_msg = "";

// Connecting, selecting database
$dbc = mysqli_connect('localhost', 'root', 'root', 'help_me_be_healthy') or die("Error " . mysqli_error($dbc));
mysqli_set_charset($dbc, "utf8");

if(isset($_POST['submit_1']))
{


	$query = "UPDATE users SET recipes_saved = (SELECT recipe_1_name FROM carbohydrates LIMIT 1) WHERE user_id = '" . $_SESSION['user_id'] . "'";

	$data= mysqli_query($dbc,$query) or die("Error " . mysqli_error($data));

	echo $query;
}


if(isset($_POST['submit_2']))
{


	$query = "UPDATE users SET recipes_saved = (SELECT recipe_2_name FROM carbohydrates LIMIT 1) WHERE user_id = '" . $_SESSION['user_id'] . "'";

	$data= mysqli_query($dbc,$query) or die("Error " . mysqli_error($data));

	echo $query;
}

?>