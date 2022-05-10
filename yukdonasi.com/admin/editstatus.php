<!DOCTYPE html>
<?php 
    $koneksi=mysqli_connect("localhost","root","","uts_nurafiifalmas");
    
    function nominal($angka){
	
        $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
        return $hasil_rupiah;
     
    }
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
        $query = mysqli_query($koneksi,"SELECT * FROM tb_pembayaran WHERE kode_pembayaran='".$_GET['id']."'");
		while ($row = mysqli_fetch_assoc($query)) {
	?> 
    <section>
        <div class="container p-5">  
            <div class="row">

            <div>
                <h1 class="text-default">Edit Status Pembayaran</h1>
            </div>
            
            <form method="post" class="modal-content modal-body border-0 p-0" enctype="multipart/form-data">
                <label class="form-label fw-bold">Id Donasi</label>
                <div class="input-group mb-2">
                    <input  class="form-control" type="number" name="id_donasi"  value="<?php echo $row['id_donasi']; ?>" readonly>
                </div>
                <label class="form-label fw-bold">Jumlah Donasi</label>
                <div class="input-group mb-2">
                    <input  class="form-control" type="number" name="donasi"  value="<?php echo $row['jumlah_donasi']; ?>" readonly>
                </div>
                <label class="form-label fw-bold">Status Pembayaran</label>
                <div class="input-group mb-2">
                <select class="form-select" name="status" aria-label="Default select example">
                    <option value="belum" <?php if ( $row['status_pembayaran'] == 'belum') echo 'selected="selected"'; ?>>Belum Dibayar</option>
                    <option value="sudah" <?php if ( $row['status_pembayaran'] == 'sudah') echo 'selected="selected"'; ?>>Sudah Dibayar</option>
                </select>
                </div>
                
                <button type="submit" name=submit class="btn btn-success">Submit</button>
            </form>

            <?php 

	if(isset($_POST['submit'])){
        $status = $_POST['status'];
        $donasi = $_POST['donasi'];
        $id_donasi = $_POST['id_donasi'];
        
        $query = mysqli_query($koneksi,"SELECT * FROM tb_donasi WHERE id_donasi='$id_donasi'");
			while ($row = mysqli_fetch_assoc($query)) {
                $donasi_sebelumnya = $row['donasi_sementara'];
            }

        $donasi_sementara = $donasi_sebelumnya + $donasi;

        if ($status == "sudah") {
            $query = mysqli_query($koneksi,"UPDATE tb_pembayaran
                    SET status_pembayaran='$status' 
                    WHERE kode_pembayaran='".$_GET['id']."'");
            
                if($query){
                    
                    $query = mysqli_query($koneksi,"UPDATE tb_donasi
                                SET donasi_sementara='$donasi_sementara' 
                                WHERE id_donasi='$id_donasi'");
            
                            if($query){
                                echo "<script>alert('Data berhasil diubah')</script>";
                                echo "<script>location='pembayaran.php'</script>";
                            }else{
                                echo "<script>alert('Data gagal diubah')</script>";
                            }
                }else{
                    echo "<script>alert('Data gagal diubah')</script>";
                }
        }else{
            echo "<script>location='pembayaran.php'</script>";
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

