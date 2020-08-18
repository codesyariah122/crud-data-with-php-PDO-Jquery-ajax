	function emojiReact(emoji=[]){
		document.getElementById('react-onclick').style.display='none';
		// console.log(emoji.length);
		for(let i = 0; i <= emoji.length-1; i++){
			$('.emoji-label').eq(i).html(emoji[i]);
			let emojiLabel = document.querySelector('.emoji-label')[i];
			$('.emoji-label').removeClass('display');
		}
	}

	emoji = ['🥰', '&#128077;', '&#128079;', '&#127882;'];

	$(document).ready(function(){
		$('#react-value').load('contents/react_data.php');

		$('input[type=checkbox]').click(function(){
			const reactEmoji = $('input[name=reactemoji]:checked').val();
			const reactId = $('input[type=hidden][name=reactId]').val();

			switch(reactEmoji){
				case "love":
				emoji = '🥰';
				break;
				case "likes":
				emoji = '&#128077;';
				break;
				case "clapping":
				emoji = '&#128079;';
				break;
				case "cool":
				emoji = '&#127882;';
				break;
			}
			
			$.ajax({
				url: 'contents/react_data.php?reactemoji='+reactEmoji+'&reactid='+reactId,
				type: 'post',
				data: 'reactEmoji='+reactEmoji+'&reactId='+reactId,
				success:function(response){
					if(response){
						Swal.fire("Your Reaction : "+emoji);
						$('#react-value').html(response);
						$('input[name=reactemoji]').prop('checked', false);
					}
				}
			})

		})
	})