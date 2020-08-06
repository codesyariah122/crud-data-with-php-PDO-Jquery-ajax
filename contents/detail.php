<style type="text/css">
	.polygon{
		clip-path: polygon(25% 0%, 75% 0%, 100% 50%, 75% 100%, 25% 100%, 0% 50%);
	}
</style>
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
		  <img id="setan" src="assets/images/<?=$data['product_image']?>" class="card-img-top polygon" alt="<?=$data['product_name']?>">
		  <div class="card-body">
		  	<h3 class="text-primary"><?=$data['product_name']?></h3>
		    <p class="card-text">
		    	IDR - <?=number_format($data['product_price'], 2)?>
		    </p>
		    <p class="blockquote-footer">
		    	<?=$data['product_description']?>
		    </p>
		    <div id="reaction">
		    	<input type="hidden" id="id_react" name="id_react" value="<?=$data['id_react']?>">
		    </div>
		  </div>
		</div>
	</div>
<?php endforeach; ?>


<script type="text/javascript" src="assets/js/getReaction.js"></script>