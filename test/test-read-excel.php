<?php

require_once './vendor/autoload.php';
use leeminkan\SendMail\SwiftMail;

$inputFileName = './src/data/data.xlsx';

$Reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

$spreadSheet = $Reader->load($inputFileName);
$excelSheet = $spreadSheet->getActiveSheet();
$spreadSheetAry = $excelSheet->toArray();
$sheetCount = count($spreadSheetAry);

$swift = new SwiftMail();
$swift->setSubject("Approve. ...")
->setFrom("student10c1thpt@gmail.com")
->setTemplate("approve-result-form-laziots");

for ($i = 1; $i < $sheetCount; $i ++) {

    $email = "";
    $param = [];

    if (isset($spreadSheetAry[$i][2])) {
        $param["customer_name"] = $spreadSheetAry[$i][2];
    }

    if (isset($spreadSheetAry[$i][3])) {
        $param["completed_distance"] = $spreadSheetAry[$i][3];
    }
    

    if (isset($spreadSheetAry[$i][1])) {
        $email = $spreadSheetAry[$i][1];

        $swift->setTo($email)
        ->setParam($param)
        ->send();
    }

}
?>