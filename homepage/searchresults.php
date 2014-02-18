<html>
<style type="text/css">
table{
 margin: 10px 0;
}
</style>

<head>
 <title>Search Results</title>
</head>

<body>
 <ul>
  <li><a href="index.php">Back to Homepage</a></li>
</ul>


</body>


<?php
 $key = $_GET['search']; 

$dbc = mysqli_connect('localhost', 'root', 'root', 'help_me_be_healthy') or die("Error " . mysqli_error($dbc));
mysqli_set_charset($dbc, "utf8");

if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$query = "SELECT `recipe_name`, `ingredient_name`, `category_name` FROM `recipes` WHERE `ingredient_name` LIKE '%$key%' OR  `recipe_name` LIKE '%$key%'";
$data= mysqli_query($dbc,$query) or die('Query failed: ' . mysqli_error());

?>
<body>

<table width="20%" border="1" cellspacing="1" cellpadding="0">
<tr>

<tr>
<td align="center"><strong>Recipe Name</strong></td>
</tr>

<?php
while($row = mysqli_fetch_array($data)){
?>
<tr>
<td>
<?php 
echo $row['recipe_name'];
$firstStr = $row['category_name'] ;
$secondStr = $row['ingredient_name'];
$fullStr = $firstStr."/".$secondStr.".php";
?> 
</td>
<td align="center"><a href="../homepage/<?php echo $fullStr; ?>">go to recipe</a></td>
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