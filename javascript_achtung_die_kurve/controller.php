<?php
require_once 'mysql_connect.php';
if(!isset($_GET['ID'])){
			$game_id = mysql_fetch_array(mysql_query("select game_id,id_0,id_1,id_2,id_3 from games where free='true'"));
			if($game_id != false){
				if(!$game_id['id_1']){
					$player = 1;
					if(!$game_id['id_2']){
						$player = 2;
						if(!$game_id['id_3']){
							$player = 3;
						}
					}
				}
			}
			if($player == 3){
				mysql_query("update games set free='false' where game_id=".$game_id['game_id']);
				
			}
			else{
				mysql_query("update games set id_$player='true' where game_id=".$game_id['game_id']);
			}
		if($game_id == 0){
			$rand = rand(0,99999999999999999999999);
			echo $rand.';0';
			mysql_query("insert into games(game_id,id_0,id_1,id_2,id_3,free) values('$rand','false','false','false','false','true')");
		}
		else {
			echo $game_id['game_id'].';'.$player;
			
		}
	
}
else{
	$id = check_inject($_GET['ID']);
	$ready = mysql_result(mysql_query("select free from games where id=$id"),0);
	$q = mysql_query("select * from games where id=$id");
	if($q){
		while($row = mysql_fetch_array($q)){
			
			
		}
	}
}
?>