<?php
namespace leeminkan\SendMail;
trait Util {
    function getFileContent($path) {
        $file_content = file_get_contents($path);
        
        return $file_content;
    }

    function getMailConfig() {
        $file_content = file_get_contents("./src/config.json");

        $config = json_decode($file_content, TRUE);
        
        return $config;
    }
}
?>