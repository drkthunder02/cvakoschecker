<?php

function TextAreaToArray($textarea) {
    $i = 0;
    $result = array();

    $lines = explode(PHP_EOL, $textarea);

    foreach($lines as $line) {
        $result[$i] = $line;
        $i++;
    }

    return $result;
}

?>
