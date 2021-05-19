<?php

include("koneksi.php");

if( isset($_GET['id_hutang']) ){
	//var_dump($_GET);
	
	// ambil id dari query string
	$id_hutang = $_GET['id_hutang'];
	
	// buat query hapus
	$sql = "UPDATE data_hutang SET status='Terhapus' WHERE id_hutang='$id_hutang'";
	$query = mysqli_query($connect, $sql);
	
	// apakah query hapus berhasil?
	if( $query ){
		header('Location: tabelhutang.php');
	}
	else
	{
		echo "<script>alert('gagal')</script>";
	}
}

?>