// dedicated untuk istriku tercinta : Iim Marlina
// pujiermanto@sidoarjo-2020
$('#add').click(function(){
	$('#animated').load('contents/animated2.php').fadeIn(2500);
		setTimeout(function(){
			$('#animated').hide('slow').slideUp(1000);
			$('#cruddata').hide().load('contents/add.php').fadeIn(1000);
		}, 2500);
});
$('#cruddata').on('click', '#close', function(){
	$('#animated').load('contents/animated.php').fadeIn(1000);
	$('#cruddata').hide('slow').slideUp(1000);
	setTimeout(function(){
		$('#animated').hide('slow').fadeOut(1000);
	}, 2500);
})

$(document).ready(function(){

	$('#viewdata').load('contents/view.php').fadeIn(1000);

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
						if(response){
							Swal.fire({
							  title: 'New Product Has Benn Added',
							  text: "Success Addedd new product : "+productName,
							  icon: 'info',
							  showCancelButton: false,
							  confirmButtonColor: '#8086ff',
							  cancelButtonColor: '#d33',
							  confirmButtonText: 'View Product!'
							}).then((result) => {
							  if (result.value) {
							  	$('#cruddata').hide('slow').fadeOut(1000);
							    $('#animated').load('contents/animated.php').fadeIn(2500);
							    setTimeout(function(){
							    	$('#viewdata').load('contents/view.php').fadeIn(100);
							    	$('#animated').hide('slow').slideUp(1000);
							    }, 3000);
							    Swal.fire(
							      'New product has been added',
							      'Your file has been saved on database.',
							      'success'
							    );
							  }
							})							
						
						}else{
							alert("Failed add new product");
						}
					}
				});
			}
		});

		$('#viewdata').on('click', '.edit', function(){
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
						if(response){
							$('#animated').load('contents/animated.php').fadeIn(1000);
							setTimeout(function(){
								$('#viewdata').load('contents/view.php').fadeIn(1000);
								$('#cruddata').hide('slow').fadeOut(1000);
							}, 1000);
							setTimeout(function(){
								$('#animated').hide('slow').fadeOut(1000);
							}, 5000);
							
						}else{
							alert('Failed update');
						}
					}
				});
			}

		});

		$('#viewdata').on('click', '.del', function(){
			const id = $(this).attr('id');
			Swal.fire({
			  title: 'Are you sure?',
			  text: "You won't be able to revert this!",
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
			  if (result.value) {
			  	$.ajax({
					url: 'contents/delete.php?page=del',
					type: 'post',
					data: 'id='+id,
					success: function(response){
						if(response){
							$('#cruddata').hide('slow').fadeOut(1000);
						}else{
							alert('Failed deleted data');
						}
					}
				});
			    Swal.fire(
			      'Deleted!',
			      'Your product data with product id : '+id+', success deleted.',
			      'success'
			    );
			    $('#animated').load('contents/animated.php').fadeIn(1500);
			    setTimeout(function(){
			    	$('#animated').hide('slow').slideUp(1000);
			    	$('#viewdata').load('contents/view.php').fadeIn(1000);
			    }, 1500);
			  }
			});



	});
});