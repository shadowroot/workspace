<?php
  $days = array("Monday" => "Pond�l�","Tuesday" => "�ter�","Wednesday" => "St�eda","Thursday" => "�tvrtek","Friday" => "P�tek","Saturday" => "Sobota","Sunday"=>"Ned�le");
  $den = date("l");
  $matches=array();
  $keys = array_keys($days);
  foreach ($days as $key => $array){
    preg_match("/$den/",$key,$matches);
    if(count($matches)==1){
      $day = $matches[0];
      echo "Dnes je: ". $days[$day]. " " . date("d.m.Y")."<br>";
      break;
    }
  }
  echo "Dnes je: ". $den . " " . date("d.m.Y")." <br>";
?>
