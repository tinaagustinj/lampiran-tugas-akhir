<?php

// require composer autoload
require_once "./mpdf_v8.0.3-master/vendor/autoload.php";
$mpdf = new \Mpdf\Mpdf(); // Create new mPDF Document

// Beginning Buffer to save PHP variables and HTML tags
ob_start();

session_start();

include("koneksi.php");

if( !isset($_GET['id_piutang']) ){
    // kalau tidak ada id di query string
header('Location: angsurpiutang.php');
}

//ambil id dari query string
$id_piutang = $_GET['id_piutang'];
//$_SESSION['id_pembelian'] = $id_pembelian; 

// buat query untuk ambil data dari database
$connect = mysqli_connect($host, $username, $password, $database); 
$sql=mysqli_query($connect, "SELECT * FROM data_piutang where id_piutang='$_GET[id_piutang]'; ");
$data=mysqli_fetch_array($sql);
$nominal=$data['nominal'];

$sql2=mysqli_query($connect, "SELECT sum(angsuranp) as jumlah FROM angsuran_piutang WHERE id_piutang='$_GET[id_piutang]';");
$data2=mysqli_fetch_array($sql2);
	

$sql3 = mysqli_query($connect, "SELECT * FROM data_piutang WHERE status='ada'");
$bayar = mysqli_fetch_array($sql3); // Ambil datanya dari hasil query tadi
		
		$sisa=$data['nominal']-$data2['jumlah'];
		
		if($sisa<=0) {
			$ket="Lunas";
		}else {
			$ket="Belum lunas";
		}
		

	

mysqli_query($connect, "UPDATE data_piutang SET sisa='$sisa', keterangan='$ket' where id_piutang='$_GET[id_piutang]';");



//$querypembelian = mysqli_query($connect, "SELECT * FROM data_pembelian, data_supplier WHERE data_pembelian.id_supplier=data_supplier.id_supplier AND id_pembelian='$id_pembelian'");

//$pembelian = mysqli_fetch_assoc($querypembelian);
//$tanggal = $pembelian['tanggal'];
//$tanggal = date_create($tanggal);


// jika data yang di-edit tidak ditemukan
//if( mysqli_num_rows($querypembelian) < 1 ){
// die("data tidak ditemukan...");
//}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Title Page-->
    <title>Rincian Pembelian</title>
    <style type="text/css">
		.table1 {
		    font-family: sans-serif;
		    color: #444;
		    border-collapse: collapse;
		    width: 100%;
		    border: 1px solid #f2f5f7;
		}

		.table1 tr th{
		    background: #35A9DB;
		    color: #fff;
		    font-weight: normal;
		}

		.table1, th, td {
		    padding: 8px 20px;
		    text-align: center;
		}

		.table1 tr:hover {
		    background-color: #f5f5f5;
		}

		.table1 tr:nth-child(even) {
		    background-color: #f2f2f2;
		}
    </style>

</head>

<body class="animsition">
    <div class="page-wrapper">


                                <!-- DATA TABLE -->
                                <img src="images/icon/fsindonesia.jpg" height="70" width="150" style="float: left;"/><h4 style="text-align: center; line-height: 30px;">FS INDONESIA<br>Gg. Ijan, Ciwaruga, Kecamatan Parongpong, Kabupaten Bandung Barat, Jawa Barat 40559</br></h4><br/>
                                <hr class= "hr">
                                <h4 align="center">LAPORAN KEUANGAN</h4>
                                <h5 align="center">RINCIAN ANGSURAN</h5>
								<br />
                                        <p>Nama &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span><?php echo $data['nama'] ?></span></p>
										<p>No. Telepon &nbsp;: <span><?php echo $data['no_tlpn'] ?></span></p>
										<p>Alamat &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span><?php echo $data['alamat'] ?></span></p>
										<p>Sisa Piutang : <span><?php echo "Rp".number_format($sisa,0,"",'.').",-" ?></span></p>
										<p>Keterangan &nbsp;: <span><?php echo $ket ?></span></p>
										<p>Catatan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span><?php echo $data['catatan'] ?></span></p>
										
                                    <table class="table1" align="center">
                                        <thead>
                                            <tr>
                                                <th>No</th>
												<th>Tanggal</th>
												<th>Angsuran</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $no=1;
												$query=mysqli_query($connect, "SELECT * FROM angsuran_piutang WHERE id_piutang='$_GET[id_piutang]' order by tgl_bayar desc");
												while ($data=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
												  $angsuran=$data['angsuranp'];
												  $tanggal = $data['tgl_bayar'];
												  $tanggal = date_create($tanggal);
                                            ?>
                                                <tr>
												  <td><?php echo $no;?></td>
												  <td><?php echo date_format($tanggal, "d F Y h:i"); ?></td>
												  <td><?php echo "Rp".number_format($angsuran,0,"",'.').",-"?></td>
												  
												</tr>
												<?php $no++; } ?>
												</tbody>
                                    </table>
    </div>
</body>


</html>
<!-- end document-->

<?php

$html = ob_get_contents();
ob_end_clean();

// Here convert the encode for UTF-8, if you prefer 
// the ISO-8859-1 just change for $mpdf->WriteHTML($html);
$mpdf->WriteHTML(utf8_encode($html));
$content = $mpdf->Output();
?>