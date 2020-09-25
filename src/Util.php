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

    function findAndReplace($content, $data) {
        preg_match_all('/\[(\w*)\]/', $content, $matches);
        if (isset($matches[1])) {
            foreach ($matches[1] as $match) {
                $replace = isset($data[$match]) ? $data[$match] : "";
                $content = str_replace('[' . $match . ']', $replace, $content);
            }
        }
        return $content;
    }
}
?>