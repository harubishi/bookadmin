<?php 
require_once($_SERVER['DOCUMENT_ROOT'] .'/Model/Row/Store.php');
require_once($_SERVER['DOCUMENT_ROOT'] .'/Model/Row/Book.php');
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
		$params = !empty($params[$this->row])? $params[$this->row] : $params;
		$this->_params = $params;
		if(!empty($this->__Validation)){
			$this->__Validation->set($params);
		}
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

	public function beginTransaction()
	{
		return $this->__Db->beginTransaction();
	}


	public function commit()
	{
		$this->__Db->commit();
	}

	
	public function rollBack()
	{
		$this->__Db->rollBack();
	}


	protected function setCurrentDate()
	{
		return date('Y-m-d H:i:s');
	}

}