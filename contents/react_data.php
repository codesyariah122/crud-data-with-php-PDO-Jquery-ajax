<style type="text/css">
	ul{
			display: flex;
			padding:2px;
			margin-top:-2rem;
		}
		li {
			list-style: none;
			padding: 10px;
		}
</style>
<?php
require_once '../functions.php';

if(@$_GET['reactemoji'] && @$_GET['reactid']):
	reactEmoji(@$_GET, 'reaction');
$emoji = @$_GET['reactemoji'];
$idEmoji = @$_GET['reactid'];
$emojiValue = view("SELECT * FROM `reaction` WHERE `id_react` = $idEmoji")[0];
?>
<ul class="ml-2">
	<li><?=$emojiValue['love']?></li>
	<li style="margin-left:0.5rem;"><?=$emojiValue['likes']?></li>
	<li style="margin-left:1.2rem;"><?=$emojiValue['clapping']?></li>
	<li style="margin-left:0.5rem;"><?=$emojiValue['cool']?></li>
</ul>

<?php endif; ?>