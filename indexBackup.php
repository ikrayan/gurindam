<?php include 'header.php'; ?>

<!-- mulai carousel -->
		<div class="bd-example mb-n3">
			<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
					<li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
					<li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
					<li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
				</ol>
				<div class="carousel-inner">
					<div class="carousel-item active">
						<img src="gambar/carousel/carousel1.jpg" class="d-block w-100" alt="...">
					</div>
					<div class="carousel-item">
						<img src="gambar/carousel/carousel2.jpg" class="d-block w-100" alt="...">
					</div>
					<div class="carousel-item">
						<img src="gambar/carousel/carousel3.jpg" class="d-block w-100" alt="...">
					</div>
				
					<a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
			</div>
		</div>
		<hr class="mb-3">
<!-- end carousel -->

<div class="container col-lg-9">

  <div class="row">

    <div class="col-lg-9">      

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
				<form action="indexQ.php" method="get">
					<div class="form-row mb-1">
					  <div class="col-lg-12 mb-1">
						 <div class="input-group input-group-alternative">
							<div class="input-group-append">
							  <span class="input-group-text shadow"><i class="fa fa-search"></i></span>
							</div>
							 <input class="form-control shadow" name="cari" placeholder=" Cari di sini .." type="text">
						 </div>
					  </div>
					 </div>
					  <div class="col-lg-12 mb-2" style="cursor: pointer;">
					  	<span class="btn btn-sm btn-block m-1" id="btn_extra_down"><i class="fa fa-2x fa-caret-down"></i></span>
					  	<span class="btn btn-sm btn-block m-1" id="btn_extra_up"><i class="fa fa-2x fa-caret-up"></i></span>
					  </div>
					
					<div class="form-row ml-1 mt-2" id="extra">
						<div class="col-lg-2 mb-2">> Pencarian Lanjutan</div>
						<div class="col-lg-2 mb-2">
							<select class="form-control shadow" name="jenis" id="jenis">
								<option value="">Semua Jenis</option>
								<option value="regulasi">Regulasi</option>
								<option value="knowledge">Knowledge</option>								
								<option value="share">Share</option>
							</select>
						</div>					 
						<div class="col-lg-2 mb-2">
							<select class="form-control shadow" name="visibil" id="visibil">
								<option value="">Semua Viewer</option>
								<option value="publik">Publik</option>
								<option value="internal">Internal</option>
							</select>
						</div>
						<div class="col-lg-4 mb-2">
							<select class="selectpicker form-control shadow" name="kategori" id="kategori" data-live-search="true">
								<option value="all">Kategori</option>
								<option class="dropdown-divider bg-light" disabled></option>
								<?php 
								$data = mysqli_query($koneksi,"SELECT * FROM kategori WHERE kategori_jenis='manajemenasn' ORDER BY kategori_nama ASC");
								while($d = mysqli_fetch_array($data)){ ?>
								<option value="<?php echo $d['kategori_id']; ?>"><?php echo $d['kategori_nama']; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="col-lg-2 mb-2">							
							<button class="btn btn-primary btn-block shadow" value="submit">Cari</button>
						</div>
					</div>
					
					<!-- old 
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
								<option value="publik">Publik</option>
								<option value="internal">Internal</option>
							</select>
						</div>
						<div class="col-lg-3">
							<select class="selectpicker form-control shadow" name="kategori" id="kategori" data-live-search="true">
								<option value="all">Kategori Fungsi</option>
								<option class="dropdown-divider bg-light" disabled></option>
								<?php /*
								$data = mysqli_query($koneksi,"SELECT * FROM kategori ORDER BY kategori_nama ASC");
								while($d = mysqli_fetch_array($data)){ ?>
								<option value="<?php echo $d['kategori_id']; ?>"><?php echo $d['kategori_nama']; ?></option>
								<?php } */ ?>
							</select>
						</div>
						<div class="col-lg-2">
							<button class="btn btn-primary btn-block shadow" value="submit">Cari</button>
						</div>
					</div>
					<!-- old -->
				</form>
			</div>
			
			<?php }else{ //jika belum login ?>
			
			<div class="form-group">
				<form action="indexQ.php" method="get">
					<div class="form-row mb-1">
					  <div class="col-lg-12 mb-2">
						 <div class="input-group input-group-alternative">
							<div class="input-group-append">
							  <span class="input-group-text shadow"><i class="fa fa-search"></i></span>
							</div>
							 <input class="form-control shadow" name="cari" placeholder=" Cari di sini .." type="text">
						 </div>
					  </div>
					 </div>
					  <div class="col-lg-12 mb-2" style="cursor: pointer;">
					  	<span class="btn btn-sm btn-block m-1" id="btn_extra_down"><i class="fa fa-2x fa-caret-down"></i></span>
					  	<span class="btn btn-sm btn-block m-1" id="btn_extra_up"><i class="fa fa-2x fa-caret-up"></i></span>
					  </div>
					
					
					<div class="form-row ml-1 mt-2" id="extra">					   
						<div class="col-lg-2 mb-2">> Pencarian Lanjutan</div>
						<div class="col-lg-2 mb-2">
							<select class="form-control shadow" name="jenis" id="jenis">								
								<option value="">Semua Jenis</option>
								<option value="regulasi">Regulasi</option>
								<option value="knowledge">Knowledge</option>								
								<option value="share">Share</option>
							</select>
						</div>	
						<div class="col-lg-6 mb-2">
							<select class="selectpicker form-control shadow" name="kategori" id="kategori" data-live-search="true">
								<option value="all">Kategori</option>
								<?php 
								$data = mysqli_query($koneksi,"SELECT * FROM kategori WHERE kategori_jenis='manajemenasn' ORDER BY kategori_nama ASC");
								while($d = mysqli_fetch_array($data)){ ?>
								<option value="<?php echo $d['kategori_id']; ?>"><?php echo $d['kategori_nama']; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="col-lg-2 mb-2">							
							<button class="btn btn-primary btn-block shadow" value="submit">Cari</button>
						</div>
					</div>				
				</form>
			</div>
			<?php } ?>
		
	<!-- end search box -->
	
	<hr class="mt-n2 mb-3">
	
<!-- Posting Terbaru -->
	<div class="card mb-4">
      	<div class="card-header pb-3 pt-3">
			<h5 class="mb-0"><b>Posting</b>Terbaru</h5>
		</div>
     	
     	<div class="card-body shadow">
  			- List Posting Terbaru
		</div>
	</div>
  	
 <!-- Lets Share -->
  	<div class="card mb-4">
      	<div class="card-header pb-3 pt-3">
      	  <div class="clearfix">
      	  	<div class="pull-left">
				<h5 class="mb-0">Lets<b>Share</b></h5>
			</div>
	  		<?php 
			if(isset($_SESSION['member_status'])){
			?>
		  	<div class="pull-right">
		  		<a href="posting.php" target="_blank"><i class="fa fa-2x fa-plus-square text-black-50"></i></a>
			</div>
			<?php
			}
			?>
		  </div>  
		</div>
     	
     	<div class="card-body shadow">
  			<?php 
			if(isset($_SESSION['member_status'])){ //Jika login
				$datashare = mysqli_query($koneksi, "select * from posting where posting_jenis='share' and posting_step=2 order by posting_id DESC LIMIT 5");	
				
			}else{ //Jika tidak login
				$datashare = mysqli_query($koneksi, "select * from posting where posting_jenis='share' and posting_visibility='publik' and posting_step=2 order by posting_id DESC LIMIT 5");
			}			
			//end logic sql
			if(mysqli_num_rows($datashare)>0){
			?>
				<div class="d-flex flex-wrap ml-n1">
			
			<?php
			while($listshare = mysqli_fetch_array($datashare)){
			?>				
				<div class="d-flex align-items-center col-lg-4 mb-3">
					<i class="fa text-black-50 fa-share-alt"></i>
					<a target="_blank" href="diskusi.php?id_posting=<?php echo $listshare['posting_id']; ?>"><span class="ml-2 text-dark"><?php echo $listshare['posting_judul']; ?></span></a>
				</div>	
			<?php
			}
			?>	
				</div>
				<a href="indexQ.php?jenis=share" target="_blank" class="text-black-50 d-flex justify-content-end"><small>Tampilkan semua >></small></a>
			<?php	
			}else{
				echo "<small><i>Belum ada data</i></small>";
			}
			?>
		</div>
	</div>
 <!-- Batas Lets Share -->
 
 <!-- Aspek Manajemen ASN -->  
    <div class="card mb-4">
       	<div class="card-header pb-3 pt-3">  			
  			<div class="clearfix">
      	  	<div class="pull-left">
				<h5 class="mb-0">Aspek<b>Manajemen</b><i>ASN</i></h5>
			</div>
	  		<?php 
			if(isset($_SESSION['member_status'])){
			?>
		  	<div class="pull-right">
		  		<a href="posting.php" target="_blank"><i class="fa fa-2x fa-plus-square text-black-50"></i></a>
			</div>
			<?php
			}
			?>
		  </div>
		</div>
       
        <div class="card-body shadow">	
						
		<?php
			
			$kat = mysqli_query($koneksi, "SELECT * FROM kategori WHERE kategori_jenis='manajemenasn' ORDER BY kategori_nama");
			$jmlkat = mysqli_num_rows($kat);
			$lis = 0;
			
            while($k = mysqli_fetch_array($kat)){
				$lis++;				
        ?>
        
<!-- Tampilkan kategori fungsi -->
   		<div id=<?php echo $k['kategori_id']; ?>>
  		  <div id=<?php echo "katMenu".$lis ?> class="mb-2" style="cursor: pointer;" onmouseover="style.backgroundColor='#EEEEEE'" onmouseout="style.backgroundColor='transparent'">
   		  	<h6 class="mb-n3 text-black-50">&nbsp;
   		  		<i class="fa fa-caret-right" id=<?php echo "caretRight".$lis ?>></i>
   		  		<i class="fa fa-caret-down" id=<?php echo "caretDown".$lis ?>></i>
   		  			<b><?php echo $k['kategori_nama']; ?></b>
   		  	</h6><br>
		  </div>
  		  	
   		  	<div id=<?php echo "katContent".$lis ?>>
				<ul class="nav nav-tabs ml-3" id="myTab" role="tablist">
			  	  <!-- tab regulasi -->
				  <li class="nav-item">
					<a class="nav-link active" id=<?php echo "regulasi-tab".$lis; ?> data-toggle="tab" href=<?php echo "#regulasi".$lis; ?> role="tab" aria-controls="regulasi" aria-selected="true"><small><b>Regulasi</b></small></a>
				  </li>
				  <!-- tab knowledge -->
				  <li class="nav-item">
					<a class="nav-link" id=<?php echo "knowledge-tab".$lis; ?> data-toggle="tab" href=<?php echo "#knowledge".$lis; ?> role="tab" aria-controls="knowledge" aria-selected="false"><small><b>Knowledge</b></small></a>
				  </li>
				  <!-- tab media 
				  <li class="nav-item">
					<a class="nav-link" id=<?php //echo "media-tab".$lis; ?> data-toggle="tab" href=<?php //echo "#media".$lis; ?> role="tab" aria-controls="media" aria-selected="false"><small><b>Media</b></small></a>
				  </li> -->
				  <!-- tab faq -->
				  <li class="nav-item">
					<a class="nav-link" id=<?php echo "faq-tab".$lis; ?> data-toggle="tab" href=<?php echo "#faq".$lis; ?> role="tab" aria-controls="faq" aria-selected="false"><small><b>FAQ</b></small></a>
				  </li>
				</ul>
				
				<div class="tab-content" id="myTabContent">
				
		<!-- isi tab regulasi -->
				  <div class="tab-pane fade show active" role="tabpanel" id=<?php echo "regulasi".$lis; ?>  aria-labelledby=<?php echo "regulasi-tab".$lis ?>>
				  
			<?php 
			if(isset($_SESSION['member_status'])){ //Jika login
				$datareg = mysqli_query($koneksi, "select * from posting where posting_jenis='regulasi' and posting_step=2 and posting_kategori=$k[kategori_id] order by posting_id DESC LIMIT 5");	
				
			}else{ //Jika tidak login
				$datareg = mysqli_query($koneksi, "select * from posting where posting_jenis='regulasi' and posting_visibility='publik' and posting_step=2 and posting_kategori=$k[kategori_id] order by posting_id DESC LIMIT 5");
			}			
			//end logic sql
			if(mysqli_num_rows($datareg)>0){
			?>
				<div class="d-flex flex-wrap ml-3 mt-4">
			
			<?php
			while($listreg = mysqli_fetch_array($datareg)){
			?>	
			
				<div class="d-flex align-items-center col-lg-4 mb-3">
					<i class="fa fa-2x text-black-50 fa-file-pdf-o"></i>
					<a target="_blank" href="diskusi.php?id_posting=<?php echo $listreg['posting_id']; ?>"><span class="ml-2 text-dark"><?php echo $listreg['posting_judul']; ?></span></a>
				</div>	
						
			<?php
			}
			?>	
				</div>
				<a href="indexQ.php?jenis=regulasi" target="_blank" class="text-black-50 d-flex justify-content-end"><small>Tampilkan semua >></small></a>
			<?php	
			}else{
				echo "<br><span class='pl-4'><small><i>Belum ada data</i></small></span>";
			}
			?>
				  </div>
				
		<!-- isi tab knowledge -->
				  <div class="tab-pane fade" role="tabpanel" id=<?php echo "knowledge".$lis; ?> aria-labelledby=<?php echo "knowledge-tab".$lis ?>>
				  	
			<?php 
			if(isset($_SESSION['member_status'])){ //Jika login
				$datadok = mysqli_query($koneksi, "select * from posting where posting_jenis='knowledge' and posting_step=2 and posting_kategori=$k[kategori_id] order by posting_id DESC LIMIT 5");	
				
			}else{ //Jika tidak login
				$datadok = mysqli_query($koneksi, "select * from posting where posting_jenis='knowledge' and posting_visibility='publik' and posting_step=2 and posting_kategori=$k[kategori_id] order by posting_id DESC LIMIT 5");
			}			
			//end logic sql
			if(mysqli_num_rows($datadok)>0){
			?>
				<div class="d-flex flex-wrap ml-3 mt-4">
			
			<?php
			while($listdok = mysqli_fetch_array($datadok)){
			?>			
				<div class="d-flex align-items-center col-lg-4 mb-3">
					<i class="fa fa-2x text-black-50 fa-file-archive-o"></i>
					<a target="_blank" href="diskusi.php?id_posting=<?php echo $listdok['posting_id']; ?>"><span class="ml-2 text-dark"><?php echo $listdok['posting_judul']; ?></span></a>
				</div>	
						
			<?php
			}
			?>	
				</div>
				<a href="indexQ.php?jenis=knowledge" target="_blank" class="text-black-50 d-flex justify-content-end"><small>Tampilkan semua >></small></a>
			<?php
			}else{
				echo "<br><span class='pl-4'><small><i>Belum ada data</i></small></span>";
			}
			?>
				  	
				  </div>
				 
		<!-- isi tab media 
				  <div class="tab-pane fade" role="tabpanel" id=<?php /* echo "media".$lis; ?> aria-labelledby=<?php echo "media-tab".$lis ?>>
				  	
			<?php 
			if(isset($_SESSION['member_status'])){ //Jika login
				$datamed = mysqli_query($koneksi, "select * from posting where posting_jenis='media' and posting_step=2 and posting_kategori=$k[kategori_id] order by posting_id DESC LIMIT 5");	
				
			}else{ //Jika tidak login
				$datamed = mysqli_query($koneksi, "select * from posting where posting_jenis='media' and posting_visibility='publik' and posting_step=2 and posting_kategori=$k[kategori_id] order by posting_id DESC LIMIT 5");
			}			
			//end logic sql
			if(mysqli_num_rows($datamed)>0){
			?>
				<div class="d-flex flex-wrap ml-3 mt-3">
			
			<?php
			while($listmed = mysqli_fetch_array($datamed)){
			?>			
				<div class="d-flex align-items-center col-lg-4 mb-3">
					<i class="fa fa-2x text-black-50 fa-film"></i>
					<a target="_blank" href="diskusi.php?id_posting=<?php echo $listmed['posting_id']; ?>"><span class="ml-2 text-dark"><?php echo $listmed['posting_judul']; ?></span></a>
				</div>	
						
			<?php
			}
			?>	
				</div>
				<a href="indexQ.php?jenis=media" target="_blank" class="text-black-50 d-flex justify-content-end"><small>Tampilkan semua >></small></a>
			<?php
			}else{
				echo "<br><span class='pl-4'><small><i>Belum ada data</i></small></span>";
			} */
			?>
				  	
				  </div> --> 
				
		<!-- isi tab faq -->
				  <div class="tab-pane fade" role="tabpanel" id=<?php echo "faq".$lis; ?> aria-labelledby=<?php echo "faq-tab".$lis ?>>
				  	<br><span class='pl-4'><small><i>Belum ada data FAQ</i></small></span>
				  </div>
				</div>
				<hr class="ml-3 mt-4 mb-3 bg-dark">
			</div>
			
		</div>
   		
    <!-- Akhir Tampilkan kategori fungsi -->

        <?php 
          }
        ?>
    </div>
  </div>
<!-- Akhir Aspek Manajemen ASN -->
</div>

<?php include 'sidebar.php'; ?>

</div>
</div>

<?php include 'footer_old.php'; ?>
