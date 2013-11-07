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
  $dbc = mysqli_connect('localhost', 'root', 'root', 'help_me_be_healthy') or die("Error " . mysqli_error($dbc));
  mysqli_set_charset($dbc, "utf8");
// Check connection
  if (mysqli_connect_errno())
  {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  $query = "SELECT `recipe_1_name`, `recipe_1_price`, `recipe_1_calories`, `recipe_1_fat`, `recipe_1_cholestrol`, `recipe_1_carbs`, `recipe_1_protein`, `recipe_1_fibre`, `recipe_1_sodium`, `recipe_1_potassium`, `recipe_1_source`
  FROM `carbohydrates` WHERE `ingredient_name`= 'bananas'";
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
    echo "<td>" . $row['recipe_1_name'] . "</td>";
    echo "<td>" . $row['recipe_1_price'] . "</td>";
    echo "<td>" . $row['recipe_1_calories'] . "</td>";
    echo "<td>" . $row['recipe_1_fat'] . "</td>";
    echo "<td>" . $row['recipe_1_cholestrol'] . "</td>";
    echo "<td>" . $row['recipe_1_carbs'] . "</td>";
    echo "<td>" . $row['recipe_1_protein'] . "</td>";
    echo "<td>" . $row['recipe_1_fibre'] . "</td>";
    echo "<td>" . $row['recipe_1_sodium'] . "</td>";
    echo "<td>" . $row['recipe_1_potassium'] . "</td>";
    echo "<td><a href=\"" . $row['recipe_1_source'] . "\">Click here to view the recipe</a></td>";
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

$query = "SELECT `recipe_2_name`, `recipe_2_price`, `recipe_2_calories`,`recipe_2_fat`, `recipe_2_cholestrol`, `recipe_2_carbs`, `recipe_2_protein`, `recipe_2_fibre`, `recipe_2_sodium`, `recipe_2_source` FROM `carbohydrates` WHERE `ingredient_name`= 'bananas'
";
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
  echo "<td>" . $row['recipe_2_name'] . "</td>";
  echo "<td>" . $row['recipe_2_price'] . "</td>";
  echo "<td>" . $row['recipe_2_calories'] . "</td>";
  echo "<td>" . $row['recipe_2_fat'] . "</td>";
  echo "<td>" . $row['recipe_2_cholestrol'] . "</td>";
  echo "<td>" . $row['recipe_2_carbs'] . "</td>";
  echo "<td>" . $row['recipe_2_protein'] . "</td>";
  echo "<td>" . $row['recipe_2_fibre'] . "</td>";
  echo "<td>" . $row['recipe_2_sodium'] . "</td>";
  echo "<td><a href=\"" . $row['recipe_2_source'] . "\">Click here to view the recipe</a></td>";
  echo "</tr>";
}
echo "</table>";

mysqli_close($con);

?>



  <html>
  <body>

    <form action="../user profile/save_recipe.php" method="post"> 
      <input type="submit" name="submit" value="Save Recipe"> 
    </form>

  </body>   
  </html>



