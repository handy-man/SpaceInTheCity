<?PHP
//Create a new PHPMailer instance
$mail = new PHPMailer();
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;
//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
//Set the hostname of the mail server
$mail->Host = "mail.example.com";
//Set the SMTP port number - likely to be 25, 465 or 587
$mail->Port = 25;
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication
$mail->Username = "username";
//Password to use for SMTP authentication
$mail->Password = "password";
//Set who the message is to be sent from
$mail->setFrom('support@abercog.co.uk', 'Aberystwyth Community Of Gamers');
//Set an alternative reply-to address
$mail->addReplyTo('support@abercog.co.uk', 'Aberystwyth Community Of Gamers');
?>