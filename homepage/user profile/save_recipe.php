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

// Make sure the browser is transmitting in UTF-8
header('Content-type: text/html; charset=utf-8');

// Clear the error message
$error_msg = "";

// Connecting, selecting database
$link = mysql_connect('localhost:8889', 'root', 'root')
or die('Could not connect: ' . mysql_error());

mysql_select_db('help_me_be_healthy') or die('Could not select database');


if(isset($_POST['submit'])){

    echo success;

    $query = "SELECT `recipe_name` from `carbohydrates` left join `users_recipes` ON carbohydrates.recipe_id = users_recipes.recipe_id WHERE `user_id` = '$user_id'";

    $result = mysql_query($query) or die('Query failed: ' . mysql_error());



    if (!isset($_SESSION['recipe_id'])) {

        echo success;

        $query = "SELECT `recipe_id` FROM `carbohydrates` WHERE `recipe_name` = '$recipe_name'";

        $result = mysql_query($query) or die('Query failed: ' . mysql_error());

        echo "<table>\n";
        while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
            echo "\t<tr>\n";
            foreach ($line as $col_value) {
                echo "\t\t<td>$col_value</td>\n";
            }
            echo "\t</tr>\n";
        }
        echo "</table>\n";

    }
    //$recipe_id = $_SESSION['recipe_id']; 

    //echo $recipe_id;

   // $query = "INSERT INTO users_recipes (user_id, recipe_id) VALUES ('$user_id', '$recipe_id')";

   // $data= mysqli_query($dbc,$query) or die("Error " . mysqli_error($data));

   // echo 'Recipe Successfully saved to your profile';

}

?>