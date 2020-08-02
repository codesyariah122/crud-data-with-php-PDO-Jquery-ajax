<?php
require_once 'config.php';
$perPage = 3;

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


function addAjax($data, $file, $table){
	// var_dump(@$data); //menangani pengolahan data
	// var_dump(@$file); //menangani pengolahan input file

	$dbh = connect();
	$productCode = @$data['productcode'];
	$productImage = upload($file, '../assets/images/'); // disini kita deklarasikan fungsi uploadnya
	$productName = @$data['productname'];
	$productDesc = @$data['productdescription'];
	$productPrice = @$data['productprice'];

	if(!$productImage){
		$productImage = 'no-product-image.jpg';
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


function searchData($keyword, $limitStart, $limit){
	$query = "SELECT * FROM `product` WHERE 
			  `product_code` LIKE '%$keyword' OR
			  `product_name` LIKE '%$keyword%' OR 
			  `product_price` LIKE '%$keyword%' 
			  LIMIT $limitStart, $limit";

	return view($query);
}


function upload($file, $dir){
	$namaFile = @$file['productimage']['name'];
	$ukuranFile = @$file['productimage']['size'];
	$error = @$file['productimage']['error'];
	$tmpName = @$file['productimage']['tmp_name'];

	if($error === 4){
		$empty = true;
		if(isset($empty)){
			echo "Sory ... upload image error";
		}
		return false;
	}

	// cek ekstensi file yang diupload
	// file harus berekstensi gambar atau image
	$ekstensiValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));

	echo $ekstensiGambar;

	// validasi ekstensi file yang diupload
	if(!in_array($ekstensiGambar, $ekstensiValid)){
		$errorEkstensi = true;
		if(isset($errorEkstensi)){
			echo "File upload error, not image file";
		}
		return false;
	}

	// cek size file nya 
	if($ukuranFile > 700000){
		$errorSize = true;
		if(isset($errorSize)){
			echo "Image file too big size";
		}
		return false;
	}

	// lolos semua tahap validasi 
	// terakhir kita buat nama file baru
	// bertujuan agar file baru dengan nilai yang sama tida tertimpa
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;

	// kita gunakan fungsi upload dari php
	// move_uploaded_file()
	move_uploaded_file($tmpName, $dir.$namaFileBaru);

	return $namaFileBaru;
}