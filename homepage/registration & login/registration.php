<?php
      // Display any errors.
error_reporting(E_ALL &~ E_NOTICE);

    // Make sure the browser is transmitting in UTF-8
header('Content-type: text/html; charset=utf-8');
$dbc = mysqli_connect('localhost', 'root', 'root', 'help_me_be_healthy') or die("Error " . mysqli_error($dbc));
mysqli_set_charset($dbc, "utf8");


if (isset($_POST['submit'])) {

   // Grab the profile data from the POST
  $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
  $first_name = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
  $last_name = mysqli_real_escape_string($dbc, trim($_POST['last_name']));
  $age = mysqli_real_escape_string($dbc, trim($_POST['age']));
  $num_in_household = mysqli_real_escape_string($dbc, trim($_POST['num_in_household']));
  $password1 = mysqli_real_escape_string($dbc, trim($_POST['password1']));
  $password2 = mysqli_real_escape_string($dbc, trim($_POST['password2']));
  $email_address = mysqli_real_escape_string($dbc, trim($_POST['email_address']));
  $email_code = mysqli_real_escape_string($dbc, md5($_POST['$username'] + microtime()));

  if (!empty($_POST['username']) && !empty($_POST['password1']) && !empty($_POST['password2']) && !empty($_POST['email_address']) && ($password1 == $password2)) {
          // Make sure someone isn't already registered using this username
    $query = "SELECT * FROM users WHERE username = '$username'";
    $data = mysqli_query($dbc, $query);

    if (mysqli_num_rows($data) == 0) {

      // The username is unique, so insert the data into the database
      $query = "INSERT INTO `users` (`user_id`, `username`, `first_name`, `last_name`, `age`, `num_in_household`,`password`, `email_address`, `email_code`) 
      VALUES (NULL, '$username', '$first_name', '$last_name', '$age', '$num_in_household', SHA('$password1'), '$email_address', '$email_code')";

      mysqli_query($dbc, $query); 


      if($query){ 

        echo '<p id="p1">Your new account has been successfully created. Please check your email for a link to activate your account. </p>'; 

        // send e-mail to ...
        $to=$email_address;

        // Your subject
        $subject="Account Confirmation";

        $header="from: helpmebehealthy <helpmebehealthy.info";

        // Your message
        $message="Hello, \r\n \r\n";
        $message.="Please click on the link below to activate your account: \r\n \r\n";
        $message.="http://localhost:8888/homepage/registration%20&%20login/activation.php?passkey=$email_code \r\n \r\n";
        $message.="Regards, \r\n \r\n";
        $message.="helpmebehealthy.info ";

        $sentmail = mail($to,$subject,$message,$header);
      }
    }
    else {
            // An account already exists for this username, so display an error message
      echo '<p id="p2">An account already exists for this username. Please use a different email address.</p>';
      $username = "";

    }

  }
  else {
    echo '<p class="p2">You must enter all the required sign-up information, including the desired password twice.</p>';
  }

}

mysqli_close($dbc);

?>

<!DOCTYPE HTML>
<html>

<head>
  <title>Registration</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="../css/style.css" />
  <link rel="stylesheet" href="../jquery-ui-1.10.4/css/ui-lightness/jquery-ui-1.10.4.css">

  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

  <!-- javascript at the bottom for fast page loading -->
  <script type="text/javascript" src="js/jquery.easing-sooper.js"></script>
  <script type="text/javascript" src="js/jquery.sooperfish.js"></script>
  <script type="text/javascript">
  $(document).ready(function() {
    $('ul.sf-menu').sooperfish();
  });
  </script>

  <script type="text/javascript">
  $(document).ready(function(){
    $('#recipe').keyup(function(){
      var x = "../suggest_search.php?keyword=" + $('#recipe').val();
      $('#recipe').autocomplete({
        source: x,
        minLength:2,
      });
    });
  });
  </script>
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
          <form method = "GET" action="../searchresults.php?">
            <h5>Want to search for a recipe?</h5>
            <div class="ui-widget">
              <input class="searchInput ui-widget" id="recipe" name="recipe" type="text" placeholder="Type Here" />
              <input id="submit" type="submit" value="submit">
            </form>
          </div>
          <div class="tfclear"></div>
        </div>
        <div class="tfclear"><br></div>
        <div class="tfclear"><br></div>
        <nav>
          <ul class="sf-menu" id="nav">
            <li><a href="../index.php">Home</a></li>
            <li><a href="../carbohydrates/carbohydrates.php">Carbohydrates</a>
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
            <li><a href="../proteins/protein.php">Proteins</a>
              <ul>
                <li><a href="../proteins/beef.php">Beef</a></li>
                <li><a href="../proteins/chicken.php">Chicken</a></li>
                <li><a href="../proteins/eggs.php">Eggs</a></li>
                <li><a href="../proteins/fish.php">Fish</a></li>
              </ul>
            </li>
            <li><a href="../fibres/fibres.php">Fibres</a>
              <ul>
                <li><a href="../fibres/beans.php">Beans</a></li>
                <li><a href="../fibres/lentils.php">Lentils</a></li>
                <li><a href="../fibres/pulses.php">Pulses</a></li>
              </ul>
            </li>
            <li><a href="../fats/fats.php">Fats</a>
              <ul>
                <li><a href="../fats/avocado.php">Avocado</a></li>
                <li><a href="../fats/mackerel.php">Mackerel</a></li>
                <li><a href="../fats/salmon.php">Salmon</a></li>
                <li><a href="../fats/tuna.php">Tuna</a></li>
              </ul>
            </li>
            <li><a href="../vitamins and minerals/vitamins and minerals.php">Vitamins & Minerals</a>
              <ul>
                <li><a href="../vitamins and minerals/chickpeas.php">Chickpeas</a></li>
                <li><a href="../vitamins and minerals/sweetpotato.php">Sweet Potato</a></li>
              </ul>
            </li>
            <?php if (isset($_SESSION['user_id'])) {?>
            <li><a href="../user profile/viewprofile.php">Your Profile</a>
              <ul>
                <li><a href="../user profile/calculatebmi.php">Calculate BMI</a></li>
                <li><a href="../user profile/creategoal.php">Create Goal</a></li>
                <li><a href="../user profile/trackgoal.php">Track Goal</a></li>
                <li><a href="change_password.php">Settings</a></li>
                <li><a href="../homepage/user profile/trends.php">Trends</a></li>
              </ul>
            </li>
            <?php exit(); }?>
          </nav>
        </header>
        <div id="content">
          <h1>Information</h1>

          <p>Please enter the required information (marked with an asterick) to sign up.</p>
          <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <fieldset>
              <legend>Registration Info</legend>
              <label for="username">Username*:</label>
              <input type="text" id="username" name="username" value="<?php if (!empty($username)) echo $username; ?>" /><br />
              <label for="first_name">First Name:</label>
              <input type="text" id="first_name" name="first_name" /><br />
              <label for="last_name">Last Name:</label>
              <input type="text" id="last_name" name="last_name" /><br />
              <label for="age">Age:</label>
              <input type="text" id="age" name="age" /><br />
              <label for="num_in_household">Number of People in Household:</label>
              <input type="text" id="num_in_household" name="num_in_household" /><br />
              <label for="password1">Password*:</label>
              <input type="password" id="password1" name="password1" /><br />
              <label for="password2">Password (retype)*:</label>
              <input type="password" id="password2" name="password2" /><br />
              <label for="email_address">Email Address*:</label>
              <input type="text" id="email_address" name="email_address" /><br />
            </fieldset>
            <input type="submit" value="Sign Up" name="submit"/>
          </form>
          <?php

          ?>

        </div>
      </div>
    </div>
  </div>
  <div id="grass"></div>
</body>
</html>
