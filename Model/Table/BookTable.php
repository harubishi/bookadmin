<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/Model/AppModel.php');

class BookTable extends AppModel{

	public $row = 'Book';

	public function getRowsetByStoreId($id)
	{
		$sql = "
			SELECT b.id,b.name,b.isbn,b.price,w.id as w_id,w.quantity,w.store_id as s_id FROM book as b INNER JOIN warehouse as w 
			ON  b.id = w.book_id where store_id = ?
		";

		$params = [$id];

		return $this->fetchAll($sql,$params);
	}
}