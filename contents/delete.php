<?php
require_once '../functions.php';  
if(@$_GET['page'] == 'del'):
	if(deleteAjax($_POST, 'product') > 0):
		echo "success";
	endif;
endif;
?>