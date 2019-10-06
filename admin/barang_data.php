<?php
    include "config.php";
    include "header.php";
    $barang = mysqli_query($connect, "SELECT * from tblbarang order by kode_barang asc");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Data Barang</title>
</head>
<body>
    <h3><span class="glyphicon glyphicon-list-alt"></span> &nbsp Data Barang</h3>
    <button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span> Tambah Barang</button>
    <br/>
    <br/>
    <br/>

    <?php
        $per_hal = 10;
        $jumlah_record = mysqli_query($connect, "SELECT COUNT(*) from tblbarang");
        $jum = mysqli_fetch_array($jumlah_record, MYSQLI_NUM);
        $halaman = ceil($jum[0] / $per_hal);
        $page = (isset($_GET['page'])) ? (int) $_GET['page'] : 1;
        $start = ($page - 1) * $per_hal;

        //ID
        $query = "SELECT max(kode_barang) as maxKode FROM tblbarang";
        $hasil = mysqli_query($connect, $query);
        $data  = mysqli_fetch_array($hasil);
        $kodeBarang = $data['maxKode'];

        // mengambil angka atau bilangan dalam kode anggota terbesar,
        // dengan cara mengambil substring mulai dari karakter ke-1 diambil 6 karakter
        // misal 'BRG001', akan diambil '001'
        // setelah substring bilangan diambil lantas dicasting menjadi integer
        $noUrut = (int) substr($kodeBarang, 1, 3);

        // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
        $noUrut++;

        // membentuk kode anggota baru
        // perintah sprintf("%03s", $noUrut); digunakan untuk memformat string sebanyak 3 karakter
        // misal sprintf("%03s", 12); maka akan dihasilkan '012'
        // atau misal sprintf("%03s", 1); maka akan dihasilkan string '001'
        $char = "B";
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

    <form action="barang_search.php" method="get">
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
            <th class="col-md-2"><center>Nama Barang</th>
            <th class="col-md-1"><center>Kode Jenis</th>
            <th class="col-md-2"><center>Harga Net</th>
            <th class="col-md-2"><center>Harga Jual</th>
            <th class="col-md-1"><center>Stok</th>
            <th class="col-md-4"><center>Opsi</th>
        </tr>
        <?php
            if (isset($_GET['cari'])) {
                $cari = mysqli_real_escape_string($connect, $_GET['cari']);
                $barang = mysqli_query($connect, "select * from tblbarang where nama_barang like '%$cari%'");
            } 
            else {
                $barang = mysqli_query($connect, "select * from tblbarang limit $start, $per_hal");
            }

            while ($data_barang = mysqli_fetch_array($barang)) {
        ?>
        <tr>
            <td><center><?php echo $data_barang['kode_barang']?></td>
            <td><center><?php echo $data_barang['nama_barang'] ?></td>
            <td><center><?php echo $data_barang['kode_jenis'] ?></td>            
            <td><center>Rp.<?php echo number_format($data_barang['harga_net']) ?>,-</td>
            <td><center>Rp.<?php echo number_format($data_barang['harga_jual']) ?>,-</td>
            <td><center><?php echo $data_barang['stok'] ?></td>
            <td><center>
                <a href="barang_detail.php?kode_barang=<?php echo $data_barang['kode_barang']; ?>" class="btn btn-info">Detail</a>
                <a href="barang_update.php?kode_barang=<?php echo $data_barang['kode_barang']; ?>" class="btn btn-warning">Edit</a>
                <a onclick="if(confirm('Apakah anda yakin ingin menghapus data <?php echo $data_barang['kode_barang']; ?>??')){ location.href='barang_delete.php?kode_barang=<?php echo $data_barang['kode_barang']; ?>' }" class="btn btn-danger">Hapus</a>
                
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
                    <h4 class="modal-title">Tambah Barang Baru</h4>
                </div>
                <div class="modal-body">
                    <form action="barang_insert.php" method="post">
                        <div class="form-group">
                            <label>Kode Barang</label>
                            <input name="kode_barang" type="text" readonly="" class="form-control" placeholder="Kode Barang" value="<?php echo $newID; ?>">
                        </div>
                        <div class="form-group">
                            <label>Nama Barang</label>
                            <input name="nama_barang" type="text" class="form-control" placeholder="Nama Barang">
                        </div>
                        <div class="form-group">
                            <label>Kode Jenis</label>
                            <br>
                            <select name="kode_jenis" class="form-control">
                                <?php
                                    $query = "select * from tbljenis";
                                    $hasil = mysqli_query($connect, $query);
                                    while ($qtabel = mysqli_fetch_array($hasil))
                                    {
                                        echo '<option value="'.$qtabel['kode_jenis'].'"> '.$qtabel['jenis'].' </option>';	
                                    }
                                ?>
                            </select>
                            <!-- <input name="kode_jenis" type="text" class="form-control" placeholder="Kode Jenis"> -->
                        </div>
                        <div class="form-group">
                            <label>Harga Net</label>
                            <input name="harga_net" type="text" class="form-control" placeholder="Harga Net">
                        </div>
                        <div class="form-group">
                            <label>Harga Jual</label>
                            <input name="harga_jual" type="text" class="form-control" placeholder="Harga Jual">
                        </div>
                        <div class="form-group">
                            <label>Stok</label>
                            <input name="stok" type="text" class="form-control" placeholder="Stok">
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

