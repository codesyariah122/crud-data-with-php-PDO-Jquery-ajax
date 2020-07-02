<?php
require_once 'config.php';
function layout($dir, $file, $ext){
	global $dir;
	if(file_exists($dir.'/'.$file.$ext)){
		require_once $dir.'/'.$file.$ext;
	}else{
		echo "<h1 style='color:red;'>Layout not found</h1>";
	}
}

function connect(){
	$dbhost = DB_HOST;
	$dbname = DB_NAME;
	$dbuser = DB_USER;
	$dbpass = DB_PASS;
	try{
		$conn = new PDO("mysql:host=$dbhost; dbname=$dbname", $dbuser, $dbpass);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $conn;
	}catch(PDOException $e){
		echo "Connection Failed ".$e->getMessage();
		$conn = null;
	}
	
}


function view($query){
	$dbh = connect();
	try{
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql=$dbh->query($query);
		$rows = [];

			while($row = $sql->fetch(PDO::FETCH_ASSOC)):
				$rows[]=$row;
			endwhile;

		return $rows;

	}catch(PDOException $e){
		echo $e->getMessage();
	}
}


function addAjax($data, $table){
	$dbh = connect();

	$productcode = @$data['productcode'];
	$productname = @$data['productname'];
	$productprice = @$data['productprice'];

	$insertProduct = $dbh->prepare("INSERT INTO `$table` (id, product_code, product_name, product_price) VALUES ('', ?, ?, ?)");

	$insertProduct->bindParam(1, $productcode);
	$insertProduct->bindParam(2, $productname);
	$insertProduct->bindParam(3, $productprice);

	$insertProduct->execute();

	return $insertProduct->rowCount();
}

function editAjax($data, $table){
	
	$productcode = @$data['productcode'];
	$productname = @$data['productname'];
	$productprice = @$data['productprice'];
	$productid = @$data['productid'];

	$dbh = connect();
	$edit = $dbh->prepare("UPDATE `$table` SET product_code=?, product_name=?, product_price=? WHERE `id` = ?");
	$edit->execute([$productcode, $productname, $productprice, $productid]);
	return $edit->rowCount();
}

function viewEdit($table, $id){
	$dbh = connect();
	$data = $dbh->query("SELECT * FROM `$table` WHERE `id` = '$id'");
	return $data->fetch(PDO::FETCH_OBJ);
}

function deleteAjax($data, $table){
	$dbh = connect();
	$id = @$data['id'];
	// var_dump($id);
	$delete = $dbh->prepare("DELETE FROM `$table` WHERE id = :id");
	$delete->bindParam(":id", $id);
	$delete->execute();
	return $delete->rowCount();
}