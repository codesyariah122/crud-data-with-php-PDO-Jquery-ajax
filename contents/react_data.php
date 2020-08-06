<style type="text/css">
	.react-ul{
			display: flex;
			padding:2px;
			margin-top:-2rem;
		}
	.react-list{
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
<ul class="react-ul" class="ml-2">
	<li class="react-list"><?=$emojiValue['love']?></li>
	<li class="react-list" style="margin-left:1rem;"><?=$emojiValue['likes']?></li>
	<li class="react-list" style="margin-left:1rem;"><?=$emojiValue['clapping']?></li>
	<li class="react-list" style="margin-left:0.7rem;"><?=$emojiValue['cool']?></li>
</ul>

<?php endif; ?>