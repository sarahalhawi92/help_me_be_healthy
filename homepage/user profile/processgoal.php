<?php
//Check whether the form has been submitted
if (array_key_exists('check_submit', $_POST)) {
   //Check whether a $_GET['Languages'] is set
   if ( isset($_POST['goal']) ) { 
     $_POST['goal'] = implode(', ', $_POST['goal']); //Converts an array into a single string
   }

   //Let's now print out the received values in the browser
   echo "Your goal is: {$_POST['goal']}<br />";
   //echo "Your password: {$_POST['Password']}<br />";
   //echo "Your favourite season: {$_POST['Seasons']}<br /><br />";
   //echo "Your comments:<br />{$_POST['Comments']}<br /><br />";
   //echo "You are from: {$_POST['Country']}<br />";
   //echo "Colors you chose: {$_POST['Colors']}<br />";
} else {
    echo "You can't see this page without submitting the form.";
}
?>