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
  <title>Calculate BMI</title>
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
          <h1>BMI</h1>
          <fieldset style="width:20%">
            <legend style="color:#0000FF; letter-spacing:3px; font-weight:bold">BMI check</legend>
            <table cellpadding="1" cellspacing="1">
              <tr>
                <form action="validatebmi.php" method="post">
                  <td>Kilogram</td><td><input type="text" name="kg" placeholder="  In killogram" maxlength="4"/></td>
                </tr>
                <td>Height</td><td><input type="text" name="mt" placeholder="  In mtr" maxlength="4"/></td>
              </tr>
              <tr><td colspan="2"><input type="submit" name="submit" class="btn" value="Submit"></td></tr></table>
            </form>
          </fieldset>
        </div>

        <div id="grass"></div>
      </body>
      </html>