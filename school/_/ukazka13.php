<?php
$i=0;
while($i<7) {
      echo "Házím kostkou ";
      print mt_rand(1,6)."<br>";
      echo "Konec<br>";
      $i++;
}
  
do{
$n = mt_rand(5,30); 
$mod = $n%7;
echo "èíslo ".$n."<br />";     
}while($mod != 0);
echo "Èíslo dìlitelné 7 je ".$n;
?>
                                