<?php
namespace leeminkan\SendMail;

use Exception;

class Excel {
    
    public $source;
    public $mailer;
    public $subject;
    public $from;
    public $template;
    public $columnReceiver;
    public $columnToParam = [];
    public $startRow = 0;


    function __construct() {
        $this->mailer = new SwiftMail();
    }
    
    public function setSource($source) {
        $this->source = $source;
        return $this;
    }
    
    public function setSubject($subject) {
        $this->subject = $subject;
        return $this;
    }
    public function setFrom($from) {
        $this->from = $from;
        return $this;
    }
    
    public function setTemplate($template) {
        $this->template = $template;
        return $this;
    }
    
    public function setColumnReceiver($columnReceiver) {
        $this->columnReceiver = $columnReceiver;
        return $this;
    }
    
    public function setStartRow($startRow) {
        $this->startRow = $startRow;
        return $this;
    }
    
    public function setColumnToParam($columnToParam = []) {
        $this->columnToParam = $columnToParam;
        return $this;
    }

    public function sendMail() {

        $this->mailer->setSubject($this->subject)
        ->setFrom($this->from)
        ->setTemplate($this->template);

        $Reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

        $spreadSheet = $Reader->load($this->source);
        $excelSheet = $spreadSheet->getActiveSheet();
        $spreadSheetAry = $excelSheet->toArray();
        $sheetCount = count($spreadSheetAry);

        if (!isset($this->columnToParam[$this->columnReceiver])) {
            throw new Exception("Column Receiver is incorrect!");
        }

        for ($i = 0; $i < $sheetCount; $i ++) {
            if ($i >= $this->startRow) {
                foreach ($this->columnToParam as $key => $value) {
                    if (isset($spreadSheetAry[$i][$key])) {
                        $param[$value] = $spreadSheetAry[$i][$key];
                    }
                }
                if (isset($param[$this->columnToParam[$this->columnReceiver]])) {
                    $receiver = $param[$this->columnToParam[$this->columnReceiver]];
                    $this->mailer->setTo($receiver)
                    ->setParam($param)
                    ->send();
                }
            }
        }
    }
}
?>