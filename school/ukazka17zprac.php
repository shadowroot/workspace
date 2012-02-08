<?php
$name = $_GET['name'];
$num_1 = $_GET['num_1'];
$num_2 = $_GET['num_2'];
$num_3 = $_GET['num_3'];
$ch1 = $_GET['ch1'];
$ch2 = $_GET['ch2'];
$ch3 = $_GET['ch3'];
$HID = $_GET['HID'];
$mid = ($num_1+$num_2+$num_3)/3;
echo "<table><tr><td>Jméno</td><td>$name</td></tr><tr><td>Průměr</td><td>$mid</td></tr>
<tr><td>ch1</td><td>$ch1</td></tr>
<tr><td>ch2</td><td>$ch2</td></tr>
<tr><td>ch3</td><td>$ch3</td></tr>";
echo '<a href="read.php?file=ukazka17.php">Zpět</a>';
?>