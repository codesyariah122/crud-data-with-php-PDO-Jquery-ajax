<?php  
// require_once '../functions.php';
$userAsli = 'admin';
$passAsli = 'admin';

if(@$_POST['user'] && @$_POST['pass']){
	$user = @$_POST['user'];
	$pass = @$_POST['pass'];

	if($user === $userAsli AND $pass === $passAsli){
		echo "Login Success";
	}else{
		echo "Login Failed";
	}
}
?>