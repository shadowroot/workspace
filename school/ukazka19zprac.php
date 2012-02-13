<?php
echo "Výpis hodnot všech prvků pole \$_REQUEST:<br/>";
foreach($_REQUEST as $index => $value){
	echo "\$REQUEST[\"$index\"]=$value";
}
echo "Předání prvků pole do lokálních proměných<br>";
foreach($_REQUEST as $index => $value){
	$$index = $value;
	echo "\$$index = {$$index}<br>";
}
echo "Další zpracování pomocí lokálních proměnných byly předáný hodnoty prvů pole \$_REQUEST";
echo '<a href="read.php?file=ukazka19.php">Zpět</a>';
?>