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

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container d-flex">
            <a class="navbar-brand text-success logo h1 align-self-center">
                <img src="assets/img/hero_donasi.PNG" alt="" width="200px">
            </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav left">
                <a class="nav-link text-default" href="index.php">Home</a>
            </div>
        </div>
        </div>
    </nav>
            
    <?php 
	    $query = mysqli_query($koneksi,"SELECT * FROM tb_donasi WHERE id_donasi='".$_GET['id']."'");
	    while ($row = mysqli_fetch_assoc($query)) {
    ?>
    
    <section class="bg-white">
        <div class="container pb-5">
            <div class="row">
                <div class="col-lg-5 mt-5">
                    <div class="card mb-3">
                        <img class="card-img img-fluid" src="assets/img/images/<?php echo $row['gambar_satu']; ?>" class="card-img-top" alt="">
                    </div>
                    <div class="card mb-3">
                        <img class="card-img img-fluid" src="assets/img/images/<?php echo $row['gambar_dua']; ?>" class="card-img-top" alt="">
                    </div>
                </div>
                <!-- col end -->
                <div class="col-lg-7 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="text-default"><?php echo $row['judul_donasi']; ?></h1>
                            <hr>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <h6>Target Donasi :</h6>
                                </li>
                                <li class="list-inline-item">
                                    <p class="text-muted"><strong><?php echo nominal($row['target_donasi']); ?></strong></p>
                                </li><br>
                                <li class="list-inline-item">
                                    <h6>Donasi Terkumpul :</h6>
                                </li>
                                <li class="list-inline-item">
                                    <p class="text-muted"><strong><?php echo nominal($row['donasi_sementara']); ?></strong></p>
                                </li><br>
                                <li class="list-inline-item">
                                    <h6>Batas Tanggal Akhir :</h6>
                                </li>
                                <li class="list-inline-item">
                                    <p class="text-muted"><strong><?php echo date('d F Y', strtotime($row['batas_tanggal'])); ?></strong></p>
                                </li>
                            </ul>

                            <h6>Deskripsi:</h6>
                            <p><?php echo $row['deskripsi_donasi']; ?></p>

                            <div>
                                <a type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#donasi-sekarang">Donasi Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <div class="modal fade" id="donasi-sekarang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">FORM PEMBAYARAN DONASI</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" class="modal-content modal-body border-0 p-0" enctype="multipart/form-data">
                    <label for="">Id Donasi</label>
                        <div class="input-group mb-2">
                            <input  class="form-control" type="text" name="id_donasi"  value="<?php echo $row['id_donasi']; ?>" readonly>
                        </div>
                        <div class="input-group mb-2">
                            <input  class="form-control" type="text" name="nama_donatur"  placeholder="Masukkan Nama Anda..." required>
                        </div>
                        <div class="input-group mb-2">
                            <input  class="form-control" type="text" name="jumlah_donasi" placeholder="Masukkan Jumlah Donasi..." required>
                        </div>
                        <div class="input-group mb-2">
                            <input  class="form-control" type="text" name="no_telp" placeholder="Masukkan Nomor Telepon Anda..." required>
                        </div>
                        <div class="input-group mb-2">
                            <textarea  class="form-control" type="text" name="keterangan" placeholder="Keterangan..." required></textarea>
                        </div>
                        <label>Tanggal Donasi</label>
                        <div class="input-group mb-2">
                            <input  class="form-control" type="date" name="tanggal" placeholder="Tanggal Donasi..." required>
                        </div>
                        
                        <button type="submit" name=submit class="btn btn-success">Submit</button>
                    </form>
                
    <?php
        }
    ?>
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
            </div>
        </div>
    </div>

    <?php 
	if(isset($_POST['submit'])){
        $id_donasi = $_POST['id_donasi'];
        $nama = $_POST['nama_donatur'];
        $donasi = $_POST['jumlah_donasi'];
        $telp = $_POST['no_telp'];
        $keterangan = $_POST['keterangan'];
        $tanggal = $_POST['tanggal'];

            $query = mysqli_query($koneksi,"INSERT INTO tb_pembayaran 
            VALUES (NULL,'$id_donasi','$nama','$donasi','$telp','$tanggal','$keterangan','belum')");
            
            if($query){
                echo "<script>alert('Terima kasih atas partisipasi Anda dengan layanan donasi kami!!! Scroll ke bawah untuk mendapat info selanjutnya')</script>";
                echo "<center>
                <div>
                <h1>PERHATIAN!!!!!</h1>
                            <a>
                            Nama        : "."$nama"." <br>
                            Jumlah Donasi  : Rp"."$donasi"." <br>
                            </a>
                <h2>Tata Cara Pembayaran : </h2>
                            <a>
                            Pembayaran dapat dilakukan dengan transfer melalui bank yang tersedia,<br>
                            Setelah Pembayaran dilakukan mohon untuk konfirmasi melalui nomor WhatsApp,<br>
                            Konfirmasi dapat dilakukan dengan mengirimkan <strong>BUKTI TRANSFER & NAMA TERANG,</strong><br>
                            Nomor WhatsApp : +62895359801243<br>

                <h2>Daftar Nomor Rekening BANK : </h2>
                            <a>
                            BRI : 087827381937298<br>
                            BNI : 1925937298<br>
                            BCA : 0881530819</strong><br>
                            *Seluruh BANK yang tertera di atas beratas namakan (TIM YUK DONASI)<br><br>

                            Mohon untuk melakukan pembayaran sesuai dengan nominal yang tertera.<br></br>
                            </a>
                </div>
                </center>";
				}
        
        }
?>

            </div>
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