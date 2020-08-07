<?php  
require_once '../functions.php';
$limit = 3;
$countPage = count(view("SELECT * FROM `product`"));
$totalPage = ceil($countPage / $limit);
$aktifPage = (is_numeric(@$_GET['page'])) ? @$_GET['page'] : 1 ;
$limitStart = ($limit * $aktifPage) - $limit;

?>
<span id="nav-page">
<nav aria-label="Page navigation example">
  <ul class="pagination">
    <?php if($aktifPage > 1): ?>
    <li class="page-item"><a class="page-link" data-num="<?=$aktifPage - 1?>" href="#">Previous</a></li>
    <?php else: ?>
    <li class="page-item disabled"><a class="page-link" data-num="<?=$aktifPage - 1?>" href="#">Previous</a></li>
    <?php endif; ?> 
</span>
    <?php for($i=1; $i<=$totalPage; $i++): ?>
      <?php if($i == $aktifPage): ?>
        <li class="page-item active" aria-current="page"><a class="page-link" data-num="<?=$i?>" href="#"><?=$i?><span class="sr-only">(current)</span></a></li>
      <?php else: ?>
        <li class="page-item"><a class="page-link" data-num="<?=$i?>" href="#"><?=$i?></a></li>
      <?php endif; ?>
    <?php endfor; ?>
    <?php if($aktifPage < $totalPage): ?>
    <li class="page-item"><a class="page-link" data-num="<?=$aktifPage + 1?>" href="#">Next</a></li>
    <?php else: ?>
    <li class="page-item disabled"><a class="page-link" data-num="<?=$aktifPage + 1?>" href="#">Next</a></li>
  <?php endif; ?>
  </ul>
</nav>

<script type="text/javascript">
$('.disabled').css({
    'cursor':'not-allowed'
  });
  
  $('.page-link').click(function(){
    const pageNum = $(this).data('num');
    $.ajax({
      url: 'contents/paging.php?page='+pageNum,
      method: 'POST',
      data: 'pageNum='+pageNum,
      success: function(response){
        if(response){
          $('#nav-page').html(response);
        }
      }
    });
  });
</script>