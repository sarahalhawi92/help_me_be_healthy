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

$dbc = mysqli_connect('localhost', 'root', 'root', 'help_me_be_healthy') or die("Error " . mysqli_error($dbc));
mysqli_set_charset($dbc, "utf8");

echo popopopop;

if (!isset($_SESSION['recipe_id'])) {
    if(isset($_POST['submit'])){

        echo success;

        $query = "SELECT `recipe_id` FROM `carbohydrates` WHERE `recipe_name` = \"banana bread\"";

        $data= mysqli_query($dbc,$query) or die('Query failed: ' . mysql_error());

        if (mysqli_num_rows($data) == 1) {

            echo succcccess;

            $row = mysqli_fetch_assoc($data);
            $_SESSION['recipe_id'] = $row['recipe_id'];
             setcookie('recipe_id', $row['recipe_id'], time() + (60 * 60 * 24 * 30));    // expires in 30 days

         }

         echo $_SESSION['recipe_id'];

     }
 }

                  if (isset($_SESSION['recipe_id'])) {
    // Delete the session vars by clearing the $_SESSION array
            $_SESSION = array();

    // Delete the session cookie by setting its expiration to an hour ago (3600)
            if (isset($_COOKIE[session_name()])) {
              setcookie(session_name(), '', time() - 3600);
          }

    // Destroy the session
          session_destroy();
      }

  // Delete the user ID and username cookies by setting their expirations to an hour ago (3600)
      setcookie('recipe_id', '', time() - 3600);

         ?>













