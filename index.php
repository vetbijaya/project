<!DOCTYPE html >
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>MYCIN Information</title>
</head>
<body>
<h2>MYCIN - Add Rating</h2>
<p> Welcome, researchers, do you want to give rating and made in high rating list? If so, just <a href="addscore.php"> add your own rating</a>. </p>
<hr/>

<?php
require_once ('appvars.php');
require_once ('connectvars.php');
// Connect to the database
$dbc = mysqli_connect("localhost", "root", "", "mycindatabase");
// Retrieve the score data from MySQL
$query = "SELECT * FROM mycinrating ORDER BY score DESC, date ASC";
//$query = "SELECT * FROM mycinrating";
$data = mysqli_query($dbc, $query);

// Loop through the array of rating data, formatting it as HTML
echo '<table>';
$i = 0;
while ($row = mysqli_fetch_array($data)) {
    // Display the score data
    if ($i == 0) {
        echo '<tr><td colspan="2" class="topratingheader">Top Rating: ' . $row['rating'] . '</td></tr>';
    }
    echo '<tr><td class="ratinginfo">';
    echo '<span class="rating">' . $row['rating'] . '</span><br />';
    echo '<strong>Name:</strong> ' . $row['name'] . '<br />';
    echo '<strong>Date:</strong> ' . $row['date'] . '</td>';
    if (is_file(GW_UPLOADPATH . $row['screenshot']) && filesize(GW_UPLOADPATH . $row['screenshot']) > 0) {
        echo '<td><img src="' . GW_UPLOADPATH . $row['screenshot'] . '" alt="Rating image" /></td></tr>';
    }
    else {
        echo '<td><img src="' . GW_UPLOADPATH . 'unverified.gif' . '" alt="Unverified rating" /></td></tr>';
    }
    $i++;
}
echo '</table>';

mysqli_close($dbc);
?>

</body>
</html>
