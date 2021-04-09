<?php include 'header.php'; ?>

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
            <h3 class="box-title">Komentar</h3>
            <div class="btn-group pull-right">
              <a href="diskusi.php" class="btn btn-info btn-sm"><i class="fa fa-arrow-left"></i> &nbsp Kembali</a>              
            </div>
          </div>
          <div class="box-body">

            <?php
            $id_posting = $_GET['id'];
            $posting = mysqli_query($koneksi,"select * from posting,kategori,member where posting_member=member_id and kategori_id=posting_kategori and posting_id='$id_posting'");
            $p = mysqli_fetch_assoc($posting);
            ?>

            <table>
              <tr>
                <th>Judul </th>
                <th style="padding-left: 10px;padding-right: 10px">:</th>
                <td><?php echo $p['posting_judul']; ?></td>
              </tr>
              <tr>
                <th>Kategori</th>
                <th style="padding-left: 10px;padding-right: 10px">:</th>
                <td><?php echo $p['kategori_nama']; ?></td>
              </tr>
              <tr>
                <th>Member</th>
                <th style="padding-left: 10px;padding-right: 10px">:</th>
                <td><?php echo $p['member_nama']; ?></td>
              </tr>
            </table>

            <div class="table-responsive">


              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th class="col-lg-7">Komentar</th>
                    <th>Member</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $data = mysqli_query($koneksi,"select * from posting,kategori,member,diskusi where diskusi_posting=posting_id and diskusi_member=member_id and kategori_id=posting_kategori and posting_id='$id_posting' order by diskusi_id desc");
                  while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td>
                        <?php echo $d['diskusi_isi']; ?>
                        <br/><i><small class="text-muted"><?php echo date('d-M-Y H:i:s',strtotime($d['posting_tanggal'])) ?></small></i>
                      </td>
                      <td>
                          <?php 
                          if($d['member_foto'] == ""){
                            ?>
                            <img class="img-fluid rounded-circle shadow" style="width: 40px;height: 40px" src="../gambar/sistem/member.png">
                            <?php
                          }else{
                            ?>
                            <img class="img-fluid rounded-circle shadow" style="width: 40px;height: 40px" src="../gambar/member/<?php echo $d['member_foto'] ?>">
                            <?php
                          }
                          ?>
                          <small class="ml-1"><?php echo $d['member_nama'] ?></small>
                      </td>
                      <td>                      
                        <a class="btn btn-danger btn-sm" href="diskusi_komentar_hapus.php?id=<?php echo $d['diskusi_id'] ?>&posting=<?php echo $d['posting_id'] ?>"><i class="fa fa-trash"></i> Hapus Diskusi / Komentar</a>
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