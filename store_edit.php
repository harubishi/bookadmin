<?php
require_once('./Config/loader.php');
require_once('./Model/Table/StoreTable.php');

$loader = new Loader;
$StoreTable = new StoreTable;
$StoreRow = $StoreTable->getRowById($_GET['id']);

if($loader->Request->isPost()){
 	$StoreTable->set($_POST);
	$formData = $_POST['Store'];

	if($StoreTable ->validate()){
		$StoreTable ->update();
		header('Location: index.php');
		exit;

	}else{
		$errors = $StoreTable->getErrors();
	}
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

	<form method="POST" action="" class="form-horizontal">
		<div 
			class="form-group <?php echo !empty($errors['name'])? 'has-error' : ''; ?>"
		>
			<label class="col-sm-2 control-label" for="InputName">支店名</label>
			<div class="col-sm-10">
				<input 
					type="text" 
					name="Store[name]" 
					value="<?php echo !empty($formData['name'])? $formData['name'] : $StoreRow->getName(); ?>" 
					class="form-control" 
					id="InputName" 
					placeholder="支店名"
				>
				<?php if(!empty($errors['name'])): ?>
					<div class="text-danger">
						<?php echo $loader->View->h($errors['name']); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<div class="form-group <?php echo !empty($errors['address'])? 'has-error' : ''; ?>">
			<label class="col-sm-2 control-label" for="InputAddress">住所</label>
			<div class="col-sm-10">
				<input
					type="text" 
					name="Store[address]" 
					value="<?php echo !empty($formData['address'])? $formData['address'] : $StoreRow->getAddress(); ?>"
					class="form-control" 
					id="InputAddress" 
					placeholder="住所"
				>
				<?php if(!empty($errors['address'])): ?>
					<div class="text-danger">
						<?php echo $loader->View->h($errors['address']); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<div class="form-group <?php echo !empty($errors['telephone'])? 'has-error' : ''; ?>">
			<label class="col-sm-2 control-label" for="InputTelephone">電話番号</label>
			<div class="col-sm-10">
				<input
				 	type="text" 
				 	name="Store[telephone]" 
				 	value="<?php echo !empty($formData['telephone'])? $formData['telephone'] : $StoreRow->getTelephone(); ?>"
				 	class="form-control" 
				 	id="InputTelephone" 
				 	placeholder="電話番号">
				 <?php if(!empty($errors['telephone'])): ?>
					<div class="text-danger">
						<?php echo $loader->View->h($errors['telephone']); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<input type="hidden" name="Store[id]" value="<?php echo $loader->View->h($StoreRow->getId()); ?>" />

		<div class="form-group text-center">

			<a href="<?php echo $loader->View->getRootUrl(); ?>" class="btn btn-default">キャンセル</a>

			<button type="submit" class="btn btn-success">更新</button>			
		</div>

	</form>


</body>
</html>