<?php include 'header.php'; ?>


<div class="container col-lg-10">

  <div class="row">

    <div class="col-lg-9">

      <div class="card">
        <div class="card-body shadow">

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
	  	<?php if(isset($_SESSION['member_status'])){ //jika login ?>
		  
		  	<div class="form-group">
				<form action="index.php" method="get">
					<div class="form-row">
						<div class="col-lg-5">
						 <div class="input-group input-group-alternative mb-3">
							<div class="input-group-append">
							  <span class="input-group-text shadow"><i class="fa fa-search"></i></span>
							</div>
							 <input class="form-control shadow" name="cari" placeholder=" Cari di sini .." type="text" data-live-search="true">
						  </div>
						</div>
						<div class="col-lg-2">
							<select class="form-control shadow" name="visibil" id="visibil">
								<option value="">Semua Posting</option>
								<option class="dropdown-divider bg-light" disabled></option>
								<option value="publik">Publik</option>
								<option value="internal">Internal</option>
							</select>
						</div>
						<div class="col-lg-3">
							<select class="selectpicker form-control shadow" name="kategori" id="kategori" data-live-search="true">
								<option value="all">Kategori Fungsi</option>
								<option class="dropdown-divider bg-light" disabled></option>
								<?php 
								$data = mysqli_query($koneksi,"SELECT * FROM kategori ORDER BY kategori_nama ASC");
								while($d = mysqli_fetch_array($data)){ ?>
								<option value="<?php echo $d['kategori_id']; ?>"><?php echo $d['kategori_nama']; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="col-lg-2">
							<button class="btn btn-primary btn-block shadow" value="submit">Cari</button>
						</div>
					</div>
				</form>
			</div>
			
			<?php }else{ //jika belum login ?>
			
			<div class="form-group">
				<form action="index.php" method="get">
					 <div class="form-row">
						<div class="col-lg-7">
						 <div class="input-group input-group-alternative mb-2">
							<div class="input-group-append">
							  <span class="input-group-text shadow"><i class="fa fa-search"></i></span>
							</div>
							 <input class="form-control shadow" name="cari" placeholder=" Cari di sini .." type="text">
						  </div>
						</div>
						<div class="col-lg-3">
							<select class="selectpicker form-control shadow" name="kategori" id="kategori" data-live-search="true">
								<option value="all">Kategori Fungsi</option>
								<?php 
								$data = mysqli_query($koneksi,"SELECT * FROM kategori ORDER BY kategori_nama ASC");
								while($d = mysqli_fetch_array($data)){ ?>
								<option value="<?php echo $d['kategori_id']; ?>"><?php echo $d['kategori_nama']; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="col-lg-2">
							<button class="btn btn-primary btn-block shadow" value="submit">Cari</button>
						</div>
					</div>
				</form>
			</div>
			<?php } ?>
		
		<!-- end search box -->
        
		<!-- URUTAN 
        <div class="btn-group pull-right mb-3">
          <div class="dropdown">
            Urutkan : &nbsp;
            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php /* if(isset($_GET['urutan']) && $_GET['urutan'] == "terpopuler"){echo "Terpopuler";}else{echo "Terbaru";} ?>
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
				  */ ?>
            </div>
          </div>
        </div>
        -->
        
        

            <?php
            //$halaman = 10;
            //$page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
            //$mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
            //$result = mysqli_query($koneksi, "SELECT * FROM posting where posting_step=2");
            //$total = mysqli_num_rows($result);
            //$pages = ceil($total/$halaman);  
			$bagianWhere = "";

			if (isset($_GET['cari'])){
			   $cari = $_GET['cari'];
					if(!empty($cari)){
						echo "-> Kata yang dicari : <b>".$cari."</b><br>";
					}
			   if (empty($bagianWhere)){
					$bagianWhere .= "and posting_judul like '%$cari%'";
			   }
			}
			
			if (isset($_GET['kategori'])){
			   $kategori = $_GET['kategori'];
				if($kategori=="all"){
					$bagianWhere;
				}else{
					$kat = mysqli_query($koneksi,"SELECT * FROM kategori WHERE kategori_id='$kategori'");
 						while($k = mysqli_fetch_array($kat)){
						echo "-> Kategori yang dicari : <b>".$k['kategori_nama']."</b><br>";
						}
					
				   if (empty($bagianWhere)){
						$bagianWhere .= "and kategori_id = '$kategori'";
				   }else{
						$bagianWhere .= " and kategori_id = '$kategori'";
				   }
				}
			}
			
			if (isset($_GET['visibil'])){
			   $visibil = $_GET['visibil'];
				if(empty($visibil)){
					$bagianWhere;
				}else{
					echo "-> Visibilitas : <b>".$visibil."</b><br>";
									
				   if (empty($bagianWhere)){
						$bagianWhere .= "and posting_visibility = '$visibil'";
				   }else{
						$bagianWhere .= " and posting_visibility = '$visibil'";
				   }
				}
			}
			 
		// end logika form cari	  ?>
		<br>
		<div class="table-responsive">
		<table class="table table-hover table-striped" id="table-posting-datatable">
          <thead>
            <tr>
              <th>Id</th>
              <th>Posting Terbaru</th>
              <th><i class="fa fa-eye"></i></th>
              <th><i class="fa fa-comment"></i></th>
              <!-- <th><center>Author</center></th> -->
              <th>Created</th>
            </tr>
          </thead>
          <tbody>
		
		<?php	  
		if(isset($_SESSION['member_status'])){ //Jika login
			if (isset($_GET['cari'])){
				$data = mysqli_query($koneksi, "select * from posting,kategori,member where posting_step=2 and posting_member=member_id and kategori_id=posting_kategori ".$bagianWhere);
				//echo "select * from posting,kategori,member where posting_visibility='publik' and posting_step=2 and posting_member=member_id and kategori_id=posting_kategori ".$bagianWhere;
				$total = mysqli_num_rows($data);
			}else{
				$data = mysqli_query($koneksi, "select * from posting,kategori,member where posting_step=2 and posting_member=member_id and kategori_id=posting_kategori order by posting_id DESC");
				$total = mysqli_num_rows($data);
			}

		}else{ //Jika tidak login
			
			if (isset($_GET['cari'])){
				$data = mysqli_query($koneksi, "select * from posting,kategori,member where posting_visibility='publik' and posting_step=2 and posting_member=member_id and kategori_id=posting_kategori ".$bagianWhere);
				//echo "select * from posting,kategori,member where posting_visibility='publik' and posting_step=2 and posting_member=member_id and kategori_id=posting_kategori ".$bagianWhere;
				$total = mysqli_num_rows($data);
			}else{
				$data = mysqli_query($koneksi, "select * from posting,kategori,member where posting_visibility='publik' and posting_step=2 and posting_member=member_id and kategori_id=posting_kategori order by posting_id DESC");
				$total = mysqli_num_rows($data);
			}

		}
			
			//end logic sql   
			//$pages = ceil($total/$halaman);
            //$no = $mulai+1;
			

            while($d = mysqli_fetch_array($data)){
              ?>


              <tr>
                <td>
                	<?php echo $d['posting_id']; ?>
                </td>
                <td>
                  <a href="diskusi.php?id=<?php echo $d['posting_id']; ?>"><p class="mb-n3 text-black-50"><b><?php echo $d['posting_judul'] ?></b></p></a>
                  <br>
                  <?php if($d['posting_visibility']=="publik"){ ?>
                      	<div class="badge badge-success"><i class="fa fa-arrow-up"></i>&nbsp;<?php echo $d['posting_visibility'] ?></div>
                      	<?php }else{ ?>
                      	<div class="badge badge-warning"><i class="fa fa-arrow-down"></i>&nbsp;<?php echo $d['posting_visibility'] ?></div>
                      	<?php } 
					?>
                  <a href="kategori.php?id=<?php echo $d['kategori_id']; ?>">
                    <div class="badge badge-primary"><?php echo $d['kategori_nama'] ?></div>
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
              <!--
			  <td>
                  <a href="detail_member.php?id=<?php /* echo $d['member_id']; ?>">
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
                    <small class="ml-2 text-dark"><?php echo ucfirst($d['member_nama']) */ ?></small>  
                  </center>
                </a>
              </td> -->
              <td>
              	<i><small><?php echo date('d-M-Y H:i:s',strtotime($d['posting_tanggal'])) ?></small></i>
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

</div>

<?php include 'sidebar.php'; ?>

</div>
</div>

<?php include 'footer_old.php'; ?>
