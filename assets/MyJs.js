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
		url: 'contents/product_data.php?page='+keyword,
		type: 'post',
		data: 'keyword='+keyword,
		success: function(response){
			if(response){
				//alert(response);
				$('.loader').hide().slideUp(1000);
				$('#product-data').html(response);
			}else{
				Swal.fire('Product data no found');
			}
		}
	});

});


$('#viewdata').on('click', '.page-link', function(){
	const pageNum = $(this).data('num');

	$.ajax({
		url: 'contents/product_data.php?page='+pageNum,
		type: 'post',
		data: 'pageNum='+pageNum,
		success: function(response){
			if(response){
				//alert(response);
				$('#product-data').html(response);
			}
		}
	});
});


$(document).ready(function(){
	// load view data 
	$('#viewdata').load('contents/view.php').fadeIn(1000);

	$('#cruddata').on('click', '#add', function(e){
		const productCode = $('#productcode').val();
		const productImage = $('#productimage').prop('files')[0];
		const productName = $('#productname').val();
		const productDesc = $('#productdescription').val();
		const productPrice = $('#productprice').val();

		if(productCode == '' || productImage == undefined || productName == '' || productPrice == ''){
			alert("Form data is empty, please try again");
			e.preventDefault();
		}else{
			let form_data = new FormData();
			form_data.append('productcode', productCode);
			form_data.append('productimage', productImage);
			form_data.append('productname', productName);
			form_data.append('productdescription', productDesc);
			form_data.append('productprice', productPrice);

			$.ajax({
				url: 'contents/add.php?page=add',
				type: 'post',
				startTime: new Date().getTime(),
				data: form_data,
				processData: false,
				contentType: false,
				cache: false,
				success: function(response){
					if(response){
						// alert(response);
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
		const productImage = $('#productimage').prop('files')[0];
		const productName = $('#productname').val();
		const productDesc = $('#productdescription').val();
		const productPrice = $('#productprice').val();
		const productId = $('#productid').val();

		if(productName == '' || productPrice == '' || productImage == undefined){
			Swal.fire({
			  position: 'top-end',
			  icon: 'success',
			  title: 'No new product update',
			  showConfirmButton: false,
			  timer: 1500
			});
			$('#cruddata').hide('slow').fadeOut(1000);
		}else{
			let form_data = new FormData();
			form_data.append('productid', productId);
			form_data.append('productcode', productCode);
			form_data.append('productimage', productImage);
			form_data.append('productname', productName);
			form_data.append('productdescription', productDesc);
			form_data.append('productprice', productPrice);

			$.ajax({
				url: 'contents/edit.php?page=edit',
				type: 'post',
				startTime: new Date().getTime(),
				data: form_data,
				processData: false,
				contentType: false,
				cache: false,
				async:false,

				success: function(response){
					if(response){
						let time = (new Date().getTime() - this.startTIme);
						console.log("This request took "+time+" ms");

						Swal.fire({
						  title: 'New product update',
						  text: "You product will be saved, product name : "+productName,
						  icon: 'success',
						  showCancelButton: false,
						  confirmButtonColor: '#808fe6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'View Data Product'
						}).then((result) => {
						  if (result.value) {
						  	$('#cruddata').hide('slow').fadeOut(1000);
							$('#animasi').load('contents/animated2.php').fadeIn(2500);
							$('#viewdata').load('contents/view.php').fadeIn(100);
							setTimeout(function(){
								$('#animasi').hide('slow').slideUp(1000);
							}, time);
						  }
						});
						
					}else{
						$('#cruddata').slideUp(1000).hide(1500);
						$('#animasi').load('contents/animated2.php').fadeIn(1000);
						$('#viewdata').load('contents/view.php').fadeIn(1000);
						setTimeout(function(){
							$('#animasi').hide('slow').slideUp(1000);
						}, 2500);
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
				startTime: new Date().getTime(),
				data: 'id='+id,
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

	$('#viewdata').on('click', '.detail', function(){
		const dataId = $(this).data('id');
		const productCode = $(this).attr('data-code');
		$.ajax({
			url: 'contents/detail.php?detail='+dataId,
			type: 'post',
			data: 'dataId='+dataId,
			success: function(response){
				if(response){
					console.log("Ok");
					$('#detail-product').html(response);
					$('#product-code').html(productCode);
					$('#detailData').modal('show');
				}else{
					Swal.fire("No product detail");
				}
			}
		});
	});

});

