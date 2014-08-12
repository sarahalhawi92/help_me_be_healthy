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
        <title>Login</title>
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
                <li><a href="protein.php">Proteins</a>
                  <ul>
                    <li><a href="beef.php">Beef</a></li>
                    <li><a href="chicken.php">Chicken</a></li>
                    <li><a href="eggs.php">Eggs</a></li>
                    <li><a href="fish.php">Fish</a></li>
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
                    <li><a href="../user profile/trends.php">Trends</a></li>
                    <?php }?>
                  </ul>
                </li>
              </nav>
              </header>
              <div id="content">
                <h1>Login</h1>
                <?php
        // If the session var is empty, show any error message and the log-in form; otherwise confirm the log-in
                if (empty($_SESSION['user_id'])) {
                  echo '<p class="error">' . $error_msg . '</p>';
                  ?>

                  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <fieldset>
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

  <div id="grass"></div>
</body>
</html>
