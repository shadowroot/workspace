<?php
// port FW
// Options array
class FW{
	private $port;
	private $socket;
	private $cli;
	private $i;
	private $max_client=1000;
	private $limit = 300; 
	private $log;
	
	
	
	function __construct($port,$options){
		$date = "[".date("d.m.Y H:i:s")."]";
		$this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		foreach ($options as $key => $option){
			$this->$key = $option;
		}
		socket_bind($this->socket, "0.0.0.0", $this->port=9987);
		socket_listen($this->socket);
		$i=0;
		$this->log .= $date." Server STARTED listenning ...";
		while($this->listenning){
			if($this->cli[$i]['socket'] = socket_accept($this->socket)){
				$this->process($i,$this->cli[$this->i]['socket']);
				$i++;
			}
			if($this->i > $this->limit){
				$this->listenning=0;
			}
			
		}
		$this->log .= $date." Server STOP listenning ...";
		if(file_exists(".log")){
			$hFile = fopen(".log", "w");
			fwrite($hFile, $this->log);
			fclose($hFile);
		}
		else{
			touch(".log");
			$hFile = fopen(".log", "w");
			fwrite($hFile, $this->log);
			fclose($hFile);
		}
	}
	
	
	
	function process($key,$socket){
		while(!socket_close($socket)){
			socket_recvfrom($socket, $data, 4, 0, $ip, $port);
			$this->cli[$key]['ip'] = $ip;
			$this->cli[$key]['port'] = $port;
			$this->cli[$key]['data'] .= $data;
			$this->key[] = $key;
		}
		
		
	}
	
	function api($socket){
		return array("clients" => $this->cli,"actives" => $this->keys);
	}
	
	function get_ready(){
		return $this->ready;
	}
	
	
	
}

class IRC{
	
	private $socket;
	private $cli;
	
	function __construct($port=9987){
		$this->socket = new FW($port);
		while($this->socket->get_ready()){
			$this->process_data();
		}
	}
	
	
	function process_data(){
		$this->cli = $this->socket->api($this->socket);
		$key = $this->cli['active'];
		$data = $this->cli['client'][$key]['data'];
		$code = substr($data, '0','4');
		
	}
}



?>