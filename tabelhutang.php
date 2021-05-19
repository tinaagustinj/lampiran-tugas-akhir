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
	<?php if(isset($_GET['status'])): ?>
    <p>
        <?php
            if($_GET['status'] == 'sukses'){
                echo "<script>alert('Sukses Menambahkan!')</script>";
            } else {
                echo "<script>alert('Gagal!')</script>";
            }
        ?>
    </p>
    <?php endif; ?>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Data Hutang</title>

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
                            <li class="active has-sub">
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
                        <li >
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
                                    <a href="grafikkas.php">Kas</a>
                                </li>
                                <li>
                                    <a href="grafiklabarugi.php">Pemasukan Pengeluaran</a>
                                </li>
                            </ul>
                        </li>
                        <li>
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
                <div class="section_content section_content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- DATA TABLE -->
                                <h3 class="title-5 m-b-20">Data Hutang</h3>
                                <div class="table-data__tool">
									<div class="table-data__tool-left">
                                        <a class = btn id="tambah" data-toggle="modal" data-placement="top" title="More" data-target="#modaltambah">
                                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
											<i class="zmdi zmdi-plus"></i>Tambah Hutang</button></a>
                                        <a class = btn id="tambah" data-toggle="modal" data-placement="top" title="More" data-target="#modaltanggal">
										<button class="au-btn-filter">
											<i class="zmdi zmdi-print"></i>Cetak PDF</button></a>
                                            <div class="dropDownSelect2"></div>
                                        </div>
										
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive table--no-card m-b-50">
                                            <table id="example" class="table table-borderless table-striped table-earning">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
														<th>Tanggal</th>
                                                        <th>Berhutang Kepada</th>
														<th>Hutang</th>
														<th>Sisa Hutang</th>
														<th>Keterangan</th>
                                                        <th>Tindakan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                     <?php
                                              $query = mysqli_query($connect, "SELECT * FROM data_hutang WHERE status='Ada'");
                                                $no=1;
                                                                            
                                                while ($hutang = mysqli_fetch_array($query, MYSQLI_ASSOC)){
                                                    $id_hutang = $hutang['id_hutang'];
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
                                                        <td>
                                                        <div class="table-data-feature">
														<button type="submit" class="item" data-toggle='tooltip' data-placement='top' title="Angsuran">
														<a href="angsurhutang.php?p=angsurhutang&id_hutang=<?php echo $hutang['id_hutang']; ?>">
														<i class='zmdi zmdi-balance-wallet'></i>
														</a></button>
                                                        <?php 
                                                            echo "<button class='item' data-toggle='tooltip' data-placement='top' title='Delete'>
                                                                    <a href='hapushutang.php?id_hutang=".$hutang['id_hutang']."' onclick=\"return confirm('Yakin Hapus Hutang')\">
                                                                        <i class='zmdi zmdi-delete'></i>
                                                                    </a>
                                                            </button>";
                                                                ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                                    
                                                    <?php
                                                    }       
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
								
								<!-- modal medium -->
       <div class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true"  style="z-index:999999" id="modaltanggal">

         
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="penjualan">Pilih Tanggal</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <div class="row">
                             <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Silakan Pilih Periode Tanggal</strong>
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="printhutang.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                                             <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Dari Tanggal</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="date" id="dari" name="dari" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Sampai Tanggal</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="date" id="sampai" name="sampai" class="form-control">
                                                </div>
                                            </div>
                                            </div>
                                    
                                </div>

                                <div class="modal-footer">
                            <button type="submit" name="simpan" class="btn btn-primary">Berikutnya</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>

                        </div>
                    </form>
                     </div>
                        
                    </div>
                </div>
            </div>
            <!-- end modal medium -->
                                    </div>
                                </div>
            
            <!-- modal medium -->
       <div class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true"  style="z-index:999999" id="modaltambah">

         
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" align="center" id="penjualan">Formulir Tambah Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
						<div class="modal-body">
                        <div class="row">
                             <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Formulir Data Hutang</strong>
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="proseshutang.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                             <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="nama_supplier" class=" form-control-label">Berhutang Kepada</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="hutangke" name="hutangke" placeholder="Masukan Nama" class="form-control" required>
                                                </div>
                                            </div>
											<div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="nominal" class=" form-control-label">Nominal</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="nominal" name="nominal" placeholder="Masukan Nominal" class="form-control" required>
                                                </div>
                                            </div>
											<div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="no_tlpn" class=" form-control-label">No. Telepon</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" pattern="[0-9]+" title="Anda harus memasukkan angka" id="no_tlpn" name="no_tlpn" placeholder="Masukan No. Telepon" class="form-control" required>
                                                </div>
                                            </div>
											<div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="textarea-input" class=" form-control-label">Alamat</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <textarea name="alamat" id="alamat" rows="9" placeholder="Masukan Alamat" class="form-control" required></textarea>
                                                </div>
                                            </div>
											<div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="textarea-input" class=" form-control-label">Catatan</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <textarea name="catatan" id="catatan" rows="9" placeholder="Masukan Catatan" class="form-control" required></textarea>
                                                </div>
                                            </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>

                        </div>
                    </form>
                     </div>
                        
                    </div>
					</div>
                </div>
            </div>
            <!-- end modal medium -->


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
        colReorder: true,
        buttons: [ 'copy', 'excel']
    } );
 
    table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );
} );
    </script>
</body>

</html>
<!-- end document-->