<?php 
if(@$_GET['page'] == 'add' || @$_GET['page'] == 'edit' || @$_GET['page'] == 'del'):
	require_once '../functions.php';
else:
	require_once 'functions.php';
endif;
$viewData = view("SELECT * FROM `product`");
// var_dump($viewData); die;

?>

<style type="text/css">
	table{
		border-collapse: collapse;
	}
	th, td{
		padding: 6px;
	}
</style>
<h1>View Product Data</h1>
<table border="1">
	<tr>
		<th>#</th>
		<th>Product Code</th>
		<th>Product Name</th>
		<th>Product Price</th>
		<th>Operation Table</th>
	</tr>
<?php $no=1; foreach($viewData as $v): ?>
	<tr>
		<td><?=$no?></td>
		<td><?=$v['product_code']?></td>
		<td><?=$v['product_name']?></td>
		<td><?=$v['product_price']?></td>
		<td>
			<button class="edit" id="<?=$v['id']?>">Edit</button>
			<button class="del" id="<?=$v['id']?>">Delete</button>
		</td>
	</tr>
<?php $no++; endforeach; ?>
</table>