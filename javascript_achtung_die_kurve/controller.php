<?php
/*
 * LOG_START
 * 
 * TODO:  Make everything to $_SESSION
 * 
 * 
 * LOG_END
 */

ob_start();
session_start();
require_once 'mysql_connect.php';
if(!isset($_SESSION['GID'])){
	$nick = $_GET['name'];
	$game_query = mysql_query("select game_id,id_0,id_1,id_2,id_3 from games where free='1'");
	$player=0;

	if((mysql_fetch_array($game_query))>0){
		$game_id = mysql_fetch_array($game_query);
		if($game_id['id_1'] == 0){
			$player = 1;
			if($game_id['id_2'] == 0){
				$player = 2;
				
				if($game_id['id_3'] == 0){
					$player = 3;
				}
			}
		}
	}
	
	
	if($player==3){
		do{$rand = rand(1, 999999999);}while(sizeof(mysql_fetch_array(mysql_query("select * from games where game_id='$rand'"))) <= 0);
		$_SESSION['GID'] = $rand;
		$_SESSION['UID'] = $player;
		mysql_query("insert into games(game_id,id_0,id_1,id_2,id_3,free) values('$rand','0','0','0','1','1')");
	}
	
	elseif($player == 0){
		mysql_query("update games set free='0' where game_id=".$game_id['game_id']);
		}

	
	else{
		mysql_query("update games set id_$player='1' where game_id=".$game_id['game_id']);
	}
	


}
else{
	$game_id = $_SESSION['GID'];
	$id = $_SESSION['UID'];
	
	if(isset($_POST['hero[0]'])){
			$data = $_POST['hero[0]'];
			$g_id=0;
	}
	if(isset($_POST['hero[1]'])){
			$data = $_POST['hero[1]'];
			$g_id=1;
	}
	if(isset($_POST['hero[2]'])){
			$data = $_POST['hero[2]'];
			$g_id=2;
	}
	if(isset($_POST['hero[3]'])){
			$data = $_POST['hero[3]'];
			$g_id=3;
	}
	
	
	for($i=0;$i<=3;$i++){
		if($i != $id){
			$what .= "id_$i, ";
		}
	}
	$send="";
	
	// 4 timestamps to control latency/ping
	
	$select = mysql_query("select $what from tmp where game_id='$game_id'");
	if($fetch_select = mysql_fetch_array($select)){
		foreach ($fetch_select as $key=>$value){
			$send .= $value;
		}
		
	}
	echo $send;
	$query = mysql_query("update tmp set id_$g_id='$data' where game_id='$game_id'");
	$ready = mysql_result(mysql_query("select free from games where game_id='$game_id'"),0);
	echo $ready ? "ready=0&" : "ready=1&";
	if($ready == 0){
		$q = mysql_query("select * from games where game_id=$game_id");
		if($q){
			while($row = mysql_fetch_array($q)){
			}
		}
	}
}
ob_end_flush();
?>