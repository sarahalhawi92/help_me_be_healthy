<?php

session_start();

if (!isset($_SESSION['user_id'])) {
  if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
    $_SESSION['user_id'] = $_COOKIE['user_id'];
    $_SESSION['username'] = $_COOKIE['username'];
  }

}
$user_id = $_SESSION['user_id'];

?> 
<!DOCTYPE HTML>
<html>

<head>
  <title>Trends</title>
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
                <li><a href="trends.php">Trends</a></li>
                <?php }?>
              </ul>
            </li>
          </nav>
        </header>
        <div id="content" style="display: inline-block;">

          <?php

          $dbc = mysqli_connect('localhost', 'root', 'root', 'help_me_be_healthy') or die("Error " . mysqli_error($dbc));
          mysqli_set_charset($dbc, "utf8");

          if (mysqli_connect_errno())
          {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
          }

          $query ="SELECT `search_term`, `date_time_of_search` FROM search_queries WHERE user_ids LIKE '%$user_id%'";

          $data= mysqli_query($dbc,$query) or die('Query failed: ' . mysqli_error());

          //get age of current user

          $query2 ="SELECT `age` FROM `users` WHERE `user_id` LIKE '%$user_id%'";

          $data2= mysqli_query($dbc,$query2) or die('Query failed: ' . mysqli_error());

          while($row = mysqli_fetch_array($data2)){

            $age =  $row['age'];
            $trimmed_age = substr($age, 0, 1);
          }

          //get all users with similar age

          $query3 ="SELECT GROUP_CONCAT(age ORDER BY age),GROUP_CONCAT(user_id) FROM users WHERE age LIKE '$trimmed_age%'"; 

          $data3= mysqli_query($dbc,$query3) or die('Query failed: ' . mysqli_error());

          while($row = mysqli_fetch_array($data3)){

            $ages = $row['GROUP_CONCAT(age ORDER BY age)'];
            $user_ids = $row['GROUP_CONCAT(user_id)'];
          }

          //look up those user ids in search queries table and display results

          $query4 = "SELECT search_term, date_time_of_search FROM search_queries WHERE user_ids IN ( $user_ids )";

          $data4= mysqli_query($dbc,$query4) or die('Query failed: ' . mysqli_error());

          //put the age in the table where search results are displayed

          $query6= "SELECT age FROM users WHERE user_id IN ( $user_ids ) ORDER BY age ASC";

          $data6= mysqli_query($dbc,$query6) or die('Query failed: ' . mysqli_error());

          // do the same as above but for number in household

          $query7 ="SELECT `num_in_household` FROM `users` WHERE `user_id` LIKE '%$user_id%'";

          $data7= mysqli_query($dbc,$query7) or die('Query failed: ' . mysqli_error());

          while($row = mysqli_fetch_array($data7)){

           $num_in_household =  $row['num_in_household'];
         }

        //get all users with similar number in household

         $query8 ="SELECT GROUP_CONCAT(num_in_household ORDER BY num_in_household), GROUP_CONCAT(user_id) FROM users WHERE num_in_household LIKE  '$num_in_household%'";

         $data8= mysqli_query($dbc,$query8) or die('Query failed: ' . mysqli_error());

         while($row = mysqli_fetch_array($data8)){

           $num_in_household = $row['GROUP_CONCAT(num_in_household ORDER BY num_in_household)'];
           $user_ids2 = $row['GROUP_CONCAT(user_id)'];
         }

         //look up those user ids in search queries table and display results

         $query9 = "SELECT search_term, date_time_of_search FROM search_queries WHERE user_ids IN ( $user_ids2 )";

         $data9= mysqli_query($dbc,$query9) or die('Query failed: ' . mysqli_error());

         //put the number in household in the table where search results are displayed

         $query11= "SELECT num_in_household FROM users WHERE user_id IN ( $user_ids2 ) ORDER BY num_in_household ASC";

         $data11= mysqli_query($dbc,$query11) or die('Query failed: ' . mysqli_error());

         ?>

         <!-- html for tables -->

         <?php 

         $check_query = "SELECT `user_ids` FROM search_queries WHERE `user_ids` LIKE '%$user_id%'";
         $data_check = mysqli_query($dbc,$check_query) or die('Query failed: ' . mysqli_error());

         if (mysqli_num_rows($data_check) == 0){ 
          echo "You have not made any search queries. Please make a search to view the content of this page.";
        } else {
          ?>

          <h4>What you have searched for</h4>
          <table width="50%" border="1" cellspacing="2" cellpadding="0">
            <tr>
              <td align="center"><strong>Search Query</strong></td>
              <td align="center"><strong>Date and Time of Search</strong></td>
            </tr>

            <?php
            while($row = mysqli_fetch_array($data)){
              ?>
              <tr>
                <td style="text-align:center"><?php echo $row['search_term']; ?></td>
                <td style="text-align:center"><?php echo $row['date_time_of_search']; ?></td>
              </tr>
              <?php
            }
            ?>
          </table>
          <h4>What others like you have searched for</h4><br>
          <div>
            <h5><b>Based on age</b></h5>
            <?php 

            $check_query2 = "SELECT `age` FROM users WHERE user_id = $user_id";
            $data_check2 = mysqli_query($dbc,$check_query2) or die('Query failed: ' . mysqli_error());

            while($row = mysqli_fetch_array($data_check2)){

              if($row['age'] == 0 ) {

                echo "You have not entered your age during registration.";
                echo '<br>';
                echo '<br>';
                echo '<br>';

              }


              else {
                ?>
                <table width="50%" border="1" cellspacing="2" cellpadding="0">
                  <tr>
                    <td align="center"><strong>Search Query</strong></td>
                    <td align="center"><strong>Date and Time of Search</strong></td>
                    <td align="center"><strong>Age</strong></td>
                  </tr>
                  <?php
                  while(($row = mysqli_fetch_array($data4)) && ($row2 = mysqli_fetch_array($data6))){
                    ?>
                    <tr>
                      <td style="text-align:center"><?php echo $row['search_term']; ?></td>
                      <td style="text-align:center"><?php echo $row['date_time_of_search']; ?></td>
                      <td style="text-align:center"><?php echo $row2['age']; ?></td>
                    </tr>
                    <?php
                  }
                  ?>
                </table>
              </div>
            </table>
            <?php }?>
            <?php }?>
            <h5><b>Based on number in household</b></h5>
            <?php 

            $check_query3 = "SELECT `num_in_household` FROM users WHERE user_id = $user_id";
            $data_check3 = mysqli_query($dbc,$check_query3) or die('Query failed: ' . mysqli_error());

            while($row = mysqli_fetch_array($data_check3)){

              if($row['num_in_household'] == 0 ) {

                echo "You have not entered the number of people in your household during registration.";
                echo '<br>';
                echo '<br>';
                echo '<br>';
              }
              else { ?>
              <table width="70%" border="1" cellspacing="2" cellpadding="0">
                <tr>
                  <tr>
                    <td align="center"><strong>Search Query</strong></td>
                    <td align="center"><strong>Date and Time of Search</strong></td>
                    <td align="center"><strong>Number in Household</strong></td>
                  </tr>
                  <?php
                  while(($row3 = mysqli_fetch_array($data9)) && ($row4 = mysqli_fetch_array($data11))){
                    ?>
                    <tr>
                      <td style="text-align:center"><?php echo $row3['search_term']; ?></td>
                      <td style="text-align:center"><?php echo $row3['date_time_of_search']; ?></td>
                      <td style="text-align:center"><?php echo $row4['num_in_household']; ?></td>
                    </tr>
                    <?php
                  }
                  ?>
                  <?php }?>
                  <?php }?>
                  <?php }?>
                </table>
              </div>
            </div>
          </div>
          <div id="grass"></div>
        </body>
        </html>