<?php

class Database
{
	//データベースの接続をする関数
	public function setConnection()
	{
		$pdo =new PDO ("mysql:host=localhost;dbname=test","root","root");
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$pdo->exec("SET NAMES utf8");

	}
}