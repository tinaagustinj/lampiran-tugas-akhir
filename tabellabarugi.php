<?php 

session_start(); // Start session nya
require "koneksi.php"; 
// Kita cek apakah user sudah login atau belum
// Cek nya dengan cara cek apakah terdapat session username atau tidak
if( ! isset($_SESSION['username'])){ // Jika tidak ada session username berarti dia belum login
    header("location:login.php"); // Kita Redirect ke halaman index.php karena belum login
}
$connect = mysqli_connect($host, $username, $password, $database);
$username = $_SESSION['username'];
$user = mysqli_query($connect,"SELECT * FROM user WHERE username='$username'");
$datauser = mysqli_fetch_array($user);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Data Laba Rugi</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
    <link rel="stylesheet" type="text/css" href="DataTables1/datatables.min.css"/>

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
	<link href="vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="images/icon/fsindonesia.jpg" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                         <li>
                            <a href="index.php">
                                <i class="fas fa-tachometer-alt"></i>Beranda</a>
                        </li>
                        <li>
                            <a href="tabelpelanggan.php">
                                <i class="fas fa-group"></i>Data Pelanggan</a>
                        </li>
                        <li>
                            <a href="tabelsuplier.php">
                                <i class="fas fa-user"></i>Data Supplier</a>
                        </li>
                        <li>
                            <a href="tabelbarang.php">
                                <i class="fas fa-pencil-square-o"></i>Data Barang</a>
                        </li>
                        <li>
                            <a href="tabelkategori.php">
                                <i class="fas fa-reorder"></i>Data Kategori</a>
                        </li>
                        <li>
                        <a class="js-arrow" href="#">
                                <i class="fas fa-shopping-cart"></i>Data Penjualan</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="tabelpenjualans.php">Telah Selesai</a>
                                </li>
                                <li>
                                    <a href="tabelpenjualant.php">Tertunda</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="js-arrow" href="#">
                                <i class="fas fa-shopping-bag"></i>Data Pembelian</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="tabelpembelians.php">Telah Selesai</a>
                                </li>
                                <li>
                                    <a href="tabelpembeliant.php">Tertunda</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <li>
                            <a class="js-arrow" href="#">
                                <i class="fas fa-book"></i>Data Hutang Piutang</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="tabelhutang.php">Hutang</a>
                                </li>
                                <li>
                                    <a href="tabelpiutang.php">Piutang</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="js-arrow" href="#">
                                <i class="fas fa-usd"></i>Data Kas</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="tabelkasmasuk.php">Kas Masuk</a>
                                </li>
                                <li>
                                    <a href="tabelkaskeluar.php">Kas Keluar</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <li>
                            <a class="js-arrow" href="#">
                                <i class="fas fa-bar-chart"></i>Data Grafik</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="grafikpenjualan.php">Penjualan</a>
                                </li>
                                <li>
                                    <a href="grafikpembelian.php">Pembelian</a>
                                </li>
                                <li>
                                    <a href="grafikbarang.php">Barang</a>
                                </li>
                                <li>
                                    <a href="grafiklabarugi.php">Pemasukan Pengeluaran</a>
                                </li>
                            </ul>
                        </li>
                        <li  class="active">
                            <a href="tabellabarugi.php">
                                <i class="fas fa-list-alt"></i>Data Laba Rugi</a>
                        </li>
                         <li>
                            <a href="logout.php">
                                <i class="zmdi zmdi-power"></i>Logout</a>
                        </li>
                        
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">
                            </form>
                            <div class="header-button">
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="images/icon/profile.png" alt="" />
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#"><?php echo $datauser['username']?></a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="images/icon/profile.png" alt="" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#"><?php echo $datauser['username']?></a>
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="logout.php">
                                                        <i class="zmdi zmdi-power"></i>Logout</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->
 <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- DATA TABLE -->
                                <h3 class="title-5 m-b-20">Laporan Laba Rugi</h3>
                                <div class="table-data__tool">
                                    <div class="table-data__tool-right">
									<form method="get" action="tabellabarugi.php" class="form-inline mt-3">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div class="form-group">
                        <label class="mr-2">Filter Tanggal</label>
                        <div class="input-group">
                            <input type="text" name="tgl_awal" value="<?= @$_GET['tgl_awal'] ?>" class="form-control tgl_awal" placeholder="Tanggal Awal" autocomplete="off">
                            <span class="input-group-addon">s/d</span>
                            <input type="text" name="tgl_akhir" value="<?= @$_GET['tgl_akhir'] ?>" class="form-control mr-2 tgl_akhir" placeholder="Tanggal Akhir" autocomplete="off">
                        </div>
                    </div>
                </div>
            </div>

			<button type="submit" name="filter" value="true" class="btn btn-primary mr-2">Tampilkan</button>

        </form>
                                    </div>
                                </div>
								<?php
								if(isset($_GET['filter'])){ // Jika user mengisi filter tanggal, maka munculkan tombol untuk reset filter
								echo '<a href="tabellabarugi.php" class="btn btn-danger">Reset</a>';
								
								$tgl_awal = @$_GET['tgl_awal']; // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
								$tgl_akhir = @$_GET['tgl_akhir']; // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)

										if(empty($tgl_awal) or empty($tgl_akhir)){ // Cek jika tgl_awal atau tgl_akhir kosong, maka :
											// Buat query untuk menampilkan semua data
											$query = "SELECT * FROM laba_rugi ORDER BY id_lr DESC";
											$url_cetak = "printlabarugi.php";
											$label = "Semua Data Laba Rugi";
										}else{ // Jika terisi
											// Buat query untuk menampilkan data sesuai periode tanggal
											$query = "SELECT * FROM laba_rugi WHERE (tanggal_lr BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."') ORDER BY id_lr DESC";
											$url_cetak = "printlabarugi.php?tgl_awal=".$tgl_awal."&tgl_akhir=".$tgl_akhir."&filter=true";
											$tgl_awal = date('d-m-Y', strtotime($tgl_awal)); // Ubah format tanggal jadi dd-mm-yyyy
											$tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
											$label = 'Periode Tanggal: '.$tgl_awal.' s/d '.$tgl_akhir;
										}
								?>
								
		<hr />
        <div align="margin-right: 4px;">
            <a href="<?php echo $url_cetak ?>"><button type='button' class='au-btn au-btn-icon au-btn--green au-btn--small'> <i class="zmdi zmdi-print"></i>CETAK PDF</button></a>
        </div> <br />
		<h5 align="left"><?php echo $label ?></h5>
		<br />
                                <div class="row">
                                    <div class="col-md-12">
                                <div class="table-responsive table--no-card m-b-50 ">
                                   <table id="example" class="table table-borderless table-striped table-earning">
                                    <!-- <table class="table table-data2"> -->
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Pengeluaran</th>
												<th>Pemasukan</th>
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
                                                        <td><?php echo $nom++; ?></td>
                                                        <td><?php echo date_format($tanggal, "d F Y"); ?></td>
														<td>Rp<?php echo number_format($data['pengeluaran'], 0, ',', '.'); ?></td>
                                                        <td>Rp<?php echo number_format($data['pemasukan'], 0, ',', '.'); ?></td>
														
														
                                                    </tr>
												<?php
											}
                                                ?>
                                        </tbody>
										<tr>
										<td colspan="4" align=""></td>
										</tr>
										<tr>            
											<td></td>
											<td colspan="" align="left"><b>JUMLAH PEMASUKAN</b></td>
											<td></td>
                                            <?php
                                            echo "<td><b>Rp".number_format($jmlh_masuk, 0, ",", ".")." </b></td>";
                                            ?>
											
											
																						
                                        </tr>
										<tr>
											<td></td>
											<td colspan="" align="left"><b>JUMLAH PENGELUARAN</b></td>
                                            <?php
                                            echo "<td><b>Rp".number_format($jmlh_keluar, 0, ",", ".")." </b></td>";
											?>
											<td></td>
                                        </tr>
										<tr>            
											<td></td>
											<td colspan="" align="left"><b>Total Laba Rugi</b></td>
											
											<?php
                                            echo "<td><b>Rp".number_format($total_lr, 0, ",", ".")." </b></td>";
                                            ?>
											<td></td>
                                                                                            
										</tr>
									<?php
										if($row>0){
											echo "<tr>";
												echo "<td></td>";
												echo "<td colspan='' align='left'><b>Total Balance</b></td>";
												echo "<td><b>Rp".number_format($total_balance, 0, ",", ".")." </b></td>";
												echo "<td><b>Rp".number_format($total_balance, 0, ",", ".")." </b></td>";
												
											echo "</tr>";
										} else {
											echo "<tr>";  
												echo "<td></td>";
												echo "<td colspan='' align='left'><b>Total Balance</b></td>";
												echo "<td><b>Rp0 </b></td>";
												echo "<td><b>Rp0</b></td>";
												
											echo "</tr>";
										}
										?>
                                    </table>
                                </div>
                            </div>
                        </div>
						<?php
						}
						else{
							unset($_GET['filter']);
						}
						?>
                                <!-- END DATA TABLE -->    
                        </div>
                        </div>
                        </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <script type="text/javascript" src="DataTables1/datatables.min.js"></script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

    <script type="text/javascript">
       $(document).ready(function() {
    var table = $('#example').DataTable( {
        lengthChange: false,
        responsive: true,
        colReorder: true,
        buttons: [ 'copy', 'excel']
    } );
 
    table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );
} );
    </script>
	
	<!-- Include library Bootstrap Datepicker -->
    <script src="vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

    <!-- Include File JS Custom (untuk fungsi Datepicker) -->
    <script src="js/custom.js"></script>

    <script>
    $(document).ready(function(){
        setDateRangePicker(".tgl_awal", ".tgl_akhir")
    })
    </script>

</body>

</html>
<!-- end document-->
