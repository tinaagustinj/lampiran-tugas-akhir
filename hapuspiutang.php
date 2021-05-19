<?php

include("koneksi.php");

if( isset($_GET['id_piutang']) ){
	//var_dump($_GET);
	
	// ambil id dari query string
	$id_piutang = $_GET['id_piutang'];
	
	// buat query hapus
	$sql = "UPDATE data_piutang SET status='Terhapus' WHERE id_piutang='$id_piutang'";
	$query = mysqli_query($connect, $sql);
	
	// apakah query hapus berhasil?
	if( $query ){
		header('Location: tabelpiutang.php');
	}
	else
	{
		echo "<script>alert('gagal')</script>";
	}
}

?>