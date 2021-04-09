<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>KMS BKN</title>
  <!-- DataTables -->
  <link rel="stylesheet" href="assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css"> 
  
  <link rel="stylesheet" href="assets_forum/assets/css/bootstrap/bootstrap.min.css">
  
  <link href="assets_forum/assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link type="text/css" href="assets_forum/assets/css/argon.css?v=1.1.0" rel="stylesheet">
  <link href="assets_forum/assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  
  <!--
  <link rel="stylesheet" href="assets/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">

  <link rel="stylesheet" href="assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

  <link rel="stylesheet" href="assets/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="assets/bower_components/morris.js/morris.css">
  <link rel="stylesheet" href="assets/bower_components/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  -->
  
</head>
<style>
  .cke_inner{
    display: none !important;
  }

  .dropdown-menu{
    margin-top: 10px !important;
  }
	
</style>

<?php
include 'koneksi.php';
session_start();
$file = basename($_SERVER['PHP_SELF']);


if(!isset($_SESSION['member_status'])){
	
  
  // halaman yg dilindungi jika member belum login
  $lindungi = array('verifikator.php','member.php','member_logout.php','member_profil.php','member_password.php');
  // periksa halaman, jika belum login ke halaman di atas, maka alihkan halaman
  if(in_array($file, $lindungi)){
    header("location:index.php");
  }
  if($file == "posting.php"){
    header("location:masuk.php?alert=login-dulu");
  }

}else{

  // halaman yg tidak boleh diakses jika member sudah login
  $lindungi = array('masuk.php','daftar.php');
  // periksa halaman, jika sudah dan mengakses halaman di atas, maka alihkan halaman
  if(in_array($file, $lindungi)){
    header("location:member.php");
  }

}

?>
<body class="bg-secondary">

  <header>

    <nav class="navbar navbar-expand-lg navbar-dark bg-default mb-4">
      <div class="container-fluid">
        <div class="row">
          <img src="gambar/sistem/logo.png" height="28px">
          <a class="navbar-brand float-right ml-3" href="index.php" style="font-size: 13pt;">
            KNOWLEDGE MANAGEMENT <b>SYSTEM</b>
          </a>
        </div>
       </div>
    </nav>

  </header>


<div class="container-fluid">

  <div class="row">

    <div class="col-lg-4 offset-lg-4">

      <div class="card">
        <div class="card-header">
          <h4><center><b>LOGIN</b></center></h4>
        </div>
        <div class="card-body">


          <?php 
          if(isset($_GET['alert'])){
            if($_GET['alert'] == "terdaftar"){
              ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <span class="alert-inner--icon"><i class="ni ni-bell-55"></i></span>
                <span class="alert-inner--text"><strong>Pendaftaran Berhasil.</strong> Silahkan login!</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <?php
            }elseif($_GET['alert'] == "gagal"){
              ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="alert-inner--icon"><i class="ni ni-bell-55"></i></span>
                <span class="alert-inner--text"><strong>Email dan Password salah!</strong> coba lagi!</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <?php
            }elseif($_GET['alert'] == "login-dulu"){
              ?>
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <span class="alert-inner--icon"><i class="ni ni-bell-55"></i></span>
                <span class="alert-inner--text"><strong>Warning!</strong> <br/> Silahkan login terlebih dulu</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <?php
            }
          }
          ?>

          <form action="masuk_act.php" method="post">
			
            <input name="ip" type="hidden" id="ip" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>">
            
            <div class="form-group">
              <label for=""><b>NIP / Username</b></label>
              <input type="text" class="form-control" required="required" name="email" placeholder="Masukkan email / NIP ..">
            </div>

            <div class="form-group">
              <label for=""><b>Password</b></label>
              <input type="password" class="form-control" name="password" placeholder="Masukkan password ..">
            </div>

            <div class="form-group">
              <input type="submit" class="btn btn-primary pu" value="Login">
              <a href="index.php" class="btn btn-warning pull-right">Batal</a>
            </div>
          </form>

        </div>
      </div>

    </div>

  </div>
</div>

<?php include 'footer.php'; ?>
