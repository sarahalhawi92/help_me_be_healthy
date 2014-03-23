    <!DOCTYPE HTML>
    <html>

    <head>
      <title>Track Goal</title>
      <meta name="description" content="website description" />
      <meta name="keywords" content="website keywords, website keywords" />
      <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
      <link rel="stylesheet" type="text/css" href="../css/style.css" />
      <!-- modernizr enables HTML5 elements and feature detects -->
      <script type="text/javascript" src="js/modernizr-1.5.min.js"></script>
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
                    <li><a href="../fats/avocado.php">Avocado</a></li>
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
                <li><a href="viewprofile.php">Your Profile</a>
                  <ul>
                    <li><a href="calculatebmi.php">Calculate BMI</a></li>
                    <li><a href="creategoal.php">Create Goal</a></li>
                    <li><a href="trackgoal.php">Track Goal</a></li>
                  </ul>
                </li>
              </nav>
            </header>
            <div id="content">
              <p>Let's see how you're getting on</p>

              <?php

    // Make sure the user is logged in before going any further.
              if (!isset($_SESSION['user_id'])) {
                echo '<p class="login">Please <a href="../registration & login/login.php">log in</a> to access this page.</p>';
                exit();
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

              if (mysqli_num_rows($data) > 0) {
                echo "<h>Your Goals:</h>";
                echo '<table>';
                while($row = mysqli_fetch_array($data))
                {
                  echo "<tr>";
                  echo "<td>" . $row['goal'] . "</td>";
                  echo "</tr>";
                }
                echo "</table>";

                ?>
                <form action="validategoal.php" method="post">

                  <input type="hidden" name = "check_submit", value = "1" />

                  <p>How are you doing?</p>

                  <input type="radio" name="yes[]" value="Yes">  On track  <br>
                  <input type="radio" name="no[]" value="No">  Lost track a little  <br>
                  <input type="radio" name="not_sure[]" value="Not Sure">  Completely off track  <br><br>


                  <tr><td colspan="2"><input type="submit" name="submit" class="btn" value="Submit"></td></tr></table>

                </form>

              </div>
              <?php }?>
              <?php
              if (mysqli_num_rows($data) == 0) {
                echo '<p class="creategoal">You have no goals saved. Create a <a href="creategoal.php">goal</a> here.</p>';
              }
              else {
                echo '<p class="error">There was a problem accessing your profile.</p>';
              }

              mysqli_close($dbc);
              ?>

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