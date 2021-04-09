<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Knowledge / Posting
      <small>Data Knowledge / Posting</small>
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
		
        <!--
          <div class="box-header">
            <h3 class="box-title">Knowledge / Posting</h3>
          </div> -->
          <div class="box-body">

            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-posting-datatable">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th class="col-lg-1"><center>Tanggal</center></th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Viewer</th>
                    <th>Status</th>
                    <th>Member</th>
                    <th><i class="fa fa-eye"></i></th>
                    <th><i class="fa fa-comment"></i></th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $data = mysqli_query($koneksi,"SELECT * FROM posting,kategori,user WHERE posting_member=PNS_ID AND kategori_id=posting_kategori ORDER BY posting_id DESC");
                  while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td>
                      	<?php echo $d['posting_id']; ?>
                      </td>
                      <td>
                   		<i><small><?php echo date('Y-M-d H:i:s',strtotime($d['posting_tanggal'])) ?></small></i>
                   	  </td>
                      <td>
                        <a target="_blank" href="../diskusi.php?id_posting=<?php echo $d['posting_id']; ?>"><?php echo $d['posting_judul'] ?></a>
                        <br/><i><small><?php echo date('Y-M-d H:i:s',strtotime($d['posting_tanggal'])) ?></small></i>
                      </td>
                      <td>
                        <a target="_blank" href="../kategori.php?id=<?php echo $d['kategori_id']; ?>">
                          <div class="badge bg-aqua-active"><?php echo $d['kategori_nama'] ?></div>
                        </a>
                      </td>
                      <td>
                      	<?php if($d['posting_visibility']=="publik"){ ?>
                      	<div class="badge bg-green-active"><i class="fa fa-arrow-up"></i>&nbsp;<?php echo $d['posting_visibility'] ?></div>
                      	<?php }else{ ?>
                      	<div class="badge bg-maroon-active"><i class="fa fa-arrow-down"></i>&nbsp;<?php echo $d['posting_visibility'] ?></div>
                      	<?php } ?>
                      	<a href="../posting_edit_viewer_act.php?id=<?php echo $d['posting_id']; ?>&visibility=<?php echo $d['posting_visibility'] ?>" class="badge bg-yellow-active" onClick="return confirm('Yakin mengubah viewer posting?')"><i class="fa fa-refresh"></i></a>
                      </td>
                      <td>
                      	<?php 
							$step = $d['posting_step'];
							if ($step==0){ 
								echo "<div class='badge bg-aqua-active'>Draft</div>";
							}
							elseif ($step==1){
								echo "<div class='badge bg-orange-active'>Verifikasi</div>";
							}
							elseif ($step==10){
								echo "<div class='badge bg-red-active'>Ditolak</div>";
							}
							elseif ($step==2){
								echo "<div class='badge bg-green-active'>Publish</div>";
							}
						?>
                     	<a href="../posting_turunstatus_act.php?id=<?php echo $d['posting_id']; ?>" class="badge bg-red-active" onClick="return confirm('Yakin menurunkan status posting?')"><i class="fa fa-arrow-down"></i></a>
                      </td>
                      <td>
                        <a target="_blank" href="../detail_member.php?id=<?php echo $d['PNS_ID']; ?>">
                          <?php 
                          if($d['PNS_FOTO'] == ""){
                            ?>
                            <img class="img-fluid rounded-circle shadow" style="width: 40px;height: 40px" src="../gambar/sistem/member.png">
                            <?php
                          }else{
                            ?>
                            <img class="img-fluid rounded-circle shadow" style="width: 40px;height: 40px" src="../gambar/member/<?php echo $d['PNS_FOTO'] ?>">
                            <?php
                          }
                          ?>
                          &nbsp;
                          <small class="ml-1 text-bold text-black"><?php echo $d['NAMA'] ?></small>
                        </a>
                      </td>
                      <td>
                        <div class="badge badge-info"><?php echo $d['posting_dibaca'] ?></div>
                      </td>
                      
                      <td>
                        <div class="badge badge-warning">
                          <?php 
                          $id_posting = $d['posting_id'];
                          $komentar = mysqli_query($koneksi,"select * from diskusi where diskusi_posting='$id_posting'");
                          echo mysqli_num_rows($komentar);
                          ?>
                        </div>
                      </td>
                      <td>                      
                        <a class="btn btn-success btn-sm" href="diskusi_komentar.php?id=<?php echo $d['posting_id'] ?>"><i class="fa fa-comment"></i> Lihat Komentar</a>
                        <a class="btn btn-danger btn-sm" href="diskusi_hapus_konfir.php?id=<?php echo $d['posting_id'] ?>"><i class="fa fa-trash"></i></a>
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