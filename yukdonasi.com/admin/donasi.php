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
                <a class="nav-link text-default" href="pembayaran.php">Pembayaran</a>
            </div>
        </div>
        </div>
    </nav>

<script>alert("Ini Halaman Daftar Donasi")</script>

    <section>
        <div class="container py-5">  
            <div class="row py-5">

            <div>
                <h1 class="text-default">Tabel Daftar Donasi</h1>
            </div>

                <div class="table-responsive">
                    <table  class="table table-success table-striped" width="100%" cellspacing="0">
						<tr>
							<th>No</th> 
							<th>Judul Donasi</th>
							<th>Kategori</th>
							<th>Deskripsi</th>
							<th>Target</th>
							<th>Donasi Sementara</th>
                        	<th>Batas Tanggal</th>
							<th>Foto pertama</th>
							<th>Foto Kedua</th>
                	        <th>Aksi</th>
						</tr>
							<?php 
								$no=1;
								$query = mysqli_query($koneksi,"SELECT * FROM tb_donasi ORDER BY id_donasi ASC");
								while ($row = mysqli_fetch_assoc($query)) {
							?> 
						<tr>
							<td class"center"><?php echo $no++; ?></td>
							<td><?php echo $row['judul_donasi']; ?></td>
							<td><?php echo $row['kategori_donasi']; ?></td>
							<td><?php echo $row['deskripsi_donasi']; ?></td>
							<td><?php echo nominal($row['target_donasi']); ?></td>
							<td><?php echo nominal($row['donasi_sementara']); ?></td>
							<td><?php echo date('d F Y', strtotime($row['batas_tanggal'])); ?></td>
							<td class"center"><?php 
								if($row['gambar_satu']==""){ ?>
									<img src="./../assets/img/images/kosong.jpg" width="5px">
						<?php	}else{ 
						?>
									<img width="100px" src="./../assets/img/images/<?php echo $row['gambar_satu']; ?>"> 
						<?php 	}
				 		?>
							</td>

							<td class"center"><?php 
								if($row['gambar_dua']==""){ ?>
									<img src="./../assets/img/images/kosong.jpg" width="5px">
						<?php	}else{ 
						?>
									<img width="100px" src="./../assets/img/images/<?php echo $row['gambar_dua']; ?>"> 
						<?php 	}
				 		?>
							</td>
							<td class"center">						
                                <a type="button" class="btn btn-primary"  href="editdonasi.php?id=<?php echo $row['id_donasi'];?>">Edit</a>
 			                	<a type="button" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" href="deletedonasi.php?id=<?php echo $row['id_donasi'] ?>">Delete</a>	
				    		</td>
						</tr>
							<?php  
								}
             				?>
                    </table>
                    
                    <a type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#form-tambah">Tambah Donasi</a>

 			    </div>
            </div>
        </div>
    </section>

<?php
include 'tambahdonasi.php';
?>

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