<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Untitled Document</title>
</head>
<link rel="stylesheet" href="css.css" type="text/css" />
<body>
	<?php
	error_reporting(E_ALL &~ E_NOTICE);

    // Start the session
	session_start();

	if (isset($_SESSION['username']))
		echo $_SESSION['username'];

    // Make sure the browser is transmitting in UTF-8
	header('Content-type: text/html; charset=utf-8');

    // Clear the error message
	$error_msg = "";

	$dbc = mysqli_connect('localhost', 'root', 'root', 'help_me_be_healthy') or die("Error " . mysqli_error($dbc));
	mysqli_set_charset($dbc, "utf8");

	if(isset($_POST['submit']))
	{
		$bmi=0;
		$kg=$_POST['kg'];
		$mt=$_POST['mt'];

		if(empty($kg) || empty($mt))
		{
			echo "<label class='err'><center>All fields are required</center></label>";
			include("index.php");
		}

		else if(!is_numeric($kg) && !is_numeric($mt) )
		{
			echo "<label class='err'>Please enter valid data.</label>";
			include("index.php");
		}
		else
		{

			$bmi = $kg/($mt*$mt);
			$bmi=round($bmi,2);
			if ( $bmi <= 18.5 ) 
			{
				echo "Your BMI is " .$bmi."  which means you are underweight";

			}

			else if ( $bmi>18.5 && $bmi <= 24.9) {
				echo  "Your BMI is ".$bmi." which means you are normal";
			}

			else if ( $bmi>29.9 && $bmi> 24.9 ) {
				echo "Your BMI is ".$bmi." which means you are overweight";
			}

			else if ( $bmi >29.9 && $bmi<=39.9 ) {
				echo "Your BMI is ".$bmi." which means you are obese";

			}
			else
			{
				echo "You are morbidly obese.";

			} 
			include("index.php");



		}

	}
	?>
</body>
</html>