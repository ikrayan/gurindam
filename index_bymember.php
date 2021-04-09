<?php include 'header_bymember.php'; ?>


<div class="container-fluid">

  <div class="row">

    <div class="col-lg-9">

      <div class="card">
        <div class="card-body">

         <?php 
         if(isset($_GET['alert'])){
          if($_GET['alert'] == "posting"){
            echo "<div class='alert alert-success text-center'>Posting berhasil disimpan.</div>";
          }elseif($_GET['alert'] == "logout"){
            echo "<div class='alert alert-success text-center'>Anda telah berhasil logout.</div>";
          }elseif($_GET['alert'] == "dihapus"){
            echo "<div class='alert alert-success text-center'>Posting berhasil dihapus.</div>";
          }elseif($_GET['alert'] == "kirim"){
            echo "<div class='alert alert-success text-center'>Posting berhasil dikirim ke Verifikator.</div>";
          }
        }
        ?>

        <div class="btn-group pull-right mb-3">
          <div class="dropdown">
            Urutkan : &nbsp;
            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php if(isset($_GET['urutan']) && $_GET['urutan'] == "terpopuler"){echo "Terpopuler";}else{echo "Terbaru";} ?>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="?urutan=terbaru">Terbaru</a>
              <a class="dropdown-item" href="?urutan=terpopuler">Terpopuler</a>
            </div>
          </div>
        </div>

		<?php 
        	if(isset($_GET['nama'])){
          		$nama_member = $_GET["nama"];
		  		echo "Posting oleh : <b>'".$nama_member." '</b>";
		  		}
			
			if(isset($_GET['id'])){
		  		$id_member = $_GET["id"];
				}
        
        	if(isset($_GET['cari'])){
          		$cari = $_GET['cari'];
				echo "Posting oleh : <b>'".$nama_member." '</b><br>";
          		echo "Diskusi yang dicari : <b>'".$cari." '</b>";
        		}
        
        	if(isset($_GET['urutan'])){
          		$urutan = $_GET['urutan'];
				echo "Posting oleh : <b>'".$nama_member." '</b><br>";
          		echo "Diurutkan : <b>'".$urutan." '</b>";
        		}
        ?>
        	
        
        <table class="table table-hover">
          <thead>
            <tr>
              <th class="col-lg-7">Judul Posting</th>
              <th>Kategori</th>
              
              <th><i class="fa fa-eye"></i></th>
              <th><i class="fa fa-comment"></i></th>
              <th>Status</th>
              <th colspan="2">Aksi</th>
            </tr>
          </thead>
          <tbody>

            <?php
            $halaman = 10;
            $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
            $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
			
            $result = mysqli_query($koneksi, "SELECT * FROM posting where posting_member=$id_member");
            $total = mysqli_num_rows($result);
            $pages = ceil($total/$halaman);  
            if(isset($_GET['urutan']) && $_GET['urutan'] == "terpopuler"){
              if(isset($_GET['cari'])){
                $cari = $_GET['cari'];
                $data = mysqli_query($koneksi,"select * from posting,kategori,member where posting_member=$id_member and posting_member=member_id and kategori_id=posting_kategori and posting_judul like '%$cari%' order by posting_dibaca DESC LIMIT $mulai, $halaman");
              }else{
                $data = mysqli_query($koneksi,"select * from posting,kategori,member where posting_member=$id_member and posting_member=member_id and kategori_id=posting_kategori order by posting_dibaca DESC LIMIT $mulai, $halaman");
              }
            }else{

              if(isset($_GET['cari'])){
                $cari = $_GET['cari'];
                $data = mysqli_query($koneksi,"select * from posting,kategori,member where posting_member=$id_member and posting_member=member_id and kategori_id=posting_kategori and posting_judul like '%$cari%' order by posting_id desc LIMIT $mulai, $halaman");
              }else{
                $data = mysqli_query($koneksi,"select * from posting,kategori,member where posting_member=$id_member and posting_member=member_id and kategori_id=posting_kategori order by posting_id desc LIMIT $mulai, $halaman");
              }

            }          
            $no =$mulai+1;

            while($d = mysqli_fetch_array($data)){
              ?>


              <tr>
                <td>
                  <a href="diskusi.php?id=<?php echo $d['posting_id']; ?>"><?php echo $d['posting_judul'] ?></a>
                  <br/><i><small><?php echo date('d-M-Y H:i:s',strtotime($d['posting_tanggal'])) ?></small></i>
                </td>
                <td>
                  <a href="kategori.php?id=<?php echo $d['kategori_id']; ?>">
                    <div class="badge badge-warning"><?php echo $d['kategori_nama'] ?></div>
                  </a>
                </td>
                
              <td>
                <div class="badge badge-info"><?php echo $d['posting_dibaca'] ?></div>
              </td>
              <td>
                <div class="badge badge-info">
                  <?php 
                  $id_posting = $d['posting_id'];
                  $jumlah_diskusi = mysqli_query($koneksi,"select * from diskusi where diskusi_posting='$id_posting'");
                  echo mysqli_num_rows($jumlah_diskusi);
                  ?>
                </div>
              </td>
              <td>
              	<?php 
					$step = $d['posting_step'];
					if ($step==0){ 
						echo "<button class='btn btn-primary btn-sm shadow'>Draft</button>";
					}
					elseif ($step==1){
						echo "<button class='btn btn-warning btn-sm shadow'>Verifikasi</button>";
					}
					elseif ($step==10){
						echo "<button class='btn btn-danger btn-sm shadow'>Ditolak</button>";
					}
					elseif ($step==2){
						echo "<button class='btn btn-success btn-sm shadow'>Publish</button>";
					}
				?>
              </td>
              
              	<?php 
					$id_posting = $d['posting_id'];
					$step = $d['posting_step'];
					if ($step==0 or $step==10){ 
				?>
           	<td>
             	<a href="posting_verif_act.php?id=<?php echo $id_posting ?>" onclick="return confirm('Yakin Kirim ke Verifikator?')"><i class='fa fa-upload' aria-hidden='true'> </i></a>
             	<a href="posting_edit.php?id=<?php echo $id_posting ?>" onclick="return confirm('Yakin akan mengedit?')"><i class='fa fa-pencil-square-o' aria-hidden='true'> </i></a>
             </td>
            <td>
             	<a href="posting_bymember_hapus.php?id=<?php echo $id_posting ?>&nama=<?php echo $nama_member ?>&id_member=<?php echo $id_member ?>" onclick="return confirm('Yakin Hapus?')"><i class='fa fa-trash' aria-hidden='true'></i></a>
			</td>
             	<?php 
					}
					elseif ($step==1){
				?>
				
				<td colspan="2">
				<a href="posting_bymember_hapus.php?id=<?php echo $id_posting ?>&nama=<?php echo $nama_member ?>" onclick="return confirm('Yakin Hapus?')"><center><i class='fa fa-trash' aria-hidden='true'></i></center></a>
             	<?php 
					}
				?>
              </td>
            </tr>

            <?php 
          }
          ?>

        </tbody>
      </table>

      <hr/>

      <nav aria-label="...">
        <ul class="pagination justify-content-center">


          <?php for ($i=1; $i<=$pages ; $i++){ ?>
            <?php if($page==$i){ ?>
              <li class="page-item active">
                <a class="page-link" href="#"><?php echo $i; ?> <span class="sr-only">(current)</span></a>
              </li>
            <?php }else{ ?>

              <?php 
              if(isset($_GET['cari'])){
                $cari = $_GET['cari'];
                $c = "&cari=".$cari;
              }else{
                $c = "";
              }
              if(isset($_GET['urutan']) && $_GET['urutan'] == "terpopuler"){
                ?>
                <li class="page-item"><a class="page-link" href="?halaman=<?php echo $i; ?>&urutan=terpopuler<?php echo $c ?>"><?php echo $i; ?></a></li>
                <?php 
              }else{
                ?>
                <li class="page-item"><a class="page-link" href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php
              }
              ?>

            <?php } ?>
          <?php } ?>
        </ul>
      </nav>




    </div>
  </div>

</div>

<?php include 'sidebar_bymember.php'; ?>

</div>
</div>

<?php include 'footer_old.php'; ?>
