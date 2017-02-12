<?php

class View{

	private $element = '/Element/';
	private $js = '/js/';
	private $css = '/css/';
	private $img = '/img/';

	//Elementフォルダ以下を読み込む
	public function getElement($file)
	{
		return $_SERVER['DOCUMENT_ROOT'] . $this->element . $file . '.php';
	}

	//scriptタグの取得
	public function getScript($file)
	{

		$path = $this->getRootUrl() .'/webroot'. $this->js . $file;

		return '<script type="text/javascript" src=' . $path . '></script>'; 
	}

	//imgパスの取得
	public function getImgPath($file)
	{
		return $this->getRootUrl() .'/webroot'. $this->img . $file;
	}

	//cssリンクタグの取得
	public function getCss($file)
	{
		$path = $this->getRootUrl() .'/webroot'. $this->css . $file;

		return '<link rel="stylesheet" type="text/css" href=' . $path . ' />'; 
	}

	public function getRootUrl()
	{
		return 'http://' . $_SERVER['HTTP_HOST'];
	}

	//主にxss対策
	public function h($value)
	{
		return htmlspecialchars($value,ENT_QUOTES);
	}

	//修正用
	public function debug($value)
	{
		echo '<pre>';
		echo print_r($value,true);
		echo '</pre>';
	}






}