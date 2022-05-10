<?php
$koneksi=mysqli_connect("localhost","root","","uts_nurafiifalmas");

$query=mysqli_query($koneksi,"SELECT * FROM tb_donasi 
    WHERE id_donasi='".$_GET['id']."'");
$foto_lama=mysqli_fetch_array($query);
     unlink('./../assets/img/images/'.$foto_lama['gambar_satu']);
     unlink('./../assets/img/images/'.$foto_lama['gambar_dua']);
            
$query = mysqli_query($koneksi,"DELETE FROM tb_donasi WHERE id_donasi='".$_GET['id']."'");
	if ($query) {
        
        $query = mysqli_query($koneksi,"DELETE FROM tb_pembayaran WHERE id_donasi='".$_GET['id']."'");
	    if ($query) {
            echo "<script>alert('Data telah dihapus')</script>";
    	    echo "<script>location='donasi.php'</script>";
	    }else{
            echo "<script>alert('erorr')</script>";
        }
	}else{
        echo "<script>alert('erorr')</script>";
    }
?>