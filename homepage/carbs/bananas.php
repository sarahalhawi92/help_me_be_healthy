<html>
<style type="text/css">
table{
 margin: 10px 0;
}
</style>

<head>
 <title>Carbohydrates: Bananas</title>
</head>

<body>
 <h1>Everything you need to know about bananas</h1>

 <html>
 <ul>
  <li><a href="../index.php">Back to Homepage</a></li>
</ul>
</html>

</body>

</html>

<?php

session_start();

$dbc = mysqli_connect('localhost', 'root', 'root', 'help_me_be_healthy') or die("Error " . mysqli_error($dbc));
mysqli_set_charset($dbc, "utf8");
// Check connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$query = "SELECT `recipe_name`, `recipe_price`, `recipe_calories`, `recipe_fat`, `recipe_cholestrol`, `recipe_carbs`, `recipe_protein`, `recipe_fibre`, `recipe_sodium`, `recipe_potassium`, `recipe_source`
FROM `carbohydrates` WHERE `ingredient_name`= 'bananas' AND recipe_id = 1";
$data= mysqli_query($dbc,$query) or die('Query failed: ' . mysql_error());

echo "<table border='1' width='100%'>
<tr>
<th>Recipe Name</th>
<th>Recipe Price</th>
<th>Recipe Calories</th>
<th>Amount of Fat</th>
<th>Amount of Cholestrol</th>
<th>Amount of Carbs</th>
<th>Amount of Protein</th>
<th>Amount of Fibre</th>
<th>Amount of Sodium</th>
<th>Amount of Potassium</th>
<th>Recipe Source</th>
</tr>";

while($row = mysqli_fetch_array($data))
{
  echo "<tr>";
  echo "<td>" . $row['recipe_name'] . "</td>";
  echo "<td>" . $row['recipe_price'] . "</td>";
  echo "<td>" . $row['recipe_calories'] . "</td>";
  echo "<td>" . $row['recipe_fat'] . "</td>";
  echo "<td>" . $row['recipe_cholestrol'] . "</td>";
  echo "<td>" . $row['recipe_carbs'] . "</td>";
  echo "<td>" . $row['recipe_protein'] . "</td>";
  echo "<td>" . $row['recipe_fibre'] . "</td>";
  echo "<td>" . $row['recipe_sodium'] . "</td>";
  echo "<td>" . $row['recipe_potassium'] . "</td>";
  echo "<td><a href=\"" . $row['recipe_source'] . "\">Click here to view the recipe</a></td>";
  echo "</tr>";
}
echo "</table>";

$query = "SELECT `recipe_name` FROM `carbohydrates` WHERE `ingredient_name`= 'bananas' AND recipe_id = 1";
$data= mysqli_query($dbc,$query) or die('Query failed: ' . mysql_error());

while($row = mysqli_fetch_array($data))
{
  echo "<td>" . $row['recipe_name'] . "</td>";
  $recipe_name = $row['recipe_name'];
}

echo $recipe_name;

$_SESSION['recipe_name'] = $recipe_name;
setcookie('recipe_id', $row['recipe_id'], time() + (60 * 60 * 24 * 30));    // expires in 30 days

mysqli_close($con);

?>


<html>
<body>

  <form action="../user profile/save_recipe.php" method="post">
   <input type="submit" name="submit_1" class="btn" value="Save Recipe"></td>
 </form> 

</body>   
</html>



<?php

session_start();

$dbc = mysqli_connect('localhost', 'root', 'root', 'help_me_be_healthy') or die("Error " . mysqli_error($dbc));
mysqli_set_charset($dbc, "utf8");
// Check connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$query = "SELECT `recipe_name`, `recipe_price`, `recipe_calories`,`recipe_fat`, `recipe_cholestrol`, `recipe_carbs`, `recipe_protein`, `recipe_fibre`, `recipe_sodium`, `recipe_source` 
FROM `carbohydrates` WHERE `ingredient_name`= 'bananas' AND recipe_id = 2";
$data= mysqli_query($dbc,$query) or die('Query failed: ' . mysql_error());

echo "<table border='1' width='100%'>
<tr>
<th>Recipe Name</th>
<th>Recipe Price</th>
<th>Recipe Calories</th>
<th>Amount of Fat</th>
<th>Amount of Cholestrol</th>
<th>Amount of Carbs</th>
<th>Amount of Protein</th>
<th>Amount of Fibre</th>
<th>Amount of Sodium</th>
<th>Recipe Source</th>
</tr>";

while($row = mysqli_fetch_array($data))
{
  echo "<tr>";
  echo "<td>" . $row['recipe_name'] . "</td>";
  echo "<td>" . $row['recipe_price'] . "</td>";
  echo "<td>" . $row['recipe_calories'] . "</td>";
  echo "<td>" . $row['recipe_fat'] . "</td>";
  echo "<td>" . $row['recipe_cholestrol'] . "</td>";
  echo "<td>" . $row['recipe_carbs'] . "</td>";
  echo "<td>" . $row['recipe_protein'] . "</td>";
  echo "<td>" . $row['recipe_fibre'] . "</td>";
  echo "<td>" . $row['recipe_sodium'] . "</td>";
  echo "<td><a href=\"" . $row['recipe_source'] . "\">Click here to view the recipe</a></td>";
  echo "</tr>";
}
echo "</table>";

$query = "SELECT `recipe_name` FROM `carbohydrates` WHERE `ingredient_name`= 'bananas' AND recipe_id = 2";
$data= mysqli_query($dbc,$query) or die('Query failed: ' . mysql_error());

while($row = mysqli_fetch_array($data))
{
  echo "<td>" . $row['recipe_name'] . "</td>";
  $recipe_name_2 = $row['recipe_name'];
}

echo $recipe_name_2;

$_SESSION['recipe_name_2'] = $recipe_name_2;

mysqli_close($con);

?>

<html>
<body>

  <form action="../user profile/save_recipe.php" method="post">
   <input type="submit" name="submit_2" class="btn" value="Save Recipe"></td>
 </form> 

</body>   
</html>






