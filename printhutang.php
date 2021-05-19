<?php

// require composer autoload
require_once "./mpdf_v8.0.3-master/vendor/autoload.php";
$mpdf = new \Mpdf\Mpdf(); // Create new mPDF Document

// Beginning Buffer to save PHP variables and HTML tags
ob_start();

session_start();
include("koneksi.php");

$connect = mysqli_connect($host, $username, $password, $database); 
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Title Page-->
    <title>Laporan Hutang</title>
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
                                <h5 align="center">DATA HUTANG</P></h5>
                                    <table class="table1" align="center">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Berhutang Kepada</th>
												<th>Hutang</th>
                                                <th>Sisa Hutang</th>
												<th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
											if( isset($_POST['simpan']) ){

                                                $dari = $_POST['dari'];
                                                $sampai = $_POST['sampai'];

                                                if (!empty($dari) && !empty($sampai)) {
                                                  // perintah tampil data berdasarkan range tanggal
                                                    $querymasuk = mysqli_query($connect, "SELECT * FROM data_hutang WHERE status='Ada' AND tanggal BETWEEN '$dari' AND '$sampai' ORDER BY id_hutang DESC"); 
                                                 } else {
                                                  // perintah tampil semua data
                                                    $querymasuk = mysqli_query($connect, "SELECT * FROM data_hutang WHERE status='Ada' ORDER BY id_hutang DESC");
                                                 }

                                                }
											
                                              
                                                $no=1;
                                                                            
                                                while ($hutang = mysqli_fetch_array($querymasuk, MYSQLI_ASSOC)){
                                                    
													$nominal=$hutang['nominal'];
													$sisa=$hutang['sisa'];
													$tanggal = $hutang['tanggal'];
													$tanggal = date_create($tanggal);
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $no++; ?></td>
														<td><?php echo date_format($tanggal, "d F Y h:i"); ?></td>
                                                        <td><?php echo $hutang['hutangke']; ?></td>
                                                        <td>Rp<?php echo number_format($nominal, 0, ',', '.'); ?></td>
														<td>Rp<?php echo number_format($sisa, 0, ',', '.'); ?></td>
														<td><?php echo $hutang['keterangan']; ?></td>
                                                </tr>
                                            <?php
                                                }
                                            ?>
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