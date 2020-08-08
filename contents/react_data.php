<style type="text/css">
	.react-ul{
		display: flex;
		padding: 2px;
		margin-top: -2rem;
	}

	.react-list{
		list-style: none;
		padding: 10px;
		font-size: 2.5rem;
		margin-left: 1rem;
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
	<li class="react-list <?=($emojiValue['likes'] > 1) ? 'text-success' : 'text-warning';?>"><?=$emojiValue['likes']?></li>
	<li class="react-list <?=($emojiValue['clapping'] > 1) ? 'text-info' : 'text-primary';?>"><?=$emojiValue['clapping']?></li>
	<li class="react-list <?=($emojiValue['cool'] > 1) ? 'text-danger' : 'text-success';?>"><?=$emojiValue['cool']?></li>
</ul>

<?php endif; ?>
