<?php 
require_once '../functions.php';
//echo @$_GET['page'];
$limit = 3;
$jmlData = count(view("SELECT * FROM `product`"));
$jmlHalaman = ceil($jmlData / $limit);
$aktifPage = (is_numeric(@$_GET['page'])) ? @$_GET['page'] : 1;
$limitStart = ($perPage * $aktifPage) - $limit; 
?>

<span id="prev">
<nav aria-label="Page navigation example">
  <ul class="pagination">
<?php if($aktifPage > 1): ?>    
    <li class="page-item"><a class="page-link" href="#" data-num="<?=$aktifPage-1?>">Previous</a></li>
<?php endif; ?>
</span>
<?php for($i=1; $i<=$jmlHalaman; $i++): ?>
  <?php if($i == $aktifPage): ?>
    <li class="page-item"><a class="page-link" href="#" data-num="<?=$i?>"><?=$i?></a></li>
<?php else: ?>
   <li class="page-item"><a class="page-link" href="#" data-num="<?=$i?>"><?=$i?></a></li>
<?php endif; ?>
<?php endfor; ?>

<?php if($aktifPage < $jmlHalaman): ?>
    <li class="page-item"><a class="page-link" href="#" data-num="<?=$aktifPage+1?>">Next</a></li>
<?php endif; ?>
  </ul>
</nav>

<script type="text/javascript">
$('.page-link').click(function(){
    const pageNum = $(this).data('num');

    $.ajax({
        url: 'contents/paging.php?page='+pageNum,
        type: 'post',
        data: 'pageNum='+pageNum,
        success: function(response){
            if(response){
                //alert(response);
                $('#prev').html(response);                
            }
        }
    });
});
</script>