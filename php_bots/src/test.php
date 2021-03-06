<?php
include_once 'rsa.class.php';
include_once 'cfg.inc.php';

class cron{
	private $db;
	
	function __construct($cfg){
		$this->db = new PDO($cfg['dsn'], $cfg['user'], $cfg['passwd'], $cfg['options']);
		
	}
	
	function event($proc){
		
	}
	
	
}

//key and action value pairs

class engine{
	
	private $buff;
	private $data;
	private $auth = false;
	private $len = 2048;
	private $db;
	private $RSA;
	private $tmp;
	private $protocol;
	
	private $my_public;
	private $my_private;
	private $other_public;
	
	
	
	function __call($name,$args){
		
	}
	
	
	function __construct($cfg){
		$this->db($cfg);
		$this->RSA = new RSA_Handler();
		$this->socket();
		
	}
	
	function socket(){
		$sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		//control port 9987
		//read n bytes with while and write too
		socket_bind($sock, '127.0.0.1', '9987');
		socket_listen($sock);
		if($cli = socket_accept($sock)){
			$this->client($cli);
		}
	}
	
	function client($cli){
		$buff = socket_read($cli, $this->len);
		$this->auth($cli,$buff);
	}
	
	function auth($cli,$buff){
		$filename = ".rsa/.pem";
		if(!file_exists($filename)){
			touch($filename);
			$keys = new RSA_keymaker();
			$this->db->query("insert into rsa_keys values ('".$_SERVER['HTTP_HOST']."','$keys[1]')");
			file_put_contents($filename, $keys[0]);
		}
		else{
			$this->my_private = file_get_contents($filename);
			$this->my_public = $this->db->query("select public from rsa_keys where domain='localhost'")->fetch();
		}
		while($buff != "\r\r\r\n"){
			socket_recv($cli, $buff, '4');
			$this->data += $buff;
		}
		if(isset($key[1])){
			$this->db->query("insert into rsa_keys values ('$key[0]','$key[1]')");
			socket_write($cli, $_SERVER['HTTP_HOST']."\r\n".$keys[1]);
		}
		else{
			$this->other_public = $this->db->query("select public from rsa_keys where domain='$key[0]'")->fetch();
		}
		$this->listen($cli);
		
	}
	
	function db($cfg){
		$this->db = new PDO($cfg['dsn'], $cfg['user'], $cfg['passwd'], $cfg['options']);
	}
	
	function listen($cli){
		while(!socket_close($cli)){
			$tmp = socket_recvfrom($cli, $this->buff, $this->len);
			$this->data = $this->RSA->decrypt($tmp, $this->other_public);
			$this->process($cli);
		}
	}
	
	function process($cli){
		$handler = explode("\r\n\r\n", $this->data);
		$this->seq = $handler[0];
		$this->all = $handler[1];
	}
	
}

class bot{
	
}



?>
