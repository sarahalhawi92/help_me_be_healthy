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
  <title>Track Goal</title>
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
                <li><a href="trends.php">Trends</a></li>
                <?php }?>
              </ul>
            </li>
          </nav>
        </header>
        <div id="content">
          <p>Let's see how you're getting on</p>

          <?php

    // Make sure the user is logged in before going any further.
          if (!isset($_SESSION['user_id'])) {
            echo '<p class="login">Please <a href="../registration & login/login.php">log in</a> to access this page.</p>';
            exit();
          }

    // Connect to the database
          $dbc = mysqli_connect('localhost', 'root', 'root', 'help_me_be_healthy') or die("Error " . mysqli_error($dbc));
          mysqli_set_charset($dbc, "utf8");

    // Grab the profile data from the database
          if (!isset($_GET['user_id'])) {
            $query = "SELECT goal FROM users_goals WHERE user_id LIKE  '%" . $_SESSION['user_id'] . "%'";
          }
          else {
            $query = "SELECT goal FROM users_goals WHERE user_id LIKE  '%" . $_SESSION['user_id'] . "%'";
          }
          $data = mysqli_query($dbc, $query);

          if (mysqli_num_rows($data) > 0) {
            echo "<h>Your Goals:</h>";
            echo '<table>';
            while($row = mysqli_fetch_array($data))
            {
              echo "<tr>";
              echo "<td>" . $row['goal'] . "</td>";
              echo "</tr>";
            }
            echo "</table>";

          }

          ?>

          <form action="validategoal.php" method="post">

            <input type="hidden" name = "check_submit", value = "1" />

            <p>How are you doing?</p>

            <input type="radio" name="yes[]" value="Yes">  On track  <br>
            <input type="radio" name="no[]" value="No">  Lost track a little  <br>
            <input type="radio" name="not_sure[]" value="Not Sure">  Completely off track  <br><br>


            <tr><td colspan="2"><input type="submit" name="submit" class="btn" value="Submit"></td></tr></table>

          </form>

          <br>
          <br>

          <p> Want to see how you're really doing? Submit the data below and find out! <p>

            <!-- this input is used to create charts and graphs -->

            <!-- weight -->

            <p><b>What is your current weight? (please enter in kilograms)</b></p>

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

              <input type="hidden" name = "submit_graph", value = "1" />

              <input type="text" name="kg" maxlength="4"> 

              <br><br>

              <!-- calories -->

              <p><b>What is your average calorie intake? (e.g. 1000 or 2000)</b></p>

              <input type="text" name="calories" maxlength="4">

              <br><br>

              <!-- from carbs -->

              <p><b>How much (on average) is this intake from carbohydrates? (e.g. 400 or 500)</b></p>

              <input type="text" name="carbs" maxlength="4"> 
              <br><br>

              <p><b>How much (on average) is this intake from proteins? (e.g. 400 or 500)</b></p>

              <input type="text" name="proteins" maxlength="4"> 
              <br><br>

              <p><b>How much (on average) is this intake from fats? (e.g. 400 or 500)</b></p>

              <input type="text" name="fats" maxlength="4"> 
              <br><br>

              <p><b>Do you exercise regularly? (so this will be a minumum of twice a week doing intense exercise e.g. running/swimming/cycling)</b></p>

              <input type="radio" name="exercise[]" value="Yes">  Yes  <br>
              <input type="radio" name="exercise[]" value="No">  No  <br><br>

              <p><b>And finally, what is your gender?</b></p>

              <input type="radio" name="male[]" value="male">  Male  <br>
              <input type="radio" name="female[]" value="female"> Female  <br><br> 

              <input type="submit">

            </form>

          </div>

          <?php
          if (mysqli_num_rows($data) == 0) {
            echo '<p class="creategoal">You have no goals saved. Create a <a href="creategoal.php">goal</a> here.</p>';
          }

          ?>

          <?php

      //       //Check whether the form has been submitted
      //       //DATA FOR CHART (weight and calories)

          if(isset($_POST['submit_graph'])) {

            if (isset($_SESSION['user_id'])) {

              if (isset($_POST['kg']) ) {

                $weight = $_POST['kg'];

                $query_select = "SELECT weight FROM users WHERE user_id = " . $_SESSION['user_id'];
                $data_select = mysqli_query($dbc, $query_select);

                if(mysqli_num_rows($data_select) == 1) {

                  $query2 = "UPDATE `users` SET `weight` = CONCAT(weight,',', $weight) WHERE `user_id` = " . $_SESSION['user_id'];
                  $data2 = mysqli_query($dbc, $query2);

                } else {

                  $query_none = "UPDATE `users` SET `weight` = $weight WHERE `user_id` = " . $_SESSION['user_id'];
                  $data_none = mysqli_query($dbc, $query_none);

                }

                $query3 = "SELECT GROUP_CONCAT(weight) FROM users WHERE user_id = " . $_SESSION['user_id'];
                $data3= mysqli_query($dbc,$query3) or die('Query failed: ' . mysqli_error());

                while($row = mysqli_fetch_array($data3)){

                 $weights = $row['GROUP_CONCAT(weight)'];
               }
             }

             if ( isset($_POST['calories']) ) { 

               $calories = $_POST['calories'];

               $query_select_2 = "SELECT calorie_intake FROM users WHERE user_id = " . $_SESSION['user_id'];
               $data_select_2 = mysqli_query($dbc, $query_select_2);

               if(mysqli_num_rows($data_select_2) == 1) {

                $query4 = "UPDATE users SET calorie_intake = CONCAT(calorie_intake,',', $calories) WHERE `user_id` = " . $_SESSION['user_id'];
                $data4 = mysqli_query($dbc, $query4);

              } else {

                $query_none_2 = "UPDATE `users` SET `calorie_intake` = $calories WHERE `user_id` = " . $_SESSION['user_id'];
                $data_none_2 = mysqli_query($dbc, $query_none_2);

              }

              $query5 = "SELECT GROUP_CONCAT(calorie_intake) FROM users WHERE user_id = " . $_SESSION['user_id'];
              $data5= mysqli_query($dbc,$query5) or die('Query failed: ' . mysqli_error());

              while($row = mysqli_fetch_array($data5)){

                $calorie_intake = $row['GROUP_CONCAT(calorie_intake)'];
              }
            }
          }

        mysqli_close($dbc);

        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
          <title>Line Chart</title>
          <script src="Chart.js"></script>
          <script type="text/javascript">
          function createChart() {
            var data = {
              labels : ["14/06","15/06","17/06","18/06","19/06","20/06","21/6","22/6","23/6"],
              //weight in blue
              datasets_Y1 : [
              {
                fillColor : "rgba(220,220,220,0.5)",
                strokeColor : "rgba(220,220,220,1)",
                pointColor : "rgba(220,220,220,1)",
                pointStrokeColor : "#fff",
                data : [<?php echo $weights; ?>]
              }
              ],
              //calories in light blue
              datasets_Y2 : [ {
                fillColor : "rgba(151,187,205,0.5)",
                strokeColor : "rgba(151,187,205,1)",
                pointColor : "rgba(151,187,205,1)",
                pointStrokeColor : "#fff",
                data : [<?php echo $calorie_intake; ?>]
              } ]

            }

            var barChart = new Chart(document.getElementById("trChart").getContext("2d")).LineDoubleY(data,{Y1_scaleOverride:true,Y2_scaleOverride:true,Y1_scaleStepWidth:5,Y1_scaleStartValue:40, Y2_scaleStepWidth:100,Y2_scaleStartValue:400, scaleFontColor: "#ff0000"});

          }
        </script></head>
        <body onload="createChart();">
          <canvas id="trChart" width="600" height="450"></canvas>
          <p> Weight is shown from the left and calories is shown from the right. </p>
          <?php } ?>

        </body></html>
      </div>
    </div>
  </div>

  <div id="grass"></div>
</body>
</html>