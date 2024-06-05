<?php
function sum_digits($num){
  $sum = 0;
  while($num > 0){
    $rem = $num % 10;
    $num = $num / 10;
    $sum = $sum + $rem;
  }
  return $sum;
}
echo sum_digits(62343);
//echo sum_digits(1000);
?>