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

  	if (mysqli_connect_errno())
  	{
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	}

$passkey = $_GET['passkey'];

echo $passkey;

$query = "SELECT * FROM users WHERE email_code ='$passkey'";
$data = mysqli_query($dbc, $query); 

//breaking here

if(mysqli_num_rows($data) == 1){

// Count how many rows the passkey has 

	$count=mysqli_num_rows($data);

	echo $count;

	if($count == 1){

		echo fgdsfdf;

		$query = "UPDATE `users` SET `active` = 1 WHERE `email_code` = '$passkey'";

		$data = mysqli_query($dbc, $query) or die('Query failed: ' . mysql_error());

		echo '<p>Your account has been activated. You\'re now ready to <a href="login.php">log in</a>.</p>';

		// if not found passkey, display message "Wrong Confirmation code" 
		else {
			echo "Wrong Confirmation code";
		}
	}

}

?>