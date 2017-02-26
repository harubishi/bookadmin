<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/Model/AppModel.php');
require_once($_SERVER['DOCUMENT_ROOT'] . "/Validation/StoreValidation.php");

class StoreTable extends AppModel{

	public $row = 'Store';

	public function __construct()
	{
		parent::__construct();
		$this->__Validation = new  StoreValidation;
	}

	public function getRowset()
	{
		$sql = 'SELECT * FROM store WHERE valid =' . AppModel::STATUS_PUBLIC;
		return $this->fetchAll($sql);

	}

	public function getRowById($id)
	{
		$sql = 'SELECT *  FROM store WHERE id = ? AND valid = ' . AppModel::STATUS_PUBLIC;
		$params = [$id];
		return $this->fetch($sql ,$params);
	}

	public function update()
	{
		$sql = 'UPDATE store SET name = ? , address = ? , telephone = ? ,modified = ? WHERE id = ?';

		$params =[
			$this->_params['name'],
			$this->_params['address'],
			$this->_params['telephone'],
			$this->setCurrentDate(),
			$this->_params['id']
		];
		return $this->exec($sql,$params);

	}

	public function save()
	{
		/*
			//登録sql
			INSERT INTO テーブル名(カラム名) VALUES(値);	カラム名は省略可能
		*/
		$sql ="INSERT INTO store(name,address,telephone,created,modified) VALUES(?,?,?,?,?)"; 
		$params =[
			$this->_params['name'],
			$this->_params['address'],
			$this->_params['telephone'],
			$this->setCurrentDate(),
			$this->setCurrentDate()
		];
		return $this->exec($sql,$params);

	}

	public function delete($id)
	{
		$sql = 'UPDATE store SET valid = 0 WHERE id = ?';

		$params = [$id];
		return $this->exec($sql,$params);
	}

}