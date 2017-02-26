<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/Model/Table/StoreTable.php');

$StoreTable = new StoreTable;

if(empty($_POST['id'])){
	http_response_code(400);
	echo  json_encode(['stauts' => 'idがありません']);
	return;
}

if(!$StoreTable->delete($_POST['id'])){
	http_response_code(500);
	echo json_encode(['status' => '保存に失敗しました']);
	return;
}

echo json_encode(['status' => 'OK']);

