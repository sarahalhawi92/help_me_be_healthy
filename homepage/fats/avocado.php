  <html>
  <style type="text/css">
  table{
  	margin: 10px 0;
  }
  </style>

  <head>
  	<title>Fats: Avocado</title>
  </head>

  <body>
  	<h1>What you need to know about avocado</h1>

  	</body

  	</html>

  	<?php
  	$dbc = mysqli_connect('localhost', 'root', 'root', 'help_me_be_healthy') or die("Error " . mysqli_error($dbc));
  	mysqli_set_charset($dbc, "utf8");
// Check connection
  	if (mysqli_connect_errno())
  	{
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	}

  	$query = "SELECT `recipe_name`, `recipe_price`, `recipe_calories`, `recipe_fat`, `recipe_carbs`, `recipe_protein`, `recipe_fibre`, `recipe_source`
  	          FROM `fats` WHERE `ingredient_name`= 'avocados' AND recipe_id = 7";
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
  		echo "<td><a href=\"" . $row['recipe_source'] . "\">Click here to view the recipe</a></td>";
  		echo "</tr>";
  	}
  	echo "</table>";

  	$query = "SELECT `recipe_name`, `recipe_price`, `recipe_calories`,`recipe_fat`, `recipe_cholestrol`, `recipe_carbs`, `recipe_protein`, `recipe_fibre`, `recipe_sodium`, `recipe_source` 
              FROM `fats` WHERE `ingredient_name`= 'avocados' AND recipe_id = 8";
              
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