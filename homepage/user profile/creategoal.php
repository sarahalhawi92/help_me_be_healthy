    <!DOCTYPE HTML>
    <html>

    <head>
      <title>Create Goal</title>
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
              <p><b>What is your goal? Select from below</b></p>

              <form action="processgoal.php" method="post">

                <input type="hidden" name = "check_submit", value = "1" />

                <input type="radio" name="goal[]" value="Lose Weight"> Lose Weight <br>
                <input type="radio" name="goal[]" value="Get Fitter">  Get Fitter  <br>
                <input type="radio" name="goal[]" value="Tone Up">  Tone Up  <br>
                <input type="radio" name="goal[]" value="Eat Better">  Eat More Healthily  <br><br>


                <p><b>When would you like to achieve this?</b></p>

                <input type="radio" name="time[]" value="1 month or Less">  One Month or Less  <br>
                <input type="radio" name="time[]" value="2 - 3 Months">  Two to Three Months  <br>
                <input type="radio" name="time[]" value="3 - 6 Months">  Three to Six Months  <br>
                <input type="radio" name="time[]" value="6 Months or More">  Six Months or More  <br><br>


                <p><b>Do you have an office job?</b></p>

                <input type="radio" name="office[]" value="Yes">  Yes  <br>
                <input type="radio" name="office[]" value="No">  No  <br><br>


                <p><b>Do you go to the gym?</b></p>

                <input type="radio" name="gym[]" value="Yes">  Yes  <br>
                <input type="radio" name="gym[]" value="No">  No  <br><br>

                <p><b>If yes to the question above, how many times a week do you go?</b></p>

                <input type="radio" name="gymyes[]" value="Once a Week">  Once a Week  <br>
                <input type="radio" name="gymyes[]" value="Twice a Week">  Twice a Week  <br>
                <input type="radio" name="gymyes[]" value="3 - 4 times a Week">  Three to Four Times a Week  <br>
                <input type="radio" name="gymyes[]" value="More than 4 times a Week">  More than Four Times a Week  <br><br>


                <p><b>What foods do you generally eat? Choose from below</b></p>

                  <input type="checkbox" name="food[]" value="Chicken">  chicken  <br>
                  <input type="checkbox" name="food[]" value="Beef">  beef  <br>
                  <input type="checkbox" name="food[]" value="Lamb">  lamb  <br>
                  <input type="checkbox" name="food[]" value="Fish (Any)">  fish  <br>
                  <input type="checkbox" name="food[]" value="Cheese">  cheese  <br>
                  <input type="checkbox" name="food[]" value="Nuts">  nuts  <br>
                  <input type="checkbox" name="food[]" value="Fruit">  fruit  <br>
                  <input type="checkbox" name="food[]" value="Vegetable">  vegetable  <br>
                  <input type="checkbox" name="food[]" value="Bread">  bread  <br>
                  <input type="checkbox" name="food[]" value="Junk Food">  junk food  <br><br>


                  <input type="submit">

                </form>

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