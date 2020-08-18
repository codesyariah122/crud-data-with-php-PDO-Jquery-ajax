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