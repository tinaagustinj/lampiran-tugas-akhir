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

<?php
include "koneksi.php";

?>

<?php
$sql=mysqli_query($connect, "SELECT * FROM data_hutang where id_hutang='$_GET[id_hutang]'; ");
$data=mysqli_fetch_array($sql);
$nominal=$data['nominal'];

$sql2=mysqli_query($connect, "SELECT sum(angsuran) as jumlah FROM angsuran_hutang WHERE id_hutang='$_GET[id_hutang]';");
$data2=mysqli_fetch_array($sql2);
	

$sql3 = mysqli_query($connect, "SELECT * FROM data_hutang WHERE status='ada'");
$bayar = mysqli_fetch_array($sql3); // Ambil datanya dari hasil query tadi
		
		$sisa=$data['nominal']-$data2['jumlah'];
		
		if($sisa<=0) {
			$ket="Lunas";
		}else {
			$ket="Belum lunas";
		}
		
mysqli_query($connect, "UPDATE data_hutang SET sisa='$sisa', keterangan='$ket' where id_hutang='$_GET[id_hutang]';");

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
    <title>Data Angsuran Hutang</title>

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
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                             <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Data Angsuran</strong>
                                    </div>
                                    <div class="card-body card-block">
                                        <form method="post">
										<div class="col-sm-12 col-md-12">
                                            <div class="row form-group">
												<div class="col col-md-1">
												</div>
												<div class="col-12 col-md-9">
													<input type="hidden" id="id_hutang" name="id_hutang" placeholder="" class="form-control" value="<?php echo $_GET['id_hutang'] ?>"/>
												</div>
                                            </div>
                                             <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Masukkan Angsuran</label>
                                                </div>
                                                <div class="col-12">
                                                    <input type="text" pattern="[0-9]+" title="Hanya nominal" id="angsuran" name="angsuran" placeholder="Angsuran" class="form-control" required="required">
                                                </div>
                                            </div>
                                            

											<div class="">
												<button type="submit" name="save" class="btn btn-primary">Submit</button>
											</div>
											</div>
                                        </form><br>

                                <?php 

								include"koneksi.php";
								if(isset($_POST['save'])){

								  $tanggal = date('y-m-d h:i:s');
								  $angsuran = $_POST['angsuran'];
								  
								  if($angsuran>$sisa){
									  echo "<script>alert('Input Gagal!');history.go(-1);</script>";
								  } else {
									  $save=mysqli_query($connect, "INSERT INTO angsuran_hutang VALUES(' ','$_POST[id_hutang]','$tanggal','$angsuran')");
									  echo"<script language=javascript>
										window.location='?p=angsurhutang&id_hutang=".$_POST['id_hutang']."';
										</script>";
										exit;
								  }
								}
								?>

	
      <div class="col-12">
       
            
              <div class="row">
                <div class="col-2">
                  <label>Nama</label>
                </div>
                <div class="col-3">
                  <input type="text" value="<?php echo $data['hutangke'] ?>" class="form-control" readonly>
                </div>
                <div class="col-2">
                  
                </div>
                <div class="col-2">
                  <label>Sisa Hutang</label>
                </div>

                <div class="col-3">
                  <input type="text" value="<?php echo "Rp. ".number_format($sisa,0,"",'.').",-" ?>" name="notelp" class="form-control" readonly>
                </div>
              </div><br>
              <div class="row">
                <div class="col-2">
                  <label>No. Telepon</label>
                </div>
                <div class="col-3">
                  <input type="text" value="<?php echo $data['no_tlpn'] ?>" class="form-control" readonly>
                </div>
                <div class="col-2">
                  
                </div>
				<div class="col-2">
                  <label>Keterangan</label>
                </div>
                <div class="col-3">
				  <input type="text" value="<?php echo $ket ?>" class="form-control" readonly>
                </div>
              </div><br>
			  <div class="row">
                <div class="col-2">
                  <label>Alamat</label>
                </div>
                <div class="col-3">
                  <!--<input type="text" value="" name="notelp" class="form-control" readonly> -->
				  <textarea readonly="readonly" rows="3" class="form-control"><?php echo $data['alamat'] ?></textarea>
                </div>
				<div class="col-2">
                  
                </div>
				<div class="col-2">
                  <label>Catatan</label>
                </div>
                <div class="col-3">
				  <textarea readonly="readonly" rows="3" class="form-control"><?php echo $data['catatan'] ?></textarea>
                </div>
             </div>
			  
            
            <!-- /.box-body -->
          
        </div> 
			<br />
			<div class="col-12">

              <div class="table-responsive table--no-card m-b-50">
			  <table id="example2" class="table table-borderless table-striped table-earning">
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
                    $query=mysqli_query($connect, "SELECT * FROM angsuran_hutang WHERE id_hutang='$_GET[id_hutang]' order by tgl_bayar desc");
                    while ($data=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                      $angsuran=$data['angsuran'];
					  $tanggal = $data['tgl_bayar'];
					  $tanggal = date_create($tanggal);
                  ?>

                <tr>
                  <td><?php echo $no;?></td>
                  <td><?php echo date_format($tanggal, "d F Y h:i"); ?></td>
                  <td><?php echo "Rp. ".number_format($angsuran,0,"",'.').",-"?></td>
                  
                </tr>
                <?php $no++; } ?>
                </tbody>
				</table>
				</div>
				</div>
                               <!--<form action="prosespembelian.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Total Keseluruhan</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                <input type="text" readonly="readonly" id="harga_keseluruhan" name="harga_keseluruhan" class="form-control" value="<?php echo $harga_keseluruhan?>"/>

                                            </div>
                                        </div>
                                        
                                        <div class="card-footer">
                                        <button type="submit" id="simpan" name="simpan" class="btn btn-primary btn-sm">
                                            <i class="fa fa-dot-circle-o"></i> Simpan
                                        </button>
                                    </div>
                                </form>-->
								<div class="card-footer">
								</div>

										</div>
										</div>
                                    </div>
                                    </div>
                                 </div>
                                </div>
                            </div>
                        </div>

                    </div>

   <!--Jquery JS-->
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

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->
