<?php
function not_inj($text){
	$text = htmlspecialchars($text);
	
	$str1 = explode('<?', $text);
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
function redir(){
	header("Location:/index/");
}
if(isset($_GET['err']) && $_GET['err'] == 1){
	echo '<div class="error">'.$_GET['subs'].'</div>';
}
if(isset($_GET['err']) && $_GET['err'] == 0){
	echo '<div class="ok">'.$_GET['subs'].'</div>';
}
?>