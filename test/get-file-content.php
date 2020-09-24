<?php
    function getFileContent($path) {
        $file_content = file_get_contents($path);
        
        return $file_content;
    }
?>