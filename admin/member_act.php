<?php 
include '../koneksi.php';
$nama  = $_POST['nama'];
$nip  = $_POST['nip'];
$email  = $_POST['email'];
$hp  = $_POST['hp'];
$password = md5($_POST['password']);
$alamat = $_POST['alamat'];

$rand = rand();
$allowed =  array('gif','png','jpg','jpeg');
$filename = $_FILES['foto']['name'];

if($filename == ""){
	mysqli_query($koneksi, "insert into member values (NULL,'$nama','$nip','$email','$hp','$password','$alamat','','member')");
	header("location:member.php");
}else{
	$ext = pathinfo($filename, PATHINFO_EXTENSION);

	if(!in_array($ext,$allowed) ) {
		header("location:member.php?alert=gagal");
	}else{
		move_uploaded_file($_FILES['foto']['tmp_name'], '../gambar/member/'.$rand.'_'.$filename);
		$file_gambar = $rand.'_'.$filename;
		mysqli_query($koneksi, "insert into member values (NULL,'$nama','$nip','$email','$hp','$password','$alamat','$file_gambar','member')");
		header("location:member.php");
	}
}

