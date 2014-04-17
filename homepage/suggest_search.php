
<?php

$dbc = mysqli_connect('localhost', 'root', 'root', 'help_me_be_healthy') or die("Error " . mysqli_error($dbc));
mysqli_set_charset($dbc, "utf8");

$search = $_GET['keyword']; 


$query ="SELECT * FROM recipes WHERE recipe_name Like '%$search%' OR ingredient_name LIKE '%$search%'";
$data= mysqli_query($dbc,$query) or die('Query failed: ' . mysqli_error());

$result = array();

while ($row = mysqli_fetch_array($data))
{
	$result[] = $row['recipe_name'];
}

echo json_encode($result);

?>





