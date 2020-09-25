<?php

require_once './vendor/autoload.php';

use leeminkan\SendMail\SwiftMail;

$swift = new SwiftMail();

$param = [
    "customer_name" => "Kan", 
    "completed_distance" => "20KM"
];

$swift->setSubject("Test Subject")
->setFrom("student10c1thpt@gmail.com")
->setTo("nguyenhoangphuc.kan@gmail.com")
->setTemplate("approve-result-form-laziots")
->setParam($param)
->send();

?>