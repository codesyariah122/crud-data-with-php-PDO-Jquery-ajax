<?php  
require_once '../functions.php';
if(@$_GET['detail']):
	$dataId = @$_GET['detail'];
	$detailData = view("SELECT * FROM `product` WHERE `id` = '$dataId'");
endif;
?>
<?php foreach($detailData as $data): ?>
	<div class="row justify-content-center">
		<div class="card" style="width: 18rem;">
		  <img src="assets/images/<?=$data['product_image']?>" class="card-img-top" alt="<?=$data['product_name']?>">
		  <div class="card-body">
		  	<h3 class="text-primary"><?=$data['product_name']?></h3>
		    <p class="card-text">
		    	IDR - <?=number_format($data['product_price'], 2)?>
		    </p>
		    <p class="blockquote-footer">
		    	<?=$data['product_description']?>
		    </p>
		  </div>
		</div>
	</div>
<?php endforeach; ?>
