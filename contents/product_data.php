<?php 
require_once '../functions.php'; 
if(@$_GET['keyword'] == @$_POST['keyword']):
  $keyword = @$_POST['keyword'];
    //usleep(700000);
    $viewData = searchData($keyword);
endif;   
?>

<?php if(empty($viewData)): ?>
  <tr>
    <td colspan="5" style="color:red; font-weight: bold; text-align:center;">No data on this table product</td>
  </tr>
<?php endif; ?>


<!-- Modal untuk detail product data -->
<div class="modal fade" id="detailData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Product : <span id="product-code"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="detail-product">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


 <?php $no=1; foreach($viewData as $view): ?>
    <tr>
      <th scope="row"><?=$no?></th>
      <td><?=$view['product_code']?></td>
      <td><?=$view['product_name']?></td>
      <td>
        <button id="<?=$view['id']?>" class="edit btn btn-danger btn-sm"><i class='fas fa-edit'></i></button>
        <button id="<?=$view['id']?>" class="del btn btn-info btn-sm"><i class='fas fa-eraser'></i></button>
        <button data-id="<?=$view['id']?>" class="detail btn btn-success btn-sm" data-toggle="modal" data-target="#detailData" data-code="<?=$view['product_code']?>"><i class="fas fa-fw fa-binoculars"></i></button>
      </td>
    </tr>
<?php $no++; endforeach; ?>



