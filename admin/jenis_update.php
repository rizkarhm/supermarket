<?php
    include 'header.php';
    include 'config.php';
?>

<h3><span class="glyphicon glyphicon-user"></span> Edit Jenis Barang</h3>
<a class="btn" href="jenis_data.php"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>

<?php
    $kode_jenis = mysqli_real_escape_string($connect, $_GET['kode_jenis']);
    $det = mysqli_query($connect, "select * from tbljenis where kode_jenis='$kode_jenis'") or die(mysqli_connect_error());
    while ($d = mysqli_fetch_array($det)) {
?>

<form action="jenis_update.php" method="post">
    <table class="table">
        <tr>
            <!-- <td>Kode Jenis</td> -->
            <td><input type="hidden" class="form-control" name="kode_jenis" value="<?php echo $d['kode_jenis'] ?>"></td>
        </tr>
        <tr>
            <td>Jenis Barang</td>
            <td><input type="text" class="form-control" name="jenis" value="<?php echo $d['jenis'] ?>"></td>
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
        $kode_jenis = $_POST['kode_jenis'];
        $jenis      = $_POST['jenis'];

        // update user data
        $det = mysqli_query($connect, "update tbljenis set jenis='$jenis' where kode_jenis='$kode_jenis'");
        header("location:jenis_data.php");
    }    
?>