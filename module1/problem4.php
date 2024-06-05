<?php
function pyramid_gen($n){
  $shift = $n - 1;
  for($i = 0; $i < $n; $i++){
    $tmp = 2 * $i + 1;
    for($j = 0; $j < $shift; $j++){
      echo " ";
    }
    $shift--;
    for($k = 0; $k < $tmp; $k++){
      echo "*";  
    }
    echo "\n";
  }
}
pyramid_gen(5);
?>