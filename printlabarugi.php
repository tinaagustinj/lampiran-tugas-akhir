<?php ob_start(); ?>
<html>
<head>
	<title>Laporan Laba Rugi/title>
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
		    text-align: left;
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
	<?php
	// Load file koneksi.php
	include "koneksi.php";

	$tgl_awal = @$_GET['tgl_awal']; // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
								$tgl_akhir = @$_GET['tgl_akhir']; // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)

										if(empty($tgl_awal) or empty($tgl_akhir)){ // Cek jika tgl_awal atau tgl_akhir kosong, maka :
											// Buat query untuk menampilkan semua data
											$query = "SELECT * FROM laba_rugi ORDER BY id_lr DESC";
											$url_cetak = "printlabarugi.php";
											$label = "";
										}else{ // Jika terisi
											// Buat query untuk menampilkan data sesuai periode tanggal
											$query = "SELECT * FROM laba_rugi WHERE (tanggal_lr BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."') ORDER BY id_lr DESC";
											$url_cetak = "printlabarugi.php?tgl_awal=".$tgl_awal."&tgl_akhir=".$tgl_akhir."&filter=true";
											$tgl_awal = date('d-m-Y', strtotime($tgl_awal)); // Ubah format tanggal jadi dd-mm-yyyy
											$tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
											$label = 'Periode Tanggal: '.$tgl_awal.' s/d '.$tgl_akhir;
										}
								?>
								

                                
                                <img src="images/icon/fsindonesia.jpg" height="70" width="150" style="float: left;"/><h4 style="text-align: center; line-height: 30px;">FS INDONESIA<br>Gg. Ijan, Ciwaruga, Kecamatan Parongpong, Kabupaten Bandung Barat, Jawa Barat 40559</br></h4><br/>
                                <hr class= "hr">
                                <h4 align="center">LAPORAN KEUANGAN</h4>
                                <h5 align="center">LABA RUGI</h5>
								<h5 align="center"><?php echo $label ?></h5>
                                    <table class="table1" border="1" style="margin-top: 10px;">
                                        <thead>
                                            <tr>
                                                <th align="center">No</th>
                                                <th align="center">Tanggal</th>
												<th align="center">Pengeluaran</th>
                                                <th align="center">Pemasukan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
											$sql = mysqli_query($connect, $query);
											$row = mysqli_num_rows($sql);
											$nom=1;
											$labarugi=0;
											$jmlh_masuk=0;
											$jmlh_keluar=0;
											$total_lr=0;
                                                                            
											while ($data = mysqli_fetch_array($sql, MYSQLI_ASSOC)){
                                                    
													//$tgl = date('d-m-Y', strtotime($data['tanggal_lr']));
                                                    $tanggal = $data['tanggal_lr'];
                                                    $tanggal = date_create($tanggal);
													$pemasukan = $data['pemasukan'];
													$pengeluaran = $data['pengeluaran'];
													$labarugi = $data['pemasukan'] - $data['pengeluaran'];
                                                    $jmlh_masuk += $pemasukan;
													$jmlh_keluar += $pengeluaran;
													$total_lr += $labarugi;
													$total_balance = $jmlh_keluar+$total_lr;
											?>
                                                    <tr>
                                                        <td align="center"><?php echo $nom++; ?></td>
                                                        <td><?php echo date_format($tanggal, "d F Y"); ?></td>
														<td>Rp<?php echo number_format($data['pengeluaran'], 0, ',', '.'); ?></td>
                                                        <td>Rp<?php echo number_format($data['pemasukan'], 0, ',', '.'); ?></td>
                                                    </tr>
												<?php
                                                }     
                                                ?>
                                        </tbody>
										<tr>
										<!--<td colspan="4" align=""></td>-->
										</tr>
										<tr>            
											<td colspan="2" align="center"><h5><b>JUMLAH PEMASUKAN</b></h5></td>
											<td></td>
                                            <?php
                                            echo "<td><b>Rp".number_format($jmlh_masuk, 0, ",", ".")." </b></td>";
                                            ?>			   
                                        </tr>
										<tr>
											<td colspan="2" align="center"><h5><b>JUMLAH PENGELUARAN</b></h5></td>
                                            <?php
                                            echo "<td><b>Rp".number_format($jmlh_keluar, 0, ",", ".")." </b></td>";
											?>            
                                        </tr>
										<tr>            
											<td colspan="2" align="center"><h5><b>LABA RUGI</b></h5></td>
											
                                            <?php
                                            echo "<td><b>Rp".number_format($total_lr, 0, ",", ".")." </b></td>";
                                            ?>                                                
                                        </tr>
										<?php
										if($row>0){
											echo "<tr>";          
												echo "<td colspan='2' align='center'><h5><b>TOTAL BALANCE</b></h5></td>";
												echo "<td><b>Rp".number_format($total_balance, 0, ",", ".")." </b></td>";
												echo "<td><b>Rp".number_format($total_balance, 0, ",", ".")." </b></td>";                                                  
											echo "</tr>";
										} else {
											echo "<tr>";            
												echo "<td colspan='2' align='center'><h5><b>TOTAL BALANCE</b></h5></td>";
												echo "<td><b>Rp0</b></td>";
												echo "<td><b>Rp0</b></td>";
											echo "</tr>";
										}
										?>
                                    </table>
                        </div>
</body>
</html>
<?php
$html = ob_get_contents();
ob_end_clean();

require_once "./mpdf_v8.0.3-master/vendor/autoload.php";

$mpdf = new \Mpdf\Mpdf(); // Create new mPDF Document
$mpdf->WriteHTML($html);
$content = $mpdf->Output();
?>
