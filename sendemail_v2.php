<!DOCTYPE html>
<html>
<head>
   <title>Travel the World Blog - Send Email to Mailing List</title>
   <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<img src="sea.jpeg" id="sea" alt="The sea front" />
   <h1>Travel the World Blog - Send Email</h1>
   <p><strong>Private: </strong>For lovers of travel only!<br />
   Write and send an email to mailing list members.</p>
<?php
// Set the variables for the database access:
    require_once('connectvars.php');

    if (isset($_POST['submit'])) { // if true, we came from the form
        $from = 'TravelTheWorldClub@travel.com';
        $subject = $_POST['subject'];
        $text = $_POST['travelEmail'];
        $output_form = false;
        if (empty($subject) && empty($text)) { // both $subject & $text are blank
        echo 'You forgot the email subject and body text.<br />';
        $output_form = true;
        }
        if (empty($subject) && (!empty($text))) { // $subject left empty
        echo 'You forgot the email subject.<br />';
        $output_form = true;
        }
        if ((!empty($subject)) && empty($text)) { // $text left empty
        echo 'You forgot the email body text.<br />';
        $output_form = true;
        }
        } else { // before displaying the form,
        $output_form = true; // set the $subject and $text variables to EMPTY
        $subject = '';
        $text = '';
        }
        if ((!empty($subject)) && (!empty($text))) {
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
           
            $query = "SELECT * FROM email_list";
            $result = mysqli_query($dbc, $query) or die('Error querying database.');
            while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
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
            }
            if ($output_form) { // $output_form = true
                ?>
                 <form method="post"
                 action="<?php echo $_SERVER['PHP_SELF']; ?>">
                 <label for="subject">Subject of email:</label><br />
                 <input id="subject" name="subject" type="text"
                 value="<?php echo $subject; ?>" size="30" /><br />
                 <label for="travelEmail">Body of email:</label><br />
                 <textarea id="travelEmail" name="travelEmail" rows="8" cols="40">
                 <?php echo $text; ?></textarea><br />
                 <input type="submit" name="submit" value="Submit" />
                 </form>
                <?php
                 }
                ?>
</body>
</html>