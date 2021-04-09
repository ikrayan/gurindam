<?php 
include '../koneksi.php';
$id = $_GET['id'];

mysqli_query($koneksi, "delete from member where member_id='$id'");

mysqli_query($koneksi, "delete from posting where posting_member='$id'");

mysqli_query($koneksi, "delete from diskusi where diskusi_member='$id'");

header("location:member.php");