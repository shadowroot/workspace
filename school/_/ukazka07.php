<?php
     //cykly
     $a[0] = 11;
     $a[1] = 3;
     $a[2] = -1;
     $a[3] = 4;
     $a[4] = 3;
     $soucet = 0;
     for ($i=0;$i<=4;$i++){
        echo "\$a[$i] = $a[$i]<br>";
     }
     for ($i=0;$i<=4;$i++){
        $soucet += $a[$i];
     }
     echo "Souèet je $soucet.";
?>

