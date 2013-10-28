     <?php
      // Display any errors.
      error_reporting(E_ALL &~ E_NOTICE);

    // Start the session
      session_start();

    // Make sure the browser is transmitting in UTF-8
      header('Content-type: text/html; charset=utf-8');

    // Clear the error message
      $error_msg = "";

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

        if (!empty($_POST['username']) && !empty($_POST['password1']) && !empty($_POST['password2']) && !empty($_POST['email_address']) && ($password1 == $password2)) {
          // Make sure someone isn't already registered using this username
          $query = "SELECT * FROM users WHERE username = '$username'";
          $data = mysqli_query($dbc, $query);

          if (mysqli_num_rows($data) == 0) {
            // The username is unique, so insert the data into the database
            $query = "INSERT INTO `users` (`user_id`, `username`, `first_name`, `last_name`, `age`, `num_in_household`,`password`, `email_address`) 
            VALUES (NULL, '$username', '$first_name', '$last_name', '$age', '$num_in_household', SHA('$password1'), '$email_address')";

            mysqli_query($dbc, $query); 

            // Confirm success with the user
            echo '<p>Your new account has been successfully created. You\'re now ready to <a href="login.php">log in</a>.</p>';
            //echo $_POST ['username'];
            //echo $_POST ['password1'];
            //echo $_POST ['email_address'];

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
          echo '<p class="error">You must enter all of the sign-up data, including the desired password twice.</p>';
        }
      }

      mysqli_close($dbc);
      ?>
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>helpmebehealthy sign up</title>
      <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    <body>
      <h3>Registration</h3>

      <p>Please enter your username and desired password to sign up.</p>
      <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <fieldset>
          <legend>Registration Info</legend>
          <label for="username">Username:</label>
          <input type="text" id="username" name="username" value="<?php if (!empty($username)) echo $username; ?>" /><br />
          <label for="first_name">First Name (Optional):</label>
          <input type="text" id="first_name" name="first_name" /><br />
          <label for="last_name">Last Name (Optional):</label>
          <input type="text" id="last_name" name="last_name" /><br />
          <label for="age">Age:</label>
          <input type="text" id="age" name="age" /><br />
          <label for="num_in_household">Number of People in Household:</label>
          <input type="text" id="num_in_household" name="num_in_household" /><br />
          <label for="password1">Password:</label>
          <input type="password" id="password1" name="password1" /><br />
          <label for="password2">Password (retype):</label>
          <input type="password" id="password2" name="password2" /><br />
          <label for="email_address">Email Address:</label>
          <input type="text" id="email_address" name="email_address" /><br />
        </fieldset>
        <input type="submit" value="Sign Up" name="submit" />
      </form>
    </body> 
    </html>
