<?php 
include '../koneksi.php';
$id = $_GET['id'];
$posting = $_GET['posting'];

mysqli_query($koneksi, "delete from diskusi where diskusi_id='$id'");

header("location:diskusi_komentar.php?id=$posting");
