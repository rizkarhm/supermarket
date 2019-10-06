<?php
    include 'header.php';
    include 'config.php';
?>

<h3><span class="glyphicon glyphicon-user"></span> Edit Data Barang</h3>
<a class="btn" href="barang_data.php"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>

<?php
    $kode_barang = mysqli_real_escape_string($connect, $_GET['kode_barang']);
    $barang = mysqli_query($connect, "select * from tblbarang where kode_barang='$kode_barang'") or die(mysqli_connect_error());
    $tbljenis = mysqli_query($connect, "select * from tbljenis");
    //$tblbarang = mysqli_query($connect, "select kode_jenis from tblbarang");
    while ($data_barang = mysqli_fetch_array($barang)) {
?>

<form action="barang_update.php" method="post">
    <table class="table">
        <tr>
            <td></td>
            <td><input type="hidden" class="form-control" name="kode_barang" value="<?php echo $data_barang['kode_barang'] ?>"></td>
        </tr>
        <tr>
            <td>Nama Barang</td>
            <td><input type="text" class="form-control" name="nama_barang" value="<?php echo $data_barang['nama_barang'] ?>"></td>
        </tr>
        <tr>
            <td>Kode Jenis</td>
            <td>
            <select name="kode_jenis" class="form-control">
                <?php
                $sql_jenis = mysqli_query($connect, "SELECT * FROM tbljenis");
                while ($data_jenis = mysqli_fetch_array($sql_jenis)) {
                    if ($data_barang['kode_jenis'] == $data_jenis['kode_jenis']) {
                        $select="selected";
                    } else{
                        $select="";
                    }
                    echo "<option value=".$data_jenis['kode_jenis']." $select> ". $data_jenis['jenis'] ."</option>";
                }
                ?>      
            </select>
            </td>
        </tr>
        <tr>
            <td>Harga Net</td>
            <td><input type="text" class="form-control" name="harga_net" value="<?php echo $data_barang['harga_net'] ?>"></td>
        </tr>
        <tr>
            <td>Harga Jual</td>
            <td><input type="text" class="form-control" name="harga_jual" value="<?php echo $data_barang['harga_jual'] ?>"></td>
        </tr>
        <tr>
            <td>Stok</td>
            <td><input type="text" class="form-control" name="stok" value="<?php echo $data_barang['stok'] ?>"></td>
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
        $kode_barang    = $_POST['kode_barang'];

        $nama_barang    = $_POST['nama_barang'];
        $kode_jenis     = $_POST['kode_jenis'];
        $harga_net      = $_POST['harga_net'];
        $harga_jual     = $_POST['harga_jual'];
        $stok           = $_POST['stok'];

        // update user data
        $barang = mysqli_query($connect, "update tblbarang set nama_barang='$nama_barang', kode_jenis='$kode_jenis', harga_net='$harga_net', harga_jual='$harga_jual', stok='$stok' where kode_barang='$kode_barang'");

       header("location:barang_data.php");
    }    
?>

