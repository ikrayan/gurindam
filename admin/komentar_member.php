<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Posting - KMS</title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../assets/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">

  <link rel="stylesheet" href="../assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

  <link rel="stylesheet" href="../assets/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="../assets/bower_components/morris.js/morris.css">
  <link rel="stylesheet" href="../assets/bower_components/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="../assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="../assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="../assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <?php 
  include '../koneksi.php';
  session_start();
  if(!isset($_SESSION['member_level'])){
    	header("location:../index.php");
	  	}
  elseif(!isset($_GET['id_member'])){
			header("location:../index.php");
   }else{
	  $id_member = $_GET['id_member'];
	  $level_member = $_SESSION['member_level'];
  }
  ?>

</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <a href="index.php" class="logo">
        <span class="logo-mini"><i class="fa fa-code"></i></span>
        <span class="logo-lg">MEMBER <b>KMS</b></span>
      </a>
      
	<nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
		</nav>
   
    </header>

<aside class="main-sidebar">
	<section class="sidebar">
	<div class="user-panel">
          <div class="pull-left image">
            <?php 
            //$id = $_SESSION['id'];
            $profil = mysqli_query($koneksi,"select * from user where PNS_ID='$id_member'");
            $profil = mysqli_fetch_assoc($profil);
            if($profil['PNS_FOTO'] == ""){ 
              ?>
              <img src="../gambar/sistem/member.png" class="img-circle">
            <?php }else{ ?>
              <img src="../gambar/member/<?php echo $profil['PNS_FOTO'] ?>" class="img-circle" style="max-height:45px">
            <?php } ?>
          </div>
          <div class="pull-left info">
            <p><?php echo $_SESSION['member_nama']; ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
	
	<ul class="sidebar-menu" data-widget="tree">
        <li>
            <a href="../index.php">
              <i class="fa fa-home"></i><span>Home</span>
            </a>
        </li>
        <li>
            <a href="../<?php echo $level_member; ?>.php?id=<?php echo $id_member; ?>">
              <i class="fa fa-sign-out"></i><span>Dashboard</span>
            </a>
        </li>
	</ul>
	</section>
</aside>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Komentar Knowledge
      <small>Data Komentar</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-12">
        <div class="box box-info">

          <div class="box-header">
            <h3 class="box-title">Komentar Saya</h3>
            
          </div>
          <div class="box-body">

            <?php
            $id_member = $_GET['id_member'];
            $posting = mysqli_query($koneksi,"select * from posting,kategori,user where posting_member=PNS_ID and kategori_id=posting_kategori and PNS_ID='$id_member'");
            $p = mysqli_fetch_assoc($posting);
            ?>



            <div class="table-responsive">

              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th>Komentar</th>
                    <th>Posting</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $data = mysqli_query($koneksi,"select * from posting,kategori,user,diskusi where diskusi_posting=posting_id and diskusi_member=PNS_ID and kategori_id=posting_kategori and PNS_ID='$id_member' order by diskusi_id desc");
                  while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td>
                        <?php echo $d['diskusi_isi']; ?>
                        <br/><i><small class="text-muted"><?php echo date('d-M-Y H:i:s',strtotime($d['posting_tanggal'])) ?></small></i>
                      </td>
                      <td>
                          <a target="_blank" href="../diskusi.php?id=<?php echo $d['posting_id']; ?>"><b><?php echo $d['posting_judul'] ?></b></a>
                      </td>
                      <td>                      
                        <a class="btn btn-danger btn-sm" onclick="return confirm('Yakin akan menghapus?')" href="komentar_member_hapus.php?id_diskusi=<?php echo $d['diskusi_id'] ?>&id_member=<?php echo $id_member; ?>"><i class="fa fa-trash"></i> Hapus Diskusi / Komentar</a>
                      </td>
                    </tr>

                    <?php 
                  }
                  ?>

                </tbody>
              </table>

            </div>

          </div>

        </div>
      </section>
    </div>
  </section>

</div>
<?php include 'footer.php'; ?>