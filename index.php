<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
include 'random_code.php';
include 'kode_pembelian.php';
include 'format_rupiah.php';
include 'koneksi.php';
session_start();
// $koneksi = mysqli_connect("localhost","root","","db_pos");
if(!empty($_SESSION['username']) AND !empty($_SESSION['id_karyawan'])) {

    $id_karyawan = $_SESSION['id_karyawan'];
    $user = mysqli_query($koneksi, "SELECT * FROM tb_karyawan, tb_jabatan WHERE tb_karyawan.id_jabatan = tb_jabatan.id_jabatan AND tb_karyawan.id_karyawan = '$id_karyawan'");
    $userData = mysqli_fetch_array($user);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="asset/icon/cashier-machine.png"/>
    <title><?php include "title.php" ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="asset/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="asset/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="asset/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="asset/morrisjs/morris.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="asset/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="asset/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="asset/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Bootstrap Chosen -->
    <link rel="stylesheet" href="asset/chosen/bootstrap-chosen.css"/>

    <!-- Flatpickr -->
    <link rel="stylesheet" href="asset/flatpickr/dist/flatpickr.min.css"/>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="?page=beranda"><i><img src="asset/icon/cashier-machine-2.png" alt=""></i> Point Of Sale</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                 <!-- /.dropdown -->
                 <li class="dropdown">
                    <?php 
                    $bar2 = mysqli_query($koneksi, "SELECT COUNT(id_barang) AS barang FROM `tb_barang` WHERE stok <= 10 ");
                    $ambil2 = mysqli_fetch_array($bar2);
                    ?>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <b style="color: red"><?php if($ambil2['barang'] != 0){ echo $ambil2['barang']; } ?></b> <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <?php
                        $bar = mysqli_query($koneksi, "SELECT * FROM `tb_barang` WHERE stok <= 10 ");
                        while($ambil = mysqli_fetch_array($bar)) {
                        ?>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-cube fa-fw"></i> <?php echo $ambil['nama_barang'] ?>
                                    <span class="pull-right text-muted small">Stok <?php echo $ambil['stok'] ?></span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <?php } ?>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="?page=user"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <h4><?php echo $userData['nama'] ?></h4>
                            <h6>Login Sebagai <b><?php echo $userData['jabatan'] ?></b></h6>
                            <p><b><?php echo date("Y-m-d") ?></b></p>
                            <!-- /input-group -->
                        </li>
                        <?php if($userData['jabatan'] == "Administrator") { ?>
                        <li>
                            <a href="?page=beranda"><i class="fa fa-home fa-fw"></i> Beranda</a>
                        </li>
                        <li>
                            <a href="?page=barang"><i class="fa fa-cubes fa-fw"></i> Barang</a>
                        </li>
                        <li>
                            <a href="?page=penjualan&kodepj=<?php echo $kode ?>"><i class="fa fa-shopping-cart fa-fw"></i> Penjualan</a>
                        </li>
                        <li>
                            <a href="?page=pembelian&kodepb=<?php echo $kodePB ?>"><i class="fa fa-cart-plus fa-fw"></i> Pembelian</a>
                        </li>
                        <li>
                            <a href="?page=supplier"><i class="fa fa-truck fa-fw"></i> Supplier</a>
                        </li>
                        <li>
                            <a href="?page=pelanggan"><i class="fa fa-users fa-fw"></i> Pelanggan</a>
                        </li>
                        <li>
                            <a href="?page=karyawan"><i class="fa fa-male fa-fw"></i> Karyawan</a>
                        </li>
                        <li>
                            <a href="?page=laporan"><i class="fa fa-book fa-fw"></i> Laporan</a>
                        </li>
                        <li>
                            <a href="?page=pengaturan_aplikasi"><i class="fa fa-gear fa-fw"></i> Pengaturan Aplikasi</a>
                        </li>
                        <?php } else { ?>
                        <li>
                            <a href="?page=beranda"><i class="fa fa-home fa-fw"></i> Beranda</a>
                        </li>
                        <li>
                            <a href="?page=barang"><i class="fa fa-cubes fa-fw"></i> Barang</a>
                        </li>
                        <li>
                            <a href="?page=penjualan&kodepj=<?php echo $kode ?>"><i class="fa fa-shopping-cart fa-fw"></i> Penjualan</a>
                        </li>
                        <li>
                            <a href="?page=pelanggan"><i class="fa fa-users fa-fw"></i> Pelanggan</a>
                        </li>
                        <li>
                            <a href="?page=laporan"><i class="fa fa-book fa-fw"></i> Laporan</a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <?php include "konten.php"; ?>
        </div>
        <!-- /#page-wrapper --> 
    </div>
    <footer>
		<div class="container-fluid">
			<p class="copyright">&copy; 2019 <b>Nailul Firdaus</b></p>
		</div>
	</footer>
    
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="asset/jquery/jquery.min.js"></script>
    
    <!-- Bootstrap Core JavaScript -->
    <script src="asset/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="asset/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="asset/raphael/raphael.min.js"></script>
    <script src="asset/morrisjs/morris.min.js"></script>
    <script src="../data/morris-data.js"></script>

    <!-- DataTables JavaScript -->
    <script src="asset/datatables/js/jquery.dataTables.min.js"></script>
    <script src="asset/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="asset/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="asset/dist/js/sb-admin-2.js"></script>
    <!-- Validation form -->
    <script src="asset/jquery/jquery.validate.min.js"></script>
    <script src="asset/jquery/additional-methods.min.js"></script>
    
    <!-- JS Chosen -->
    <script src="asset/chosen/chosen.jquery.min.js"></script>

    <!-- JS flatpickr -->
    <script src="asset/flatpickr/dist/flatpickr.min.js"></script>

    <script src="asset/js/main.js"></script>
    <script>
        $(".chosen-select").chosen();
        
        flatpickr(".flatpickr", {
			dateFormat: "Y-m-d",
		});

        // $(document).ready(function(){
        //     $(".flatpickr").flatpickr({
        //         dateFormat: "Y-m-d"
        //     });
        // });

    </script>

</body>

</html>
<?php
} else {
    echo "<meta http-equiv='refresh' content='1;url=login.php' >";
}
?>
