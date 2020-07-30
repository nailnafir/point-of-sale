<?php
// $koneksi = mysqli_connect('localhost','root','','db_pos');
include '../koneksi.php';
include '../format_rupiah.php';
$mulai = $_GET['mulai'];
$akhir = $_GET['akhir'];
$query = mysqli_query($koneksi, "SELECT * FROM tb_pembelian, tb_barang WHERE (tgl_pembelian BETWEEN '$mulai' AND '$akhir') AND tb_pembelian.kode_barcode = tb_barang.kode_barcode");
?>
<title>Laporan Penjualan</title>
<style>
.container {
    width: 80%;
    padding-right: 20px;
    padding-left: 20px;
    margin-right: auto;
    margin-left: auto;
}
</style>
<div class='container' onclick="window.print()">
    <h1 align="center">Toko Serba Ada</h1>
    <br>
    <br>
    Laporan Pembelian Tanggal <?php echo $mulai." Sampai ". $akhir ?>
    <br>
    <br>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Tanggal Penjualan</th>
                <th width="200px">Kode Barcode</th>
                <th width="200px">Nama Barang</th>
                <th>Jumlah</th>
                <th width="150px">Harga Jual</th>
                <th width="200px">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total = 0;
            while($row = mysqli_fetch_array($query)){
            ?>
                <tr>
                    <td><?php echo $row['tgl_pembelian'] ?></td>
                    <td><?php echo $row['kode_barcode']; ?></td>
                    <td><?php echo $row['nama_barang']; ?></td>
                    <td><?php echo $row['jumlah']; ?></td>
                    <td><?php echo rupiah($row['harga_beli']); ?></td>
                    <td><?php echo rupiah($row['total']); ?></td>
                </tr>
            <?php 
            $total = $total + $row['total'];
            } ?> 
            <tr>
                <td colspan="5">Jumlah Pendapatan</td>
                <td><b>Rp. <?php echo rupiah($total) ?></b></td>
            </tr>
        </tbody>
    </table>
</div>