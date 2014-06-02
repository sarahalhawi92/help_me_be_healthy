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
  <title>Potatoes</title>
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

    <script type="text/javascript">
  $(document).ready(function(){
    $(".select").click(function(){
      if (!confirm("Are you sure you want to go to this recipe? Doing so will take you to an external page.")){
        return false;
      }
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
            <li><a href="carbohydrates.php">Carbohydrates</a>
              <ul>
                <li><a href="bananas.php">Bananas</a></li>
                <li><a href="beans.php">Beans</a></li>
                <li><a href="brown_rice.php">Brown Rice</a></li>
                <li><a href="chickpeas.php">Chickpeas</a></li>
                <li><a href="lentils.php">Lentils</a></li>
                <li><a href="parsnips.php">Parsnips</a></li>
                <li><a href="potatoes.php">Potatoes</a></li>
                <li><a href="sweetcorn.php">Sweetcorn</a></li>
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
            <li><a href="../user profile/viewprofile.php">Your Profile</a>
              <ul>
                <li><a href="../user profile/calculatebmi.php">Calculate BMI</a></li>
                <li><a href="../user profile/creategoal.php">Create Goal</a></li>
                <li><a href="../user profile/trackgoal.php">Track Goal</a></li>
                <li><a href="../registration & login/change_password.php">Settings</a></li>
                <li><a href="../user profile/trends.php">Trends</a></li>
                <?php }?>
              </ul>
            </li>
          </nav>
        </header>
        <div id="content">
          <h1>Information</h1>
        </div>

        <?php

        session_start();

        if (!isset($_SESSION['user_id'])) {
          if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
            $_SESSION['user_id'] = $_COOKIE['user_id'];
            $_SESSION['username'] = $_COOKIE['username'];
          }
        }

// Connect to server and select database.
        $dbc = mysqli_connect('localhost', 'root', 'root', 'help_me_be_healthy') or die("Error " . mysqli_error($dbc));
        mysqli_set_charset($dbc, "utf8");

        if (mysqli_connect_errno())
        {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        $query ="SELECT * FROM recipes WHERE category_name Like 'carbohydrates%' AND ingredient_name = 'potatoes'";
        $data= mysqli_query($dbc,$query) or die('Query failed: ' . mysqli_error());

        ?>
        <body>

          <table width="100%" border="1" cellspacing="1" cellpadding="0">
            <tr>

              <tr>
                <td align="center"><strong>Recipe Name</strong></td>
                <td align="center"><strong>Recipe Price</strong></td>
                <td align="center"><strong>Recipe Calories</strong></td>
                <td align="center"><strong>Amount of Fat</strong></td>
                <td align="center"><strong>Amount of Cholestrol</strong></td>
                <td align="center"><strong>Amount of Carbs</strong></td>
                <td align="center"><strong>Amount of Protein</strong></td>
                <td align="center"><strong>Amount of Fibre</strong></td>
                <td align="center"><strong>Amount of Sodium</strong></td>
                <td align="center"><strong>Amount of Potassium</strong></td>
                <td align="center"><strong>Recipe Source</strong></td>
                <td align="center"><strong>Save recipe?</strong></td>
              </tr>

              <?php
              while($row = mysqli_fetch_array($data)){
                ?>
                <tr>
                  <td><?php echo $row['recipe_name']; ?></td>
                  <td><?php echo $row['recipe_price']; ?></td>
                  <td><?php echo $row['recipe_calories']; ?></td>
                  <td><?php echo $row['recipe_fat']; ?></td> 
                  <td><?php echo $row['recipe_cholestrol']; ?></td> 
                  <td><?php echo $row['recipe_carbs']; ?></td> 
                  <td><?php echo $row['recipe_protein']; ?></td> 
                  <td><?php echo $row['recipe_fibre']; ?></td> 
                  <td><?php echo $row['recipe_sodium']; ?></td> 
                  <td><?php echo $row['recipe_potassium']; ?></td> 
                  <td align="center"><a href=<?php echo $row['recipe_source']; ?> class="select">Click here to view the recipe</a></td>
                  <td align="center"><a href="../user profile/save_recipe.php?id=<?php echo $row['recipe_id']; ?>">save</a></td>
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
