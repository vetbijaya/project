<!DOCTYPE html >
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Survey on MYCIN</title>
</head>
<body>
<h2>Survey on MYCIN</h2>

<?php
$first_name = $_POST['firstname'];
$last_name = $_POST['lastname'];
$knownbefore = $_POST["knownbefore"];
$occupation = $_POST['occupation'];
$email = $_POST['email'];

$dbc = mysqli_connect('localhost', 'root', '', 'mycindatabase')
or die('Error connecting to MySQL server.');

    $query = "INSERT INTO mycin_survey (first_name, last_name, known_before, occupation, email)".
          "VALUES ('$first_name', '$last_name', '$knownbefore', '$occupation', '$email')";

    $result = mysqli_query($dbc, $query)
    or die('Error querying database.');

    mysqli_close($dbc);

echo 'Thanks for submitting the form.<br />';
echo 'Do you know before? ' . $knownbefore .'<br/>';
echo 'What is your occupation?' .$occupation . '<br/>';
echo 'Your email address is ' . $email ;

?>

</body>
</html>
