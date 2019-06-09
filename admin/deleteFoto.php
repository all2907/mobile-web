<?php
session_start();
if(!isset($_SESSION['admin'])){
	header("Location: login.php");
}

include "../koneksi.php";
$koneksi = new Koneksi();
$h = $koneksi->connect();
$idwisata=$_GET['idwisata'];
$id=$_GET['id'];
$q_foto = mysqli_query($h, "select * from foto_wisata WHERE id_foto= '$id'");
$data = mysqli_fetch_assoc($q_foto);
$name_file = "../photos/".$data['nama_foto'];
// $name_file = "../datas/al.jpg";
// echo $name_file;

if (file_exists($name_file)) {
	chmod($name_file,0777);
	unlink($name_file);
	$hasil = mysqli_query($h, "DELETE FROM foto_wisata WHERE id_foto = '$id'");
	// $hasil2 = mysqli_query($h, "DELETE FROM halte_transjogja WHERE id_halte = '$id_halte'");
	if($hasil){
	  echo "
	  <script>
	    window.alert('Berhasil Menghapus Foto');
	    window.location='index.php?page=edit&id=".$idwisata."'</script>";
	}
	else{
		echo "
	  <script>
	     window.alert('Gagal Hapus Foto');
	     window.location='index.php?page=edit&id=".$idwisata."'</script>";
	}
} else {
	echo 'Could not delete '.$filename.', file does not exist';
}
?>
