<?php
    include "config.php";
    include "header.php";
    $petugas = mysqli_query($connect, "SELECT * from tblpetugas order by id_petugas asc");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Data petugas</title>
</head>
<body>
    <h3><span class="glyphicon glyphicon-wrench"></span> &nbsp Data Petugas</h3>
    <button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span> Tambah Petugas</button>
    <br/>
    <br/>
    <br/>

    <?php
        $per_hal = 10;
        $jumlah_record = mysqli_query($connect, "SELECT COUNT(*) from tblpetugas");
        $jum = mysqli_fetch_array($jumlah_record, MYSQLI_NUM);
        $halaman = ceil($jum[0] / $per_hal);
        $page = (isset($_GET['page'])) ? (int) $_GET['page'] : 1;
        $start = ($page - 1) * $per_hal;

        //ID
        $query = "SELECT max(id_petugas) as maxid FROM tblpetugas";
        $hasil = mysqli_query($connect, $query);
        $data  = mysqli_fetch_array($hasil);
        $idpetugas = $data['maxid'];

        // mengambil angka atau bilangan dalam id anggota terbesar,
        // dengan cara mengambil substring mulai dari karakter ke-1 diambil 6 karakter
        // misal 'BRG001', akan diambil '001'
        // setelah substring bilangan diambil lantas dicasting menjadi integer
        $noUrut = (int) substr($idpetugas, 1, 3);

        // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
        $noUrut++;

        // membentuk id anggota baru
        // perintah sprintf("%03s", $noUrut); digunakan untuk memformat string sebanyak 3 karakter
        // misal sprintf("%03s", 12); maka akan dihasilkan '012'
        // atau misal sprintf("%03s", 1); maka akan dihasilkan string '001'
        $char = "P";
        $newID = $char . sprintf("%03s", $noUrut);
    ?>

    <table class="col-md-2">
            <tr>
                <td>Jumlah Record</td>
                <td><?php echo ": ".$jum[0]; ?></td>
            </tr>
            <tr>
                <td>Jumlah Halaman</td>
                <td><?php echo ": ".$halaman; ?></td>
            </tr>
    </table>

    <form action="petugas_search.php" method="get">
        <div class="input-group col-md-5 col-md-offset-7">
            <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span></span>
            <input type="text" class="form-control" placeholder="Cari" aria-describedby="basic-addon1"
                name="cari">
        </div>
    </form>
    <br />
    <table class="table table-hover">
        <tr>
            <th class="col-md-1"><center>ID</th>
            <th class="col-md-2"><center>Nama Petugas</th>
            <th class="col-md-2"><center>Alamat</th>
            <th class="col-md-2"><center>Email</th>
            <th class="col-md-1"><center>Telepon</th>
            <th class="col-md-4"><center>Opsi</th>
        </tr>
        <?php
            if (isset($_GET['cari'])) {
                $cari = mysqli_real_escape_string($connect, $_GET['cari']);
                $petugas = mysqli_query($connect, "select * from tblpetugas where nama_petugas like '%$cari%'");
            } 
            else {
                $petugas = mysqli_query($connect, "select * from tblpetugas limit $start, $per_hal");
            }

            while ($data_petugas = mysqli_fetch_array($petugas)) {
        ?>
        <tr>
            <td><center><?php echo $data_petugas['id_petugas']?></td>
            <td><center><?php echo $data_petugas['nama_petugas'] ?></td>
            <td><center><?php echo $data_petugas['alamat'] ?></td>
            <td><center><?php echo $data_petugas['email'] ?></td>
            <td><center><?php echo $data_petugas['telepon'] ?></td>
            <td><center>
                <a href="petugas_detail.php?id_petugas=<?php echo $data_petugas['id_petugas']; ?>" class="btn btn-info">Detail</a>
                <a href="petugas_update.php?id_petugas=<?php echo $data_petugas['id_petugas']; ?>" class="btn btn-warning">Edit</a>
                <a onclick="if(confirm('Apakah anda yakin ingin menghapus data <?php echo $data_petugas['id_petugas']; ?>??')){ location.href='petugas_delete.php?id_petugas=<?php echo $data_petugas['id_petugas']; ?>' }" class="btn btn-danger">Hapus</a>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>

    <ul class="pagination">
        <?php
        for ($x = 1; $x <= $halaman; $x++) {
            ?>
        <li><a href="?page=<?php echo $x ?>"><?php echo $x ?></a></li>
        <?php
        }
        ?>
    </ul>

    <!-- modal input -->
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Tambah Petugas Baru</h4>
                </div>
                <div class="modal-body">
                    <form action="petugas_insert.php" method="post">
                        <div class="form-group">
                            <label>ID</label>
                            <input name="id_petugas" type="text" readonly="" class="form-control" placeholder="ID Petugas" value="<?php echo $newID; ?>">
                        </div>
                        <div class="form-group">
                            <label>Nama Petugas</label>
                            <input name="nama_petugas" type="text" class="form-control" placeholder="Nama Petugas">
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input name="alamat" type="text" class="form-control" placeholder="Alamat">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input name="email" type="text" class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label>Telepon</label>
                            <input name="telepon" type="text" class="form-control" placeholder="Telepon">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input name="password" type="password" class="form-control" placeholder="Password">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <input type="submit" class="btn btn-primary" value="Simpan">
                </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

