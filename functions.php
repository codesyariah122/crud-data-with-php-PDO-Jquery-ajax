<?php
require_once 'config.php';

function layout($dir, $file, $ext){
	global $dir;
	if(file_exists($dir.'/'.$file.$ext)){
		require_once $dir.'/'.$file.$ext;
	}else{
		echo "<h1 class='text-danger text-center'>Layout Not Found</h1>";
	}
}

function connect(){
	$dbhost = DB_HOST;
	$dbname = DB_NAME;
	$dbuser = DB_USER;
	$dbpass = DB_PASS;

	try{
		$conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//echo "Connection succesfully added";
		return $conn;
	}catch(PDOException $e){
		echo "Connection failed ".$e->getMessage();
	}
}


function view($query){
	$dbh = connect();
	try{
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = $dbh->query($query);
		$rows=[];

		while($row = $sql->fetch(PDO::FETCH_ASSOC)):
			$rows[] = $row;
		endwhile;

		return $rows;
	}catch(PDOException $e){
		echo $e->getMessage();
	}
}


function addAjax($data, $table){
	// var_dump($data);
	$dbh = connect();
	$productCode = @$data['productcode'];
	$productName = @$data['productname'];
	$productPrice = @$data['productprice'];

	$insertProduct = $dbh->prepare("INSERT INTO `$table` (id, product_code, product_name, product_price) VALUES ('', ?, ?, ?)");
	$insertProduct->bindParam(1, $productCode);
	$insertProduct->bindParam(2, $productName);
	$insertProduct->bindParam(3, $productPrice);

	$insertProduct->execute();

	return $insertProduct->rowCount();
}

function editAjax($data, $table){
	$productCode = @$data['productcode'];
	$productName = @$data['productname'];
	$productPrice = @$data['productprice'];
	$productId = @$data['productid'];

	$dbh = connect();

	$edit = $dbh->prepare("UPDATE `$table` SET product_code = ?, product_name = ?, product_price = ? WHERE `id` = ?");
	$edit->execute([$productCode, $productName, $productPrice, $productId]);
	return $edit->rowCount();
}

function deleteAjax($data, $table){
	$dbh = connect();
	$id = @$data['id'];
	$delete = $dbh->prepare("DELETE FROM `$table` WHERE `id` = :id");
	$delete->bindParam(":id", $id);

	$delete->execute();

	return $delete->rowCount();
}