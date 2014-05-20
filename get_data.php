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
<!doctype html>
<html lang="en">
<head>
  <title>Helpmebehealthy</title>
</head>

<body>

<?php


$dbc = mysqli_connect('localhost', 'root', 'root', 'help_me_be_healthy') or die("Error " . mysqli_error($dbc));

mysqli_set_charset($dbc, "utf8");

$query = "SELECT  `user_bmi` FROM  `users` WHERE  `user_id` = 64";

$data = mysqli_query($dbc, $query);

if ( !$query ) {
    echo mysqli_error();
    die;
}

$bmiData = array();

for ($x = 0; $x < mysqli_num_rows($data); $x++) {
    $bmiData[] = mysqli_fetch_array($data);
}

echo json_encode($bmiData);

mysqli_close($dbc);     


?>
      </div>
    </div>
  </div>
  <div id="grass"></div>
</body>
</html>


