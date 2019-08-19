<?php
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';


//Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';

// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;



//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "ibahhc@gmail.com";
//Password to use for SMTP authentication
$mail->Password = "b9CZVPc@4N&47TWufUahZ2!jpTe!gm2Q";




//Set who the message is to be sent from
$mail->setFrom('bsharma1@eagles.nccu.edu', 'Bijaya Sharma');

//Set an alternative reply-to address
$mail->addReplyTo('vetbijaya@gmail.com', 'Bijaya Sharma');
//Set who the message is to be sent to
$mail->addAddress('keshavpanthi@gmail.com', 'Keshav Panthi');
//Set the subject line
$mail->Subject = 'PHPMailer Test email';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
$mail->Body = 'This is Body of email ';
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
    //Section 2: IMAP
    //Uncomment these to save your message in the 'Sent Mail' folder.
    #if (save_mail($mail)) {
    #    echo "Message saved!";
    #}
}