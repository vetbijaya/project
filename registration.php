<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Event Registration</title>
</head>
<body>
<img src="images.png" alt="Event Registration" />
<h3>Event Registration</h3>

<?php
if (isset($_POST['submit'])) {
    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $position = $_POST['position'];
    $output_form = 'no';
    if (empty($first_name)) {
        // $first_name is blank
        echo '<p class="error">You forgot to enter your first name.</p>';
        $output_form = 'yes';
    }
    if (empty($last_name)) {
        // $last_name is blank
        echo '<p class="error">You forgot to enter your last name.</p>';
        $output_form = 'yes';
    }
    if (!preg_match('/^[a-zA-Z0-9][a-zA-Z0-9\._\-&!?=#]*@/', $email)) {
        // $email is invalid because LocalName is bad
        echo '<p class="error">Your email address is invalid.</p>';
        $output_form = 'yes';
    }
    else {
        // Strip out everything but the domain from the email
        $domain = preg_replace('/^[a-zA-Z0-9][a-zA-Z0-9\._\-&!?=#]*@/', '', $email);
        // Now check if $domain is registered
        if (!checkdnsrr($domain)) {
            echo '<p class="error">Your email address is invalid.</p>';
            $output_form = 'yes';
        }
    }
    if (!preg_match('/^\(?[2-9]\d{2}\)?[-\s]\d{3}-\d{4}$/', $phone)) {
        // $phone is not valid
        echo '<p class="error">Your phone number is invalid.</p>';
        $output_form = 'yes';
    }
    if (empty($position)) {
        // $position is blank
        echo '<p class="error">You forgot to enter your position.</p>';
        $output_form = 'yes';
    }
}
else {
    $output_form = 'yes';
}

if ($output_form == 'yes') {
    ?>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <p>Register the Event by using below form:</p>
        <table>
            <tr>
                <td><label for="firstname">First Name:</label></td>
                <td><input id="firstname" name="firstname" type="text" value="<?php echo $first_name; ?>"/></td></tr>
            <tr>
                <td><label for="lastname">Last Name:</label></td>
                <td><input id="lastname" name="lastname" type="text" value="<?php echo $last_name; ?>"/></td></tr>
            <tr>
                <td><label for="email">Email:</label></td>
                <td><input id="email" name="email" type="text" value="<?php echo $email; ?>"/></td></tr>
            <tr>
                <td><label for="phone">Phone:</label></td>
                <td><input id="phone" name="phone" type="text" value="<?php echo $phone; ?>"/></td></tr>
            <tr>
                <td><label for="position">Position:</label></td>
                <td><input id="position" name="job" type="text" value="<?php echo $position; ?>"/></td>
            </tr>
        </table>
        <p>
            <input type="submit" name="submit" value="Submit" />
        </p>
    </form>

    <?php
}
else if ($output_form == 'no') {
    echo '<p>' . $first_name . ' ' . $last_name . ', thanks for registering the Event!<br />';
    $pattern = '/[\(\)\-\s]/';
    $replacement = '';
    $new_phone = preg_replace($pattern, $replacement, $phone);
    echo 'Your phone number has been registered as ' . $new_phone . '.</p>';

}
?>

</body>
</html>
