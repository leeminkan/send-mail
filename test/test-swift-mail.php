<?php

require_once './vendor/autoload.php';

// Create the Transport
  $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
  ->setUsername("student10c1thpt@gmail.com")
  ->setPassword("xxxxx");

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);

// Create a message
$message = (new Swift_Message('Wonderful Subject'))
  ->setFrom(['student10c1thpt@gmail.com' => 'Sender'])
  ->setTo(['nguyenhoangphuc.kan@gmail.com' => 'Receiver'])
  ->setBody('Here is the message itself')
  ;

// Send the message
$result = $mailer->send($message);
?>