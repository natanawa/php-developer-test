<?php
function findIndexString($paramOne,$paramTwo){
  $newParam   = str_split($paramOne);
  $varOne     = 0;
  $varTwo     = 0;
  $countParam = count($newParam);
  $result     = "Undefined";
  for($x = $paramTwo ; $x < $countParam ; $x++){
    if($newParam[$x]=='('){
      $varOne++;
    }elseif($newParam[$x]==")"){
      $varTwo++;
    }
    if($varOne == $varTwo && ($varOne != 0 && $varTwo != 0)){
      $result = $x;
      $x = $countParam;
    }
  }
  echo '<pre>'.$result.'</pre>';
}
findIndexString("a (b c (d e (f) g) h) i (j k)", 2);
?>