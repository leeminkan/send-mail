<?php
//PHP Fatal error: Uncaught Error: Class 'Net_SMTP' not found => Resolve: sudo pear install Net_SMTP
require_once './vendor/autoload.php';
include 'get-file-content.php';

$from = 'Your Hotel <student10c1thpt@gmail.com>';
$to = 'Me <nguyenhoangphuc.kan@gmail.com>';
$subject = 'Thanks for choosing Our Hotel!';
 
$headers = ['From' => $from,'To' => $to, 'Subject' => $subject];
 
// include text and HTML versions 
// $text = 'Hi there, we are happy to confirm your booking. Please check the document in the attachment.';
// $html = 'Hi there, we are happy to <br>confirm your booking.</br> Please check the document in the attachment.';
$html = getFileContent('./src/template/approve-result-form-laziots.html');

$mime = new Mail_mime();
// $mime->setTXTBody($text);
$mime->setHTMLBody($html);
 
$body = $mime->get();
$headers = $mime->headers($headers);
 

$host = 'smtp.mailtrap.io';
$username = '364b6eb39cddd4'; // generated by Mailtrap
$password = '7af10b3ab4a861'; // generated by Mailtrap
$port = '2525';


// $host = 'ssl://smtp.gmail.com';
// $username = 'student10c1thpt@gmail.com'; // generated by Mailtrap
// $password = 'xxxx'; // generated by Mailtrap
// $port = '465';
 
$smtp = Mail::factory('smtp', [
  'host' => $host,
  'auth' => true,
  'username' => $username,
  'password' => $password,
  'port' => $port
]);
 
$mail = $smtp->send($to, $headers, $body);
 
if (PEAR::isError($mail)) {
    echo('<p>' . $mail->getMessage() . '</p>');
} else {
    echo('<p>Message successfully sent!</p>');
}
?>