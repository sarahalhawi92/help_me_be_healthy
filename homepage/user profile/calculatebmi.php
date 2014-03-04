  <html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Calculate BMI</title>
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
<link rel="stylesheet" href="css.css" type="text/css" />

<body>
<fieldset style="width:20%">
<legend style="color:#0000FF; letter-spacing:3px; font-weight:bold">BMI check</legend>
<table cellpadding="1" cellspacing="1">
<tr>
	<form action="validatebmi.php" method="post">
		<td>Kilogram</td><td><input type="text" name="kg" placeholder="  In killogram" maxlength="4"/></td>
</tr>
	<td>Height</td><td><input type="text" name="mt" placeholder="  In mtr" maxlength="4"/></td>
	</tr>
	<tr><td colspan="2"><input type="submit" name="submit" class="btn" value="Submit"></td></tr></table>
</form>
</fieldset>
</body>
</html>
