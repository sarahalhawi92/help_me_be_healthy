  <html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Progress on Goal</title>
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

<?php

error_reporting(E_ALL &~ E_NOTICE);

session_start();

$dbc = mysqli_connect('localhost', 'root', 'root', 'help_me_be_healthy') or die("Error " . mysqli_error($dbc));
mysqli_set_charset($dbc, "utf8");

if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

//Check whether the form has been submitted
if(isset($_POST['submit'])) {

 if ( isset($_POST['yes']) ) { 

     $_POST['yes'] = implode(', ', $_POST['yes']); //Converts an array into a single string

     $yes = $_POST['yes'];

     echo 'Nice Work!';

   }

   if ( isset($_POST['no']) ) { 

     $_POST['no'] = implode(', ', $_POST['no']); 

     $no = $_POST['no'];

     echo 'Keep Trying:)';

   }

   if ( isset($_POST['not_sure']) ) {

     $_POST['not_sure'] = implode(', ', $_POST['not_sure']); 

     $not_sure = $_POST['not_sure'];

     echo 'Keep going!';

   }

 }

 ?>

    <html>
    <ul>
      <li><a href="../index.php">Back to Homepage</a></li>
      <li><a href="viewprofile.php">Back to Profile</a></li>
    </ul>
    </html>
  </body> 
  </html>


