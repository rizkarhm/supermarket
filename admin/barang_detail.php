<?php
    include 'header.php';
    include 'config.php';
?>

<h3><span class="glyphicon glyphicon-briefcase"></span> Detail Barang</h3>
<a class="btn" href="barang_data.php"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>

<?php
    $kode_barang = mysqli_real_escape_string($connect, $_GET['kode_barang']);
    
    $det = mysqli_query($connect, "select B.kode_barang, B.nama_barang, B.kode_jenis, J.jenis, B.harga_net, B.harga_jual, B.stok from tblbarang B inner join tbljenis J on B.kode_jenis=J.kode_jenis where B.kode_barang='$kode_barang'") or die(mysqli_connect_error());    

    while ($d = mysqli_fetch_array($det)) {
?>

<table class="table">
    <tr>
        <td>Kode Barang</td>
        <td><?php echo $d['kode_barang'] ?></td>
    </tr>
    <tr>
        <td>Nama Barang</td>
        <td><?php echo $d['nama_barang'] ?></td>
    </tr>
    <tr>
        <td>Kode Jenis</td>
        <td><?php echo $d['kode_jenis'] ?></td>
    </tr>
    <tr>
        <td>Jenis</td>
        <td><?php echo $d['jenis'] ?></td>
    </tr>
    <tr>
        <td>Harga Net</td>
        <td>Rp.<?php echo number_format($d['harga_net']) ?>,-</td>
    </tr>
    <tr>
        <td>Harga Jual</td>
        <td>Rp.<?php echo number_format($d['harga_jual']) ?>,-</td>
    </tr>
    <tr>
        <td>Stok</td>
        <td><?php echo $d['stok'] ?></td>
    </tr>
</table>
<?php
}
?>