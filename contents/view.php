<?php 
require_once '../functions.php';

$viewData = view("SELECT * FROM `product`"); 

?>

<h1 class="text-primary text-center mt-4 pt-4">Product Table</h1>
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Product Code</th>
      <th scope="col">Product Name</th>
      <th scope="col">Product Price</th>
      <th scope="col">Operation Table</th>
    </tr>
  </thead>
  <tbody>
<?php if(empty($viewData)): ?>
  <tr>
    <td colspan="5" class="text-danger text-center">No data on this table product</td>
  </tr>
<?php endif; ?>
<?php $no=1; foreach($viewData as $view): ?>
    <tr>
      <th scope="row"><?=$no?></th>
      <td><?=$view['product_code']?></td>
      <td><?=$view['product_name']?></td>
      <td><?=$view['product_price']?></td>
      <td>
        <button id="<?=$view['id']?>" class="edit btn btn-danger btn-sm"><i class='fas fa-edit'></i></button>
        <button id="<?=$view['id']?>" class="del btn btn-info btn-sm"><i class='fas fa-eraser'></i></button>
      </td>
    </tr>
<?php $no++; endforeach; ?>

  </tbody>
</table>