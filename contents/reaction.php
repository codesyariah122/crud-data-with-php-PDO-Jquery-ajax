<?php  require_once '../functions.php';?>

<style type="text/css">
	input[type="checkbox"]{
			display: none;
		}

		.emoji-label{
			cursor: pointer;
			font-size: 2rem;
			margin-left:0.3rem;
			margin-top:-1rem;
		}
</style>
<?php 
if(@$_GET['react_id']):
	$dataId = @$_GET['react_id']; 
endif; 
?>

<input type="hidden" name="reactId" id="reactId" value="<?=$dataId?>">

<input type="checkbox" id="love" value="love" name="reactemoji" class="reaction">
<label for="love" class="emoji-label">love</label>
<input type="checkbox" id="likes" value="likes" name="reactemoji" class="reaction">
<label for="likes" class="emoji-label">like</label>
<input type="checkbox" id="clapping" value="clapping" name="reactemoji" class="reaction">
<label for="clapping" class="emoji-label">clapping</label>
<input type="checkbox" id="cool" value="cool" name="reactemoji" class="reaction">
<label for="cool" class="emoji-label">cool</label>

<div id="react-value"></div>

<script type="text/javascript">

function emojiReact(emoji=[]){
	for(let i = 0; i<=emoji.length; i++){
		$('.emoji-label').eq(i).html(emoji[i]);
		let emojiLabel = document.querySelector('.emoji-label')[i];
	}
}
emoji = ['&#128157;', '&#128077;', '&#128079;&#127996;', '&#129321;'];
emojiReact(emoji);

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

</script>