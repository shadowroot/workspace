
<?php
$name = $_REQUEST['name'];
$num_1 = $_REQUEST['num_1'];
$num_2 = $_REQUEST['num_2'];
$num_3 = $_REQUEST['num_3'];
$ch1 = $_REQUEST['ch1'];
$ch2 = $_REQUEST['ch2'];
$ch3 = $_REQUEST['ch3'];
$HID = $_REQUEST['HID'];
$mid = ($num_1+$num_2+$num_3)/3;
echo "<table><tr><td>Jméno</td><td>$name</td></tr><tr><td>Průměr</td><td>$mid</td></tr>
<tr><td>ch1</td><td>$ch1</td></tr>
<tr><td>ch2</td><td>$ch2</td></tr>
<tr><td>ch3</td><td>$ch3</td></tr>";
echo '<tr><td><a href="read.php?file=ukazka18.php">Zpět</a></td><td></td></tr>';
?>