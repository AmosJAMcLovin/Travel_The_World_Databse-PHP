<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
  <title>Create Email List TABLE</title>
    <link type="text/css" rel="stylesheet" href="../style_table.css" />
</head>
<body>
<?php
// Set the variables for the database access:
  require_once('connectvars.php');

$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

$tableName = "email_list";

$query = "CREATE TABLE email_list (
  id INT AUTO_INCREMENT,
  first_name VARCHAR(20),
  last_name VARCHAR(20),
  email VARCHAR(60),
  PRIMARY KEY (id)
)";
 
if (mysqli_query ($dbc, $query)) {
    echo "<h3 class='success'>The query, CREATE TABLE $tableName, was successfully executed!</h3>";
} else {
 	echo "The query, CREATE TABLE $tableName, could not be executed! " . mysqli_error($dbc);
} 
mysqli_close($dbc);
?>
</body>
</html>