<?php include 'header.php'; ?>


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
          }
        }
        ?>
		
		<!-- search box -->
	  	<?php if(isset($_SESSION['member_status'])){ ?>
		  
		  	<div class="form-group">
				<form action="index.php" method="get">
				<div class="form-row">
					<div class="col-lg-2">
						<select class="form-control form-control-lg shadow" name="visibel" id="visibel">
							<?php 
								if(isset($_GET['visibel'])){
								  $visibel = $_GET['visibel'];
								  if($visibel=="publik"){
								  echo "<option>publik</option>";
								  echo "<option>internal</option>";
								  echo "<option>semua</option>";
								}elseif($visibel=="internal"){
								  echo "<option>internal</option>";
								  echo "<option>publik</option>";
								  echo "<option>semua</option>";
								}else{
								  echo "<option>semua</option>";
								  echo "<option>publik</option>";
								  echo "<option>internal</option>";
								  }
								}else{
								?>
						
							<option>semua</option>
							<option>publik</option>
							<option>internal</option>
							<?php } ?>
						</select>
					</div>
					<div class="col-lg-10">
					  
						 <div class="input-group input-group-alternative mb-3 shadow">
							<div class="input-group-append">
							  <span class="input-group-text"><i class="fa fa-search"></i></span>
							</div>
							<input class="form-control" name="cari" placeholder="Cari di sini .." type="text">
						  </div>
					  
					</div>
				</div>
				</form>
			  
			</div>
			<?php }else{  ?>
			<div class="form-group">
				<form action="index.php" method="get">
						 <div class="input-group input-group-alternative mb-3 shadow">
							<div class="input-group-append">
							  <span class="input-group-text"><i class="fa fa-search"></i></span>
							</div>
							<input class="form-control" name="cari" placeholder="Cari di sini .." type="text">
						  </div>
				</form>
			</div>
			<?php } ?>
		
		<!-- end search box -->
        

        <div class="btn-group pull-right mb-3">
          <div class="dropdown">
            Urutkan : &nbsp;
            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php if(isset($_GET['urutan']) && $_GET['urutan'] == "terpopuler"){echo "Terpopuler";}else{echo "Terbaru";} ?>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
             <?php 
             if(isset($_GET['cari'])){
          		$cari = $_GET['cari'];
				 if(isset($_GET['visibel'])){
					$visibel = $_GET['visibel']; ?>
             		<a class="dropdown-item" href="?urutan=terbaru&cari=<?php echo $cari; ?>&visibel=<?php echo $visibel; ?>">Terbaru</a>
					<a class="dropdown-item" href="?urutan=terpopuler&cari=<?php echo $cari; ?>&visibel=<?php echo $visibel; ?>">Terpopuler</a>
				  <?php }else{ ?>
					  <a class="dropdown-item" href="?urutan=terbaru&cari=<?php echo $cari; ?>">Terbaru</a>
					  <a class="dropdown-item" href="?urutan=terpopuler&cari=<?php echo $cari; ?>">Terpopuler</a>
              <?php }
			 }else{ ?>
				  <a class="dropdown-item" href="?urutan=terbaru">Terbaru</a>
				  <a class="dropdown-item" href="?urutan=terpopuler">Terpopuler</a>
              <?php } 
				  ?>
            </div>
          </div>
        </div>
        
        <?php 
        if(isset($_GET['cari'])){
          $cari = $_GET['cari'];
		  if($cari == ""){
			  echo "Semua Posting<br>";
		  }else{
          echo "Posting yang dicari : <b>'".$cari." '</b><br>";
		  }
        }
        ?>

        <?php 
        if(isset($_GET['urutan'])){
          $urutan = $_GET['urutan'];
          echo "Diurutkan : <b>'".$urutan." '</b><br>";
        }
        ?>
        
        <?php 
        if(isset($_GET['visibel'])){
          $visibel = $_GET['visibel'];
		  echo "Visibilitas : <b>'".$visibel." '</b><br>";
        }
        ?>

        <table class="table table-hover table-striped">
          <thead>
            <tr>
              <th>Judul Posting</th>
              <th>Kategori</th>
              <th><center>Viewer</center></th>
              <th><center>Author</center></th>
              <th><i class="fa fa-eye"></i></th>
              <th><i class="fa fa-comment"></i></th>
            </tr>
          </thead>
          <tbody>

            <?php
            $halaman = 10;
            $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
            $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
            //$result = mysqli_query($koneksi, "SELECT * FROM posting where posting_step=2");
            //$total = mysqli_num_rows($result);
            //$pages = ceil($total/$halaman);  
	
	if(isset($_SESSION['member_status'])){ //Jika login
		if(isset($_GET['cari'])){ 
			$cari = $_GET['cari'];
			if($visibel=="semua"){
				if(isset($_GET['urutan']) && $_GET['urutan'] == "terpopuler"){
					$data = mysqli_query($koneksi,"select * from posting,kategori,member where posting_step=2 and posting_member=member_id and kategori_id=posting_kategori and posting_judul like '%$cari%' OR posting_step=2 and posting_member=member_id and kategori_id=posting_kategori and kategori_nama like '%$cari%' OR posting_step=2 and posting_member=member_id and kategori_id=posting_kategori and member_nama like '%$cari%' order by posting_dibaca DESC LIMIT $mulai, $halaman");
					$total = mysqli_num_rows($data);
				}else{
					$data = mysqli_query($koneksi,"select * from posting,kategori,member where posting_step=2 and posting_member=member_id and kategori_id=posting_kategori and posting_judul like '%$cari%' OR posting_step=2 and posting_member=member_id and kategori_id=posting_kategori and kategori_nama like '%$cari%' OR posting_step=2 and posting_member=member_id and kategori_id=posting_kategori and member_nama like '%$cari%' order by posting_id DESC LIMIT $mulai, $halaman");
					$total = mysqli_num_rows($data);
				}
			}else{
				if(isset($_GET['urutan']) && $_GET['urutan'] == "terpopuler"){
					$data = mysqli_query($koneksi,"select * from posting,kategori,member where posting_visibility='$visibel' and posting_step=2 and posting_member=member_id and kategori_id=posting_kategori and posting_judul like '%$cari%' OR posting_visibility='$visibel' and posting_step=2 and posting_member=member_id and kategori_id=posting_kategori and kategori_nama like '%$cari%' OR posting_visibility='$visibel' and posting_step=2 and posting_member=member_id and kategori_id=posting_kategori and member_nama like '%$cari%' order by posting_dibaca DESC LIMIT $mulai, $halaman");
					$total = mysqli_num_rows($data);
				}else{
					$data = mysqli_query($koneksi,"select * from posting,kategori,member where posting_visibility='$visibel' and posting_step=2 and posting_member=member_id and kategori_id=posting_kategori and posting_judul like '%$cari%' OR posting_visibility='$visibel' and posting_step=2 and posting_member=member_id and kategori_id=posting_kategori and kategori_nama like '%$cari%' OR posting_visibility='$visibel' and posting_step=2 and posting_member=member_id and kategori_id=posting_kategori and member_nama like '%$cari%' order by posting_id DESC LIMIT $mulai, $halaman");
					$total = mysqli_num_rows($data);
				}
		    }
		}else{
			if(isset($_GET['urutan']) && $_GET['urutan'] == "terpopuler"){
				$data = mysqli_query($koneksi,"select * from posting,kategori,member where posting_step=2 and posting_member=member_id and kategori_id=posting_kategori order by posting_dibaca DESC LIMIT $mulai, $halaman");
				$total = mysqli_num_rows($data);
			}else{
				$data = mysqli_query($koneksi,"select * from posting,kategori,member where posting_step=2 and posting_member=member_id and kategori_id=posting_kategori order by posting_id desc LIMIT $mulai, $halaman");
				$total = mysqli_num_rows($data);
			}
		}
	}else{ //Jika tidak login
		if(isset($_GET['cari'])){
			$cari = $_GET['cari'];
			if(isset($_GET['urutan']) && $_GET['urutan'] == "terpopuler"){
				$data = mysqli_query($koneksi,"select * from posting,kategori,member where posting_visibility='publik' and posting_step=2 and posting_member=member_id and kategori_id=posting_kategori and posting_judul like '%$cari%' OR posting_visibility='publik' and posting_step=2 and posting_member=member_id and kategori_id=posting_kategori and kategori_nama like '%$cari%' OR posting_visibility='publik' and posting_step=2 and posting_member=member_id and kategori_id=posting_kategori and member_nama like '%$cari%' order by posting_dibaca DESC LIMIT $mulai, $halaman");
				$total = mysqli_num_rows($data);
			}else{
				$data = mysqli_query($koneksi,"select * from posting,kategori,member where posting_visibility='publik' and posting_step=2 and posting_member=member_id and kategori_id=posting_kategori and posting_judul like '%$cari%' OR posting_visibility='publik' and posting_step=2 and posting_member=member_id and kategori_id=posting_kategori and kategori_nama like '%$cari%' OR posting_visibility='publik' and posting_step=2 and posting_member=member_id and kategori_id=posting_kategori and member_nama like '%$cari%' order by posting_id DESC LIMIT $mulai, $halaman");
				$total = mysqli_num_rows($data);
			}
		}else{
			if(isset($_GET['urutan']) && $_GET['urutan'] == "terpopuler"){
				$data = mysqli_query($koneksi,"select * from posting,kategori,member where posting_visibility='publik' and posting_step=2 and posting_member=member_id and kategori_id=posting_kategori order by posting_dibaca DESC LIMIT $mulai, $halaman");
				$total = mysqli_num_rows($data);
			}else{
				$data = mysqli_query($koneksi,"select * from posting,kategori,member where posting_visibility='publik' and posting_step=2 and posting_member=member_id and kategori_id=posting_kategori order by posting_id desc LIMIT $mulai, $halaman");
				$total = mysqli_num_rows($data);
			}
		}
	}
			
			//end logic sql   
			$pages = ceil($total/$halaman);
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
                <td><center>
                 <?php if($d['posting_visibility']=="publik"){ ?>
                      	<div class="badge bg-success text-white"><i class="fa fa-arrow-up"></i>&nbsp;<?php echo $d['posting_visibility'] ?></div>
                      	<?php }else{ ?>
                      	<div class="badge bg-warning text-white"><i class="fa fa-arrow-down"></i>&nbsp;<?php echo $d['posting_visibility'] ?></div>
                      	<?php } ?> </center>
                </td>
                <td>
                  <a href="detail_member.php?id=<?php echo $d['member_id']; ?>">
                   <center>
                    <?php 
                    if($d['member_foto'] == ""){
                      ?>
                      <img class="img-fluid rounded-circle shadow" style="width: 35px;height: 35px" src="gambar/sistem/member.png">
                      <?php
                    }else{
                      ?>
                      <img class="img-fluid rounded-circle shadow" style="width: 35px;height: 35px" src="gambar/member/<?php echo $d['member_foto'] ?>">
                      <?php
                    }
                    ?>
                    <br>
                    <small class="ml-2 text-dark"><?php echo ucfirst($d['member_nama']) ?></small>  
                  </center>
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

<?php include 'sidebar.php'; ?>

</div>
</div>

<?php include 'footer_old.php'; ?>
