<!DOCTYPE html>
<?php 
    $koneksi=mysqli_connect("localhost","root","","uts_nurafiifalmas");
?>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>website donasi online | YukDonasi.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container d-flex">
            <a class="navbar-brand text-success logo h1 align-self-center">
                <img src="./../assets/img/hero_donasi.PNG" alt="" width="200px">
            </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav left">
                <a class="nav-link text-default" href="index.php">Home</a>
                <a class="nav-link text-default" href="donasi.php">Donasi</a>
                <a class="nav-link text-default" href="index.php">Pembayaran</a>
            </div>
        </div>
        </div>
    </nav>
    <?php 
        $query = mysqli_query($koneksi,"SELECT * FROM tb_donasi WHERE id_donasi='".$_GET['id']."'");
		while ($row = mysqli_fetch_assoc($query)) {
	?> 
    <section>
        <div class="container p-5">  
            <div class="row">

            <div>
                <h1 class="text-default">Edit data Donasi</h1>
            </div>
            
            <form method="post" class="modal-content modal-body border-0 p-0" enctype="multipart/form-data">
                <label class="form-label fw-bold">Judul Donasi</label>
                <div class="input-group mb-2">
                    <input  class="form-control" type="text" name="judul"  value="<?php echo $row['judul_donasi'];?>" required>
                </div>
                <label class="form-label fw-bold">Kategori Donasi</label>
                <div class="input-group mb-2">
                    <input  class="form-control" type="text" name="kategori" value="<?php echo $row['kategori_donasi']; ?>" required>
                </div>
                <label class="form-label fw-bold">Deskripsi Donasi</label>
                <div class="input-group mb-2">
                    <input  class="form-control" type="text" name="deskripsi" value="<?php echo $row['deskripsi_donasi'];?>" required>
                </div>
                <label class="form-label fw-bold">Target Donasi</label>
                <div class="input-group mb-2">
                    <input  class="form-control" type="number" name="target" value="<?php echo $row['target_donasi']; ?>" required>
                </div>
                <label class="form-label fw-bold">Batas Akhir</label>
                <div class="input-group mb-2">
                    <input  class="form-control" type="date" name="tanggal" value="<?php echo $row['batas_tanggal']; ?>" required>
                </div>
                <label class="form-label fw-bold">Foto pertama</label>
                <span>
                <?php echo $row['gambar_satu']; ?>"
                </span>
                <div class="input-group mb-2">
                    <input  class="form-control" type="file" name="foto1" placeholder="Foto pertama">
                </div>
                <label class="form-label fw-bold">Foto kedua</label>
                <span>
                <?php echo $row['gambar_dua']; ?>"
                </span>
                <div class="input-group mb-2">
                    <input  class="form-control" type="file" name="foto2" placeholder="Foto kedua">
                </div>
                <button type="submit" name=submit class="btn btn-success">Submit</button>
            </form>

            <?php 

	if(isset($_POST['submit'])){
        $judul = $_POST['judul'];
        $kategori = $_POST['kategori'];
        $deskripsi = $_POST['deskripsi'];
        $target = $_POST['target'];
        $tanggal = $_POST['tanggal'];
        $foto1 = $_FILES["foto1"]["name"];
        $foto2 = $_FILES["foto2"]["name"];
        $tmp1 = $_FILES["foto1"]["tmp_name"];
        $tmp2 = $_FILES["foto2"]["tmp_name"]; 
        $path = "./../assets/img/images/";

        if(empty($foto2) && !empty($foto1)){
            $query=mysqli_query($koneksi,"SELECT * FROM tb_donasi 
            WHERE id_donasi='".$_GET['id']."'");
			$foto_lama=mysqli_fetch_array($query);
            unlink('./../assets/img/images/'.$foto_lama['gambar_satu']);

            if ($foto1 != "") {
                move_uploaded_file($tmp1, $path.$foto1);

                $query = mysqli_query($koneksi,"UPDATE tb_donasi 
                        SET judul_donasi='$judul',
                        kategori_donasi='$kategori',
                        deskripsi_donasi='$deskripsi',
                        target_donasi='$target',
                        batas_tanggal='$tanggal',
                        gambar_satu='$foto1'
                        WHERE id_donasi='".$row['id_donasi']."'");
        
                if($query){
                    echo "<script>alert('Data berhasil diubah')</script>";
                    echo "<script>location='donasi.php'</script>";
                }else{
                    echo "<script>alert('Data gagal diubah')</script>";
                }
            }
        }
        elseif(empty($foto1) && !empty($foto2)){
            $query=mysqli_query($koneksi,"SELECT * FROM tb_donasi 
            WHERE id_donasi='".$_GET['id']."'");
			$foto_lama=mysqli_fetch_array($query);
            unlink('./../assets/img/images/'.$foto_lama['gambar_dua']);

            if ($foto2 != "") {
                move_uploaded_file($tmp2, $path.$foto2);

                $query = mysqli_query($koneksi,"UPDATE tb_donasi 
                        SET judul_donasi='$judul',
                        kategori_donasi='$kategori',
                        deskripsi_donasi='$deskripsi',
                        target_donasi='$target',
                        batas_tanggal='$tanggal',
                        gambar_dua='$foto2'
                        WHERE id_donasi='".$row['id_donasi']."'");
        
                if($query){
                    echo "<script>alert('Data berhasil diubah')</script>";
                    echo "<script>location='donasi.php'</script>";
                }else{
                    echo "<script>alert('Data gagal diubah')</script>";
                }
            }
        }
        elseif(!empty($foto1 && $foto2)){
            $query=mysqli_query($koneksi,"SELECT * FROM tb_donasi 
            WHERE id_donasi='".$_GET['id']."'");
			$foto_lama=mysqli_fetch_array($query);
            unlink('./../assets/img/images/'.$foto_lama['gambar_satu']);
            unlink('./../assets/img/images/'.$foto_lama['gambar_dua']);

            if ($foto1 != "" && $foto2 != "") {
                move_uploaded_file($tmp1, $path.$foto1);
                move_uploaded_file($tmp2, $path.$foto2);

                $query = mysqli_query($koneksi,"UPDATE tb_donasi 
                        SET judul_donasi='$judul',
                        kategori_donasi='$kategori',
                        deskripsi_donasi='$deskripsi',
                        target_donasi='$target',
                        batas_tanggal='$tanggal',
                        gambar_satu='$foto1',
                        gambar_dua='$foto2' 
                        WHERE id_donasi='".$row['id_donasi']."'");
        
                if($query){
                    echo "<script>alert('Data berhasil diubah')</script>";
                    echo "<script>location='donasi.php'</script>";
                }else{
                    echo "<script>alert('Data gagal diubah')</script>";
                }
            }
        }
        else {
            $query = mysqli_query($koneksi,"UPDATE tb_donasi 
                    SET judul_donasi='$judul',
                    kategori_donasi='$kategori',
                    deskripsi_donasi='$deskripsi',
                    target_donasi='$target',
                    batas_tanggal='$tanggal' 
                    WHERE id_donasi='".$row['id_donasi']."'");
            
                if($query){
                    echo "<script>alert('Data berhasil diubah')</script>";
                    echo "<script>location='donasi.php'</script>";
                }else{
                    echo "<script>alert('Data gagal diubah')</script>";
                }
        }
	}
?>
        <?php
            }
        ?>
        </div>
    </section>


<footer class="text-center text-muted">
  <section>
  <div class="text-center py-2 bg-dark">
      __
        <p>
            Copyright &copy; 2022 YukDonasi.com 
            | Designed by <a href="#" target="_blank">rafiif's_website</a>
        </p>
  </div>
  </section>

</footer>
    
</body>
</html>

