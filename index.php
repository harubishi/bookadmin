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
			<th>ID</th>
			<th>店舗名</th>
			<th>住所</th>
			<th>電話番号</th>
			<th>編集</th>
			<th>削除</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($StoreRowset as $StoreRow): ?>
			<tr>
				<th 
					class="js-store-id-space" 
					data-store-id="<?php echo $loader->View->h($StoreRow->getId()); ?>"
				>
					<?php echo $loader->View->h($StoreRow->getId()); ?>
					
				</th>
				<td><?php echo $loader->View->h($StoreRow->getName()); ?></td>
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
		<?php endforeach; ?>
	</tbody>
</table>

<a href="<?php $loader->View->getRootUrl(); ?>/store_add.php" class="btn btn-primary">
	店舗登録
</a>

<script>

(function(){
	//document.getElementById(id) 要素を取得
	//document.getElementsByClassName(class) クラス要素を取得
	//document.getElementsByTagName(tag) tagの要素を取得
	addListener(document.getElementById('js-store-table'),'click',function(e){
		//e.targetでイベントが発生した場所をとれる
		
		if(e.target.classList[0] !== 'js-delete-store-row-button'){
			return;
		}

		if(!window.confirm('本当に削除してもよろしいですか?')){
			return;
		}
		var tr = e.target.parentNode.parentNode;
		$.ajax({
			type : 'POST',
			datatype : 'JSON',
			data : {'id' : tr.firstElementChild.getAttribute('data-store-id')},
			url : document.getElementById('ajax-url-list').getAttribute('data-delete-store-url')

		}).done(function(response){
			tr.parentNode.removeChild(tr);
		}).fail(function(error){
			//var errorText = JSON.parse(error.responseText);
			alert('保存に失敗しました');
		});
	});
})();

function addListener(elem,event,listener){
	if(elem.addEventListener){
		elem.addEventListener(event,listener,false);
	}else if(elem.attachEvent){
		elem.attachEvent('on' + event,listener);
	}else{
		throw new Error('イベントリスナ未対応')
	}
}
</script>


</body>
</html>