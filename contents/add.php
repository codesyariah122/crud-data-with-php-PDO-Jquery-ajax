<?php 
require_once '../functions.php'; 
if(@$_GET['page'] == 'add'):
	if( addAjax($_POST, 'product') > 0):
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



<legend><b>Add New Data</b></legend>

<ul>
	<li>
		<label for="productcode">Product Code</label>
		<input type="text" id="productcode" name="productcode">
	</li>
	<li>
		<label for="productname">Product Name</label>
		<input type="text" id="productname" name="productname">
	</li>
	<li>
		<label for="productprice">Product Price</label>
		<input type="number" id="productprice" name="productprice">
	</li>
	<li>
		<button id="add">Add New Product</button>
	</li>
</ul>
</fieldset>

<?php endif;?>