function emojiReact(emoji=[]){
	document.getElementById('react-onclick').style.display="none";
	for(let i = 0; i<=emoji.length; i++){
		document.getElementsByClassName("emoji-label")[i].classList.remove('display');
		$('.emoji-label').eq(i).html(emoji[i]);
		let emojiLabel = document.querySelector('.emoji-label')[i];
	}
}
emoji = ['&#128157;', '&#128077;', '&#128079;&#127996;', '&#129321;'];

$(document).ready(function(){
	$('#react-value').load('contents/react_data.php');
	$('input[type=checkbox]').click(function(){
		const reactEmoji = $('input[name=reactemoji]:checked').val();
		const reactId = $('input[type=hidden][name=reactId]').val();
		if(reactEmoji){
			switch(reactEmoji){
				case "love":
				emoji = "&#128157;";
				break;
				case "likes":
				emoji = "&#128077;";
				break;
				case "clapping":
				emoji = "&#128079;&#127996;";
				break;
				case "cool":
				emoji = "&#129321;";
				break;
			}
			$.ajax({
				url: 'contents/react_data.php?reactemoji='+reactEmoji+'&reactid='+reactId,
				type: 'post',
				data: 'reactEmoji='+reactEmoji+'&reactId='+reactId,
				success: function(response){
					if(response){
						//Swal.fire(response);
						Swal.fire("Your reaction : "+emoji);
						$('#react-value').html(response);
						$('input[name=reactemoji]').prop('checked', false);
					}
				}
			})
		}
	})
})





// $(document).ready(function(){
// 	$('input[type=checkbox]').click(function(e){
// 		let reaction = [];
// 		$.each($("input[name='reactemoji']:checked"), function(){
// 			reaction.push($(this).val());
// 		});
// 		Swal.fire("Your reaction : "+reaction.join(','))
// 	});
// });


// reaction.addEventListener('change', function(){	
// 	if(this.checked){
// 		console.log(reactEmoji.value);
// 	}else{
// 		console.log("Not change");
// 	}
// })
