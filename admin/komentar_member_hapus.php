<?php 
include '../koneksi.php';
$id_diskusi = $_GET['id_diskusi'];
$id_member = $_GET['id_member'];

mysqli_query($koneksi, "delete from diskusi where diskusi_id='$id_diskusi'");

header("location:komentar_member.php?id_member=$id_member");
