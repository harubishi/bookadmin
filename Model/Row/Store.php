<?php

class Store{
	public $id;
	public $name;
	public $address;
	public $telephone;

	public function getId()
	{
		return !empty($this->id)? $this->id : false;
	}

	public function getName()
	{
		return !empty($this->name)? $this->name : false;
	}	

	public function getAddress()
	{
		return !empty($this->address)? $this->address : false;
	}

	public function getTelephone()
	{
		return !empty($this->telephone)? $this->telephone : false;
	}
}