<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/Model/AppModel.php');

class SaleTable extends AppModel{

	public $row = 'SaleTable';

	public function save()
	{
		$sql ="INSERT INTO sale(price,quantity,created,modified,store_id,book_id) VALUES(?,?,?,?,?,?)"; 
		$params =[
			$this->_params['price'],
			$this->_params['quantity'],
			$this->setCurrentDate(),
			$this->setCurrentDate(),
			$this->_params['s_id'],
			$this->_params['id'],
		];
		return $this->exec($sql,$params);

	}

}