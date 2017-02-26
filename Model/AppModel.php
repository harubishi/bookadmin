<?php 
require_once($_SERVER['DOCUMENT_ROOT'] .'/Model/Row/Store.php');
require_once($_SERVER['DOCUMENT_ROOT'] . "/Config/database.php");

class AppModel{

	const STATUS_PUBLIC = 1; //定数
	const STATUS_PRIVATE = 0;
	protected $_params;
	protected  $__Validation;
	private  $__Db;
	
	public function __construct()
	{
		$this->__Db = new Database;
	}

	public function validate()
	{
		return ($this->__Validation->validate())? true : false;
	}

	public function getErrors()
	{
		return $this->__Validation->getErrors();
	}

	public function set($params)
	{
		$params = $params[$this->row];
		$this->_params = $params;
		$this->__Validation->set($params);
	}

	public function fetch($sql,$params = array())
	{
		return $this->__Db->execute($sql,$params)->fetchObject($this->row);
	}

	public function fetchAll($sql,$params = array())
	{
		return $this->__Db->execute($sql,$params)->fetchAll(PDO::FETCH_CLASS,$this->row);
	}

	public function exec($sql,$params = array())
	{
		try{
			$this->__Db->execute($sql,$params);
		}catch(PDOException $e){
			echo $e->Message();
			exit;
		}

		return true;
	}

	protected function setCurrentDate()
	{
		return date('Y-m-d H:i:s');
	}

}