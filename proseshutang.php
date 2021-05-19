<?php

include("koneksi.php");

// cek apakah tombol daftar sudah diklik atau blum?
if(isset($_POST['simpan'])){
	
	// ambil data dari formulir

	$tanggal = date('y-m-d h:i:s');
	$hutangke = $_POST['hutangke'];
	$no_tlpn = $_POST['no_tlpn'];
	$alamat = $_POST['alamat'];
	$catatan = $_POST['catatan'];
	$nominal = trim($_POST['nominal']);
	if (is_numeric ($nominal) == TRUE) {
		$sql = mysqli_query($connect, "INSERT INTO data_hutang VALUES(' ', '$tanggal', '$hutangke', '$no_tlpn', '$alamat', '$catatan', '$nominal', '$nominal', 'Belum lunas', 'Ada')");
		header('Location: tabelhutang.php?status=sukses');
	} else {
		header('Location: tabelhutang.php?status=gagal');
	}
	
	//$keterangan = $_POST['keterangan'];			
	
	
	// buat query
	//$sql = "INSERT INTO data_hutang VALUES (' ', '$tanggal', '$hutangke', '$no_tlpn', '$alamat', '$catatan', '$nominal', '$nominal', 'Belum lunas', 'Ada')";
	//$query = mysqli_query($connect, $sql);
	
	// apakah query simpan berhasil?
/*	if( $query ) {
		// kalau berhasil alihkan ke halaman index.php dengan status=sukses
		header('Location: tabelhutang.php?status=sukses');
	} else {
		// kalau gagal alihkan ke halaman indek.php dengan status=gagal
		header('Location: tabelhutang.php?status=gagal');
	}
	*/
	
} else {
	die("Akses dilarang...");
}

?>