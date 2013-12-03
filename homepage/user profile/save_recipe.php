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
$dbc = mysqli_connect('localhost', 'root', 'root', 'help_me_be_healthy') or die("Error " . mysqli_error($dbc));
mysqli_set_charset($dbc, "utf8");


if(isset($_POST['submit'])){

    $query = "SELECT `recipe_name` from `carbohydrates` left join `users_recipes` ON carbohydrates.recipe_id = users_recipes.recipe_id WHERE `user_id` = '$user_id'";


    $data= mysqli_query($dbc,$query);


    if (!isset($_SESSION['recipe_id'])) {

        $query = "SELECT `recipe_id` FROM `carbohydrates` WHERE `recipe_name` = '$data'";

        $_SESSION['recipe_id'] = $row['recipe_id'];
        setcookie('recipe_id', $row['recipe_id'], time() + (60 * 1));

    }

    $recipe_id = $_SESSION['recipe_id']; 

    $query = "INSERT INTO users_recipes (user_id, recipe_id) VALUES ('$user_id', '$recipe_id')";

    $data= mysqli_query($dbc,$query) or die("Error " . mysqli_error($data));

    echo 'Recipe Successfully saved to your profile';

}

?>