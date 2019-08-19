<?php
  require_once('authorize.php');
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Mycin-An Early Expert System</title>

</head>
<body>
  <h2>Mycin-An Early Expert System</h2>
  <p>Below is a list of all ratings of MYCIN. Use this page to remove scores as needed.</p>
  <hr />

<?php
  require_once('appvars.php');
  require_once('connectvars.php');

  // Connect to the database 
  $dbc = mysqli_connect('localhost', 'root', '', 'mycindatabase');

  // Retrieve the score data from MySQL
  $query = "SELECT * FROM mycinrating ORDER BY score DESC, date ASC";
  $data = mysqli_query($dbc, $query);

  // Loop through the array of score data, formatting it as HTML 
  echo '<table>';
  echo '<tr><th>Name</th><th>Date</th><th>Score</th><th>Action</th></tr>';
  while ($row = mysqli_fetch_array($data)) { 
    // Display the score data
    echo '<tr class="scorerow"><td><strong>' . $row['name'] . '</strong></td>';
    echo '<td>' . $row['date'] . '</td>';
    echo '<td>' . $row['score'] . '</td>';
    echo '<td><a href="removescore.php?id=' . $row['id'] . '&amp;date=' . $row['date'] .
      '&amp;name=' . $row['name'] . '&amp;score=' . $row['score'] .
      '&amp;screenshot=' . $row['screenshot'] . '">Remove</a>';
    if ($row['approved'] == '0') {
      echo ' / <a href="approvescore.php?id=' . $row['id'] . '&amp;date=' . $row['date'] .
        '&amp;name=' . $row['name'] . '&amp;score=' . $row['score'] . '&amp;screenshot=' .
        $row['screenshot'] . '">Approve</a>';
    }
    echo '</td></tr>';
  }
  echo '</table>';

  mysqli_close($dbc);
?>

</body> 
</html>
