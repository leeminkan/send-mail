<?php

require_once './vendor/autoload.php';
use leeminkan\SendMail\SwiftMail;

$inputFileName = './src/data/data.xlsx';

$swift = new SwiftMail();
$swift->setSubject("Test simple Approve. ...")
->setFrom("student10c1thpt@gmail.com")
->setTemplate("approve-result-form-laziots");

if ( $xlsx = SimpleXLSX::parse($inputFileName) ) {
    $i = 0;

    foreach ($xlsx->rows() as $elt) {
        if ($i == 0) {
            //Nothing
        } else {
            $email = "";
            $param = [];

            if (isset($elt[2])) {
                $param["customer_name"] = $elt[2];
            }

            if (isset($elt[3])) {
                $param["completed_distance"] = $elt[3];
            }
            

            if (isset($elt[1])) {
                $email = $elt[1];

                $swift->setTo($email)
                ->setParam($param)
                ->send();
            }
        }      
        $i++;
    }
} else {
    echo SimpleXLSX::parseError();
}

?>