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

    <nav class="navbar navbar-expand-lg navbar-light bg-white">
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

    <section class="bg">
        <div>
            <div class="container py-5">
                <div class="row">
                    <div class="col-lg-12 d-flex align-items-center">
                        <div class="center-text">
                        <h1 class="h1 text-default">Marhaban Ya Ramadhan</h1>
                        <h1 class="text-default">#BERBAGIITUINDAH</h1>
                        <p class="text-white">
                            Marilah kita sisihkan sedikit rezeki kita untuk membantu orang - orang yang sedang membutuhkan
                            bantuan. Bukan masalah sedikit atau banyak namun setidaknya berapabapun jumlahnya asalkan
                            kita ikhlas dan tulus untuk membantu insyallah bisa meringankan beban orang - orang tersebut.
                        </p>
                        <div class="mx-auto col-md-8 col-lg-10">
                            <img src="assets/img/pngtree-donation-box-icon-png-image_2049453-removebg-preview.PNG" alt="" width="250px">
                        </div>
                        <br>
                        <a class="btn btn-success" href="#listdonasi">Donasi Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white">
        <div class="container py-5">
            <div class="row text-center py-3">
                <div class="col-lg-6 m-auto">
                    <div>
                        <p>
                            “Sesungguhnya sedekah itu benar – benar akan dapat memadamkan
                            panasnya alam kubur bagi penghuninya dan orang mukmin
                            akan bernaung di bawah bayang – bayang sedekahnya”.
                        </p>
                            <h3 class="text-default">(HR. At-Thabarani)</h3>
                    </div>
                </div>
                <div class="col-6 col-md-6">
                    <div class="mx-auto col-md-8 col-lg-10">
                        <img class="img-fluid border" src="assets/img/gambar.JPG" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-light" id="listdonasi">
        <div class="container py-5">
            <div class="row text-center py-3">
                <div class="col-lg-6 m-auto">
                    <h2 class="h2">Penggalangan Dana yang Sedang Berjalan</h2>
                </div>
            </div>
            <div class="row">
            
            <?php 
		        $query = mysqli_query($koneksi,"SELECT * FROM tb_donasi ORDER BY id_donasi ASC");
			        while ($row = mysqli_fetch_assoc($query)) {
	        ?>
                <div class="col-12 col-md-4 mb-4">
                    <div class="card border">             
                        <a href="detaildonasi.php?id=<?php echo $row['id_donasi'] ?>">
                            <img src="assets/img/images/<?php echo $row['gambar_satu']; ?>" class="card-img-top border-img" alt="...">
                        </a>

                        <div class="card-body">
                        <div>
                                <a href="detaildonasi.php?id=<?php echo $row['id_donasi'] ?>" class="h3 text-decoration-none text-default"><?php echo $row['kategori_donasi']; ?></a>
                            </div>
                            <hr>
                            <div>
                                <a href="detaildonasi.php?id=<?php echo $row['id_donasi'] ?>" class="h2 text-decoration-none text-default"><?php echo $row['judul_donasi']; ?></a>
                            </div>
                            <p class="card-text">
                            </p>
                            <ul class="list-unstyled d-flex justify-content-between">
                                <li class="text text-right">Dana Target</li>
                                <li class="text-muted text-right"><?php echo nominal($row['target_donasi']); ?></li>
                            </ul>
                            <ul class="list-unstyled d-flex justify-content-between">
                                <li class="text text-right">Dana Terkumpul</li>
                                <li class="text-muted text-right"><?php echo nominal($row['donasi_sementara']); ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php
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