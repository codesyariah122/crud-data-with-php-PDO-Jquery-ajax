<?php  
require_once '../functions.php';
$dbh=connect();
if(@$_GET['react_id']):
	$dataId = @$_GET['react_id'];
	$reactData = view("SELECT * FROM `reaction` INNER JOIN `product` ON `reaction`.`id_react` = `product`.`id_react` WHERE `id` = $dataId ");
	echo $reactData[0]['id_react'];
endif;
if(@$_GET['react']):
	$react = @$_POST['react'];
	$idReact = (int)@$_POST['reactId'];
	echo $react."<br/> id : ".$idReact;
endif;
?>

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

<input type="hidden" name="reactId" id="reactId" value="<?=@$_GET['react_id']?>">

<input type="checkbox" id="love" value="love" name="reactemoji" class="reaction">
<label for="love" class="emoji-label">love</label>
<input type="checkbox" id="like" value="like" name="reactemoji" class="reaction">
<label for="like" class="emoji-label">like</label>
<input type="checkbox" id="clapping" value="clapping" name="reactemoji" class="reaction">
<label for="clapping" class="emoji-label">clapping</label>
<input type="checkbox" id="cool" value="cool" name="reactemoji" class="reaction">
<label for="cool" class="emoji-label">cool</label>

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
	$('input[type=checkbox]').click(function(){
		const reactEmoji = $('input[name=reactemoji]:checked').val();
		const reactId = $('#reactId').val();
		if(reactEmoji){
			$.ajax({
				url: 'contents/reaction.php?react='+reactEmoji+'&idreact='+reactId,
				type: 'post',
				data: 'reactEmoji='+reactEmoji+'&reactId='+reactId,
				success: function(response){
					if(response){
						Swal.fire(response);
						// Swal.fire("Your Reaction: "+reactEmoji);
						// $('#value-react').text(reactEmoji);
						// $('#id-product').text(reactId);
						// $('input[name=reactemoji]').prop('checked', false);
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