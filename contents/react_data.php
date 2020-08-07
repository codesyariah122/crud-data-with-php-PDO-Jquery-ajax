<style type="text/css">
	.react-ul{
			display: flex;
			padding:2px;
			margin-top:-2rem;
		}
	.react-list{
			list-style: none;
			padding: 10px;
			font-size: 1.5rem;
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
<ul class="react-ul" class="ml-4">
	<li class="react-list <?=($emojiValue['love'] > 1) ? 'text-primary' : 'text-danger';?>"><?=$emojiValue['love']?></li>
	<li class="react-list <?=($emojiValue['likes'] > 1) ? 'text-primary' : 'text-danger';?>" style="margin-left:2rem;"><?=$emojiValue['likes']?></li>
	<li class="react-list <?=($emojiValue['clapping'] > 1) ? 'text-primary' : 'text-danger';?>" style="margin-left:2rem;"><?=$emojiValue['clapping']?></li>
	<li class="react-list <?=($emojiValue['cool'] > 1) ? 'text-primary' : 'text-danger';?>" style="margin-left:1.7rem;"><?=$emojiValue['cool']?></li>
</ul>

<?php endif; ?>