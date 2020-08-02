<?php
require_once '../functions.php';
	//echo "?page=".@$_GET['page'];
$limit = 3;
$jmlData = count(view("SELECT * FROM `product`"));
$jmlHalaman = ceil($jmlData / $limit);
$aktifPage = ((int)@$_GET['page']) ? @$_GET['page'] : 1;
$limitStart = ($aktifPage - 1)*$limit;
switch(@$_GET['page']):
	case @$_POST['keyword']:
	$keyword = @$_POST['keyword'];
	$no = $limitStart+1;
	$viewData = searchData($keyword, $limitStart, $limit);
	break;
	case @$_GET['page']:
	$no = $limitStart+1;
	$viewData = view("SELECT * FROM `product` ORDER BY `id` DESC LIMIT $limitStart, $limit");
endswitch;

// if(@$_GET['page'] == @$_POST['keyword']):
//   $keyword = @$_POST['keyword'];
//     //usleep(700000);
//     $viewData = searchData($keyword, $limitStart, $limit);
// endif;
?>


<?php if(empty($viewData)): ?>
  <tr>
    <td colspan="5" style="color:red; font-weight: bold; text-align:center;">No data on this table product</td>
  </tr>
<?php endif; ?>


 <?php foreach($viewData as $view): ?>
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

