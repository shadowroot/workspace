<h2>Aritmetický průměr</h2>
<form action="ukazka19zprac.php" method="post">
<table>
<tr><td>Zadavatel</td><td> <input type="text" name="name" value="JMENO_PRIJMENI"></td></tr>
<tr><td>Číslo 1</td><td><input type="text" name="num_1" value="10"></td></tr>
<tr><td>Číslo 2</td><td><input type="text" name="num_2"></td></tr>
<tr><td>Číslo 3</td><td><input type="text" name="num_3"></td></tr>
<tr><td><input type="checkbox" name="ch1" value="ch1"></td><td>Zaškrtávací 1</td></tr>
<tr><td><input type="checkbox" name="ch2" value="ch2"></td><td>Zaškrtávací 2</td></tr>
<tr><td><input type="checkbox" name="ch3" value="ch3"></td><td>Zaškrtávací 3</td></tr>

<input type="hidden" name="HID" value="80">
<tr><td><input type="reset" value="Obnovit"></td><td></td></tr>
<tr><td><input name="OK" type="submit" value="Odeslat"></td><td></td></tr>
</table>
</form>

<?php

?>