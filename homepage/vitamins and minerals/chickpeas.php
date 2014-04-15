<!DOCTYPE HTML>
<html>

<head>
  <title>Chickpeas</title>
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
            <li><a href="../carbohydrates.html">Carbohydrates</a>
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
                <li><a href="../fats/avocado.php">Avocodo</a></li>
                <li><a href="../fats/mackerel.php">Mackerel</a></li>
                <li><a href="../fats/salmon.php">Salmon</a></li>
                <li><a href="../fatstuna.php">Tuna</a></li>
              </ul>
            </li>
            <li><a href="vitamins and minerals.html">Vitamins & Minerals</a>
              <ul>
                <li><a href="chickpeas.php">Chickpeas</a></li>
                <li><a href="sweetpotato.php">Sweet Potato</a></li>
              </ul>
            </li>
          </nav>
        </header>
        <div id="content">
          <h1>Information</h1>
          <p>Some text</p>
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

        $query ="SELECT * FROM recipes WHERE category_name Like 'carbohydrates%' AND ingredient_name = 'chickpeas'";
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
                  <td align="center"><a href=<?php echo $row['recipe_source']; ?>>Click here to view the recipe</a></td>
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