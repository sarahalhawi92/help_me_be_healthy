<?php

      // Display any errors.
error_reporting(E_ALL &~ E_NOTICE);


      // Make sure the browser is transmitting in UTF-8
header('Content-type: text/html; charset=utf-8');

      // Clear the error message
$error_msg = "";

echo ggfdg;

if (isset($_POST['submit'])) { // Handle the form.

	$dbc = mysqli_connect('localhost', 'root', 'root', 'help_me_be_healthy') or die("Error " . mysqli_error($dbc));
	mysqli_set_charset($dbc, "utf8");

	echo blah;

	if (empty($_POST['email_address'])) { // Validate the email address.

		echo blah2;

//$uid = FALSE;

//echo ‘<p><font color=”red” size=”+1″>You forgot to enter your email address!</font></p>’;

//Checks if the form below has been submitted. Then it checks that an email address has been entered with the empty() function. If not we warn the visitor.

	} else {

// Check for the existence of that email address.


		$query = "SELECT `user_id` FROM `users` WHERE `email_address`= '" . $_POST['email_address'] . "' ";

		$data= mysqli_query($dbc,$query) or die('Query failed: ' . mysql_error());


//Here we are checking that the email address they entered is valid. The query asks for a user_id, form the table users, where the value is equal to the email entered. The escape_data() function cleans up the information entered. 

		if (mysqli_num_rows($data) == 1) {

			echo blah3;

// Retrieve the user ID.

			$row = mysqli_fetch_assoc($data);
			$_SESSION['user_id'] = $row['user_id'];

			$temp_pass = substr ( md5(uniqid(rand(),1)), 3, 10);

			echo $temp_pass;

			$query = "UPDATE `users` SET `password` = SHA('$temp_pass') WHERE `user_id` = '" . $_SESSION['user_id'] . "' ";

			mysqli_query($dbc, $query) or die("Error " . mysqli_error($data));

//		} else {

//			echo ‘<p><font color=”red” size=”+1″>The submitted email address does not match those on file!</font></p>’;

//			$user_id = FALSE;

		}

	}

          if($query){

          	echo blah5;

          	$to=$email_address;

          	$subject="Reset your Password";

          	$header="from: helpmebehealthy <helpmebehealthy.com>";

          	$message="Your password to log into SITENAME has been temporarily changed to ‘$temp_pass’. Please log in using this password and your email address. ";

          	$sentmail = mail($to,$subject,$message,$header);

          }

           // if your email succesfully sent
          if($sentmail){

           echo "Your Confirmation link Has Been Sent To Your Email Address.";

          }

          else {

            echo "Cannot send  link to your e-mail address";

} // Confirm success with the user
//echo '<p>Your password has been reset.</p>';


//mysqli_close($dbc);

//exit();




} 

?>