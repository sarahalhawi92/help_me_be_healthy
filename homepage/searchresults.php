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
  <title>Search Results</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <!-- modernizr enables HTML5 elements and feature detects -->
  <script type="text/javascript" src="js/modernizr-1.5.min.js"></script>
  <link rel="stylesheet" href="jquery-ui-1.10.4/css/ui-lightness/jquery-ui-1.10.4.css">
  
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <script type="text/javascript" src="jquery-ui-1.10.4/development-bundle/ui/jquery.ui.position.js"></script>

  <!-- javascript for fast page loading -->
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
      var x = "suggest_search.php?keyword=" + $('#recipe').val();
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
    <img src="images/sun.png" alt="sunshine" />
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
            <li><a href="index.php">Home</a></li>
            <li><a href="carbohydrates/carbohydrates.php">Carbohydrates</a>
              <ul>
                <li><a href="carbohydrates/bananas.php">Bananas</a></li>
                <li><a href="carbohydrates/beans.php">Beans</a></li>
                <li><a href="carbohydrates/brown_rice.php">Brown Rice</a></li>
                <li><a href="carbohydrates/chickpeas.php">Chickpeas</a></li>
                <li><a href="carbohydrates/lentils.php">Lentils</a></li>
                <li><a href="carbohydrates/parsnips.php">Parsnips</a></li>
                <li><a href="carbohydrates/potatoes.php">Potatoes</a></li>
                <li><a href="carbohydrates/sweetcorn.php">Sweetcorn</a></li>
              </ul>
            </li>
            <li><a href="proteins/protein.php">Proteins</a>
              <ul>
                <li><a href="proteins/beef.php">Beef</a></li>
                <li><a href="proteins/chicken.php">Chicken</a></li>
                <li><a href="proteins/eggs.php">Eggs</a></li>
                <li><a href="proteins/fish.php">Fish</a></li>
              </ul>
            </li>
            <li><a href="fibres/fibres.php">Fibres</a>
              <ul>
                <li><a href="fibres/beans.php">Beans</a></li>
                <li><a href="fibres/lentils.php">Lentils</a></li>
                <li><a href="fibres/pulses.php">Pulses</a></li>
              </ul>
            </li>
            <li><a href="fats/fats.php">Fats</a>
              <ul>
                <li><a href="fats/avocodo.php">Avocodo</a></li>
                <li><a href="fats/mackerel.php">Mackerel</a></li>
                <li><a href="fats/salmon.php">Salmon</a></li>
                <li><a href="fats/tuna.php">Tuna</a></li>
              </ul>
            </li>
            <li><a href="vitamins and minerals/vitamins and minerals.php">Vitamins & Minerals</a>
              <ul>
                <li><a href="vitamins and minerals/chickpeas.php">Chickpeas</a></li>
                <li><a href="vitamins and minerals/sweetpotato.php">Sweet Potato</a></li>
              </ul>
            </li>
            <?php if (isset($_SESSION['user_id'])) {?>
            <li><a href="../user profile/viewprofile.php">Your Profile</a>
              <ul>
                <li><a href="../user profile/calculatebmi.php">Calculate BMI</a></li>
                <li><a href="../user profile/creategoal.php">Create Goal</a></li>
                <li><a href="../user profile/trackgoal.php">Track Goal</a></li>
                <li><a href="../registration & login/change_password.php">Settings</a></li>
                <li><a href="../homepage/user profile/trends.php">Trends</a></li>
                <?php }?>
              </ul>
            </li>
          </nav>
        </header>
        <div id="content">
          <h1>Search Results</h1>
          <p>Below are the results based on what you have searched. If you haven't found what you need, please refine your search.</p>
        </div>
        <?php

        $key = $_GET['recipe']; 

        if (!isset($_SESSION['user_id'])) {
          if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
            $_SESSION['user_id'] = $_COOKIE['user_id'];
            $_SESSION['username'] = $_COOKIE['username'];
          }
        }

        $user_id = $_SESSION['user_id'];

        $dbc = mysqli_connect('localhost', 'root', 'root', 'help_me_be_healthy') or die("Error " . mysqli_error($dbc));
        mysqli_set_charset($dbc, "utf8");

        if (mysqli_connect_errno())
        {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        $query1 = "SELECT `recipe_name`, `category_name`, `ingredient_name` FROM `recipes` WHERE `ingredient_name` LIKE '%$key%' OR  `recipe_name` LIKE '%$key%'";
        $data= mysqli_query($dbc,$query1) or die('Query failed: ' . mysqli_error());

        $query2 = "SELECT `search_term` FROM `search_queries` WHERE `search_term` LIKE '%$key%'";
        $data2= mysqli_query($dbc,$query2) or die('Query failed: ' . mysqli_error());

        if (isset($_SESSION['user_id'])) {

          if (mysqli_num_rows($data2) == 1) {

          $query= "UPDATE search_queries SET user_ids = CONCAT(user_ids,',', $user_id) WHERE search_term LIKE '%$key%'";
          $result= mysqli_query($dbc, $query);

        } else {

          $query3 = "INSERT INTO `search_queries` (`search_id`, `user_ids`, `search_term`) VALUES (NULL, '$user_id', '$key')";
          $data3= mysqli_query($dbc,$query3) or die('Query failed: ' . mysqli_error());

        }
      }
        ?>


        <body>

          <table width="20%" border="1" cellspacing="1" cellpadding="1">
            <tr>

              <tr>
                <td align="center"><strong>Recipe Name</strong></td>
              </tr>

              <?php
              while($row = mysqli_fetch_array($data)){
                ?>
                <tr>
                  <td>
                    <?php 
                    echo $row['recipe_name'];
                    $firstStr = $row['category_name'] ;
                    $secondStr = $row['ingredient_name'];
                    $fullStr = $firstStr."/".$secondStr.".php";
                    ?> 
                  </td>
                  <td align="center"><a href="../homepage/<?php echo $fullStr; ?>">go to recipe</a></td>
                </tr>

                <?php
              }

              ?>

            </table>
          </td>
        </tr>
      </table>
    </div>
  </div>
</div>
<div id="grass"></div>
</body>
</html>