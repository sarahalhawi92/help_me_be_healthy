 <!DOCTYPE HTML>
 <html>

 <head>
  <title>Reset Password</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" type="text/css" href="../css/style.css" />
  <!-- modernizr enables HTML5 elements and feature detects -->
  <script type="text/javascript" src="js/modernizr-1.5.min.js"></script>
</head>

<body>
  <div id="container">
    <img src="../images/sun.png" alt="sunshine" />
    <div id="main">
      <header>
        <div id="logo">
          <div id="logo_text">
            <h1><a href="../index.php">Helpmebe<span class="logo_colour">healthy</span></a></h1>
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
            <li><a href="../index.php">Home</a></li>
            <li><a href="../carbohydrates/carbohydrates.html">Carbohydrates</a>
              <ul>
                <li><a href="../carbohydrates/bananas.php">Bananas</a></li>
                <li><a href="../carbohydrates/beans.php">Beans</a></li>
                <li><a href="../carbohydrates/brown_rice.php">Brown Rice</a></li>
                <li><a href="../carbohydrates/chickpeas.php">Chickpeas</a></li>
                <li><a href="../carbohydrates/lentils.php">Lentils</a></li>
                <li><a href="../carbohydrates/parsnips.php">Parsnips</a></li>
                <li><a href="../carbohydrates/potatoes.php">Potatoes</a></li>
                <li><a href="../carbohydrates/sweetcorn.php">Sweetcorn</a></li>
              </ul>
            </li>
            <li><a href="../proteins/protein.html">Proteins</a>
              <ul>
                <li><a href="../proteins/beef.php">Beef</a></li>
                <li><a href="../proteins/chicken.php">Chicken</a></li>
                <li><a href="../proteins/eggs.php">Eggs</a></li>
                <li><a href="../proteins/fish.php">Fish</a></li>
              </ul>
            </li>
            <li><a href="../fibres/fibres.html">Fibres</a>
              <ul>
                <li><a href="../fibres/beans.php">Beans</a></li>
                <li><a href="../fibres/lentils.php">Lentils</a></li>
                <li><a href="../fibres/pulses.php">Pulses</a></li>
              </ul>
            </li>
            <li><a href="../fats/fats.html">Fats</a>
              <ul>
                <li><a href="../fats/avocodo.php">Avocodo</a></li>
                <li><a href="../fats/mackerel.php">Mackerel</a></li>
                <li><a href="../fats/salmon.php">Salmon</a></li>
                <li><a href="../fats/tuna.php">Tuna</a></li>
              </ul>
            </li>
            <li><a href="../vitamins and minerals/vitamins and minerals.html">Vitamins & Minerals</a>
              <ul>
                <li><a href="../vitamins and minerals/chickpeas.php">Chickpeas</a></li>
                <li><a href="../vitamins and minerals/sweetpotato.php">Sweet Potato</a></li>
              </ul>
            </li>
            <?php if (!empty($_SESSION['user_id'])) ?>
            <li><a href="../user profile/viewprofile.php">Your Profile</a>
              <ul>
                <li><a href="../user profile/calculatebmi.php">Calculate BMI</a></li>
                <li><a href="../user profile/creategoal.php">Create Goal</a></li>
                <li><a href="../user profile/trackgoal.php">Track Goal</a></li>
                <li><a href="change_password.php">Settings</a></li>
              </ul>
            </li>
          </nav>
        </header>
        <div id="content">
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

        $message="Your password to log into helpmebehealthy has been temporarily changed to '$temp_pass'. Please log in using this password and your username. ";

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
</div>
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
