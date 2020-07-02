<?php 
require_once '../functions.php'; 

$id = @$_POST['id'];
$viewById = viewEdit('product', $id);
// var_dump($viewById); 

if(@$_GET['page'] == 'edit' || @$_GET['page'] == 'add'):
	if(editAjax($_POST, 'product') > 0):
		echo "success";
	endif;
else:
?>
<style type="text/css">
	li{
		list-style: none;
		margin-bottom: 1rem;
		padding:2px;
	}
	input{
		margin-left: 1rem;
	}
</style>
<fieldset>



<legend><b>Edit Product Data</b></legend>

<ul>
	<li>
		<input type="hidden" name="productid" id="productid" value="<?=$viewById->id?>">
		<label for="productcode">Product Code</label>
		<input type="text" id="productcode" name="productcode" value="<?=$viewById->product_code?>">
	</li>
	<li>
		<label for="productname">Product Name</label>
		<input type="text" id="productname" name="productname" value="<?=$viewById->product_name?>">
	</li>
	<li>
		<label for="productprice">Product Price</label>
		<input type="number" id="productprice" name="productprice" value="<?=$viewById->product_price?>">
	</li>
	<li>
		<button id="edit">Add New Product</button>
	</li>
</ul>
</fieldset>

<?php endif; ?>