<?php
  function keep_order_reverse_string($sentence){
    $arrStrWords = explode(" ", $sentence);
    $strSum = "";
    for ($i = 0; $i < count($arrStrWords); $i++ ){
      $strSum = $strSum." ".strrev($arrStrWords[$i]);
    } 
    return explode(" ",$strSum);
  }
  $arrRevWords = keep_order_reverse_string("`I love programming`");
  for($i = 0; $i < count($arrRevWords); $i++){
    echo $arrRevWords[$i];
    echo " ";
  }
?>