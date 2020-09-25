<?php

namespace leeminkan\SendMail;

class SwiftMail {
    use Util;

    // Properties
    public $host;
    public $port;
    public $username;
    public $password;
    public $encryption;

    public $subject;
    public $from;
    public $to;
    public $body;
    public $template;
    public $param;

    function __construct() {
        $config = $this->getMailConfig();
        $this->host = isset($config["host"]) ? $config["host"] : "";
        $this->port = isset($config["port"]) ? $config["port"] : "";
        $this->username = isset($config["username"]) ? $config["username"] : "";
        $this->password = isset($config["password"]) ? $config["password"] : "";
        $this->encryption = isset($config["encryption"]) ? $config["encryption"] : "";
        if (isset($config["from_address"])) {
            if (isset($config["from_name"])) {
                $this->from = [
                    $config["from_address"] => $config["from_name"]
                ];
            } else {
                $this->from = $config["from_address"];
            }
        } else {
            $this->from = isset($config["username"]) ? $config["username"] : "";
        }
    }

    public function setSubject($subject) {
        $this->subject = $subject;
        return $this;
    }

    public function setFrom($from) {
        $this->from = $from;
        return $this;
    }

    public function setTo($to) {
        $this->to = $to;
        return $this;
    }

    public function setBody($body) {
        $this->body = $body;
        return $this;
    }

    public function setTemplate($template) {
        $this->template = $template;
        return $this;
    }

    public function setParam($param) {
        $this->param = $param;
        return $this;
    }

    public function getContentTemplate() {
        $path = "./src/template/" . $this->template . ".html";
        return $this->getFileContent($path);
    }

    function send() {
        try {
            $transport = (new \Swift_SmtpTransport($this->host, $this->port))
            ->setUsername($this->username)
            ->setPassword($this->password);

            if ($this->encryption) {
                $transport->setEncryption($this->encryption);
            }
            
            $message = (new \Swift_Message($this->subject))
              ->setFrom($this->from)
              ->setTo($this->to);
            
            if ($this->template) {
                $message->setContentType("text/html");
                $this->body = $this->getContentTemplate();
                if ($this->param && is_array($this->param)) {
                    $this->body = $this->findAndReplace($this->body, $this->param);
                }
            } 
            
            
            $message->setBody($this->body);

            // Create the Mailer using your created Transport
            $mailer = new \Swift_Mailer($transport);

            return  $mailer->send($message);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}

?>