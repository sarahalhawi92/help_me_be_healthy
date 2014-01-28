<?php
session_start();

  // If the session vars aren't set, try to set them with a cookie
if (!isset($_SESSION['user_id'])) {
  if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
    $_SESSION['user_id'] = $_COOKIE['user_id'];
    $_SESSION['username'] = $_COOKIE['username'];
  }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Homepage</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>

  <h2>Welcome to helpmebehealthy.com!</h2>

  <ul>
    <li><a href="carbs/carbohydrates.html">The Carbs</a></li>
    <li><a href="proteins/protein.html">The Protein</a></li>
    <li><a href="fibres/fibres.html">The Fibre</a></li> 
    <li><a href="fats/fats.html">Fats</a></li> 
    <li><a href="vitamins and minerals/vitamins and minerals.html">Vitamins and Minerals</a></li> 
  </ul>

  </body>

  </html>

  <?php
  $dbc = mysqli_connect('localhost', 'root', 'root', 'help_me_be_healthy') or die("Error " . mysqli_error($dbc));
  //$dbc = mysqli_connect('mysql8.000webhost.com', 'a2976397_healthy', 'masabi2014', 'a2976397_healthy') or die("Error " . mysqli_error($dbc));
  mysqli_set_charset($dbc, "utf8");

  if (!empty($_SESSION['user_id'])) {
        // Confirm the successful log-in
    echo('<p class="login">You are logged in as ' . $_SESSION['username'] . '.</p>');
  }

  // Generate the navigation menu
  if (isset($_SESSION['username'])) {
    //echo('<p class="login">You are logged in as ' . $_SESSION['username'] . '.</p>');
    echo '&#10084; <a href="user profile/viewprofile.php">View Profile</a><br />';
    echo '&#10084; <a href="registration & login/logout.php">Log Out (' . $_SESSION['username'] . ')</a>';
  }
  else {
    echo '<a href="registration & login/login.php">Log In</a><br />';
    echo '<a href="registration & login/registration.php">Sign Up</a>';
  }

  mysqli_close($dbc);
  ?>

</body> 
</html>