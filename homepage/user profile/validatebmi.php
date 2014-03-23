    <!DOCTYPE HTML>
    <html>

    <head>
      <title>Calculate BMI</title>
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
              <h1>BMI</h1>
              <?php

              error_reporting(E_ALL &~ E_NOTICE);

    // Start the session
              session_start();

      // If the session vars aren't set, try to set them with a cookie
              if (!isset($_SESSION['user_id'])) {
                if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
                  $_SESSION['user_id'] = $_COOKIE['user_id'];
                  $_SESSION['username'] = $_COOKIE['username'];
                }
              }


    // Make sure the browser is transmitting in UTF-8
              header('Content-type: text/html; charset=utf-8');

      // Clear the error message
              $error_msg = "";

  //if (isset($_SESSION['user_id']))
  //  echo $_SESSION['user_id'];

              $dbc = mysqli_connect('localhost', 'root', 'root', 'help_me_be_healthy') or die("Error " . mysqli_error($dbc));
              mysqli_set_charset($dbc, "utf8");


              if(isset($_POST['submit']))
              {
                $bmi=0;
                $kg=$_POST['kg'];
                $mt=$_POST['mt'];

                if(empty($kg) || empty($mt))
                {
                  echo "<label class='err'><center>All fields are required</center></label>";
                  include("index.php");
                }

                else if(!is_numeric($kg) && !is_numeric($mt) )
                {
                  echo "<label class='err'>Please enter valid data.</label>";
                  include("index.php");
                }
                else
                {
                  $bmi = $kg/($mt*$mt);
                  $bmi=round($bmi,2);
                  if ( $bmi <= 18.5 ) 
                  {
                    echo "Your BMI is " .$bmi."  which means you are underweight";

                  }

                  else if ( $bmi>18.5 && $bmi <= 24.9) {
                    echo  "Your BMI is ".$bmi." which means you are normal";
                  }

                  else if ( $bmi>29.9 && $bmi< 24.9 ) {
                    echo "Your BMI is ".$bmi." which means you are overweight";
                  }

                  else if ( $bmi >29.9 && $bmi<=39.9 ) {
                    echo "Your BMI is ".$bmi." which means you are obese";

                  }
                  else
                  {
                    echo "You are morbidly obese.";

                  } 
                  include("index.php");

                  $query = "UPDATE `users` SET `user_bmi`= $bmi WHERE `user_id` = " . $_SESSION['user_id'];


                  $data = mysqli_query($dbc, $query);
                  if (!mysqli_query($dbc,$query)) {
                    echo "Failed to store";
                  }

                }
              }
              ?>

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