<?php  
require_once '../functions.php';

$id = @$_POST['id'];

$viewById = view("SELECT * FROM `product` WHERE `id` = '$id'");

//var_dump($viewById);

if(@$_GET['page'] == 'edit'):
	if(editAjax($_POST, 'product') > 0):
		echo @$_POST;
	endif;
else:
?>
<style type="text/css">
	li{
		list-style: none;
	}
	#close{
		margin-top:-0.5rem;
	}
</style>
<fieldset class="card mt-5 mb-5">
	<div class="row justify-content-end">
		<button id="close" class="btn btn-md"><i class="far fa-fw fa-window-close fa-lg"></i></button>
	</div>
	<h4 class="text-info text-center"><b>Edit Product Data</b></h4>

	<ul>
		<li>
			<input type="hidden" id="productid" value="<?=$viewById[0]['id']?>">
			<label for="productcode">Product Code</label>
			<input type="text" id="productcode" class="form-control" value="<?=$viewById[0]['product_code']?>">
		</li>
		<li>
			<label for="productname">Product Name</label>
			<input type="text" id="productname" class="form-control" value="<?=$viewById[0]['product_name']?>">
		</li>
		<li>
			<label for="productprice">Product Price</label>
			<input type="number" id="productprice" class="form-control" value="<?=$viewById[0]['product_price']?>">
		</li>
		<li>
			<button id="edit" class="mt-5 btn btn-primary btn-lg">Edit Product</button>
		</li>
	</ul>

</fieldset>

<?php endif; ?>