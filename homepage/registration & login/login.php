      <?php

      // Display any errors.
      error_reporting(E_ALL &~ E_NOTICE);

      // Start the session
      session_start();

      // Make sure the browser is transmitting in UTF-8
      header('Content-type: text/html; charset=utf-8');

      // Clear the error message
      $error_msg = "";

      // If the user isn't logged in, try to log them in
      if (!isset($_SESSION['user_id'])) {
        if (isset($_POST['submit'])) {
          // Connect to the database
          $dbc = mysqli_connect('localhost', 'root', 'root', 'help_me_be_healthy') or die("Error " . mysqli_error($dbc));
          mysqli_set_charset($dbc, "utf8");

          // Grab the user-entered log-in data
          $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
          //echo $_POST ['username'];
          $password = mysqli_real_escape_string($dbc, trim($_POST['password']));
          //echo $_POST ['password'];

          if (!empty($_POST['username']) && !empty($_POST['password'])){
            $password = sha1($password);
            // Look up the username and password in the database

            $query = "SELECT `user_id`, `username` FROM `users` WHERE `username` = '$username' AND `password` = '$password'";
            $data= mysqli_query($dbc,$query);

            if (mysqli_num_rows($data) == 1) {

              // The log-in is OK so set the user ID and username session vars (and cookies), and redirect to the home page
              $row = mysqli_fetch_assoc($data);
              $_SESSION['user_id'] = $row['user_id'];
              $_SESSION['username'] = $row['username'];
              setcookie('user_id', $row['user_id'], time() + (60 * 60 * 24 * 30));    // expires in 30 days
              setcookie('username', $row['username'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
              echo "<meta http-equiv=\"refresh\" content=\"0;URL=../index.php?view=$username\">";
            }
            else {
              // The username/password are incorrect so set an error message
              $error_msg = 'Sorry, you must enter a valid username and password to log in.';
            }
          }
          else {
            // The username/password weren't entered so set an error message
            $error_msg = 'Sorry, you must enter your username and password to log in.';
          }
        }
      }
      ?>
      <!DOCTYPE HTML>
      <html>

      <head>
        <title>Carbohydrates</title>
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
                  <h1><a href="index.php">Helpmebe<span class="logo_colour">healthy</span></a></h1>
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
                <?php
        // If the session var is empty, show any error message and the log-in form; otherwise confirm the log-in
                if (empty($_SESSION['user_id'])) {
                  echo '<p class="error">' . $error_msg . '</p>';
                  ?>

                  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <fieldset>
                      <legend>Log In</legend>
                      <label for="username">Username:</label>
                      <input type="text" id = "username" name="username" 
                      value="<?php if (!empty($username)) echo $username; ?>" /><br />
                      <label for="password">Password:</label>
                      <input type="password" id = "password" name="password" />
                      <a href="forgot_password.php">Forgotten your Password?</a>
                    </fieldset>
                    <input type="submit" value="Log In" name="submit" />
                  </form>

                  <?php
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
