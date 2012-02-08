<?php
echo "Aktuální datum je ".date("d.m.Y H:i:s")."<br>";
if(date("A") == "AM"){
echo "Dobré dopoledne";
}
else if(date("H")<18){
echo "Dobré odpoledne";
}
else{
echo "Dobrý veèer";
}

?>