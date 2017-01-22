<?php

class View{

	private $path = 'http://' . $_SERVER['HTTP_HOST'];
	private $layout = '/Layout/';
	private $element = '/Element/';
	private $js = '/js/';
	private $css = '/css/';
	private $img = '/img/';
	
	//Layoutファルダ以下を読み込む
	public function  getLayout($file)

		return include_once( $this->path . $this->layout . $file . '.php');
	}

	//Elementフォルダ以下を読み込む
	public function getElement($file)
	{
		return include_once( $this->path . $this->element . $file . '.php');
	}

	//scriptタグの取得
	public function getScript($file)
	{
		$path = $this->path . $this->js . $file;

		return '<script type="text/javascript" src="{$path}"></script>'; 
	}

	//imgパスの取得
	public function getImgPath($file)
	{
		return $this->path . $this->img . $file;
	}

	//cssリンクタグの取得
	public function getCss($file)
	{
		$path = $this->path . $this->css . $file;

		return '<link rel="stylesheet" type="text/css" href="{$path"} />'; 
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