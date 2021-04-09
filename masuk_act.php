<?php 
// menghubungkan dengan koneksi
include 'koneksi.php';

if(isset($_SESSION['member_level'])){
	session_destroy();
}

// menangkap data yang dikirim dari form
$ip = $_POST['ip'];
$email = $_POST['email'];
$password = md5($_POST['password']);

$login = mysqli_query($koneksi, "SELECT * FROM user WHERE NIP_BARU='$email' AND PASSWORD='$password' OR USERNAME='$email' AND PASSWORD='$password'");
$cek = mysqli_num_rows($login);

if($cek > 0){
	session_start();
	$data = mysqli_fetch_assoc($login);

	// hapus session yg lain, agar tidak bentrok dengan session member
	unset($_SESSION['member_id']);
	unset($_SESSION['member_nama']);
	unset($_SESSION['member_status']);
	unset($_SESSION['member_level']);
	unset($_SESSION['member_jabatan']);
	unset($_SESSION['member_unor']);

	// buat session member
	$_SESSION['member_id'] = $data['PNS_ID'];
	$_SESSION['member_nama'] = $data['NAMA'];
	$_SESSION['member_jabatan'] = $data['JABATAN_NAMA'];
	$_SESSION['member_unor'] = $data['UNOR_NAMA'];	
	$_SESSION['member_level'] = $data['LEVEL'];
	$_SESSION['member_status'] = "login";
	$id_member = $data['PNS_ID'];
	$nama_member = $data['NAMA'];
	$dashboard = $data['LEVEL'];
	
	mysqli_query($koneksi, "INSERT INTO log_user VALUES (NULL,'$id_member','$nama_member',NOW(),NULL,'$ip')");
	
	//header("location:$dashboard.php");
	header("location:index.php?alert=sukses");
}else{
	header("location:masuk.php?alert=gagal"); 
} 
