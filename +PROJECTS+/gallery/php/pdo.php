<?php
class db extends PDO{
	/*
	 * Little bit extended PDO for supposes of gallery with customized queriest to getting to database
	 * function subscription($sub)
	 * Example usage
	 * $pdo = new db($dsn,$user,$pass);
	 * //MySQL database must be InnoDB
	 * $pdo->beginTransaction();
	 * $pdo->gal_sub($subscription);
	 * $pdo->gal_image($image_path);
	 * $pdo->endTransaction();
	 * $pdo->commit();
	 */
	private $pdo;
	private $state;
	private $err;
	private $debug = 1;
	private $current;
	private $obj;
	private $tmp;
	private $subs_start=0;
	private $image_start=0;
	private $subs;
	private $subs_obj;
	private $images;
	private $images_obj;
	
	
	function transact(){
		$this->temp_transaction("start transaction");
		$this->temp_transaction("begin");
	}
	function roll(){
		$this->temp_transaction("rollback");
	}
	function exception_handler(){
		$this->temp_transaction("rollback");
		$this->state = 0;
		if($this->debug){
			echo $this->errorCode()."\n";
			echo $this->errorInfo();
		}
		else{
			echo "";
		}
	}
	function end(){
		$this->temp_transaction("end");
	}
	function success(){
		$this->temp_transaction("commit");
		$this->state = 1;
	}
	function temp_table($name){
		if($this->query("create temporary table tmp_".$name." on commit preserve rows as select * from ".$name))
		{
			
		}
	}
	function backup(){
		$this->query("show databases");
	}
	function fetch(){
		return $this->query($this->tmp)->fetchObject();
	}
	function temp_transaction($t){
		if(!$this->query($t.";")){
			$this->exception_handler();
		}
	}
	function gal_subs_sql($sub){
		if(!$this->subs_start){
			$this->beginTransaction();
		}
		$this->subs[] = $this->prepare("insert into gallery".$sub);
	}
	function gal_subs_fetch(){
		foreach ($this->subs as $key => $query){
		$query->execute();
		$this->subs_obj->$key = $query->fetchObject();
		}
		return $this->subs_obj;
	}
	function gal_image_sql($img){
		
	}
	

}

?>