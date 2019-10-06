<?php
    include 'header.php';
    include 'config.php';
?>

<h3><span class="glyphicon glyphicon-briefcase"></span> Detail Petugas</h3>
<a class="btn" href="petugas_data.php"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>

<?php
    $id_petugas = mysqli_real_escape_string($connect, $_GET['id_petugas']);
    $det = mysqli_query($connect, "select * from tblpetugas where id_petugas='$id_petugas'") or die(mysqli_connect_error());
    while ($d = mysqli_fetch_array($det)) {
?>

<table class="table">
    <tr>
        <td>ID Petugas</td>
        <td><?php echo $d['id_petugas'] ?></td>
    </tr>
    <tr>
        <td>Nama Petugas</td>
        <td><?php echo $d['nama_petugas'] ?></td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td><?php echo $d['alamat'] ?></td>
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