 <?php

echo 1;

//       // Display any errors.
 error_reporting(E_ALL &~ E_NOTICE);

//       // Make sure the browser is transmitting in UTF-8
 header('Content-type: text/html; charset=utf-8');


 echo blah;

// if (isset($_POST['search'])) {

//   $dbc = mysqli_connect('localhost', 'root', 'root', 'help_me_be_healthy') or die("Error " . mysqli_error($dbc));
//   mysqli_set_charset($dbc, "utf8");

//           // Grab the user-entered log-in data
//   $keyword = mysqli_real_escape_string($dbc, trim($_POST['keyword']));

//   echo blah;

//   if (!empty($_POST['keyword']){

//     //$query = "SELECT `recipe_name` FROM `recipes` WHERE `ingredient_name` LIKE '%b%' OR  `recipe_name` LIKE '%b%";
//     //$data= mysqli_query($dbc,$query);

//     $query ="SELECT * FROM recipes WHERE category_name Like 'carbohydrates%' AND ingredient_name = 'bananas'";
// $data= mysqli_query($dbc,$query) or die('Query failed: ' . mysqli_error());

 ?>


