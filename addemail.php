<!DOCTYPE html>
<html>
<head>
   <title>Travel the World Blog - Add Email</title>
   <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<img src="sea.jpeg" id="sea" alt="The sea front" />
   <h1>Travel the World</h1>
   
<?php
// Set the variables for the database access:
  require_once('connectvars.php');
  
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// retrieve data from the POST query into variables
$fName = $_POST['first_name'];
$lName = $_POST['last_name'];
$email = $_POST['email'];
  
// write the query to add the first name, last name and 
// email address into the email_list table
$query = "INSERT into email_list values ('0', '$fName', '$lName', '$email')";

mysqli_query($dbc, $query) or die('Error querying database.');

mysqli_close($dbc);

echo '<br /><center><b>Your email has been added. Travel rocks!</b></center><br />';

?>
</body>
</html>




