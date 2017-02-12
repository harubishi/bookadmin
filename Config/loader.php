<?php

require_once('request.php');
require_once('view.php');
require_once('siteSetting.php');

class Loader{

	public $Request;
	public $View;
	public $siteSetting;

	public function __construct()
	{
		date_default_timezone_set('Asia/Tokyo');
		$this->Request = new Request;
		$this->View = new View;
		$this->siteSetting = new siteSetting;
	}

}