<?php

include("koneksi.php");

// cek apakah tombol daftar sudah diklik atau blum?
if(isset($_POST['simpan'])){
	
	// ambil data dari formulir

	$tgl_piutang = date('y-m-d h:i:s');
	$nama = $_POST['nama'];
	$no_tlpn = $_POST['no_tlpn'];
	$alamat = $_POST['alamat'];
	$catatan = $_POST['catatan'];
	$nominal = $_POST['nominal'];
	if (is_numeric ($nominal) == TRUE) {
		$sql = mysqli_query($connect, "INSERT INTO data_piutang VALUES(' ', '$tgl_piutang', '$nama', '$no_tlpn', '$alamat', '$catatan', '$nominal', '$nominal', 'Belum lunas', 'Ada')");
		header('Location: tabelpiutang.php?status=sukses');
	} else {
		header('Location: tabelpiutang.php?status=gagal');
	}
	
/*	// buat query
	$sql = "INSERT INTO data_piutang VALUES (' ', '$tgl_piutang', '$nama', '$no_tlpn', '$alamat', '$catatan', '$nominal', '$nominal', 'Belum lunas', 'Ada')";
	$query = mysqli_query($connect, $sql);
	
	// apakah query simpan berhasil?
	if( $query ) {
		// kalau berhasil alihkan ke halaman index.php dengan status=sukses
		header('Location: tabelpiutang.php?status=sukses');
	} else {
		// kalau gagal alihkan ke halaman indek.php dengan status=gagal
		header('Location: tabelpiutang.php?status=gagal');
	}
	
	*/
} else {
	die("Akses dilarang...");
}

?>