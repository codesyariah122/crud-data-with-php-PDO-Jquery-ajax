<?php  require_once '../functions.php';?>

<style type="text/css">
	input[type="checkbox"]{
			display: none;
		}

		.emoji-label{
			cursor: pointer;
			font-size: 3rem;
			margin-left:0.3rem;
			margin-top:-1rem;
			animation: shake 0.5s;
		   	animation-iteration-count: infinite; 
		}
		.emoji-label:hover{
			-webkit-transform: scaleX(-1);
  			transform: scaleX(-1);
  			animation: shake 0.5s;
		   	animation-iteration-count: infinite; 
		}
		.display{
			display: none;
		}

</style>
<?php 
if(@$_GET['react_id']):
	$dataId = @$_GET['react_id']; 
endif; 
?>

<button class="btn btn-small btn-primary mb-3" id="react-onclick" onclick="emojiReact(emoji)">Push Reaction</button>
<br/>
<input type="hidden" name="reactId" id="reactId" value="<?=@$_GET['react_id']?>">

<input type="checkbox" id="love" value="love" name="reactemoji" class="reaction">
<label for="love" class="emoji-label display">love</label>

<input type="checkbox" id="likes" value="likes" name="reactemoji" class="reaction">
<label for="likes" class="emoji-label display">like</label>

<input type="checkbox" id="clapping" value="clapping" name="reactemoji" class="reaction">
<label for="clapping" class="emoji-label display">clapping</label>

<input type="checkbox" id="cool" value="cool" name="reactemoji" class="reaction">
<label for="cool" class="emoji-label display">cool</label>

<div id="react-value"></div>

<script type="text/javascript" src="assets/js/reaction.js"></script>
