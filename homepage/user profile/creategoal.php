<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Create Goal</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>

	<h2>Create your health and fitness goals here today</h2>

	<p>What is your goal? Select from below</p>

	<form action="processgoal.php" method="post">

		<input type="hidden" name = "check_submit", value = "1" />

		<input type="radio" name="goal" value="loseweight">Lose Weight<br>
		<input type="radio" name="goal" value="getfitter">Get Fitter<br>
		<input type="radio" name="goal" value="toneup">Tone Up<br>
		<input type="radio" name="goal" value="eatbetter">Eat More Healthily<br>


	<p>When would you like to achieve this?</p>

		<input type="radio" name="time" value="1mnthorless">One Month or Less<br>
		<input type="radio" name="time" value="twotothreemonths">Two to Three Months<br>
		<input type="radio" name="time" value="threetosixmonths">Three to Six Months<br>
		<input type="radio" name="time" value="sixmonthsormore">Six Months or More<br>


	<p>Do you have an office job?</p>

		<input type="radio" name="office" value="yes">Yes<br>
		<input type="radio" name="office" value="no">No<br>


	<p>Do you go to the gym?</p>

		<input type="radio" name="gym" value="yes">Yes<br>
		<input type="radio" name="gym" value="no">No<br>

	<p>If yes to the question above, how many times a week do you go?</p>

		<input type="radio" name="gymyes" value="onceaweek">Once a Week<br>
		<input type="radio" name="gymyes" value="twiceaweek">Twice a Week<br>
		<input type="radio" name="gymyes" value="twiceaweek">Three to Four Times a Week<br>
		<input type="radio" name="gymyes" value="twiceaweek">More than Four Times a Week<br>


	<p>What foods do you generally eat? Choose from below<p>

			<input type="checkbox" name="food" value="Chicken">chicken<br>
			<input type="checkbox" name="food" value="Beef">beef<br>
			<input type="checkbox" name="food" value="Lamb">lamb<br>
			<input type="checkbox" name="food" value="Fish (Any)">fish<br>
			<input type="checkbox" name="food" value="Cheese">cheese<br>
			<input type="checkbox" name="food" value="Nuts">nuts<br>
			<input type="checkbox" name="food" value="Fruit">fruit<br>
			<input type="checkbox" name="food" value="Vegetable">vegetable<br>
			<input type="checkbox" name="food" value="Bread">bread<br>
			<input type="checkbox" name="food" value="Junk Food">junk food<br> 


			<input type="submit">

		</form>


		</body

		</html>
