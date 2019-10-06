<?php
    include 'header.php';
    include 'config.php';
?>

<h3><span class="glyphicon glyphicon-user"></span> Edit Data Distributor</h3>
<a class="btn" href="barang_data.php"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>

<?php
    $id_distributor = mysqli_real_escape_string($connect, $_GET['id_distributor']);
    $distributor = mysqli_query($connect, "select * from tbldistributor where id_distributor='$id_distributor'") or die(mysqli_connect_error());
    $tbldistributor = mysqli_query($connect, "select * from tbldistributor");
    //$tblbarang = mysqli_query($connect, "select kode_jenis from tblbarang");
    while ($data_barang = mysqli_fetch_array($distributor)) {
?>

<form action="distributor_update.php" method="post">
    <table class="table">
        <tr>
            <td></td>
            <td><input type="hidden" class="form-control" name="id_distributor" value="<?php echo $data_barang['id_distributor'] ?>"></td>
        </tr>
        <tr>
            <td>Nama Distributor</td>
            <td><input type="text" class="form-control" name="nama_distributor" value="<?php echo $data_barang['nama_distributor'] ?>"></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td><input type="text" class="form-control" name="alamat" value="<?php echo $data_barang['alamat'] ?>"></td>
        </tr>
        <tr>
            <td>Kota Asal</td>
            <td><input type="text" class="form-control" name="kota_asal" value="<?php echo $data_barang['kota_asal'] ?>"></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="text" class="form-control" name="email" value="<?php echo $data_barang['email'] ?>"></td>
        </tr>
        <tr>
            <td>Telepon</td>
            <td><input type="text" class="form-control" name="telepon" value="<?php echo $data_barang['telepon'] ?>"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" class="btn btn-info" value="Simpan" name="update"></td>
        </tr>
    </table>
</form>
<?php
}
?>


<?php 
    include 'config.php';
    if(isset($_POST['update'])){   
        $id_distributor    = $_POST['id_distributor'];

        $nama_distributor  = $_POST['nama_distributor'];
        $alamat            = $_POST['alamat'];
        $kota_asal         = $_POST['kota_asal'];
        $email             = $_POST['email'];
        $telepon           = $_POST['telepon'];

        // update user data
        $barang = mysqli_query($connect, "update tbldistributor set nama_distributor='$nama_distributor', alamat='$alamat', kota_asal='$kota_asal', email='$email', telepon='$telepon' where id_distributor='$id_distributor'");

       header("location:distributor_data.php");
    }    
?>

