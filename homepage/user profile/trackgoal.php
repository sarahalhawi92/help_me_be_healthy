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
    <title>Track Goal</title>
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
    <h3>Help me be Healthy - Track Goal</h3>

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
      $query = "SELECT goal FROM users_goals WHERE user_id LIKE  '%" . $_SESSION['user_id'] . "%'";
    }
    else {
      $query = "SELECT goal FROM users_goals WHERE user_id LIKE  '%" . $_SESSION['user_id'] . "%'";
    }
    $data = mysqli_query($dbc, $query);

    echo "<h>Your Goals:</h>";
    echo '<table>';
    if (mysqli_num_rows($data) > 0) {
      while($row = mysqli_fetch_array($data))
      {
        echo "<tr>";
        echo "<td>" . $row['goal'] . "</td>";
        echo "</tr>";
      }
      echo "</table>";
    }
    else {
      echo '<p class="error">There was a problem accessing your profile.</p>';
    }

    mysqli_close($dbc);
    ?>


    <html>
    <head>
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
     <title>Create Goal</title>
     <link rel="stylesheet" type="text/css" href="style.css" />
   </head>

   <body>

     <form action="validategoal.php" method="post">

      <input type="hidden" name = "check_submit", value = "1" />

      <p>How are you doing with this goal?</p>

      <input type="radio" name="yes[]" value="Yes">On track<br>
      <input type="radio" name="no[]" value="No">Lost track a little<br>
      <input type="radio" name="not_sure[]" value="Not Sure">Completely off track<br>


      <tr><td colspan="2"><input type="submit" name="submit" class="btn" value="Submit"></td></tr></table>

    </form>
  </body>
  <ul>
    <li><a href="../index.php">Back to Homepage</a></li>
  </ul>
  </html>
</body> 
</html>
