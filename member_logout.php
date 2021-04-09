<?php 

include 'koneksi.php';

session_start();

$id_member = $_SESSION['member_id'];

mysqli_query($koneksi, "UPDATE log_user SET logout=NOW() WHERE log_pns_id='$id_member'");

	unset($_SESSION['member_id']);
	unset($_SESSION['member_nama']);
	unset($_SESSION['member_status']);
	unset($_SESSION['member_level']);
	unset($_SESSION['member_jabatan']);
	unset($_SESSION['member_unor']);

session_destroy();
	
	unset($_SESSION['member_id']);
	unset($_SESSION['member_nama']);
	unset($_SESSION['member_status']);
	unset($_SESSION['member_level']);
	unset($_SESSION['member_jabatan']);
	unset($_SESSION['member_unor']);

header("location:index.php");
?>