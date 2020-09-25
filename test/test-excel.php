<?php

require_once './vendor/autoload.php';

use leeminkan\SendMail\Excel;

$excel = new Excel();

$excel->setSubject("Test Excel")
->setFrom("student10c1thpt@gmail.com")
->setTemplate("approve-result-form-laziots")
->setSource("./src/data/data.xlsx")
->setColumnToParam([
    1 => "receiver",
    2 => "customer_name",
    3 => "completed_distance",
])
->setColumnReceiver(1)
->setStartRow(1)
->sendMail();

?>