$(document).ready(function(){
    $('#product-data').load('contents/product_data.php').fadeIn(1000);
    $('#modal-detail').load('contents/modal.php');
    $('#paging').load('contents/paging.php');
    $('#keyword').trigger('focus');
});