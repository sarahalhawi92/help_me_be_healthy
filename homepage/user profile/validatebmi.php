  <html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Validate BMI</title>
    <style type = "text/css">
    body {
      background-color: FFFFCC;
      margin-left: 10%;
      margin-right: 10%;
      border: 5px dotted green;
      padding: 10px 10px 10px 10px;
      font-family: sans-serif;
    }
    </style>

  </head>
<body>
	<?php

	error_reporting(E_ALL &~ E_NOTICE);

    // Start the session
	session_start();

	    // If the session vars aren't set, try to set them with a cookie
	if (!isset($_SESSION['user_id'])) {
		if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
			$_SESSION['user_id'] = $_COOKIE['user_id'];
			$_SESSION['username'] = $_COOKIE['username'];
		}
	}


    // Make sure the browser is transmitting in UTF-8
	header('Content-type: text/html; charset=utf-8');

	    // Clear the error message
	$error_msg = "";

	//if (isset($_SESSION['user_id']))
	//	echo $_SESSION['user_id'];

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

			else if ( $bmi>29.9 && $bmi< 24.9 ) {
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

			$query = "UPDATE `users` SET `user_bmi`= $bmi WHERE `user_id` = " . $_SESSION['user_id'];


			$data = mysqli_query($dbc, $query);
			if (!mysqli_query($dbc,$query)) {
				echo "Failed to store";
			}

		}
	}
	?>

	<html>
	<ul>
		<li><a href="viewprofile.php">Back to Profile</a></li>
	</ul>
	</html>
</body>
</html>
