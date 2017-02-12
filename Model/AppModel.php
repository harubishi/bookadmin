<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . "/Config/datebase.php");

interface fsf{

}

abstract class Abstract{
	abstract getRowset();

}

class AppModel{
	private $Db = new Database;

	public function fetch($sql,$array = array())
	{
		return $this->Db->execute($sql,$params)->fetch(PDO::FETCH_ASSOC);
	}

	public function fetchAll($sql,$array = array()){
		return $this->Db->execute($sql,$array)->fetchAll(PDO::FETCH_ASSOC);
	}

	public function insert($sql,$params = array())
	{
		try{
			$this->execute($sql,$params);
		}catch(PDOException $e){
			echo $e->Message();
			exit;
		}

		return true;
	}

	public function setCurrentDate()
	{
		return date('Y-m-d H:i:s');
	}

}