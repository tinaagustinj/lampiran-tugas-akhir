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


$label = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
$label1 = ["Pemasukan","Pengeluaran"];
 
for($bulan = 1;$bulan < 13;$bulan++)
{
    $query1 = mysqli_query($connect,"SELECT sum(pemasukan) as pemasukan from laba_rugi where MONTH(tanggal_lr)='$bulan'");
    $sql = $query1->fetch_array();
    $pemasukan[] = $sql['pemasukan'];

    $query2 = mysqli_query($connect,"SELECT sum(pengeluaran) as pengeluaran from laba_rugi where MONTH(tanggal_lr)='$bulan'");
    $sql2 = $query2->fetch_array();
    $pengeluaran[] = $sql2['pengeluaran'];
	

    
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
    <title>Grafik Transaksi Keuangan</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

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

    <script type="text/javascript" src="vendor/chartjs/Chart.bundle.min.js"></script>

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
                            <li class="active has-sub">
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
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                                <div class="col-lg-12">
                                <div class="au-card m-b-30">
                                    <div class="au-card-inner">
                                        <h3 class="title-2 m-b-40">Grafik Pemasukan Pengeluaran</h3>
                                        <canvas id="myChart1"></canvas>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
               </div>
            </div>
            <!-- MAIN CONTENT-->
        </div>

    </div>
 
 <script>
  var ctx = document.getElementById("myChart1");
      var myChart = new Chart(ctx, {
        type: 'bar',
        defaultFontFamily: 'Poppins',
        data: {
          labels: <?php echo json_encode($label); ?>,
          datasets: [
            {
              label: "Pemasukan",
              data: <?php echo json_encode($pemasukan); ?>,
              borderColor: "rgba(63, 255, 0, 0.9)",
              borderWidth: "0",
              backgroundColor: "rgba(63, 255, 0, 0.5)",
              fontFamily: "Poppins"
            },
            {
              label: "Pengeluaran",
              data: <?php echo json_encode($pengeluaran); ?>,
              borderColor: "rgba(255, 0, 0,0.9)",
              borderWidth: "0",
              backgroundColor: "rgba(255, 0, 0,0.5)",
              fontFamily: "Poppins"
            },
          ]
        },
        options: {
          legend: {
            position: 'top',
            labels: {
              fontFamily: 'Poppins'
            }

          },
          scales: {
            xAxes: [{
              ticks: {
                fontFamily: "Poppins"

              }
            }],
            yAxes: [{
              ticks: {
                beginAtZero: true,
                fontFamily: "Poppins"
              }
            }]
          }
        }
      });
</script>

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

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->
