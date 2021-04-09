<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Member
      <small>Edit Member</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-6 col-lg-offset-3">       
        <div class="box box-info">

          <div class="box-header">
            <h3 class="box-title">Edit Member</h3>
            <a href="member.php" class="btn btn-info btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp Kembali</a> 
          </div>
          <div class="box-body">


            <?php 
            $id = $_GET['id'];
            $data = mysqli_query($koneksi,"select * from user where PNS_ID='$id'");
            while($d = mysqli_fetch_array($data)){
              ?>
              <form action="member_update.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label>Nama</label>
                  <input type="hidden" name="id" value="<?php echo $d['PNS_ID']; ?>">
                  <input type="text" class="form-control" name="nama" required="required" placeholder="Masukkan Nama member.." value="<?php echo $d['NAMA']; ?>" disabled>
                </div>
                
                <div class="form-group">
                  <label>NIP</label>
                  <input type="text" class="form-control" name="nip" required="required" placeholder="Masukkan NIP member.." value="<?php echo $d['NIP_BARU']; ?>" disabled>
                </div>

                <div class="form-group">
                  <label>Email</label>
                  <input type="text" class="form-control" name="email" required="required" placeholder="Masukkan email member.." value="<?php echo $d['EMAIL']; ?>" disabled>
                </div>

                <div class="form-group">
                  <label>HP / WA</label>
                  <input type="number" class="form-control" name="hp" required="required" placeholder="Masukkan hp member.." value="<?php echo $d['NOMOR_HP']; ?>" disabled>
                </div>

                <div class="form-group">
                  <label>Jabatan</label>
                  <input type="text" class="form-control" name="jabatan" required="required" placeholder="Masukkan alamat member.." value="<?php echo $d['JABATAN_NAMA']; ?>" disabled>
                </div>

                <div class="form-group">
                  <label>Password</label>
                  <input type="password" class="form-control" name="password" placeholder="Masukkan password member..">
                  <small class="text-muted">Kosongkan jika tidak ingin mengganti password</small>
                </div>

                <div class="form-group">
                  <label>Foto Profil</label>
                  <input type="file" name="foto">
                  <small class="text-muted">Kosongkan jika tidak ingin mengganti foto profil</small>
                </div>
                
                <div class="form-group">
                  <label>Level</label>
                  <select class="form-control" id="level" name="level">
                  <option value="<?php echo $d['LEVEL']; ?>"><?php echo $d['LEVEL']; ?></option>
                  <?php if($d['LEVEL']=="member"){ ?>
				  	<option value="verifikator">verifikator</option>
				  <?php }else{ ?>
				    <option value="member">member</option>
				  <?php } ?>
				  </select>                
                </div>
                
	<!-- checkbox verifikator -->
   	<div class="form-group" id="divRoles">   		
   		<?php
			$data = mysqli_query($koneksi,"SELECT * FROM kategori LEFT JOIN v_roles ON kategori.kategori_id = v_roles.role ORDER BY kategori_nama ASC");
			if(mysqli_num_rows($data)>0){ 
				//jika sudah ada vrole
				while($d = mysqli_fetch_array($data)){
					if($d['kategori_id']==$d['role']){
					?>
					&nbsp;&nbsp;<input type="checkbox" value="<?php echo $d['kategori_id'] ?>" name="vroles[]" checked>
					<?php }else{ ?>
					&nbsp;&nbsp;<input type="checkbox" value="<?php echo $d['kategori_id'] ?>" name="vroles[]">
					<?php } ?>		
					&nbsp;<label for=""><?php echo $d['kategori_nama'] ?></label><br>
 		<?php  
				}		
			}else{
				//Jika belum ada vrole
				$data0 = mysqli_query($koneksi,"SELECT * FROM kategori ORDER BY kategori_nama ASC");
				while($d0 = mysqli_fetch_array($data0)){
		?>
					&nbsp;&nbsp;<input type="checkbox" value="<?php echo $d0['kategori_id'] ?>" name="vroles[]">
					&nbsp;<label for=""><?php echo $d0['kategori_nama'] ?></label><br>
		<?php 
				}
			}
		?>   		
   	</div>   
    <!-- akhir checkbox verifikator -->
                <div class="form-group">
                  <input type="submit" class="btn btn-sm btn-primary" value="Simpan">
                </div>
              </form>
              <?php 
            }
            ?>

          </div>

        </div>
      </section>
    </div>
  </section>

</div>
<?php include 'footer.php'; ?>