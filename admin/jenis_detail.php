<?php
    include 'header.php';
    include 'config.php';
?>

<h3><span class="glyphicon glyphicon-briefcase"></span> Detail Jenis Barang</h3>
<a class="btn" href="jenis_data.php"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>

<?php
    $kode_jenis = mysqli_real_escape_string($connect, $_GET['kode_jenis']);
    $det = mysqli_query($connect, "select * from tbljenis where kode_jenis='$kode_jenis'") or die(mysqli_connect_error());
    while ($d = mysqli_fetch_array($det)) {
?>

<table class="table">
    <tr>
        <td>Kode Jenis</td>
        <td><?php echo $d['kode_jenis'] ?></td>
    </tr>
    <tr>
        <td>Jenis Barang</td>
        <td><?php echo $d['jenis'] ?></td>
    </tr>
</table>
<?php
}
?>