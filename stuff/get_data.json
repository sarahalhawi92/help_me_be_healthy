<!doctype html>
<html lang="en">
<head>
  <title>Helpmebehealthy</title>
</head>

<body>

<?php

header("Content-Type: application/json");


$dbc = mysqli_connect('localhost', 'root', 'root', 'help_me_be_healthy') or die("Error " . mysqli_error($dbc));

$query = "SELECT  `height`, `weight`, `user_bmi` FROM  `users`";

$data = mysqli_query($dbc, $query);

if (!$query) {
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


