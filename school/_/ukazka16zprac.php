<?php
$name = $_POST['name'];
$num_1 = $_POST['num_1'];
$num_2 = $_POST['num_2'];
$num_3 = $_POST['num_3'];
$ch1 = $_POST['ch1'];
$ch2 = $_POST['ch2'];
$ch3 = $_POST['ch3'];
$HID = $_POST['HID'];
$mid = ($num_1+$num_2+$num_3)/3;
echo "<table><tr><td>Jméno</td><td>$name</td></tr><tr><td>Průměr</td><td>$mid</td></tr>";
?>