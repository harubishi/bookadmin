<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/Model/AppModel.php');

class WarehouseTable extends AppModel{

	public $row = 'Warehouse';

	public function update()
	{
		$sql = 'UPDATE warehouse SET quantity = ? ,modified = ? WHERE id = ?';

		$params =[
			$this->_params['left_quantity'],
			$this->setCurrentDate(),
			$this->_params['w_id'],
		];
		return $this->exec($sql,$params);

	}
}