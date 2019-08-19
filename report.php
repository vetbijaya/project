<?php
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';
?>

<!DOCTYPE html >
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Survey on MYCIN</title>
</head>
<body>
<h2>Survey on MYCIN</h2>

<?php
    $name = $_POST['firstname'] . ' ' . $_POST['lastname'];
    $email = $_POST['email'];
    $occupation = $_POST['occupation'];
    $knownbefore = $_POST["knownbefore"];

    $to = $email;
    $subject = 'Inquiry about MYCIN';
    $msg = "$name was inquired $knownbefore. \n" .
            "occupation: $occupation\n" .
            "Known before: $knownbefore";

//mail($to, $subject, $msg, 'From:' . $email);

     $message = '';
     $message .='Thanks for submitting the form.<br/>';
     $message .='Do you know before? ' . $knownbefore .'<br/>';
     $message .='What is your occupation?' .$occupation . '<br/>';
     $message .='Your email address is ' . $email ;

echo $message;

?>

<?php

//Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

$mail->SMTPDebug = 0;

//Set the hostname of the mail serveran
$mail->Host = 'smtp.gmail.com';

$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

$mail->Username = "bjayasharma@gmail.com";
//Password to use for SMTP authentication
$mail->Password = "JanuaryFebruary567";

//Set an alternative reply-to address
$mail->addReplyTo('bsharma1@eagles.nccu.edu', 'Bijaya Sharma');
//Set who the message is to be sent to
$mail->addAddress('bsharma1@eagles.nccu.edu', 'Bijaya Sharma');

//Set who the message is to be sent from
$mail->setFrom($to, $name);

//Set an alternative reply-to address
//$mail->addReplyTo($to, $name);
//Set who the message is to be sent to
$mail->addAddress($to, $name);
//Set the subject line
$mail->Subject = $subject;

$mail->Body = $message;
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';

if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
?>
</body>
</html>


