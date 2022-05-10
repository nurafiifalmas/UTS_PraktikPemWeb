<div class="modal fade" id="form-tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">FORM TAMBAH DONASI</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="post" class="modal-content modal-body border-0 p-0" enctype="multipart/form-data">
                <div class="input-group mb-2">
                    <input  class="form-control" type="text" name="judul"  placeholder="Judul Donasi..." required>
                </div>
                <div class="input-group mb-2">
                    <input  class="form-control" type="text" name="kategori" placeholder="Kategori Donasi..." required>
                </div>
                <div class="input-group mb-2">
                    <textarea  class="form-control" type="text" name="deskripsi" placeholder="Deskripsi Donasi..." required></textarea>
                </div>
                <div class="input-group mb-2">
                    <input  class="form-control" type="number" name="target" placeholder="Target Donasi Rp" required>
                </div>
                <label class="form-label">Batas Akhir</label>
                <div class="input-group mb-2">
                    <input  class="form-control" type="date" name="tanggal" required>
                </div>
                <label class="form-label">Foto pertama</label>
                <div class="input-group mb-2">
                    <input  class="form-control" type="file" name="foto1" placeholder="Foto pertama" required>
                </div>
                <label class="form-label">Foto kedua</label>
                <div class="input-group mb-2">
                    <input  class="form-control" type="file" name="foto2" placeholder="Foto kedua" required>
                </div>
                <button type="submit" name=submit class="btn btn-success">Submit</button>
            </form>
      </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>

<?php 
	if(isset($_POST['submit'])){
        $judul = $_POST['judul'];
        $kategori = $_POST['kategori'];
        $deskripsi = $_POST['deskripsi'];
        $target = $_POST['target'];
        $sementara = 0;
        $tanggal = $_POST['tanggal'];
        $foto1 = $_FILES["foto1"]["name"];
        $foto2 = $_FILES["foto2"]["name"];
        $tmp1 = $_FILES["foto1"]["tmp_name"];
        $tmp2 = $_FILES["foto2"]["tmp_name"]; 
        $path = "./../assets/img/images/";

        if ($foto1 != "" && $foto2 != "") {
            move_uploaded_file($tmp1, $path.$foto1);
            move_uploaded_file($tmp2, $path.$foto2);
            $query = mysqli_query($koneksi,"INSERT INTO tb_donasi 
            VALUES (NULL,'$judul','$kategori','$deskripsi','$target','$sementara','$tanggal','".$foto1."','".$foto2."')");
            
            if($query){
                echo "<script>alert('Data berhasil ditambahkan')</script>";
				echo "<script>location='donasi.php'</script>";
				}
        }
        elseif ($foto1 != "") {
            move_uploaded_file($tmp1, $path.$foto1);
            $query = mysqli_query($koneksi,"INSERT INTO tb_donasi 
            VALUES (NULL,'$judul','$kategori','$deskripsi','$target','$sementara','$tanggal','".$foto1."','kosong')");
            
            if($query){
                echo "<script>alert('Data berhasil ditambahkan')</script>";
				echo "<script>location='donasi.php'</script>";
				}
        }
        elseif ($foto2 != "") {
            move_uploaded_file($tmp2, $path.$foto2);
            $query = mysqli_query($koneksi,"INSERT INTO tb_donasi 
            VALUES (NULL,'$judul','$kategori','$deskripsi','$target','$sementara','$tanggal','kosong','$foto2')");
            
            if($query){
                echo "<script>alert('Data berhasil ditambahkan')</script>";
				echo "<script>location='donasi.php'</script>";
				}
        }
        else {
            $query = mysqli_query($koneksi,"INSERT INTO tb_donasi 
            VALUES (NULL,'$judul','$kategori','$deskripsi','$target','$sementara','$tanggal','kosong','kosong')");
            
            if($query){
                echo "<script>alert('Data berhasil ditambahkan')</script>";
				echo "<script>location='donasi.php'</script>";
				}
        }
	}
?>