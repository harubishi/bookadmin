<?php

require_once('./Config/loader.php');
require_once('./Model/Table/StoreTable.php');
$loader = new Loader;
$loader->siteSetting->setMeta([
	'title' => '店舗登録画面',
	'h1' => '店舗登録'
]);
$Store = new StoreTable;
$StoreRowset = $Store->getRowset();

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
			<th>店舗名</th>
			<th>住所</th>
			<th>電話番号</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($StoreRowset as $StoreRow): ?>
			<tr>
				<td>
					<a href="<?php echo $loader->View->getRootUrl(); ?>/buy_add.php?id=<?php echo $loader->View->h($StoreRow->getId());?>">
						<?php echo $loader->View->h($StoreRow->getName()); ?>
					</a>
				</td>
				<td><?php echo $loader->View->h($StoreRow->getAddress()); ?></td>
				<td><?php echo $loader->View->h($StoreRow->getTelephone()); ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
</body>
</html>