<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="Taneční podložky" />
<title>Taneční podložky</title>
</head>
<body>
	<div id="nadpis">Taneční podložky</div>
	<div id="predmet_foto"></div>
	<div id="info">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
		Aenean tristique diam quis mi malesuada vel laoreet neque dapibus.
		Pellentesque elementum ullamcorper lectus nec dapibus. In ullamcorper
		consequat erat, ac dignissim est malesuada semper. Phasellus et metus
		est. Nulla tincidunt, arcu quis hendrerit rutrum, ligula leo dignissim
		nisl, vitae viverra mi risus nec urna. Maecenas porta dolor et libero
		vehicula adipiscing. Sed tristique viverra quam, ac viverra arcu
		vulputate eu. Vestibulum semper laoreet facilisis. Duis fringilla
		eleifend lectus vitae pretium. Duis a quam vitae leo pellentesque
		viverra vitae venenatis velit. Vivamus dignissim neque a neque tempor
		non eleifend velit sollicitudin.</div>
	<div id="cena"></div>
	<div id="nova_cena"></div>

	<div id="div_form">


	<?php
	if(isset($_GET['error']) && $_GET['error'] == 1){
		echo '<div class="error">Nevyplnili jste správně formulář!</div>';
	}
	if(isset($_GET['error']) && $_GET['error'] == 0){
		echo '<div class="error">Zboží bylo obědnáno</div>';
	}
	?>
		<form action="process.php" method="post">
			<table id="form">
				<tr class="form_col">
					<td>*Jméno</td>
					<td><input type="text" size="20" name="jmeno"
						value="<?php if(isset($_GET['jmeno'])){echo $_GET['jmeno'];} ?>" />
					</td>
				</tr>
				<tr class="form_col">
					<td>*Přijmení</td>
					<td><input type="text" size="20" name="prijmeni"
						value="<?php if(isset($_GET['prijmeni'])){echo $_GET['prijmeni'];} ?>" />
					</td>
				</tr>
				<tr class="form_col">
					<td>*Ulice</td>
					<td><input type="text" size="20" name="ulice"
						value="<?php if(isset($_GET['ulice']))echo $_GET['ulice']; ?>" />
					</td>
				</tr>
				<tr class="form_col">
					<td>*Město</td>
					<td><input type="text" size="20" name="mesto"
						value="<?php if(isset($_GET['mesto']))echo $_GET['mesto']; ?>" />
					</td>
				</tr>
				<tr class="form_col">
					<td>*PSČ</td>
					<td><input type="text" size="20" name="psc"
						value="<?php if(isset($_GET['psc']))echo $_GET['psc']; ?>" />
					</td>
				</tr>
				<tr class="form_col">
					<td>*E-mail</td>
					<td><input type="text" size="20" name="email"
						value="<?php if(isset($_GET['email']))echo $_GET['email']; ?>" />
					</td>
				</tr>
				<tr class="form_col">
					<td>Telefon</td>
					<td><input type="text" size="20" name="telefon"
						value="<?php if(isset($_GET['tel']))echo $_GET['tel']; ?>" /></td>
				</tr>
				<tr class="form_col">
					<td>Slevový kupón</td>
					<td><input type="text" size="20" name="sleva"
						value="<?php if(isset($_GET['sleva']))echo $_GET['sleva']; ?>" />
					</td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" value="Koupit" /></td>
				</tr>
			</table>
			<div id="minimal">(Položky s * musí být vyplněny)</div>
		</form>
	</div>
	<div id="footer"><a href="view.php">Admin</a></div>
</body>
</html>
