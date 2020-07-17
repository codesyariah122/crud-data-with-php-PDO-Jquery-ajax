<?php 
require_once '../functions.php';
if(@$_GET['page'] == 'add'):

	if(addAjax($_POST, 'product') > 0):
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
	<h4 class="text-primary text-center">Add New Product</h4>

	<ul>
		<li>
			<label for="productcode">Product Code</label>
			<input type="text" id="productcode" class="form-control">
		</li>
		<li>
			<label for="productname">Product Name</label>
			<input type="text" id="productname" class="form-control">
		</li>
		<li>
			<label for="productprice">Product Price</label>
			<input type="number" id="productprice" class="form-control">
		</li>
		<li>
			<button id="add" class="mt-5 btn btn-primary btn-lg">Add Product</button>
		</li>
	</ul>

</fieldset>

<?php endif; ?>