<?php

class siteSetting{

	private $title;
	private $h1;

	public function setMetaData($params)
	{
		$this->title = isset($params['title'])? $params['title'] : '';
		$this->h1 = isset($params['h1'])? $params['h1'] : '';
	}

	public function getTitle()
	{
		return $this->title;
	}


	public function getH1()
	{
		return $this->h1;
	}
}