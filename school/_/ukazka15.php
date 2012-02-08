<?php
$x = array(11,13,12,24,22,8,0,-12,19);
$soucet = 0;
foreach ($x as $key=>$value) {
	         echo "index_x = $key hodnota_x = $value x=$value<br>";
	         $soucet += $value;
}
echo "Souèet je $soucet<br>";
  foreach ($x as $value) {
	         echo "x[$key]=$value<br>";
}
?>
