<style type="text/css">
	input[type="checkbox"]{
		display: none;
	}

	.emoji-label{
		cursor: pointer;
		font-size: 3rem;
		margin-left: 0.3rem;
		margin-top: -1rem;
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

<button class="btn btn-small btn-primary mb-3" id="react-onclick" onclick="emojiReact(emoji)">Show Reaction</button>
<br/>
<input type="hidden" name="reactId" id="reactId" value="<?=@$_GET['react_id']?>">

<input type="checkbox" name="reactemoji" id="love" value="love" class="reaction">
<label for="love" class="emoji-label display">Love</label>

<input type="checkbox" name="reactemoji" id="likes" value="likes" class="reaction">
<label for="likes" class="emoji-label display">Like</label>

<input type="checkbox" name="reactemoji" id="clapping" value="clapping" class="reaction">
<label for="clapping" class="emoji-label display">Clapping</label>

<input type="checkbox" name="reactemoji" id="cool" value="cool" class="reaction">
<label for="cool" class="emoji-label display">Cool</label>

<div id="react-value"></div>

<script type="text/javascript" src="assets/js/reaction.js"></script>
