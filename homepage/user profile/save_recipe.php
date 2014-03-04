  <html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Save Recipe</title>
    <style type = "text/css">
    body {
      background-color: FFFFCC;
      margin-left: 10%;
      margin-right: 10%;
      border: 5px dotted green;
      padding: 10px 10px 10px 10px;
      font-family: sans-serif;
    }
    </style>

  </head>
  </html>

<?php

error_reporting(E_ALL &~ E_NOTICE);

session_start();

if (!isset($_SESSION['user_id'])) {
    if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
      $_SESSION['user_id'] = $_COOKIE['user_id'];
      $_SESSION['username'] = $_COOKIE['username'];
  }
}

$user_id = $_SESSION['user_id'];

$dbc = mysqli_connect('localhost', 'root', 'root', 'help_me_be_healthy') or die("Error " . mysqli_error($dbc));
mysqli_set_charset($dbc, "utf8");

if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// get value of id that sent from address bar
$id=$_GET['id'];

$query = "SELECT * FROM recipes WHERE user_ids LIKE '%$user_id%' AND recipe_id = $id";
$data = mysqli_query($dbc, $query);

if (mysqli_num_rows($data) == 0) {

    $query= "UPDATE recipes SET user_ids = CONCAT(user_ids,',', $user_id) WHERE recipe_id = $id";
    $result= mysqli_query($dbc, $query);

}

if ($result)
{
      echo "Successful";
    echo "<BR>";
    echo "<a href='viewprofile.php'>View result</a>";


}

?>



