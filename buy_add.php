<?php
require_once('./Config/loader.php');
require_once('./Model/Table/BookTable.php');
require_once('./Model/Table/WarehouseTable.php');
require_once('./Model/Table/SaleTable.php');
$loader = new Loader;
$loader->siteSetting->setMeta([
	'title' => '購入画面',
	'h1' => '購入画面'
]);
$BookTable = new BookTable;
$BookRowset = $BookTable->getRowsetByStoreId($_GET['id']);
if($loader->Request->isPost()){
	$BookTable->beginTransaction();
	try{
		foreach($_POST as $key => $params){
			if($params['quantity'] > 0){
				$WarehouseTable = new WarehouseTable;
				$SaleTable = new SaleTable;
				$params['left_quantity'] = $BookRowset[$key]->getQuantity() - $params['quantity'];
				$WarehouseTable->set($params);
				$SaleTable->set($params);

				$WarehouseTable->update();
				$SaleTable->save();
			}
		}
	}catch(Exception $e){
		echo $e->getMessage();
		$BookTable->rollBack();
		exit;
	}

	$BookTable->commit();
	header('Location:index.php');
	exit;
}	

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
	<form action="" method="POST">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>ISBN</th>
				<th>本</th>
				<th>金額</th>
				<th>数量</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($BookRowset as $key => $BookRow): ?>
				<tr>
					<td>
						<?php echo $loader->View->h($BookRow->getIsbn()); ?>
					</td>
					<td>
						<?php echo $loader->View->h($BookRow->getName()); ?>
					</td>
					<td><?php echo $loader->View->h($BookRow->getPrice()); ?></td>
					<td>
						<select name="<?php echo $key; ?>[quantity]">
							<?php for($i = 0;$i < 4; $i++):?>
								<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
							<?php endfor;?>
						</select>
					</td>
				</tr>

				<input type="hidden" name="<?php echo $key; ?>[id]" value="<?php echo $loader->View->h($BookRow->getId()); ?>">
				<input type="hidden" name="<?php echo $key; ?>[w_id]" value="<?php echo $loader->View->h($BookRow->getWarehouseId()); ?>">
				<input type="hidden" name="<?php echo $key; ?>[price]" value="<?php echo $loader->View->h($BookRow->getPrice()); ?>">
				<input type="hidden" name="<?php echo $key; ?>[s_id]" value="<?php echo $loader->View->h($BookRow->getStoreId()); ?>">
			<?php endforeach ?>
		</tbody>
	</table>


			<div class="form-group text-center">
				<input type="submit" class="btn btn-default" value="キャンセル">
				<input id="buy" type="submit" class="btn btn-primary" value="購入する">
			</div>		
	</form>


<script>
var buy = document.getElementById('buy');
buy.onclick = function(){
	if(!confirm('購入しますか?')){
		return false;
	}
};
</script>
</body>
</html>