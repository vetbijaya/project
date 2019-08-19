<!DOCTYPE html >
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>MYCIN Information</title>
</head>
<body>

<?php
require_once ('appvars.php');
require_once ('connectvars.php');

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $rating = $_POST['rating'];
    $screenshot = $_FILES['screenshot'] ['name'];
    $screenshot_type = $_FILES['screenshot'] ['type'];
    $screenshot_size = $_FILES['screenshot'] ['size'];

    if (!empty ($name) && !empty($rating) && !empty($screenshot)) {
        if ((($screenshot_type == 'image/gif') || ($screenshot_type == 'image/jpeg') || ($screenshot_type == 'image/pjpeg') || ($screenshot_type == 'image/png'))
        && ($screenshot_size > 0) && ($screenshot_size <= GW_MAXFILESIZE)){
            if ($_FILES['screenshot']['error'] == 0) {
                // Move the file to the target upload folder
                $target = GW_UPLOADPATH . $screenshot;
                if (move_uploaded_file($_FILES['screenshot']['tmp_name'], $target)) {
                    // Connect to the database
                    $dbc = mysqli_connect("localhost", "root", "", "mycindatabase");
                    // Write the data to the database
                    $query = "INSERT INTO mycinrating VALUES (0, NOW(), '$name', '$rating', '$screenshot')";
                    mysqli_query($dbc, $query);

                    // Confirm success with the user
                    echo '<p>Thanks for adding your new rating! </p>';
                    echo '<p><strong>Name:</strong> ' . $name . '<br />';
                    echo '<strong>Rating:</strong> ' . $rating . '<br />';
                    echo '<img src="' . GW_UPLOADPATH . $screenshot . '" alt="Rating image" /></p>';
                    echo '<p><a href="index.php">&lt;&lt; Back to high rating</a></p>';
                    // Clear the score data to clear the form
                    $name = "";
                    $rating = "";
                    $screenshot = "";

                    mysqli_close($dbc);
                } else {
                    echo '<p class="error">Sorry, there was a problem uploading your screen shot image.</p>';
                }
            }
        } else {
            echo '<p class="error">The screen shot must be a GIF, JPEG, or PNG image file no greater than ' . (GW_MAXFILESIZE / 1024) . ' KB in size.</p>';
        }
    }
    // Try to delete the temporary screen shot image file
    @unlink($_FILES['screenshot']['tmp_name']);
}
else {
    echo '<p class="error"> <strong> Please enter all of the information to add your high rating</strong>.</p>';
}
?>
<hr />
<form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF'];
?>">
    <input type="hidden" name="MAX_FILE_SIZE" value="32768" />
    <!--      <input type="hidden" name="MAX_FILE_SIZE" value="--><?php //echo GW_MAXFILESIZE; ?><!--" />-->
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php if (!empty($name)) echo $name; ?>" /><br />
    <label for="rating">Rating:</label>
    <input type="text" id="rating" name="rating" value="<?php if (!empty($rating)) echo $rating; ?>" /><br />
    <label for="screenshot">Screen shot:</label>
    <input type="file" id="screenshot" name="screenshot" />
    <hr />
    <input type="submit" value="Add" name="submit" />
</form>
</body>
</html>
