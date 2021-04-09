<?php 
include 'koneksi.php';

$id_posting = $_GET['id_posting'];

$acc_posting = mysqli_query($koneksi, "update posting set posting_step=2 where posting_id=$id_posting");
if($acc_posting){
	mysqli_query($koneksi, "delete from diskusi where diskusi_posting=$id_posting");
}

if(isset($_GET['id_verifikator'])){
	$id_verifikator = $_GET['id_verifikator'];
	header("location:admin/verifikasi.php?id_member=$id_verifikator");
}
if(isset($_GET['id_member'])){
	$id_member = $_GET['id_member'];
	header("location:admin/postingan_member.php?id_member=$id_member");
}


?>