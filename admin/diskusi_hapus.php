<?php 
include '../koneksi.php';
$id = $_GET['id'];

mysqli_query($koneksi, "delete from posting where posting_id='$id'");
mysqli_query($koneksi, "delete from diskusi where diskusi_posting='$id'");
mysqli_query($koneksi, "delete from attachment where attach_posting='$id'");

header("location:diskusi.php");
