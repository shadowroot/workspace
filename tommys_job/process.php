<?php
require_once 'mysql_connect.php';
/*
 * CSV format
* 7
* |Jm�no|P��jmen�|Ulice|Mesto|E-mail|Telefon|Sleva|
*
*
* @param $my_email = "serverlock00@gmail.com" (string)
* @param $filename = "name_of_file" (string)
*
*
*/


$my_email = "serverlock00@gmail.com";


function not_inj($text){
	$text = htmlspecialchars($text);
	$text = str_replace(',', '&#44;', $text);
	$str1 = explode("<?", $text);
	if(sizeof($str1)>1){
		$str2 = explode("?>",$str1[1]);
		if(sizeof($str2)>1){
			$text = $str1[0].$str2[1];
		}
		else{
			$text = $str1[0].$str2[0];
		}
	}

	return $text;
}


$jmeno = not_inj($_POST['jmeno']);
$prijmeni = not_inj($_POST['prijmeni']);
$ulice = not_inj($_POST['ulice']);
$mesto = not_inj($_POST['mesto']);
$email = not_inj($_POST['email']);
$tel = not_inj($_POST['telefon']);
$sleva = not_inj($_POST['sleva']);
$psc = not_inj($_POST['psc']);

if(isset($_POST['jmeno']) && $_POST['jmeno'] != "" && isset($_POST['prijmeni']) && $_POST['prijmeni'] != "" && isset($_POST['ulice']) && $_POST['ulice'] != "" && isset($_POST['mesto']) && $_POST['mesto'] != "" && isset($_POST['email']) && $_POST['email'] != "" && isset($_POST['psc']) && $_POST['psc'] != "")
{


	$query = mysql_query("INSERT INTO orders (jmeno,prijmeni,ulice,mesto,psc,email,telefon,sleva) values ('$jmeno','$prijmeni','$ulice','$mesto','$psc','$email','$tel','$sleva')");
	$message = "Jméno: ".$jmeno."\r\nPřijmení: ".$prijmeni."\r\nUlice: ".$ulice."\r\nMěsto: ".$mesto."\r\nE-mail: ".$email."\r\nTelefon: ".$tel."\r\nSleva: ".$sleva."\r\n By Datasystems";
	if($query){
		mail($my_email, 'Objednávka taneční podložky' , $message);
		header("Location:index.php?error=0");
	}
}
else{
	header("Location:index.php?error=1&jmeno=".$jmeno."&prijmeni=".$prijmeni."&ulice=".$ulice."&mesto=".$mesto."&email=".$email."&tel=".$telefon."&sleva=".$sleva."&psc=".$psc);
}
?>