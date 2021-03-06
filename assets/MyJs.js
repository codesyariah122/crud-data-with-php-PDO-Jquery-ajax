$('#add').click(function(){
	//Swal.fire("Hallo world");
	$('#cruddata').hide('slow').fadeOut(1000);
	$('#animasi').load('contents/animated.php').fadeIn(1500);
	setTimeout(function(){
		$('#cruddata').hide().load('contents/add.php').fadeIn(1000);
		$('#animasi').hide('slow').slideUp(1000);
	}, 2500);
	
});

$('#cruddata').on('click', '#close', function(){
	$('#animasi').load("contents/animated2.php").fadeIn(2500);
	$('#cruddata').hide('slow').slideUp(1000);
	setTimeout(function(){
		$('#animasi').hide('slow').slideUp(1000);
	}, 3000);
});

$('#viewdata').on('keyup', '#keyword', function(){
	$('.loader').show();
	const keyword = $('#keyword').val();

	$.ajax({
		url: 'contents/product_data.php?keyword='+keyword,
		type: 'post',
		data: 'keyword='+keyword,
		success: function(response){
			if(response){
				$('.loader').hide('slow').fadeOut(1000);
				$('#product-data').html(response);
			}else{
				Swal.fire("Data no found");
			}
		}
	});
});

$(document).ready(function(){
	// load view data 
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
				startTime: new Date().getTime(),
				data: 'productcode='+productCode+'&productname='+productName+'&productprice='+productPrice,
				success: function(response){
					if(response == 'success'){
						let time = (new Date().getTime() - this.startTime);
						console.log("This request took "+time+" ms");
						Swal.fire({
						  title: 'New product added',
						  text: "You product will be saved, product name : "+productName,
						  icon: 'success',
						  showCancelButton: false,
						  confirmButtonColor: '#808fe6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'View Data Product'
						}).then((result) => {
						  if (result.value) {
						  	$('#cruddata').hide('slow').fadeOut(1000);
						  	Swal.fire(
						      'New product Saved : '+productCode,
						      'Your product data has been saved.',
						      'success'
						    );
							$('#animasi').load('contents/animated.php').fadeIn(2500);
							setTimeout(function(){
								$('#viewdata').load('contents/view.php').fadeIn(100);
								$('#animasi').hide('slow').slideUp(1000);
							}, time);
						  }
						});


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
				startTime: new Date().getTime(),
				data: 'productcode='+productCode+'&productname='+productName+'&productprice='+productPrice+'&productid='+productId,
				success: function(response){
					if(response=='success'){
						let time = (new Date().getTime() - this.startTime);
						console.log("This request took "+time+" ms");

						$('#cruddata').hide('slow').fadeOut(1000);
						$('#animasi').load('contents/animated2.php').fadeIn(1500);
						setTimeout(function(){
							$('#viewdata').load('contents/view.php').fadeIn(1000);
							$('#animasi').hide('slow').slideUp(1000);
						}, time);
						
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
				startTime: new Date().getTime(),
				success: function(response){
					if(response){
						let time = (new Date().getTime() - this.startTime);
						console.log("This request took "+time+" ms");

						$('#cruddata').hide('slow').fadeOut(1000);
							Swal.fire(
						      'Deleted! product data with id : '+id,
						      'Your data has been deleted.',
						      'success'
						    );
						$('#animasi').load('contents/animated.php').fadeIn(1000);
						setTimeout(function(){
							$('#animasi').hide('slow').slideUp(1000);
							$('#viewdata').load('contents/view.php').fadeIn(1000);
						}, time);   

					}else{
						alert('Failed deleted data');
					}
				}
			});

		  }
		});


	});
});

