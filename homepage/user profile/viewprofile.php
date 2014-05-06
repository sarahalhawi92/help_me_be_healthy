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
  <title>View Profile</title>
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
            <li><a href="viewprofile.php">Your Profile</a>
              <ul>
                <li><a href="calculatebmi.php">Calculate BMI</a></li>
                <li><a href="creategoal.php">Create Goal</a></li>
                <li><a href="trackgoal.php">Track Goal</a></li>
                <li><a href="../registration & login/change_password.php">Settings</a></li>
                <?php }?>
              </ul>
            </li>
          </nav>
        </header>
        <div id="content">
          <h1>Profile</h1>
        </div>

        <?php

        $user_id = $_SESSION['user_id'];

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
      $maxPrice = 0;
      $counter = 0;
      $resultSet = array();
    }

    while($row = mysqli_fetch_array($recipeData))
    {
      $maxPrice = $maxPrice + $row['recipe_price'];
      echo "<tr>";
      echo "<td>" . $row['recipe_name'] . "</td>";
      echo "<td>" . $row['recipe_calories'] . "</td>";
      echo "<td>" . $row['recipe_price'] . "</td>";
      echo "</tr>";
      $counter++;
    }
    echo "</table>";
    $average = $maxPrice/$counter; 

    //select recipe from database with price range of average

    $query = "SELECT  `recipe_name` FROM  `recipes` WHERE  `recipe_price` <= (SELECT AVG (`recipe_price`) FROM  `recipes` 
      WHERE  `user_ids` LIKE  '%$user_id%') ORDER BY RAND() LIMIT 1";

$suggestData = mysqli_query($dbc, $query);

while($row = mysqli_fetch_array($suggestData)) {
  echo ('Based on what you have searched, why not try ' . $row['recipe_name'] . '.');
  echo "<br>";
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

</div>
</div>
</div>

<div id="grass"></div>
</body>
</html>