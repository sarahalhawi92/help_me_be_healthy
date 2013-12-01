<html>
<style type="text/css">
table{
 margin: 10px 0;
}
</style>

<head>
 <title>Carbohydrates: Potatoes</title>
</head>

<body>
 <h1>Everything you need to know about potatoes</h1>

 <html>
 <ul>
  <li><a href="../index.php">Back to Homepage</a></li>
</ul>
</html>

</body>

</html>

<?php

$dbc = mysqli_connect('localhost', 'root', 'root', 'help_me_be_healthy') or die("Error " . mysqli_error($dbc));
mysqli_set_charset($dbc, "utf8");
// Check connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$query = "SELECT `recipe_name`, `recipe_price`, `recipe_calories`, `recipe_fat`, `recipe_carbs`, `recipe_protein`, `recipe_fibre`, `recipe_sodium`, `recipe_source`
FROM `carbohydrates` WHERE `ingredient_name`= 'sweetcorn' AND recipe_id = 15";
$data= mysqli_query($dbc,$query) or die('Query failed: ' . mysql_error());

echo "<table border='1' width='100%'>
<tr>
<th>Recipe Name</th>
<th>Recipe Price</th>
<th>Recipe Calories</th>
<th>Amount of Fat</th>
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
  echo "<td>" . $row['recipe_carbs'] . "</td>";
  echo "<td>" . $row['recipe_protein'] . "</td>";
  echo "<td>" . $row['recipe_fibre'] . "</td>";
  echo "<td>" . $row['recipe_sodium'] . "</td>";
  echo "<td><a href=\"" . $row['recipe_source'] . "\">Click here to view the recipe</a></td>";
  echo "</tr>";
}
echo "</table>";

mysqli_close($con);

?>

<html>
<body>

  <form action="../user profile/save_recipe.php" method="post">
   <input type="submit" name="submit" class="btn" value="Save Recipe"></td>
 </form> 

</body>   
</html>



<?php

$dbc = mysqli_connect('localhost', 'root', 'root', 'help_me_be_healthy') or die("Error " . mysqli_error($dbc));
mysqli_set_charset($dbc, "utf8");
// Check connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$query = "SELECT `recipe_name`, `recipe_price`, `recipe_calories`,`recipe_fat`, `recipe_cholestrol`, `recipe_carbs`, `recipe_protein`, `recipe_fibre`, `recipe_sodium`, `recipe_source` 
FROM `carbohydrates` WHERE `ingredient_name`= 'sweetcorn' AND recipe_id = 16";
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

mysqli_close($con);

?>

<html>
<body>

  <form action="../user profile/save_recipe.php" method="post">
   <input type="submit" name="submit" class="btn" value="Save Recipe"></td>
 </form> 

</body>   
</html>




