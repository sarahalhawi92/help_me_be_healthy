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

  <html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>View Profile</title>
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
      $query = "SELECT username, email_address, user_bmi FROM users WHERE user_id = '" . $_SESSION['user_id'] . "'";
      $query2 = "SELECT * FROM recipes WHERE user_ids LIKE  '%" . $_SESSION['user_id'] . "%' ORDER BY recipe_calories DESC";
      $query3 = "SELECT * FROM users_goals WHERE user_id LIKE  '%" . $_SESSION['user_id'] . "%'";
    }
    else {     
      $query = "SELECT username, email_address, user_bmi FROM users WHERE user_id = '" . $_GET['user_id'] . "'";
      $query2 = "SELECT * FROM recipes WHERE user_ids LIKE  '%" . $_GET['user_id'] . "%' ORDER BY recipe_calories DESC";
      $query3 = "SELECT * FROM users_goals WHERE user_id LIKE  '%" . $_SESSION['user_id'] . "%'";
    }
    $data = mysqli_query($dbc, $query);
    $recipeData = mysqli_query($dbc, $query2);
    $goalsData = mysqli_query($dbc, $query3);

    if (mysqli_num_rows($data) == 1) 
    {
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
      echo '</table>';
    } // End of check for a single row of user results
    else 
    {
      echo '<p class="error">There was a problem accessing your profile.</p>';
    }
    echo "<br>";


    if (mysqli_num_rows($recipeData) > 0) {
      echo "<h>Saved recipes:</h>";
      echo "<table border='1' width='45%'>
      <tr>
      <th>Recipe Name</th>
      <th>Recipe Calories</th>
      <th>Recipe Price</th>
      </tr>";
      echo "<br>";
      echo "<br>";
      while($row = mysqli_fetch_array($recipeData))
      {
        echo "<tr>";
        echo "<td>" . $row['recipe_name'] . "</td>";
        echo "<td>" . $row['recipe_calories'] . "</td>";
        echo "<td>" . $row['recipe_price'] . "</td>";
        echo "</tr>";
      }
      echo "</table>";
    }
    echo "<br>";
    
    if (mysqli_num_rows($goalsData) > 0) {
      echo "<h>Your Goals:</h>";
      echo "<table border='1' width='50%'>
      <tr>
      <th>Goal</th>
      <th>Time to achieve</th>
      <th>Office Job</th>
      <th>Gym?</th>
      <th>Number of times to gym</th>
      <th>Foods You Eat</th>
      </tr>";
      echo "<br>";
      echo "<br>";
      while($row = mysqli_fetch_array($goalsData))
      {
        echo "<tr>";
        echo "<td>" . $row['goal'] . "</td>";
        echo "<td>" . $row['time'] . "</td>";
        echo "<td>" . $row['office'] . "</td>";
        echo "<td>" . $row['gym'] . "</td>";
        echo "<td>" . $row['gym_yes'] . "</td>";
        echo "<td>" . $row['food'] . "</td>";
        echo "</tr>";
      }
      echo "</table>";
    }

    echo '</table>';

    mysqli_close($dbc);
    ?>

    <html>
    <ul>
      <li><a href="../index.php">Back to Homepage</a></li>
      <li><a href="calculatebmi.php">Calculate BMI</a></li>
      <br>
      <li><a href="..\registration & login\change_password.php">Change Password?</a></li>
      <br>
      <li><a href="creategoal.php">Create Goal</a></li>
      <li><a href="trackgoal.php">Track Goal</a></li>
    </ul>
    </html>
  </body> 
  </html>
