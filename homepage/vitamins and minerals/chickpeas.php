<html>
<style type="text/css">
body {
	background-color: FFFFCC;
	margin-left: 10%;
	margin-right: 10%;
	border: 5px dotted green;
	padding: 10px 10px 10px 10px;
	font-family: sans-serif;
}

table{
	margin: 10px 0;
}
table{
 margin: 10px 0;
}
</style>

<head>
 <title>Carbohydrates: Chickpeas</title>
</head>

<body>
 <h1>Chickpeas: nutritional information</h1>

  <style type = "text/css">
  body {
    background-color: FFFFCC;
    margin-left: 10%;
    margin-right: 10%;
    border: 5px dotted green;
    padding: 10px 10px 10px 10px;
    font-family: sans-serif;
  }
  ul
  {
    background-color: #efe5d0;
    list-style-type:none;
    margin:0;
    padding: 5px 0px 5px 0px;
  }
  ul li
  {
    display:inline;
    padding: 5px 10px 5px 10px;
  }
  ul li a:link, nav ul li a:visited {
    color: #954b4b;
    border-bottom: none;
    font-weight: bold;
  }
  ul li.selected {
    background-color: #c8b99c;
  }
  </style>
</head>

<body>
  <ul>
    <li><a href="../index.php">HOME</a></li>
    <li><a href="../vitamins%20and%20minerals/sweetpotato.php">SWEET POTATO</a></li>
    <li class="selected"><a href="chickpeas.php">CHICKPEAS</a></li>
  </ul>

</body>
</html>

<?php

session_start();

   if (!isset($_SESSION['user_id'])) {
    if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
      $_SESSION['user_id'] = $_COOKIE['user_id'];
      $_SESSION['username'] = $_COOKIE['username'];
    }
  }

// Connect to server and select database.
$dbc = mysqli_connect('localhost', 'root', 'root', 'help_me_be_healthy') or die("Error " . mysqli_error($dbc));
mysqli_set_charset($dbc, "utf8");

if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$query ="SELECT * FROM recipes WHERE category_name Like 'carbohydrates%' AND ingredient_name = 'chickpeas'";
$data= mysqli_query($dbc,$query) or die('Query failed: ' . mysqli_error());

?>
<body>

<table width="100%" border="1" cellspacing="1" cellpadding="0">
<tr>

<tr>
<td align="center"><strong>Recipe Name</strong></td>
<td align="center"><strong>Recipe Price</strong></td>
<td align="center"><strong>Recipe Calories</strong></td>
<td align="center"><strong>Amount of Fat</strong></td>
<td align="center"><strong>Amount of Cholestrol</strong></td>
<td align="center"><strong>Amount of Carbs</strong></td>
<td align="center"><strong>Amount of Protein</strong></td>
<td align="center"><strong>Amount of Fibre</strong></td>
<td align="center"><strong>Amount of Sodium</strong></td>
<td align="center"><strong>Amount of Potassium</strong></td>
<td align="center"><strong>Recipe Source</strong></td>
<td align="center"><strong>Save recipe?</strong></td>
</tr>

<?php
while($row = mysqli_fetch_array($data)){
?>
<tr>
<td><?php echo $row['recipe_name']; ?></td>
<td><?php echo $row['recipe_price']; ?></td>
<td><?php echo $row['recipe_calories']; ?></td>
<td><?php echo $row['recipe_fat']; ?></td> 
<td><?php echo $row['recipe_cholestrol']; ?></td> 
<td><?php echo $row['recipe_carbs']; ?></td> 
<td><?php echo $row['recipe_protein']; ?></td> 
<td><?php echo $row['recipe_fibre']; ?></td> 
<td><?php echo $row['recipe_sodium']; ?></td> 
<td><?php echo $row['recipe_potassium']; ?></td> 
<td align="center"><a href=<?php echo $row['recipe_source']; ?>>Click here to view the recipe</a></td>
<td align="center"><a href="../user profile/save_recipe.php?id=<?php echo $row['recipe_id']; ?>">save</a></td>
</tr>

<?php
}

?>

</table>
</td>
</tr>
</table>
</body>
</html>