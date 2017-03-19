<?php

class Book{
	public $id;
	public $name;
	public $isbn;
	public $price;
	public $w_id;
	public $quantity;

	public function getId()
	{
		return !empty($this->id)? $this->id : false;
	}

	public function getName()
	{
		return !empty($this->name)? $this->name : false;
	}	

	public function getIsbn()
	{
		return !empty($this->isbn)? $this->isbn : false;
	}

	public function getPrice()
	{
		return !empty($this->price)? $this->price : false;
	}

	public function getWarehouseId()
	{
		return !empty($this->w_id)? $this->w_id : false;
	}

	public function getStoreId()
	{
		return !empty($this->s_id)? $this->s_id : false;
	}

	public function getQuantity()
	{
		return !empty($this->quantity)? $this->quantity :false;
	}
}