<?php 
require_once '../functions.php';
if(@$_GET['page'] == 'add'):
	//addAjax($_POST, $_FILES, 'product');	
	if(addAjax($_POST, $_FILES, 'product') > 0):
		usleep(700000);
		echo $_POST['productcode'] ."<br/>". $_FILES['productimage']['name'] . "<br/>". $_POST['productname'] . "<br/>" .
		$_POST['productdescription'] . "<br/>" . $_POST['productprice'];
		
	endif;

else:



?>

<style type="text/css">
	li{
		list-style: none;
	}
	#close{
		margin-top: -0.7rem;
	}
</style>

<fieldset class="card mt-5 mb-5">

	<div class="row justify-content-end">
		<button id="close" class="btn btn-lg"><i class="far fa-fw fa-lg fa-window-close"></i></button>	
	</div>

	<h4 class="text-primary text-center mt-2">Add New Product</h4>

<div class="col mx-auto">
	<ul>
		<form method="post" enctype="multipart/form-data">
			<li>
				<label for="productcode">Product Code</label>
				<input type="text" id="productcode" class="form-control">
			</li>
			<li>
				<div class="form-group mt-3 mb-3">
					<label for="productimage">Upload product image</label>
					<input type="file" class="form-control-file" id="productimage">
				</div>
			</li>
			<li>
				<label for="productname">Product Name</label>
				<input type="text" id="productname" class="form-control">
			</li>
			<li>
				<label for="productdescription">Product Description</label>
    			<textarea class="form-control" id="productdescription" rows="3" cols="5"></textarea>
			</li>
			<li>
				<label for="productprice">Product Price</label>
				<input type="number" id="productprice" class="form-control">
			</li>	
		</form>	
		<li>
			<button id="add" class="mt-5 btn btn-primary btn-lg">Add Product</button>
		</li>
	</ul>
</div>


</fieldset>

<?php endif; ?>