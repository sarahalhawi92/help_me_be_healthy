    <!DOCTYPE HTML>
    <html>

    <head>
      <title>Change Password</title>
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
              <form method = "GET" action="searchresults.php?">
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
                <li><a href="viewprofile.php">Your Profile</a>
                  <ul>
                    <li><a href="calculatebmi.php">Calculate BMI</a></li>
                    <li><a href="creategoal.php">Create Goal</a></li>
                    <li><a href="trackgoal.php">Track Goal</a></li>
                    <li><a href="../registration & login/change_password.php">Settings</a></li>
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

              <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <fieldset>
                  <label for="current_password">Current Password:</label>
                  <input type="text" id = "current_password" name="current_password" 
                  <label for="new_password">New Password:</label>
                  <input type="new_password" id = "new_password" name="new_password" />
                  <label for="confirm_new_password">Confirm New Password:</label>
                  <input type="confirm_new_password" id = "confirm_new_password" name="confirm_new_password" />
                </fieldset>
                <input type="submit" value="Change Password" name="submit" />
              </form>
            </div>
          </div>
        </div>
      </div>
      <div id="grass"></div>
    </body>
    </html>

    <?php
      // Display any errors.
    error_reporting(E_ALL &~ E_NOTICE);

      // Start the session
    session_start();

      // Make sure the browser is transmitting in UTF-8
    header('Content-type: text/html; charset=utf-8');

      // Clear the error message
    $error_msg = "";


    session_start();

    if (!isset($_SESSION['user_id'])) {
      if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
        $_SESSION['user_id'] = $_COOKIE['user_id'];
        $_SESSION['username'] = $_COOKIE['username'];
      }
    }

    if (isset($_POST['submit'])) {

      $dbc = mysqli_connect('localhost', 'root', 'root', 'help_me_be_healthy') or die("Error " . mysqli_error($dbc));
      mysqli_set_charset($dbc, "utf8");


      $password = mysqli_real_escape_string($dbc, trim($_POST['current_password']));
      $newpassword = mysqli_real_escape_string($dbc, trim($_POST['new_password']));
      $confirmnewpassword = mysqli_real_escape_string($dbc, trim($_POST['confirm_new_password']));

      if (!empty($_POST['current_password']) && !empty($_POST['new_password']) && !empty($_POST['confirm_new_password'])){


        $query = "SELECT `password` FROM `users` WHERE `username`=  '" . $_SESSION['user_id'] . "' ";
        $data= mysqli_query($dbc,$query) or die('Query failed: ' . mysql_error());

        if($new_password == $confirm_new_password) {


          $query = "UPDATE `users` SET `password` = SHA('$new_password') WHERE `user_id` = '" . $_SESSION['user_id'] . "' ";
          mysqli_query($dbc, $query) or die("Error " . mysqli_error($data));
          echo "Congratulations You have successfully changed your password";   
        }
        else {

          echo "The new password and confirm new password fields must be the same"; 
        }
      }
    }

    ?>
