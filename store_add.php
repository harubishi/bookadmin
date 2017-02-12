<?php

require_once('./Config/loader.php');
require_once('./Config/database.php');

$loader = new Loader;
$loader->siteSetting->setMeta([
	'title' => '店舗登録画面',
	'h1' => '店舗登録'
]);

if($loader->Request->isPost())
{
	$formData = $_POST['Store'];
	$result = TRUE;

	if(empty($formData['name'])){
		$errors['Store']['name'] = '支店名を入力してください';
		$result = FALSE;
	}elseif(mb_strlen($formData['name'],'UTF8') >= 20){
		$errors['Store']['name'] = '支店名は20文字以内です';
		$result = FALSE;
	}

	if(empty($formData['address'])){
		$errors['Store']['address'] = '住所を入力してください';
		$result = FALSE;
	}elseif(mb_strlen($formData['address'],'UTF8') >= 255){
		$errors['Store']['address'] = '住所は255文字以内です';
		$result = FALSE;
	}

	if(empty($formData['telephone'])){
		$errors['Store']['telephone'] = '電話番号を入力してください';
		$result = FALSE;
	}elseif(mb_strlen($formData['telephone'],'UTF8') >= 20){
		$errors['Store']['telephone'] = '電話番号は20文字以内です';
		$result = FALSE;
	}

	if($result){
		$Database = new Database;
		/*
			//登録sql
			INSERT INTO テーブル名(カラム名) VALUES(値);	カラム名は省略可能
		*/
		$sql ="INSERT INTO store(name,address,telephone,created,modified) VALUES(?,?,?,?,?)"; 
		$params =[$formData['name'],$formData['address'],$formData['telephone'],date('Y-m-d H:i:s'),date('Y-m-d H:i:s')];

		$Database->execute($sql,$params);

		header('Location: index.php');
		exit;

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
			class="form-group <?php echo !empty($errors['Store']['name'])? 'has-error' : ''; ?>"
		>
			<label class="col-sm-2 control-label" for="InputName">支店名</label>
			<div class="col-sm-10">
				<input 
					type="text" 
					name="Store[name]" 
					value="<?php echo !empty($formData['name'])? $formData['name'] : ''; ?>" 
					class="form-control" 
					id="InputName" 
					placeholder="支店名"
				>
				<?php if(!empty($errors['Store']['name'])): ?>
					<div class="text-danger">
						<?php echo $loader->View->h($errors['Store']['name']); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<div class="form-group <?php echo !empty($errors['Store']['address'])? 'has-error' : ''; ?>">
			<label class="col-sm-2 control-label" for="InputAddress">住所</label>
			<div class="col-sm-10">
				<input
					type="text" 
					name="Store[address]" 
					value="<?php echo !empty($formData['address'])? $formData['address'] : ''; ?>"
					class="form-control" 
					id="InputAddress" 
					placeholder="住所"
				>
				<?php if(!empty($errors['Store']['address'])): ?>
					<div class="text-danger">
						<?php echo $loader->View->h($errors['Store']['address']); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<div class="form-group <?php echo !empty($errors['Store']['telephone'])? 'has-error' : ''; ?>">
			<label class="col-sm-2 control-label" for="InputTelephone">電話番号</label>
			<div class="col-sm-10">
				<input
				 	type="text" 
				 	name="Store[telephone]" 
				 	value="<?php echo !empty($formData['telephone'])? $formData['telephone'] : ''; ?>"
				 	class="form-control" 
				 	id="InputTelephone" 
				 	placeholder="電話番号">
				 <?php if(!empty($errors['Store']['telephone'])): ?>
					<div class="text-danger">
						<?php echo $loader->View->h($errors['Store']['telephone']); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>


		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-primary">送信</button>
			</div>
		</div>
	</form>


</body>
</html>