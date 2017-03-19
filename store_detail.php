<?php

require_once('./Config/loader.php');
require_once('./Model/Table/StoreTable.php');
$loader = new Loader;

$Store = new StoreTable;
$StoreRow= $Store->getRowById($_GET['id']);

$loader->siteSetting->setMeta([
	'title' => '店舗登録画面',
	'h1' => $StoreRow->getName()
]);


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $loader->siteSetting->getTitle(); ?></title>
	<?php echo $loader->View->getCss('bootstrap.min.css'); ?>
	<?php echo $loader->View->getScript('jquery-3.1.1.min.js'); ?>
	<?php echo $loader->View->getScript('bootstrap.min.js'); ?>
</head>
<body style="padding:50px;">

	<?php  include_once($loader->View->getElement('header')); ?>

	<div 
		id="ajax-url-list"
		data-delete-store-url="<?php echo $loader->View->getRootUrl();?>/Ajax/Store/delete.php"
	></div>

	<table id="js-store-table" class="table table-bordered table-responsive table-striped">
	<thead>
		<tr>
			<th>住所</th>
			<th>電話番号</th>
			<th>編集</th>
			<th>削除</th>
		</tr>
	</thead>
	<tbody>

			<tr>
				<td><?php echo $loader->View->h($StoreRow->getAddress()); ?></td>
				<td><?php echo $loader->View->h($StoreRow->getTelephone()); ?></td>
				<td>
					<a 
						href="<?php echo $loader->View->getRootUrl(); ?>/store_edit.php?id=<?php echo $loader->View->h($StoreRow->getId());?>"
						class="btn btn-success">編集
					</a>
				</td>
				<td><button class="js-delete-store-row-button btn btn-danger">削除</button></td>
			</tr>

	</tbody>
</table>

<a class="btn btn-default" href="<?php echo $loader->View->getRootUrl(); ?>">
	一覧に戻る
</a>



</body>
</html>