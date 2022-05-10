<?php
$koneksi=mysqli_connect("localhost","root","","uts_nurafiifalmas");

$query = mysqli_query($koneksi,"DELETE FROM tb_pembayaran WHERE kode_pembayaran='".$_GET['id']."'");
	if ($query) {
        echo "<script>alert('Data telah dihapus')</script>";
	    echo "<script>location='pembayaran.php'</script>";
	}else{
        echo "<script>alert('erorr')</script>";
    }
?>