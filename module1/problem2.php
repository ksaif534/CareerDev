<?php

(string) $fileContent = file_get_contents('./fileToReadP2.txt');

function readFileContentWords($fileContent){
    $arrPara = explode("\n", $fileContent);
    $sum = 0;
    for ($i = 0; $i < count($arrPara) ; $i++) { 
        if ($arrPara[$i] == '') {
            continue;
        }
        $arrEach = explode(" ", $arrPara[$i]);
        $sum = $sum + count($arrEach);
    }
    return $sum;
}

print_r(readFileContentWords($fileContent));