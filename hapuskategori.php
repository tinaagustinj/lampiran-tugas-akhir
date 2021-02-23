<?php

include("koneksi.php");

if( isset($_GET['id_kategori']) ){
	//var_dump($_GET);
	
	// ambil id dari query string
	$id_kategori = $_GET['id_kategori'];
	
	// buat query hapus
	$sql = "UPDATE data_kategori SET status='Terhapus' WHERE id_kategori='$id_kategori'";
	$query = mysqli_query($connect, $sql);
	
	// apakah query hapus berhasil?
	if( $query ){
		header('Location: tabelkategori.php');
	}
	else
	{
		echo "<script>alert('gagal')</script>";
	}
}

?>