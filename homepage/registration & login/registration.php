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

          //mail ('$email_address', 'Activate your Account', "Hello " . '$first_name' . ",\n \n You need to activate your account, you can use the link below: http://localhost:8888/homepage/registration & login/activate.php?email=" . ['$email_address'] . "&email_code=" . ['$email_code'] . "\n \n  -helpmebehealthy");

          if($query){

            

            // send e-mail to ...
            $to=$email_address;

            echo $email_address;

            // Your subject
            $subject="Your confirmation link here";

            echo $subject;


             // Your message
            $message="Your Comfirmation link \r\n";
            $message.="Click on this link to activate your account \r\n";
            $message.="http://localhost:8888/homepage/registration%20&%20login/activation.php?passkey=$email_code";

            echo $message;

            $sentmail = mail('$to', '$subject', '$message', 'From: helpmebehealthy.com');

            echo $sentmail;

          }

           // if not found 
          else {
            echo "Email not found in database";
          }

           // if your email succesfully sent
          if($sentmail){

            echo "Your Confirmation link Has Been Sent To Your Email Address.";

          }

          else {

            echo "Cannot send Confirmation link to your e-mail address";

} // Confirm success with the user
echo '<p>Your new account has been successfully created.</p>';


mysqli_close($dbc);

exit();

}

else {
            // An account already exists for this username, so display an error message
  echo '<p class="error">An account already exists for this username. Please use a different address.</p>';
  $username = "";

}

}
else {
  echo '<p class="error">You must enter all the required sign-up information, including the desired password twice.</p>';
}

}

mysqli_close($dbc);

?>

<!DOCTYPE HTML>
<html>

<head>
  <title>Registration</title>
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
        <nav>
          <ul class="sf-menu" id="nav">
            <li><a href="../index.php">Home</a></li>
            <li><a href="../carbohydrates/carbohydrates.html">Carbohydrates</a></li>
            <li><a href="../proteins/protein.html">Proteins</a></li>
            <li><a href="../fibres/fibres.html">Fibres</a></li>
            <li><a href="../fats/fats.html">Fats</a></li>
            <li><a href="../vitamins and minerals/vitamins and minerals.html">Vitamins & Minerals</a>
            </ul>
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
            <input type="submit" value="Sign Up" name="submit" />
          </form>
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
