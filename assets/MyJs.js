$('#add').click(function(){
	$('#cruddata').hide().load('contents/add.php').fadeIn(1000);
});

$('#reload').click(function(){
	$('#cruddata').hide('slow').fadeOut(1000);
	location.reload();
});

$('#cruddata').on('click', '#add', function(){
	const productCode = $('#productcode').val();
	const productName = $('#productname').val();
	const productPrice = $('#productprice').val();

	if(productCode == '' || productName == '' || productPrice == ''){
		alert("Form data is empty, please try again");
	}else{
		$.ajax({
			url: 'contents/add.php?page=add',
			type: 'post',
			data: 'productcode='+productCode+'&productname='+productName+'&productprice='+productPrice,
			success: function(response){
				if(response == 'success'){
					$('#viewdata').load('contents/view.php?page=add').fadeIn(100);
					$('#cruddata').hide('slow').fadeOut(1000);
					location.reload();
				}else{
					alert("Failed add new product");
				}
			}
		});
	}
});

$('.edit').on('click', function(){
	//ambil attribute id dari table data
	const id = $(this).attr('id');

	$.ajax({
		url: 'contents/edit.php',
		type: 'post',
		data: 'id='+id,
		success: function(response){
			$('#cruddata').hide().fadeIn(1000).html(response);
		}
	});
});

//proses edit 
$('#cruddata').on('click', '#edit', function(){
	const productCode = $('#productcode').val();
	const productName = $('#productname').val();
	const productPrice = $('#productprice').val();
	const productId = $('#productid').val();

	if(productCode == '' || productName == '' || productPrice == ''){
		alert('No update !');
		$('#cruddata').hide('slow').fadeOut(1000);
	}else{
		$.ajax({
			url: 'contents/edit.php?page=edit',
			type: 'post',
			data: 'productcode='+productCode+'&productname='+productName+'&productprice='+productPrice+'&productid='+productId,
			success: function(response){
				if(response == 'success'){
					$('#viewdata').load('contents/view.php?page=edit').fadeIn(1000);
					$('#cruddata').hide('slow').fadeOut(1000);
					location.reload();
				}else{
					alert('Failed update');
				}
			}
		});
	}

});

$('#viewdata').on('click', '.del', function(){
	const id = $(this).attr('id');
	const ask = confirm('Are you sure ? ');

	if(ask){
		$.ajax({
			url: 'contents/delete.php?page=del',
			type: 'post',
			data: 'id='+id,
			success: function(response){
				if(response){
					alert("delete product where id = "+id);
					$('#viewdata').load('contents/view.php?page=del').fadeIn(1000);
					$('#cruddata').hide('slow').fadeOut(1000);

				}else{
					alert('Failed deleted data');
				}
			}
		})
	}
})