	$('#add').click(function(){
		$('#cruddata').hide().load('contents/add.php').fadeIn(1000);
	});

	$('#cruddata').on("click", "#add", function(){
		let productCode = $('#productcode').val();
		let productName = $('#productname').val();
		let productPrice = $('#productprice').val();
		if(productCode == '' || productName == '' || productPrice == ''){
			alert("Form data is empty, please try again");
		}else{
			$.ajax({
				url: 'contents/add.php?page=add',
				type: 'post',
				data: 'productcode='+productCode+'&productname='+productName+'&productprice='+productPrice,
				success: function(response){
					if(response == 'success'){
						$('#viewdata').load('contents/view.php?page=add').fadeIn(1000);
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


//proses edit data with ajax
$('#cruddata').on("click", "#edit", function(){
	let productCode = $('#productcode').val();
	let productName = $('#productname').val();
	let productPrice = $('#productprice').val();

	let productId = $('#productid').val();
	if(productcode == '' || productname == '' || productprice == ''){
			alert("Form data is empty, please try again");
		}else{
		$.ajax({
			url: 'contents/edit.php?page=edit',
			type: 'post',
			data: 'productcode='+productCode+'&productname='+productName+'&productprice='+productPrice+'&productid='+productId,
			success: function(response){
				if(response == 'success'){
					$('#viewdata').load('contents/view.php?page=edit').fadeIn(1000);
					$('#cruddata').hide('slow');
				}else{
					alert("Failed edit product data");
				}
			}
		});
	}

});

$('#viewdata').on("click", ".del", function(){
	let id = $(this).attr('id');
	let ask = confirm("are you sure ? ");
	if(ask){
		$.ajax({
			url: 'contents/delete.php?page=del',
			type: 'post',
			data: 'id='+id,
			success: function(response){
				if(response){
					$('#viewdata').load('contents/view.php?page=del').fadeIn();
					$('#cruddata').hide('slow');
				}else{
					alert("Failed deleted product");
				}
			}
		})
	}
})