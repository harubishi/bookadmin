<?php

class Database
{

	private $default;
	private $development =[
		'host' => 'localhost',
		'database' => 'test',
		'username' => 'root',
		'password' => 'root',
		'charset' => 'utf8'
	];

	private $production =[
		'host' => '',
		'database' => '',
		'username' => '',
		'password' => '',
		'charset' => ''
	];

	private $pdo;

	//new　クラス名;したときに実行される関数
	public function __construct()
	{
		$this->setEnvironment()->setConnection();
	}

	//sqlを実行する関数
	public function excute($sql,$params){
		try{
			//SQLジェックション
			$stmt = $this->pdo->prepare($sql);
			$stmt->excute($params);

			return $stmt;

		}catch(PDOException $e){
			echo $e->getMessage();
			exit;
		}
	}

	//データベースの接続をする関数
	private function setConnection()
	{
		try{
			$pdo = new PDO ("mysql:host={$this->default['host']};dbname={$this->default['database']}","{$this->default['username']}","{$this->default['password']}");
			$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$pdo->exec("SET NAMES {$this->default['charset']}");

			$this->pdo = $pdo;

		}catch(PDOException $e){
			echo $e->getMessage();
			exit;
		}
	}

	private function setEnvironment()
	{
		if(
			$_SERVER['HTTP_HOST'] == 'www.example.jp' || 
			$_SERVER['HTTP_HOST'] == 'example.jp'
		){
			$this->default = $this->production;
		}else{
			$this->default = $this->development;
		}

		return $this;
	}

}
