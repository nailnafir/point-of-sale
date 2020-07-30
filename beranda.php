<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-home fa-fw"></i> Beranda</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i><img src="asset/icon/shopping-cart.png" alt=""></i>
                    </div>
                    <?php
                    $date = date("Y-m-d");
                    $query1 = mysqli_query($koneksi, "SELECT SUM(sub_total) AS pendapatan, COUNT(kode_penjualan) AS penjualan FROM tb_penjualan_detail WHERE tanggal ='$date' ");
                    $data1 = mysqli_fetch_array($query1);
                    ?>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $data1['penjualan'] ?></div>
                        <div>Penjualan <?php echo $date; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i><img src="asset/icon/rich.png" alt=""></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">Rp. <?php echo rupiah($data1['pendapatan']) ?></div>
                        <div>Pendapatan <?php echo date("Y-m-d") ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i><img src="asset/icon/trolley.png" alt=""></i>
                    </div>
                    <?php
                    $query2 = mysqli_query($koneksi, "SELECT SUM(total) AS pengeluaran, COUNT(kode_pembelian) AS pembelian FROM tb_pembelian_detail WHERE tanggal = '$date' ");
                    $data2= mysqli_fetch_array($query2);
                    ?>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $data2['pembelian'] ?></div>
                        <div>Pembelian <?php echo $date ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i><img src="asset/icon/payment.png" alt=""></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">Rp. <?php echo rupiah($data2['pengeluaran']) ?></div>
                        <div>Pengeluaran <?php echo $date ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-5">
        <h4>Stok Barang Mendekati Habis</h4>
        <table class="table table-responsive table-bordered">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Stok</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query3 = mysqli_query($koneksi, "SELECT * FROM tb_barang WHERE stok <= 10");
                while($data3 = mysqli_fetch_array($query3)) {
                ?>
                <tr>
                    <td><?php echo $data3['nama_barang'] ?></td>
                    <td><?php echo $data3['stok'] ?></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>