<?php
require_once 'config.php';

function layout($dir, $file, $ext){
	//global $dir;
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


function addAjax($data, $file, $table){
	// var_dump(@$file);
	// var_dump(@$data);

	$dbh = connect();
	$productCode = @$data['productcode'];
	$productImage = upload($file, '../assets/images/');
	$productName = @$data['productname'];
	$productDesc = @$data['productdescription'];
	$productPrice = @$data['productprice'];

	if(!$productImage){
		$productImage = 'no-product-image.png';
	}

	$insertProduct = $dbh->prepare("INSERT INTO `$table` (id, product_code, product_image, product_name, product_description, product_price) VALUES ('', ?, ?, ?, ?, ?)");
	$insertProduct->bindParam(1, $productCode);
	$insertProduct->bindParam(2, $productImage);
	$insertProduct->bindParam(3, $productName);
	$insertProduct->bindParam(4, $productDesc);
	$insertProduct->bindParam(5, $productPrice);

	$insertProduct->execute();

	return $insertProduct->rowCount();
}

function editAjax($data, $file, $table){
	$productCode = @$data['productcode'];
	$productImage = @$data['productimage'];
	$productName = @$data['productname'];
	$productDesc = @$data['productdescription'];
 	$productPrice = @$data['productprice'];
	$productId = @$data['productid'];

	if(!$productImage){
		$productImage = upload($file, '../assets/images/');
	}elseif(empty($productImage)){
		$productImage = 'no-product-image.png';
	}


	$dbh = connect();

	$edit = $dbh->prepare("UPDATE `$table` SET product_code = ?, product_image = ?, product_name = ?, product_description = ?, product_price = ? WHERE `id` = ?");
	$edit->execute([$productCode, $productImage, $productName, $productDesc, $productPrice, $productId]);

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

function searchData($keyword){
	$query = "SELECT * FROM `product` WHERE 
			  `product_code` LIKE '%$keyword' OR
			  `product_name` LIKE '%$keyword%' OR 
			  `product_price` LIKE '%$keyword%'
			  ORDER BY `id` DESC
	";

	return view($query);
}

function upload($file, $dir){
	$namaFile = @$file['productimage']['name'];
	$ukuranFile = @$file['productimage']['size'];
	$error = @$file['productimage']['error'];
	$tmpName = @$file['productimage']['tmp_name'];

	// validasi error
	if($error === 4){
		$empty = true;
		if(isset($empty)){
			echo "Image not upload";
		}
		return false;
	}

	// validasi ekstensi gambar
	$ekstensiValid = ['jpg', 'jpeg', 'png', 'gif'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	echo $ekstensiGambar;

		if(!in_array($ekstensiGambar, $ekstensiValid)){
			$noEkstensi = true;
			if(isset($noEkstensi)){
				echo "File no image";
			}
		return false;
		}
	// cek ukuran gambar
		if($ukuranFile > 700000){
			$sizeError = true;
			if(isset($sizeError)){
				echo "File image is too big";
			}
			return false;
		}

	// lolos pengecekan

	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;

	// lakukan process upload
	move_uploaded_file($tmpName, $dir.$namaFileBaru);

	return $namaFileBaru;

}