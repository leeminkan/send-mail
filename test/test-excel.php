<?php

require_once './vendor/autoload.php';

use leeminkan\SendMail\Excel;

$excel = new Excel();

$excel->setSubject("Test Excel")
->setTemplate("approve-result-form-laziots")
->setSource("./src/data/data.xlsx")
->setColumnToParam([
    2 => "customer_name",
    3 => "completed_distance",
])
->setColumnReceiver(1)
->setStartRow(1)
->sendMail();

?>