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

<script>alert("Ini Halaman Daftar Pembayaran")</script>

    <section>
        <div class="container py-5">  
            <div class="row py-5">

            <div>
                <h1 class="text-default">Tabel Daftar Pembayaran</h1>
            </div>

                <div class="table-responsive">
                    <table  class="table table-success table-striped" width="100%" cellspacing="0">
						<tr>
							<th>No</th> 
							<th>Judul Donasi</th>
							<th>Nama Donatur</th>
							<th>Jumlah Donasi</th>
							<th>Nomor Telepon</th>
							<th>Tanggal Donasi</th>
                        	<th>Keterangan</th>
							<th>Status Pembayaran</th>
                	        <th>Aksi</th>
						</tr>
							<?php 
								$no=1;
                                $query = mysqli_query($koneksi,"SELECT * FROM tb_pembayaran JOIN tb_donasi
                                ON tb_pembayaran.id_donasi = tb_donasi.id_donasi");
								while ($row = mysqli_fetch_assoc($query)) {
							?> 
						<tr>
							<td class"center"><?php echo $no++; ?></td>
							<td><?php echo $row['judul_donasi']; ?></td>
							<td><?php echo $row['nama_donatur']; ?></td>
							<td><?php echo nominal($row['jumlah_donasi']); ?></td>
							<td><?php echo $row['no_tlp_donatur']; ?></td>
							<td><?php echo date('d F Y', strtotime($row['tanggal_pembayaran'])); ?></td>
                            <td><?php echo $row['keterangan']; ?></td>
                            <td><?php

                            if($row['status_pembayaran']=="belum"){ ?>
                                <a class="btn badge bg-danger text-wrap" style="width: 6rem;" href="editstatus.php?id=<?php echo $row['kode_pembayaran'];?>">
                                    <?php echo $row['status_pembayaran']; ?></td>
                                </a>
                    <?php	}elseif($row['status_pembayaran']=="sudah"){ ?>
                                <a class="btn badge bg-success text-wrap" style="width: 6rem;" href="editstatus.php?id=<?php echo $row['kode_pembayaran'];?>">
                                    <?php echo $row['status_pembayaran']; ?></td>
                                </a>
                    <?php 	}else{?>
                                <a class="btn badge bg-light text-wrap" style="width: 6rem;" href="editstatus.php?id=<?php echo $row['kode_pembayaran'];?>">
                                    <?php echo $row['status_pembayaran']; ?></td>
                                </a>
                        <?php 	}?>

							<td class"center">		
                                <a type="button" class="btn btn-primary"  href="editpembayaran.php?id=<?php echo $row['kode_pembayaran'];?>">Edit</a>				
 			                	<a type="button" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" href="deletedatapembayaran.php?id=<?php echo $row['kode_pembayaran'] ?>">Delete</a>	
				    		</td>
						</tr>
							<?php  
								}
             				?>
                    </table>
                    
 			    </div>
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