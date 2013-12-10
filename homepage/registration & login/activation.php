<?php
      // Display any errors.
error_reporting(E_ALL &~ E_NOTICE);

    // Start the session
session_start();

    // Make sure the browser is transmitting in UTF-8
header('Content-type: text/html; charset=utf-8');

    // Clear the error message
$error_msg = "";

$dbc = mysqli_connect('localhost', 'root', 'root', 'help_me_be_healthy') or die("Error " . mysqli_error($dbc));
mysqli_set_charset($dbc, "utf8");

$passkey = $_GET['passkey'];

echo $passkey;

$query = "SELECT * FROM users WHERE email_code ='$passkey'";

$data = mysqli_query($dbc, $query); 

//breaking here

if($data){

	echo fdsfdl;

// Count how many row has this passkey
	$count=mysqli_num_rows($data);

	echo $count;



}

?>