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

// jika tombol simpan diklik
	if(isset($_POST['simpan'])){
		
		if(@$_GET['hal'] == "edit"){
			// ambil data dari formulir
			$jenis_kategori = $_POST['jenis_kategori'];
			$tanggal = date('y-m-d h:i:s');
			
			// buat query
			$sql1 = "UPDATE data_kategori SET jenis_kategori='$jenis_kategori', tanggal='$tanggal' WHERE id_kategori='$_GET[id_kategori]'";
			$edit = mysqli_query($connect, $sql1);
			
			// apakah query simpan berhasil?
			if( $edit ) {
				echo "<script>
						alert('Edit Data Sukses!');
						document.location='tabelkategori.php';
					</script>";
			} else {
				echo "<script>
						alert('Gagal!');
						document.location='tabelkategori.php';
					</script>";
			}
		} else {
			// ambil data dari formulir
			$jenis_kategori = $_POST['jenis_kategori'];
			$tanggal = date('y-m-d h:i:s');
			
			$sql9 = "SELECT * FROM data_kategori WHERE jenis_kategori='$jenis_kategori'";
			$cek = mysqli_query($connect, $sql9);
		 
			if(mysqli_num_rows($cek) > 0){
				
				echo "<script>
						alert('Gagal!');
						document.location='tabelkategori.php?status=gagal';
					</script>";
		 
			} else {
		 
				$sql = "INSERT INTO data_kategori VALUES (' ', '$jenis_kategori', '$tanggal', 'Ada')";
				$query = mysqli_query($connect, $sql);
		 
				echo "<script>
						alert('Sukses Menambahkan!');
						document.location='tabelkategori.php?status=sukses';
					</script>";
			}
			/*// buat query
			$sql = "INSERT INTO data_kategori VALUES (' ', '$jenis_kategori', '$tanggal', 'Ada')";
			$query = mysqli_query($connect, $sql);
			
			// apakah query simpan berhasil?
			if( $query ) {
				echo "<script>
						alert('Sukses Menambahkan!');
						document.location='tabelkategori.php';
					</script>";
			} else {
				echo "<script>
						alert('Gagal!');
						document.location='tabelkategori.php';
					</script>";
			}	*/
		}
		
		
	}

// jika tombol edit atau hapus diklik
	if(isset($_GET['hal'])){
		if($_GET['hal'] == "edit"){
			$tampil = mysqli_query($connect,"SELECT * FROM data_kategori WHERE id_kategori='$_GET[id_kategori]'");
			$data = mysqli_fetch_array($tampil);
			if($data){
				$jkategori = $data['jenis_kategori'];
			}
		}
	}

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
    <title>Data Kategori Barang</title>

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
                        <li class="active">
                            <a href="tabelkategori.php">
                                <i class="fas fa-reorder"></i>Data Kategori Barang</a>
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
                                    <a href="grafiklabarugi.php">Laba Rugi</a>
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
                            <div class="col-md-12">
                                <!-- DATA TABLE -->
                                <h3 class="title-5 m-b-20">Data Kategori Barang</h3>
                                <div class="table-data__tool">
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-7">
                                <div class="table-responsive table--no-card m-b-50 ">
                                   <table id="example" class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Jenis Kategori</th>
                                                <th>Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
												$query = mysqli_query($connect, "SELECT * FROM data_kategori WHERE status='Ada'");
                                                $no=1;
																			
													while ($kategori = mysqli_fetch_array($query, MYSQLI_ASSOC)){
														echo "<tr>";
                                                        echo "<td>".$no++."</td>";
														echo "<td>".$kategori['jenis_kategori']."</td>";
														echo "<td>
													       	<div class='table-data-feature'>
															<button type='submit' class='item' data-toggle='tooltip' data-placement='top' title='Edit'>
															<a href='tabelkategori.php?hal=edit&id_kategori=".$kategori['id_kategori']."'>
															<i class='zmdi zmdi-edit'></i>
															</a></button>
															
																<button class='item' data-toggle='tooltip' data-placement='top' title='Delete'>
																	<a href='hapuskategori.php?id_kategori=".$kategori['id_kategori']."' onclick=\"return confirm('Yakin Hapus Kategori')\">
																		<i class='zmdi zmdi-delete'></i>
																	</a>
																</button>
															</div>
														</td>";
												    echo "</tr>";
												}
											?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
								
							<div class="col-lg-5">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Formulir Data Kategori Barang</strong>
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                             <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Jenis Kategori</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="text-input" name="jenis_kategori" value="<?= @$data['jenis_kategori'];?>" required="required" placeholder="Masukan Jenis Kategori" class="form-control">
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <button type="submit"  name="simpan"  class="btn btn-primary btn-sm">
                                                    <i class="fa fa-dot-circle-o"></i> Simpan
                                                </button>
												<button type="reset"  name="reset"  class="btn btn-danger btn-sm">
												<a href="tabelkategori.php" class="text-white">
                                                    <i class="fa fa-times"></i> Batal
                                                </a></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
							
							
							
                        </div>
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
        $(document).ready( function () {
    $('#example').DataTable();
} );
    </script>

</body>

</html>
<!-- end document-->
