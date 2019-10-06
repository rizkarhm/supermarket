<?php
    include 'header.php';
    include 'config.php';
?>

<h3><span class="glyphicon glyphicon-briefcase"></span> Detail Distributor</h3>
<a class="btn" href="distributor_data.php"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>

<?php
    $id_distributor = mysqli_real_escape_string($connect, $_GET['id_distributor']);
    $det = mysqli_query($connect, "select * from tbldistributor where id_distributor='$id_distributor'") or die(mysqli_connect_error());
    while ($d = mysqli_fetch_array($det)) {
?>

<table class="table">
    <tr>
        <td>ID Distributor</td>
        <td><?php echo $d['id_distributor'] ?></td>
    </tr>
    <tr>
        <td>Nama Distributor</td>
        <td><?php echo $d['nama_distributor'] ?></td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td><?php echo $d['alamat'] ?></td>
    </tr>
    <tr>
        <td>Kota Asal</td>
        <td><?php echo $d['kota_asal'] ?></td>
    </tr>
    <tr>
        <td>Email</td>
        <td><?php echo $d['email'] ?></td>
    </tr>
    <tr>
        <td>Telepon</td>
        <td><?php echo $d['telepon'] ?></td>
    </tr>
</table>
<?php
}
?>