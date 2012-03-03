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
	$_COOKIE['error'] = '!$_SESSION[\'GID\']';
	$nick = check_inject($_GET['name']);
	$_SESSION['nick'] = $nick;
	$game_query = mysql_query("select game_id,id_0,id_1,id_2,id_3 from games where free='1'") or die("select[game_query] error");
	if($row = mysql_fetch_array($game_query)){
		$_SESSION['GID'] = $row['game_id'];
		if($row['id_3']){
			if($row['id_2']){
				if($row['id_1']){
					$id=0;
				}
				$id=1;
			}
			$id=2;
		}
		$id=3;
	}
	else{
		$id=3;
		mysql_query("insert into games(game_id,id_0,id_1,id_2,id_3,free) values('$rand','0','0','0','1','1')") or die("insert error");
		mysql_query("insert into ping(game_id,id_0,id_1,id_2,id_3,last) values('$rand','','','','',NOW())") or die("insert[] error");
		mysql_query("insert into tmp(game_id,id_0,id_1,id_2,id_3) VALUES ('$game_id','','','','')") or die("insert[tmp] error");
		echo $_SESSION['GID'];
		
	}
	$_SESSION['UID'] = $id;
	
	
	do{$rand = rand(1, 999999999);}while(mysql_fetch_array(mysql_query("select * from games where game_id='$rand'")) != false);
	
	$_SESSION['GID'] = $rand;
	$_SESSION['UID'] = $id;
	$_SESSION['nick'] = $nick;
	

	
	if($_SESSION['UID'] == 0){
		mysql_query("update games set free='0' where game_id={$_SESSION['GID']}") or die("update[free] error");
	}


	
	if($_SESSION['UID'] <= 3){
		mysql_query("update games set id_{$_SESSION['UID']}='1' where game_id={$_SESSION['GID']}") or die("update[id] error");
	}

	


}
elseif($_SESSION['GID'] > 0){
	$game_id = $_SESSION['GID'];
	$id = $_SESSION['UID'];
	$data = $_POST["hero[{$id}]"];
	
	
	
	for($i=0;$i<=3;$i++){
		if($i != $id){
			$what .= "id_$i, ";
		}
	}
	$what .= "null";
	$send="";
	
	// 4 timestamps to control latency/ping
	$select = mysql_query("select $what from tmp where game_id='$game_id'") or die("select[tmp] error");
	if($fetch_select = mysql_fetch_array($select)){
		foreach ($fetch_select as $key=>$value){
			$send .= '&'.$value;
		}
		
	}

	if(isset($data)){
		$res = mysql_result(mysql_query("select if ((id_0-100) < last,0,-1),  if((id_1-100) < last,1,-1), if((id_2-100) < last,2,-1), if((id_3-100) < last,3,-1) from ping"));
		if($res < 0 ){
			$query = mysql_query("update tmp set id_$id='$data' where game_id='$game_id'")  or die("update[data] error");
			mysql_query("update ping set id_$id=NOW(), last=NOW() where game_id='$game_id'")  or die("update[ping] error");
		}
		else{
			$send = "attrs.ready_to_start[$res]=true&hero[$res].running=false&attrs.errors=\"High ping at $res;Sorry game stopped;\"";
		}
	}

	
	echo $send;
	

}
else{
	echo "null";	
}
ob_end_flush();
?>