  <html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Process Goal</title>
    <style type = "text/css">
    body {
      background-color: FFFFCC;
      margin-left: 10%;
      margin-right: 10%;
      border: 5px dotted green;
      padding: 10px 10px 10px 10px;
      font-family: sans-serif;
    }
    </style>

  </head>

<?php

error_reporting(E_ALL &~ E_NOTICE);

session_start();

if (!isset($_SESSION['user_id'])) {
  if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
    $_SESSION['user_id'] = $_COOKIE['user_id'];
    $_SESSION['username'] = $_COOKIE['username'];
  }
}


$user_id = $_SESSION['user_id'];

$dbc = mysqli_connect('localhost', 'root', 'root', 'help_me_be_healthy') or die("Error " . mysqli_error($dbc));
mysqli_set_charset($dbc, "utf8");

if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

//Check whether the form has been submitted
if (array_key_exists('check_submit', $_POST)) {

 if ( isset($_POST['goal']) ) { 

     $_POST['goal'] = implode(', ', $_POST['goal']); //Converts an array into a single string

     $goal = $_POST['goal'];

   }

   if ( isset($_POST['time']) ) { 

     $_POST['time'] = implode(', ', $_POST['time']); 

     $time = $_POST['time'];

   }

   if ( isset($_POST['office']) ) {

     $_POST['office'] = implode(', ', $_POST['office']); 

     $office = $_POST['office'];

   }

   if ( isset($_POST['gym']) ) {

     $_POST['gym'] = implode(', ', $_POST['gym']); 

     $gym = $_POST['gym'];

   }

   if ( isset($_POST['gymyes']) ) { 
     $_POST['gymyes'] = implode(', ', $_POST['gymyes']); //Converts an array into a single string

     $gym_yes = $_POST['gymyes'];

   }

   if ( isset($_POST['food']) ) { 
     $_POST['food'] = implode(', ', $_POST['food']); //Converts an array into a single string

     $food = $_POST['food'];

   }

   $query = "INSERT INTO `users_goals` (`goal_id`, `user_id`, `goal`, `time`, `office`, `gym`, `gym_yes`, `food`) VALUES (NULL, '$user_id', '$goal', '$time', '$office', '$gym', '$gym_yes', '$food')";

   $data = mysqli_query($dbc, $query) or die("Error " . mysqli_error($data));

 }


 echo 'Goal successfully saved to your profile';

 ?>

     <html>
    <ul>
      <li><a href="../index.php">Back to Homepage</a></li>
    </ul>
    </html>
  </body> 
  </html>




