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

         // Validate the email address.
  if (empty($_POST['email_address'])) { 

        //$uid = FALSE;
       //echo ‘<p><font color=”red” size=”+1″>You forgot to enter your email address!</font></p>’;

  } else {

// Check for the existence of that email address.

    $query = "SELECT `user_id` FROM `users` WHERE `email_address`= '" . $_POST['email_address'] . "' ";
    $data= mysqli_query($dbc,$query) or die('Query failed: ' . mysql_error());

    if (mysqli_num_rows($data) == 1) {

      $row = mysqli_fetch_assoc($data);
      $_SESSION['user_id'] = $row['user_id'];

      $temp_pass = substr ( md5(uniqid(rand(),1)), 3, 10);

      $query = "UPDATE `users` SET `password` = SHA('$temp_pass') WHERE `user_id` = '" . $_SESSION['user_id'] . "' ";

      mysqli_query($dbc, $query) or die("Error " . mysqli_error($data));

      if (mysqli_num_rows($data) == 1){

        $to=$_POST['email_address'];

        $subject="Reset your Password";

        $header="from: helpmebehealthy <helpmebehealthy.com>";

        $message="Your password to log into helpmebehealthy has been temporarily changed to '$temp_pass'. Please log in using this password and your email address. ";

        $sentmail = mail($to,$subject,$message,$header);

        echo "Please check your email for instructions on how to login into your account";

      } else {

        echo "Cannot send  link to your e-mail address";

      }

//                } else {

//                        echo ‘<p><font color=”red” size=”+1″>The submitted email address does not match those on file!</font></p>’;

//                        $user_id = FALSE;

    }

  }

 // Confirm success with the user
//echo '<p>Your password has been reset.</p>';


//mysqli_close($dbc);

//exit();




} 

?>