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

//Check whether the form has been submitted
if (array_key_exists('check_submit', $_POST)) {
   //Check whether a $_GET['Languages'] is set
 if ( isset($_POST['goal']) ) { 

     $_POST['goal'] = implode(', ', $_POST['goal']); //Converts an array into a single string

     $goal = $_POST['goal'];

     $query = "UPDATE `users` SET `goal` = '$goal' WHERE `user_id` = '" . $_SESSION['user_id'] . "' ";

     mysqli_query($dbc, $query) or die("Error " . mysqli_error($data));
   }

   if ( isset($_POST['time']) ) { 

     $_POST['time'] = implode(', ', $_POST['time']); //Converts an array into a single string

     $time = $_POST['time'];

     $query = "UPDATE `users` SET `time` = '$time' WHERE `user_id` = '" . $_SESSION['user_id'] . "' ";

     mysqli_query($dbc, $query) or die("Error " . mysqli_error($data));
   }

   if ( isset($_POST['office']) ) {

     $_POST['office'] = implode(', ', $_POST['office']); //Converts an array into a single string

      $office = $_POST['office'];

     $query = "UPDATE `users` SET `office` = '$office' WHERE `user_id` = '" . $_SESSION['user_id'] . "' ";

     mysqli_query($dbc, $query) or die("Error " . mysqli_error($data));
   }

   if ( isset($_POST['gym']) ) {

     $_POST['gym'] = implode(', ', $_POST['gym']); //Converts an array into a single string

     $gym = $_POST['gym'];

     $query = "UPDATE `users` SET `gym` = '$gym' WHERE `user_id` = '" . $_SESSION['user_id'] . "' ";

     mysqli_query($dbc, $query) or die("Error " . mysqli_error($data));
   }

   if ( isset($_POST['gymyes']) ) { 
     $_POST['gymyes'] = implode(', ', $_POST['gymyes']); //Converts an array into a single string

      $gym_yes = $_POST['gymyes'];

     $query = "UPDATE `users` SET `gym_yes` = '$gym_yes' WHERE `user_id` = '" . $_SESSION['user_id'] . "' ";

     mysqli_query($dbc, $query) or die("Error " . mysqli_error($data));
   }

   if ( isset($_POST['food']) ) { 
     $_POST['food'] = implode(', ', $_POST['food']); //Converts an array into a single string

     $food = $_POST['food'];

     $query = "UPDATE `users` SET `food` = '$food' WHERE `user_id` = '" . $_SESSION['user_id'] . "' ";

     mysqli_query($dbc, $query) or die("Error " . mysqli_error($data));
   }

   //Let's now print out the received values in the browser
   echo "Your goal is: {$_POST['goal']}<br />";
   echo "You want to achieve this in: {$_POST['time']}<br />";
   echo "Office Job?: {$_POST['office']}<br />";
   echo "Gym?:{$_POST['gym']}<br />";
   echo "Number of times you go to the gym: {$_POST['gymyes']}<br />";
   echo "Food you eat: {$_POST['food']}<br />";
 } else {
  echo "You can't see this page without submitting the form.";
}
?>

<html>
<ul>
  <li><a href="../index.php">Back to Homepage</a></li>
  <li><a href="viewprofile.php">Back to Profile</a></li>
</ul>
</html>
</body> 
</html>