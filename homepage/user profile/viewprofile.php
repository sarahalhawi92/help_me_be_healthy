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
    <title>View Profile</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  <body>
    <h3>Help me be Healthy - My Profile</h3>

    <?php

    // Make sure the user is logged in before going any further.
    if (!isset($_SESSION['user_id'])) {
      echo '<p class="login">Please <a href="login.php">log in</a> to access this page.</p>';
      exit();
    }
    else {
      echo('<p class="login">You are logged in as ' . $_SESSION['username'] . '. <a href="../registration & login/logout.php">Log out</a>.</p>');
    }

    // Connect to the database
    $dbc = mysqli_connect('localhost', 'root', 'root', 'help_me_be_healthy') or die("Error " . mysqli_error($dbc));
    mysqli_set_charset($dbc, "utf8");

    // Grab the profile data from the database
    if (!isset($_GET['user_id'])) {
      $query = "SELECT username, email_address, user_bmi, recipes_saved, goal FROM users WHERE user_id = '" . $_SESSION['user_id'] . "'";
    }
    else {
      $query = "SELECT username, email_address, user_bmi, recipes_saved, goal FROM users WHERE user_id = '" . $_GET['user_id'] . "'";
    }
    $data = mysqli_query($dbc, $query);

    if (mysqli_num_rows($data) == 1) {
      // The user row was found so display the user data
      $row = mysqli_fetch_array($data);
      echo '<table>';
      if (!empty($row['username'])) {
        echo '<tr><td class="label">Username:</td><td>' . $row['username'] . '</td></tr>';
      }
      if (!empty($row['email_address'])) {
        echo '<tr><td class="label">Email Address:</td><td>' . $row['email_address'] . '</td></tr>';
      }
      if (!empty($row['user_bmi'])) {
        echo '<tr><td class="label">BMI:</td><td>' . $row['user_bmi'] . '</td></tr>';
      }
      if (!empty($row['recipes_saved'])) {
        echo '<tr><td class="label">Recipes Saved:</td><td>' . $row['recipes_saved'] . '</td></tr>';
      }

      if (!empty($row['goal'])) {
        echo '<tr><td class="label">Your Goals:</td><td>' . $row['goal'] . '</td></tr>';
      }

      echo '</table>';
    } // End of check for a single row of user results
    else {
      echo '<p class="error">There was a problem accessing your profile.</p>';
    }

    mysqli_close($dbc);
    ?>

    <html>
    <ul>
      <li><a href="../index.php">Back to Homepage</a></li>
      <li><a href="calculatebmi.php">Calculate BMI</a></li>
      <br>
      <li><a href="creategoal.php">Create Goal</a></li>
    </ul>
    </html>
  </body> 
  </html>
