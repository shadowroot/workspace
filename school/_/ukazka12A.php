<?php
echo "Aktu�ln� datum je ".date("d.m.Y H:i:s")."<br>";
if(date("A") == "AM"){
echo "Dobr� dopoledne";
}
else if(date("H")<18){
echo "Dobr� odpoledne";
}
else{
echo "Dobr� ve�er";
}

?>