 <!DOCTYPE HTML>
 <html>

 <head>
  <title>Reset Password</title>
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
            <li><a href="../user profile/viewprofile.php">Your Profile</a>
              <ul>
                <li><a href="../user profile/calculatebmi.php">Calculate BMI</a></li>
                <li><a href="../user profile/creategoal.php">Create Goal</a></li>
                <li><a href="../user profile/trackgoal.php">Track Goal</a></li>
                <li><a href="change_password.php">Settings</a></li>
              </ul>
            </li>
            <?php exit(); }?>
          </nav>
        </header>
        <div id="content">

          <?php 

          error_reporting(0);

          $email=$_POST['email_address'];

          if($_POST['submit']=='Submit')
          {

            $dbc = mysqli_connect('localhost', 'root', 'root', 'help_me_be_healthy') or die("Error " . mysqli_error($dbc));
            mysqli_set_charset($dbc, "utf8");

            $query = "SELECT `user_id` FROM `users` WHERE `email_address`= '" . $_POST['email_address'] . "' ";
            $data= mysqli_query($dbc,$query) or die('Query failed: ' . mysqli_error());

            while($row = mysqli_fetch_array($data)){

              $_SESSION['user_id'] = $row['user_id'];
            }

            if (mysqli_num_rows($data) == 1) {

             $temp_pass = substr (md5(uniqid(rand(),1)), 3, 10);

             $query = "UPDATE `users` SET `password` = sha1('$temp_pass') WHERE `user_id` = '" . $_SESSION['user_id'] . "'";

             mysqli_query($dbc, $query) or die("Error " . mysqli_error($data));

             echo "Your password has successfully been reset. ";
           }

           else
           {
             echo "No user exists with this email address. Please try again.";
           }
         }

         if (mysqli_num_rows($data) == 1){

          $to=$_POST['email_address'];

          $subject="Reset your Password";

          $header="from: helpmebehealthy <helpmebehealthy.info>";

          $message="Your password to log into helpmebehealthy has been temporarily changed to '$temp_pass'. Please log in using this password and your username. ";

          $sentmail = mail($to,$subject,$message,$header);

          echo "Please check your email for instructions on how to login into your account.";

        } else {

         echo "Cannot send  link to your e-mail address";

       }

       mysqli_close($dbc);

       exit();
       ?>

     </div>
   </div>
 </div>
</div>
<div id="grass"></div>
</body>
</html>
