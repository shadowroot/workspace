<?php
$file = $_GET['file'];
$data = file_get_contents($file);
$data = htmlspecialchars($data);
$data = str_replace(array("\n"),"<br />",$data);
echo $data;
?>
