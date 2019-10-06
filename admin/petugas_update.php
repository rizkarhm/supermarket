<?php
    include 'header.php';
    include 'config.php';
?>

<h3><span class="glyphicon glyphicon-user"></span> Edit Data petugas</h3>
<a class="btn" href="petugas_data.php"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>

<?php
    $id_petugas = mysqli_real_escape_string($connect, $_GET['id_petugas']);
    $petugas = mysqli_query($connect, "select * from tblpetugas where id_petugas='$id_petugas'") or die(mysqli_connect_error());
    $tblpetugas = mysqli_query($connect, "select * from tblpetugas");
    //$tblpetugas = mysqli_query($connect, "select kode_jenis from tblpetugas");
    while ($data_petugas = mysqli_fetch_array($petugas)) {
?>

<form action="petugas_update.php" method="post">
    <table class="table">
        <tr>
            <td></td>
            <td><input type="hidden" class="form-control" name="id_petugas" value="<?php echo $data_petugas['id_petugas'] ?>"></td>
        </tr>
        <tr>
            <td>Nama petugas</td>
            <td><input type="text" class="form-control" name="nama_petugas" value="<?php echo $data_petugas['nama_petugas'] ?>"></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td><input type="text" class="form-control" name="alamat" value="<?php echo $data_petugas['alamat'] ?>"></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="text" class="form-control" name="email" value="<?php echo $data_petugas['email'] ?>"></td>
        </tr>
        <tr>
            <td>Telepon</td>
            <td><input type="text" class="form-control" name="telepon" value="<?php echo $data_petugas['telepon'] ?>"></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="text" class="form-control" name="password" value="<?php echo $data_petugas['password'] ?>"></td>
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
        $id_petugas    = $_POST['id_petugas'];

        $nama_petugas  = $_POST['nama_petugas'];
        $alamat        = $_POST['alamat'];
        $email         = $_POST['email'];
        $telepon       = $_POST['telepon'];
        $password      = $_POST['password'];

        // update user data
        $petugas = mysqli_query($connect, "update tblpetugas set nama_petugas='$nama_petugas', alamat='$alamat',  email='$email', telepon='$telepon', password='$password' where id_petugas='$id_petugas'");

       header("location:petugas_data.php");
    }    
?>

