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

<!DOCTYPE HTML>
<html>

<head>
  <title>Helpmebehealthy</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <!-- modernizr enables HTML5 elements and feature detects -->
  <script type="text/javascript" src="js/modernizr-1.5.min.js"></script>
</head>

<body>
  <div id="container">
    <img src="images/sun.png" alt="sunshine" />
    <div id="main">
      <header>
        <div id="logo">
          <div id="logo_text">
            <h1><a href="index.php">Helpmebe<span class="logo_colour">healthy</span></a></h1>
            <h2>Choose the right lifestyle</h2>
          </div>
          <div id="logo_text2">
            <h3>Contact</h3>
            <h4>sarah.al-hawi.1@city.ac.uk</h4>
          </div>
        </div>
        <div id="tfheader">
          <form method="GET" action="searchresults.php?">
            <h5>Want to search for a recipe?</h5>
            <input id="search" name ="search" type="text" placeholder="Type Here" size="21" maxlength="120">
            <input id="submit" type="submit" value="submit">
          </form>
          <div class="tfclear"><br></div>
        </div>
        <nav>
          <ul class="sf-menu" id="nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="carbohydrates/carbohydrates.html">Carbohydrates</a></li>
            <li><a href="proteins/protein.html">Proteins</a></li>
            <li><a href="fibres/fibres.html">Fibres</a></li>
            <li><a href="fats/fats.html">Fats</a></li>
            <li><a href="vitamins and minerals/vitamins and minerals.html">Vitamins & Minerals</a>
<!--             <li><a href="#">Example Drop Down</a> 
              <ul>
                <li><a href="#">Drop Down One</a></li>
                <li><a href="#">Drop Down Two</a>
                  <ul>
                    <li><a href="#">Sub Drop Down One</a></li>
                    <li><a href="#">Sub Drop Down Two</a></li>
                    <li><a href="#">Sub Drop Down Three</a></li>
                    <li><a href="#">Sub Drop Down Four</a></li>
                    <li><a href="#">Sub Drop Down Five</a></li>
                  </ul>
                </li>
                <li><a href="#">Drop Down Three</a></li>
                <li><a href="#">Drop Down Four</a></li>
                <li><a href="#">Drop Down Five</a></li>
              </ul>
            </li> -->
            <!-- <li><a href="contact.php">Contact Us</a></li> -->
            <!-- </ul> -->
          </nav>
        </header>
        <div id="content">
          <h1>Welcome!</h1>
          <p>This website has been designed to provide a simple set of recipes. These include nutritional information and the price to make the recipes.</p>
          <p>You have the option of creating an account below, which will allow you to save recipes to your profile. You will also be able to create health and fitness goals, as well as calculate your BMI.</p>
          </div>
          <?php

          $dbc = mysqli_connect('localhost', 'root', 'root', 'help_me_be_healthy') or die("Error " . mysqli_error($dbc));
          mysqli_set_charset($dbc, "utf8");

          if (!empty($_SESSION['user_id'])) {
        // Confirm the successful log-in
            echo('<p class="login">You are logged in as ' . $_SESSION['username'] . '.</p>');
          }

  // Generate the navigation menu
          if (isset($_SESSION['username'])) {
    //echo('<p class="login">You are logged in as ' . $_SESSION['username'] . '.</p>');
            echo '<a href="user profile/viewprofile.php">View Profile</a><br />';
            echo '<a href="registration & login/logout.php">Log Out (' . $_SESSION['username'] . ')</a>';
          }
          else {
            echo '<a href="registration & login/login.php">Log In</a><br />';
            echo '<a href="registration & login/registration.php">Sign Up</a>';
          }

          mysqli_close($dbc);
          ?>
        </div>
      </div>
    </div>
    <div id="grass"></div>
    <!-- javascript at the bottom for fast page loading -->
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery.easing-sooper.js"></script>
    <script type="text/javascript" src="js/jquery.sooperfish.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
      $('ul.sf-menu').sooperfish();
    });
    </script>
  </body>
  </html>


