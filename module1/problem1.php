<?php
function minAbs($arr){
    for($i = 0; $i < count($arr); $i++){
      //Convert all values into positive (if required)
      $arr[$i] = getAbs($arr[$i]);
    }
    $minValue = $arr[0];
    for($i = 1; $i < count($arr); $i++){
      if($minValue > $arr[$i]){
        $minValue = $arr[$i];
      }
    }
    return $minValue;
  }
  
  function getAbs($value){
    if ($value < 0){
      return -1 * $value;
    }else{
      return $value;
    }
  }
  echo minAbs([10,12,15,189,22,2,34]);
// 	echo minAbs([10,-12,34,12,-3,123]);