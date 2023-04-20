<!DOCTYPE html>
<html>
<head>
   <title>Travel the World Blog - Send Email to Mailing List</title>
   <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<img src="sea.jpeg" id="sea" alt="The sea front" />
   <h1>Travel the World</h1>
<?php
// Set the variables for the database access:
  require_once('connectvars.php');

  $from = 'TravelTheWorldClub@travel.com';
  $subject = $_POST['subject'];  // subject from form
  $text = $_POST['travelEmail']; // body text from form
  
  // mail function
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  // code the SQL to retrieve all records form email_list table
  $query = "SELECT * FROM email_list";

  $result = mysqli_query($dbc,$query) or die('Error querying database.');

  while($row = mysqli_fetch_array($result)){
    $to = $row['email'];
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $msg = "Dear $first_name $last_name,\n$text";
	// DO NOT SEND EMAIL unless valid emails are used,
// otherwise, the script may hang during execution
// thus, comment out the following mail() function.
 mail($to, $subject, $msg, 'From:' . $from);
	echo '<h2>Email sent to: ' . $to . '</h2><br />';
  }

  mysqli_close($dbc);

  // Display the current date and your name as developer here! 
  $currentDate = date("l F j,Y");
  print ("<br /><p style=\"text-align: center\"><em>Amos Johnson
  &nbsp;&nbsp;Date: $currentDate </em></p>");
?>

</body>
</html>