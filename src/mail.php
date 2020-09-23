<?php

namespace leeminkan\SendMail;

class Mail {
    // Properties
    public $mail_service;

    function __construct($mail_service) {
        $this->mail_service = $mail_service;
    }
    
    // Methods
    function set_mail_service($mail_service) {
        $this->mail_service = $mail_service;
    }

    function get_mail_service() {
        return $this->mail_service;
    }
}

?>