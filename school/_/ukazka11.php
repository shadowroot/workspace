<table>
<?
$x = 5;
$i = 6;
echo "<th><tr>";
echo "<td>";
echo "V�raz";
echo "</td>";
echo "<td>";
echo "Hodnota V�razu";
echo "</td>";
echo "<td>";
echo "Pozn�mka";
echo "</td>";
echo "</tr></th>";


echo "<tr>";
$hodnota = sin($x)+8*4+5*$i;
echo "<td>";
echo "sin(\$x)+8*4+5*\$i";
echo "</td>";
echo "<td>";
echo $hodnota;
echo "</td>";
echo "</tr>";

echo "<tr>";
$hodnota = cos($x)+8*4+5*$i;
echo "<td>";
echo "cos(\$x)+8*4+5*\$i";
echo "</td>";
echo "<td>";
echo $hodnota;
echo "</td>";
echo "</tr>";

echo "<tr>";
$hodnota = 8*4+5*$i;
echo "<td>";
echo "8*4+5*\$i";
echo "</td>";
echo "<td>";
echo $hodnota;
echo "</td>";
echo "</tr>";

echo "<tr>";
$hodnota = 4+5*$i;
echo "<td>";
echo "4+5*\$i";
echo "</td>";
echo "<td>";
echo $hodnota;
echo "</td>";
echo "</tr>";


echo "<tr>";
$hodnota = 4+5;
echo "<td>";
echo "4+5";
echo "</td>";
echo "<td>";
echo $hodnota;
echo "</td>";
echo "</tr>";
?>
</table>