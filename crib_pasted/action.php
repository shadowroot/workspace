<<<<<<< HEAD
<?php
require_once 'functions.php';
	switch($_GET['a']){
		case "1":
			//register
			$passwd1 = not_inj($_POST['passwd1']);
			$passwd2 = not_inj($_POST['passwd2']);
			$user = not_inj($_POST['user']);
			$email = not_inj($_POST['email']);
			if($passwd1 == $passwd2){
				$q = mysql_query("insert into users (user,password,privilege,authorized,email) values ('$user','$passwd1','3','0','$email')");
				if($q){
					header("Location:/index/Registrace byla úspěšná/");
				}
			}
			break;
		case "2":
			if($_SESSION['privilege'] == 0){
				$q = mysql_query("update users set authorized=1 where id='".$_GET['id']."'");
			}
			break;
		case "3":
				if($_SESSION['privilege'] == 0){
					$q = mysql_query("update users set privilege='".$_GET['privilege']."' where id='".$_GET['id']."'");
				}
		break;
		case "4":
			if($_SESSION['privilege'] == 0){
				$q = mysql_query("delete users where id='".$_GET['id']."' limit 0,1");
			}
			break;
		default:
			echo 'What the fuck you think you are doing???';
			break;
	}
=======
<?php
require_once 'functions.php';
	switch($_GET['a']){
		case "1":
			//register
			$passwd1 = not_inj($_POST['passwd1']);
			$passwd2 = not_inj($_POST['passwd2']);
			$user = not_inj($_POST['user']);
			$email = not_inj($_POST['email']);
			if($passwd1 == $passwd2){
				$q = mysql_query("insert into users (user,password,privilege,authorized,email) values ('$user','$passwd1','3','0','$email')");
				if($q){
					header("Location:/index/Registrace byla úspěšná/");
				}
			}
			break;
		case "2":
			if($_SESSION['privilege'] == 0){
				$q = mysql_query("update users set authorized=1 where id='".$_GET['id']."'");
			}
			break;
		case "3":
				if($_SESSION['privilege'] == 0){
					$q = mysql_query("update users set privilege='".$_GET['privilege']."' where id='".$_GET['id']."'");
				}
		break;
		case "4":
			if($_SESSION['privilege'] == 0){
				$q = mysql_query("delete users where id='".$_GET['id']."' limit 0,1");
			}
			break;
		default:
			echo 'What the fuck you think you are doing???';
			break;
	}
>>>>>>> ab09edaaba59a3e337c0735bdc0bd0224ad31e90
?>