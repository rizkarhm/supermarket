<?php
    include "config.php";
    include "header.php";
    $jenis = mysqli_query($connect, "SELECT * from tbljenis order by kode_jenis asc");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Jenis Barang</title>
</head>
<body>
    <h3><span class="glyphicon glyphicon-tags"></span> &nbsp Jenis Barang</h3>
    <button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span> Tambah Jenis Barang</button>
    <br/>
    <br/>
    <br/>

    <?php
        $per_hal = 10;
        $jumlah_record = mysqli_query($connect, "SELECT COUNT(*) from tbljenis");
        $jum = mysqli_fetch_array($jumlah_record, MYSQLI_NUM);
        $halaman = ceil($jum[0] / $per_hal);
        $page = (isset($_GET['page'])) ? (int) $_GET['page'] : 1;
        $start = ($page - 1) * $per_hal;

        $query = "SELECT max(kode_jenis) as maxKode FROM tbljenis";
        $hasil = mysqli_query($connect, $query);
        $data  = mysqli_fetch_array($hasil);
        $kodeJenis = $data['maxKode'];

        // mengambil angka atau bilangan dalam kode anggota terbesar,
        // dengan cara mengambil substring mulai dari karakter ke-1 diambil 6 karakter
        // misal 'BRG001', akan diambil '001'
        // setelah substring bilangan diambil lantas dicasting menjadi integer
        $noUrut = (int) substr($kodeJenis, 1, 3);

        // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
        $noUrut++;

        // membentuk kode anggota baru
        // perintah sprintf("%03s", $noUrut); digunakan untuk memformat string sebanyak 3 karakter
        // misal sprintf("%03s", 12); maka akan dihasilkan '012'
        // atau misal sprintf("%03s", 1); maka akan dihasilkan string '001'
        $char = "J";
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

    <form action="jenis_search.php" method="get">
        <div class="input-group col-md-5 col-md-offset-7">
            <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span></span>
            <input type="text" class="form-control" placeholder="Cari" aria-describedby="basic-addon1"
                name="cari">
        </div>
    </form>
    <br />
    <table class="table table-hover">
        <tr>
            <th class="col-md-1"><center>Kode</th>
            <th class="col-md-4"><center>Jenis Barang</th>
            <th class="col-md-3"><center>Opsi</th>
        </tr>
        <?php
            if (isset($_GET['cari'])) {
                $cari = mysqli_real_escape_string($connect, $_GET['cari']);
                $jenis = mysqli_query($connect, "select * from tbljenis where jenis like '%$cari%'");
            } 
            else {
                $jenis = mysqli_query($connect, "select * from tbljenis limit $start, $per_hal");
            }

            while ($data_jenis = mysqli_fetch_array($jenis)) {
        ?>
        <tr>
            <td><center><?php echo $data_jenis['kode_jenis']?></td>
            <td><center><?php echo $data_jenis['jenis'] ?></td>
            <td><center>
                <a href="jenis_detail.php?kode_jenis=<?php echo $data_jenis['kode_jenis']; ?>" class="btn btn-info">Detail</a>
                <a href="jenis_update.php?kode_jenis=<?php echo $data_jenis['kode_jenis']; ?>" class="btn btn-warning">Edit</a>
                <a onclick="if(confirm('Apakah anda yakin ingin menghapus data <?php echo $data_jenis['kode_jenis']; ?>??')){ location.href='jenis_delete.php?kode_jenis=<?php echo $data_jenis['kode_jenis']; ?>' }" class="btn btn-danger">Hapus</a>
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
                    <h4 class="modal-title">Tambah Jenis Barang</h4>
                </div>
                <div class="modal-body">
                    <form action="jenis_insert.php" method="post">
                        <div class="form-group">
                            <label>Kode Jenis</label>
                            <input name="kode_jenis" type="text" readonly="" class="form-control" placeholder="Kode Jenis" value="<?php echo $newID; ?>">
                        </div>
                        <div class="form-group">
                            <label>Jenis Barang</label>
                            <input name="jenis" type="text" class="form-control" placeholder="Jenis Barang">
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

