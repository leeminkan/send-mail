<?php

require_once './vendor/autoload.php';

use leeminkan\SendMail\SwiftMail;

$swift = new SwiftMail();

$swift->setSubject("Test Subject")
->setFrom("student10c1thpt@gmail.com")
->setTo("nguyenhoangphuc.kan@gmail.com")
->setTemplate("approve-result-form-laziots")
->send();

?>