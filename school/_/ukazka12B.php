<?php
echo date("W"). ". týden<br>";
if(date("W")%2==0){
echo "Sudý týden";
}
else
{
echo "Lichý týden";
}

?>