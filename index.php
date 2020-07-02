<?php require_once 'functions.php'; $dir='contents'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Crud Data With Ajax</title>
	<style type="text/css">
		body{
			font-family: arial;
		}
		fieldset{
			margin-top: 1rem;
		}
	</style>
</head>
<body>

<div style="margin-bottom:10px;">
	<button id="add">Add New Product</button>
</div>

<div id="viewdata" style="margin-bottom:10px;">
	<?=layout($dir, 'view', '.php'); ?>
</div>

<div id="cruddata"></div>


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="assets/MyJs.js"></script>

</body>
</html>