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

$user_id = $_SESSION['user_id']; 

echo $user_id;

$recipe_name = $_SESSION['recipe_name'];
$recipe_name_2 = $_SESSION['recipe_name_2'];

//echo $recipe_name;
//echo $recipe_name_2;

// Make sure the browser is transmitting in UTF-8
header('Content-type: text/html; charset=utf-8');

// Clear the error message
$error_msg = "";

$dbc = mysqli_connect('localhost', 'root', 'root', 'help_me_be_healthy') or die("Error " . mysqli_error($dbc));
mysqli_set_charset($dbc, "utf8");


if(isset($_POST['submit_1'])){

    $query = "SELECT `recipe_id` FROM `carbohydrates` WHERE `recipe_name` = '$recipe_name'";

    $data= mysqli_query($dbc,$query) or die('Query failed: ' . mysqli_error());

    while ($row = mysqli_fetch_assoc($data)) { 

        //$recipe_name = $row['recipe_name'];
        //setcookie('recipe_name', $row['recipe_name'], time() + (60 * 60 * 24 * 30)); 

        $_SESSION['recipe_id'] = $row['recipe_id'];
        setcookie('recipe_id', $row['recipe_id'], time() + (60 * 60 * 24 * 1)); 

    }
    //echo $recipe_name;
    //echo $_SESSION['recipe_id'];;
    $recipe_id = $_SESSION['recipe_id'];
}

if(isset($_POST['submit_2'])){

    $query = "SELECT `recipe_id` FROM `carbohydrates` WHERE `recipe_name` = '$recipe_name_2'";

    $data= mysqli_query($dbc,$query) or die('Query failed: ' . mysqli_error());

    while ($row = mysqli_fetch_assoc($data)) { 

        //$recipe_name = $row['recipe_name'];
        //setcookie('recipe_name', $row['recipe_name'], time() + (60 * 60 * 24 * 30)); 

        $_SESSION['recipe_id'] = $row['recipe_id'];
        setcookie('recipe_id', $row['recipe_id'], time() + (60 * 60 * 24 * 1)); 

    }
    //echo $recipe_name;
    //echo $_SESSION['recipe_id'];;
    $recipe_id = $_SESSION['recipe_id'];
}

$query = "INSERT INTO `users_recipes` (`users_recipes_id`, `user_id`, `recipe_id`) VALUES (NULL, '$user_id', '$recipe_id')";

$data = mysqli_query($dbc, $query); 

if (mysqli_num_rows($data) == 0) {

    $query = "SELECT recipe_name from carbohydrates left join users_recipes ON carbohydrates.recipe_id = users_recipes.recipe_id WHERE `user_id` = '" . $_SESSION['user_id'] . "' LIMIT 0, 30";
    

$data= mysqli_query($dbc,$query) or die('Query failed: ' . mysql_error());

echo "<table border='1' width='50%'>
<tr>
<th>Recipes Saved: </th>
</tr>";

while($row = mysqli_fetch_array($data))
{
  echo "<tr>";
  echo "<td>" . $row['recipe_name'] . "</td>";
  $recipes_saved = array();
  $recipes_saved = $row['recipe_name'];
  echo $recipes_saved;
  $query = "UPDATE users SET recipes_saved =  ('$recipes_saved') WHERE `user_id` = '" . $_SESSION['user_id'] . "'";
  echo "</tr>";
}
echo "</table>";



echo 'Recipe Successfully saved to your profile';

}


//unset($_SESSION['recipe_id']);
//unset($_SESSION['recipe_name']);

/*if(isset($_SESSION['recipe_id'])){ 

    $_SESSION = array();
    unset($_SESSION['recipe_id']);

   } 

   setcookie('recipe_id', '', time() - 3600);

/*if(isset($_SESSION['recipe_name'])){ 

    $_SESSION = array();
    session_destroy(); 

   } 
  setcookie('recipe_name', '', time() - 3600);
*/
  var_dump();

  print_r();

  ?>
