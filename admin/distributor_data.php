<?php
    include "config.php";
    include "header.php";
    $distributor = mysqli_query($connect, "SELECT * from tbldistributor order by id_distributor asc");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Data Distributor</title>
</head>
<body>
    <h3><span class="glyphicon glyphicon-user"></span> &nbsp Data Distributor</h3>
    <button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span> Tambah Distributor</button>
    <br/>
    <br/>
    <br/>

    <?php
        $per_hal = 5;
        $jumlah_record = mysqli_query($connect, "SELECT COUNT(*) from tbldistributor");
        $jum = mysqli_fetch_array($jumlah_record, MYSQLI_NUM);
        $halaman = ceil($jum[0] / $per_hal);
        $page = (isset($_GET['page'])) ? (int) $_GET['page'] : 1;
        $start = ($page - 1) * $per_hal;

        //ID
        $query = "SELECT max(id_distributor) as maxKode FROM tbldistributor";
        $hasil = mysqli_query($connect, $query);
        $data  = mysqli_fetch_array($hasil);
        $kodeDistributor = $data['maxKode'];

        // mengambil angka atau bilangan dalam kode anggota terbesar,
        // dengan cara mengambil substring mulai dari karakter ke-1 diambil 6 karakter
        // misal 'BRG001', akan diambil '001'
        // setelah substring bilangan diambil lantas dicasting menjadi integer
        $noUrut = (int) substr($kodeDistributor, 1, 3);

        // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
        $noUrut++;

        // membentuk kode anggota baru
        // perintah sprintf("%03s", $noUrut); digunakan untuk memformat string sebanyak 3 karakter
        // misal sprintf("%03s", 12); maka akan dihasilkan '012'
        // atau misal sprintf("%03s", 1); maka akan dihasilkan string '001'
        $char = "D";
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

    <form action="distributor_search.php" method="get">
        <div class="input-group col-md-5 col-md-offset-7">
            <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span></span>
            <input type="text" class="form-control" placeholder="Cari" aria-describedby="basic-addon1"
                name="cari">
        </div>
    </form>
    <br />
    <table class="table table-hover">
        <tr>
            <th class="col-md-1/2"><center>ID</th>
            <th class="col-md-2"><center>Nama Distributor</th>
            <th class="col-md-2"><center>Alamat</th>
            <th class="col-md-1"><center>Kota Asal</th>
            <th class="col-md-2"><center>Email</th>
            <th class="col-md-2"><center>Telepon</th>
            <th class="col-md-4"><center>Opsi</th>  
        </tr>
        <?php
            if (isset($_GET['cari'])) {
                $cari = mysqli_real_escape_string($connect, $_GET['cari']);
                $distributor = mysqli_query($connect, "select * from tbldistributor where nama_distributor like '%$cari%'");
            } 
            else {
                $distributor = mysqli_query($connect, "select * from tbldistributor limit $start, $per_hal");
            }

            while ($data_distributor = mysqli_fetch_array($distributor)) {
        ?>
        <tr>
            <td><center><?php echo $data_distributor['id_distributor']?></td>
            <td><center><?php echo $data_distributor['nama_distributor'] ?></td>
            <td><center><?php echo $data_distributor['alamat'] ?></td>
            <td><center><?php echo $data_distributor['kota_asal'] ?></td>
            <td><center><?php echo $data_distributor['email'] ?></td>
            <td><center><?php echo $data_distributor['telepon'] ?></td>
            <td><center>
                <a href="distributor_detail.php?id_distributor=<?php echo $data_distributor['id_distributor']; ?>" class="btn btn-info">Detail</a>
                <a href="distributor_update.php?id_distributor=<?php echo $data_distributor['id_distributor']; ?>" class="btn btn-warning">Edit</a>
                <a onclick="if(confirm('Apakah anda yakin ingin menghapus data <?php echo $data_distributor['id_distributor']; ?>??')){ location.href='distributor_delete.php?id_distributor=<?php echo $data_distributor['id_distributor']; ?>' }" class="btn btn-danger">Hapus</a>
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
                    <h4 class="modal-title">Tambah Distributor Baru</h4>
                </div>
                <div class="modal-body">
                    <form action="distributor_insert.php" method="post">
                        <div class="form-group">
                            <label>ID</label>
                            <input name="id_distributor" type="text" class="form-control" placeholder="ID Distributor" value="<?php echo $newID; ?>" readonly="">
                        </div>
                        <div class="form-group">
                            <label>Nama Distributor</label>
                            <input name="nama_distributor" type="text" class="form-control" placeholder="Nama Distributor">
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input name="alamat" type="text" class="form-control" placeholder="Alamat">
                        </div>
                        <div class="form-group">
                            <label>Kota Asal</label>
                            <input name="kota_asal" type="text" class="form-control" placeholder="Kota Asal">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input name="email" type="text" class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label>Telepon</label>
                            <input name="telepon" type="text" class="form-control" placeholder="Telepon">
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

