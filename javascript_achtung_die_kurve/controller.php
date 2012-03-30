<?php
/*
 * LOG_START
 * 
 * TODO:  Make everything to $_SESSION
 * 
 * 
 * LOG_END
*/
/*
foreach ($_POST as $key => $value){
	echo "$key => $value";
}
*/
session_start();
ob_start();


require_once 'mysql_connect.php';

if(!isset($_SESSION['GID'])){
	$id = 0;
	$nick = check_inject($_GET['name']);
	$_SESSION['nick'] = $nick;
	$game_id="";
	$game_query = mysql_query("select * from games where free='1'") or die("select[game_query] error");
	if($row = mysql_fetch_array($game_query)){
		$_SESSION['GID'] = $row['game_id'];
		if($row['id_0'] == 0){
			$id=0;
		}
		else{
			if($row['id_1'] == 0){
				$id = 1;
				if($row['id_2'] == 0){
					$id=2;
					if($row['id_3'] == 0){
						$id=3;
					}
				}
			}
		}
	
	}
	
	else{
		do{$rand = rand(1, 999999999);$_SESSION['GID'] = $rand;}while(mysql_fetch_array(mysql_query("select * from games where game_id='$rand'")) != false);
		$id=0;
		mysql_query("insert into games(game_id,id_0,id_1,id_2,id_3,free) values('{$_SESSION['GID']}','0','0','0','1','1')") or die("insert error");
		mysql_query("insert into ping(game_id,id_0,id_1,id_2,id_3,last) values('{$_SESSION['GID']}','','','','NOW()',NOW())") or die("insert[] error");
		mysql_query("insert into tmp(game_id,id_0,id_1,id_2,id_3) VALUES ('{$_SESSION['GID']}','','','','')") or die("insert[tmp] error");
		
	}

	$_SESSION['UID'] = $id;
	
	

	
	if($id == 3){
		mysql_query("update games set free='0' where game_id={$_SESSION['GID']}") or die("update[free] error");
	}
	if($id <= 3){
		mysql_query("update games set id_{$id}='1' where game_id={$_SESSION['GID']}") or die("update[id] error");
	}

	echo "dbg=\"gid:{$_SESSION['GID']},uid:{$_SESSION['UID']},nick:{$_SESSION['nick']}\"&my=$id";


}
else{
	$game_id = $_SESSION['GID'];
	$id = $_SESSION['UID'];
	$data = $_POST['hero'][$_SESSION['UID']];
	
	for($i=0;$i<=3;$i++){
		if($i != $id){
			$what .= "id_$i, ";
		}
	}
	$what .= "null";
	$send="";
	
	// 4 timestamps to control latency/ping
	$select = mysql_query("select $what from tmp where game_id='$game_id'") or die("select[tmp] error");
	if($fetch_select = mysql_fetch_array($select) && $fetch_select['game_id'] > 0){
		foreach ($fetch_select as $key=>$value){
			$send .= $value.'&';
		}
		
	}
	if($data != ""){
		$res = mysql_fetch_array(mysql_query("select if ((id_0-100) < last,0,-1),  if((id_1-100) < last,1,-1), if((id_2-100) < last,2,-1), if((id_3-100) < last,3,-1) from ping where game_id='$game_id'"));
			
		$query = mysql_query("update tmp set id_$id='$data' where game_id='$game_id'")  or die("update[data] error");
		if(!$query){
			echo "dbg=\"update error $id , $game_id\"&";
		}
		else{
			echo "dbg=\"update ok $id , $game_id\"&";
		}
		$timestamp = time();
		mysql_query("update ping set id_$id='$timestamp', last='$timestamp' where game_id='$game_id'")  or die("update[ping] error");
		foreach ($res as $key => $value){
			if($value > -1 ){
				$send .= "attrs.ready_to_start[$value]=false&hero[$value].running=false&attrs.errors=\"High ping at $value;Sorry game stopped;\"&";
			}
		}
	}
	
	
	echo $send;
	echo "dbg=\"gid:{$_SESSION['GID']},uid:{$_SESSION['UID']},nick:{$_SESSION['nick']}\"";

}
/*
else{
	echo "dbg=\"gid:{$_SESSION['GID']},uid:{$_SESSION['UID']},nick:{$_SESSION['nick']}\"&attrs.errors=\"<p>App is not working!!!</p><p> Please contact webmaster ! </p>\"";	
}
*/
ob_end_flush();
?>