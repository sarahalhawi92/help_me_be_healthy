<?php
      // Display any errors.
error_reporting(E_ALL &~ E_NOTICE);

      // Start the session
session_start();

      // Make sure the browser is transmitting in UTF-8
header('Content-type: text/html; charset=utf-8');

      // Clear the error message
$error_msg = "";


session_start();

   if (!isset($_SESSION['user_id'])) {
    if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
      $_SESSION['user_id'] = $_COOKIE['user_id'];
      $_SESSION['username'] = $_COOKIE['username'];
    }
  }

if (isset($_POST['submit'])) {

	$dbc = mysqli_connect('localhost', 'root', 'root', 'help_me_be_healthy') or die("Error " . mysqli_error($dbc));
	mysqli_set_charset($dbc, "utf8");


	$password = mysqli_real_escape_string($dbc, trim($_POST['current_password']));
	$newpassword = mysqli_real_escape_string($dbc, trim($_POST['new_password']));
	$confirmnewpassword = mysqli_real_escape_string($dbc, trim($_POST['confirm_new_password']));

	if (!empty($_POST['current_password']) && !empty($_POST['new_password']) && !empty($_POST['confirm_new_password'])){


		$query = "SELECT `password` FROM `users` WHERE `username`=  '" . $_SESSION['user_id'] . "' ";
		$data= mysqli_query($dbc,$query) or die('Query failed: ' . mysql_error());

		if($new_password == $confirm_new_password) {


			$query = "UPDATE `users` SET `password` = SHA('$new_password') WHERE `user_id` = '" . $_SESSION['user_id'] . "' ";
			mysqli_query($dbc, $query) or die("Error " . mysqli_error($data));
			echo "Congratulations You have successfully changed your password"; 	
		}
		else {

			echo "The new password and confirm new password fields must be the same"; 
		}
	}
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Change Password</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
	<h3>Help me be Healthy - Change Password</h3>


	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<fieldset>
			<label for="current_password">Current Password:</label>
			<input type="text" id = "current_password" name="current_password" 
			<label for="new_password">New Password:</label>
			<input type="new_password" id = "new_password" name="new_password" />
			<label for="confirm_new_password">Confirm New Password:</label>
			<input type="confirm_new_password" id = "confirm_new_password" name="confirm_new_password" />
		</fieldset>
		<input type="submit" value="Change Password" name="submit" />
	</form>


