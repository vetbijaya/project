<!DOCTYPE html >
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>MYCIN Information - Send Email</title>
</head>
<body>
<p><strong>Private:</strong> For Private use ONLY<br />
    Write and send an email to mailing list members.</p>

<?php
if (isset($_POST['submit'])) {
    $from = 'bjayasharma@gmail.com';
    $subject = $_POST['subject'];
    $text = $_POST['mycinmail'];
    $output_form = false;

    if (empty($subject) && empty($text)) {
        echo "You forgot the email subject and body text. <br/>";
        $output_form = true;
    }
    if (empty($subject) && (!empty($text))) {
        echo "You forgot the email subject. <br/>";
        $output_form = true;
    }
    if ((!empty($subject)) && empty($text)) {
        echo "You forgot the email body text. <br/>";
        $output_form = true;
    }
}
else {
    $output_form = true;
}
        if ((!empty($subject)) || (!empty($text))) {

            $dbc = mysqli_connect('localhost', 'root', '', 'mycindatabase')
            or die('Error connecting to MySQL server.');

            $query = "SELECT * FROM email_list";
            $result = mysqli_query($dbc, $query)
            or die("Error querying database.");

            while ($row = mysqli_fetch_array($result)) {
                $to = $row['email'];
                $first_name = $row['first_name'];
                $last_name = $row['last_name'];
                $msg = "Dear $first_name $last_name,\n$text";
                mail($to, $subject, $msg, 'From:' . $from);
                echo 'Email sent to: ' . $to . '<br />';
            }

            mysqli_close($dbc);
        }
        if ($output_form) {
?>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <label for="subject">Subject of email:</label><br />
                <input id="subject" name="subject" type="text" value="<?php echo $subject; ?>" size="30" /><br />
                <label for="mycinmail">Body of email:</label><br />
                <textarea id="mycinmail" name="mycinmail" rows="8" cols="40"><?php echo $text; ?></textarea><br />
                <input type="submit" name="submit" value="Submit" />
            </form>
            <?php
        }
?>
</body>
</html>

