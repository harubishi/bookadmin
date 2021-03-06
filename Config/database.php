<?php

class Database
{

	private $default;
	private $development =[
		'host' => 'localhost',
		'database' => 'book_manager',
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

	//トランザクション処理開始
	public function beginTransaction()
	{
		return $this->pdo->beginTransaction();
	}

	//sqlを実行する関数
	public function execute($sql,$params){
		try{
			//SQLジェックション
			$stmt = $this->pdo->prepare($sql);
			$stmt->execute($params);

			return $stmt;

		}catch(PDOException $e){
			echo $e->getMessage();
			exit;
		}
	}

	//DB処理全てが成功したらOK
	public function commit()
	{
		$this->pdo->commit();
	}

	//DB処理が1つでもミスったら今までのDB処理を全部元に戻す
	public function rollBack()
	{
		$this->pdo->rollBack();
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
