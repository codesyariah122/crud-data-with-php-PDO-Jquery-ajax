$('#reaction').load('contents/reaction.php');
	// $('.polygon').mouseenter(function(){
 //   		$(this).removeClass('polygon');
	// });
	// $('.polygon').mouseleave(function(){
	// 	$(this).addClass('polygon');
	// })
var image = document.querySelector('.polygon')

image.addEventListener('mouseenter', function(){
	image.classList.remove('polygon');
});
image.addEventListener('mouseleave', function(){
	image.classList.add('polygon');
});


$(document).ready(function(){
	const reactId = $('input[type=hidden][name=id_react]').val();
	$.ajax({
		url: 'contents/reaction.php?react_id='+reactId,
		type: 'post',
		data: 'reactId='+reactId,
		success: function(response){
			if(response){
				$('#reactId').attr("value",reactId);
			}
		}
	})
})