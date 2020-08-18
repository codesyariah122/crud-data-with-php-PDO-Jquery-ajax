	$('#reaction').load('contents/reaction.php').fadeIn(1000);
	var image = document.querySelector('.card-img-top');
	
	image.classList.add('product-img');
	image.addEventListener('mouseenter', function(){
		image.classList.remove('product-img');
	});
	image.addEventListener('mouseleave', function(){
		image.classList.add('product-img');
	});

	$(document).ready(function(){
		const reactId = $('input[type=hidden][name=id_react]').val();
		$.ajax({
			url: 'contents/reaction.php?react_id='+reactId,
			type: 'post',
			data: 'reactId='+reactId,
			success: function(response){
				if(response){
					$('#reactId').attr('value', reactId);
				}
			}
		})
	});