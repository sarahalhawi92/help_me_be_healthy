<?php

      // Display any errors.
error_reporting(E_ALL &~ E_NOTICE);


      // Make sure the browser is transmitting in UTF-8
header('Content-type: text/html; charset=utf-8');

      // Clear the error message
$error_msg = "";


if (isset($_POST['submit'])) { // Handle the form.

	$dbc = mysqli_connect('localhost', 'root', 'root', 'help_me_be_healthy') or die("Error " . mysqli_error($dbc));
	mysqli_set_charset($dbc, "utf8");

	if (empty($_POST['email_address'])) { // Validate the email address.

		echo fdfg;

		$user_id = FALSE;

		echo ‘<p><font color=”red” size=”+1″>You forgot to enter your email address!</font></p>’;

//Checks if the form below has been submitted. Then it checks that an email address has been entered with the empty() function. If not we warn the visitor.

	} else {

// Check for the existence of that email address.

		$query = "SELECT `user_id` FROM `users` WHERE `email_address` = ’”.  ($_POST['email_address']) . “‘";


		$result = mysql_query ($query) or trigger_error(“Query: $query\n<br />MySQL Error: ” . mysql_error());

//Here we are checking that the email address they entered is valid. The query asks for a user_id, form the table users, where the value is equal to the email entered. The escape_data() function cleans up the information entered. For more information on this function, refer to the previous PHP Tutorial.

		if (mysql_num_rows($result) == 1) {

// Retrieve the user ID.

			list($uid) = mysql_fetch_array ($result, MYSQL_NUM);

//If there was a positive response from our query, retrieve the userid. We assign the results using the list function, as if they were an array, but we will only get one result, because we only have one account for each email address.

		} else {

			echo ‘<p><font color=”red” size=”+1″>The submitted email address does not match those on file!</font></p>’;

			$uid = FALSE;

		}

	}

//If the email address wasn’t found with our query, we alert them to that fact.

if ($uid) { // If everything’s OK.

// Create a new, random password.

	$p = substr ( md5(uniqid(rand(),1)), 3, 10);

//If the query was successful, we create a new 32 digit password for them. For more information on what these functions do, refer to the previous PHP Tutorial. They basically just create a new random password, for temporary use.

// Make the query.

	$query = “UPDATE users SET pass=SHA(‘$p’) WHERE user_id=$uid”;

	$result = mysql_query ($query) or trigger_error(“Query: $query\n<br />MySQL Error: ” . mysql_error());

//This query updates the record in the database, by setting the new password based on the record having the value of the entered email address.

if (mysql_affected_rows() == 1) { // If it ran OK.

// Send an email.

	$body = “Your password to log into SITENAME has been temporarily changed to ‘$p’. Please log in using this password and your username. At that time you may change your password to something more familiar.”;

	mail ($_POST['email'], ‘Your temporary password.’, $body, ‘From: admin@sitename.com’);

	echo ‘<h3>Your password has been changed. You will receive the new, temporary password at the email address with which you registered. Once you have logged in with this password, you may change it by clicking on the “Change Password” link.</h3>’;

	Here we check that the update query was successful, with the mysql_affected_rows() function. If it was we create a message to send to the visitor and then mail them their new password.

// mysql_close(); // Close the database connection.

include (‘./includes/footer.html’); // Include the HTML footer.

// exit();

//Here we are closing the database connection and the script.

} else { // If it did not run OK.

	echo ‘<p><font color=”red” size=”+1″>Your password could not be changed due to a system error. We apologize for any inconvenience.</font></p>’;

}

} else { // Failed the validation test.

	echo ‘<p><font color=”red” size=”+1″>Please try again.</font></p>’;

}

//Here we are alerting the visitor that we couldn’t change their password, because of either a system error or because they entered the wrong information.






} // End of the main Submit conditional.

?>