<?php
    include "config.php";
    include "header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Transaksi Masuk</title>   
</head>
<body>
    <h3><span class="glyphicon glyphicon-import"></span> &nbsp Transaksi Masuk</h3>
    <button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span> Tambah Transaksi</button>
    <br/>
    <br/>
    <br/>

    <?php
        $user=$_SESSION['user'];
        //echo $user;

        //HALAMAN
        $per_hal = 10;
        $jumlah_record = mysqli_query($connect, "SELECT COUNT(*) from tblbrgmasuk");
        $jum = mysqli_fetch_array($jumlah_record, MYSQLI_NUM);
        $halaman = ceil($jum[0] / $per_hal);
        $page = (isset($_GET['page'])) ? (int) $_GET['page'] : 1;
        $start = ($page - 1) * $per_hal;

        $petugas = mysqli_query($connect, "select * from tblpetugas where nama_petugas='$user'");

        //ID
        $query = "SELECT max(no_nota) as maxKode FROM tblbrgmasuk";
        $hasil = mysqli_query($connect, $query);
        $data  = mysqli_fetch_array($hasil);
        $nota = $data['maxKode'];

        $no_nota = (int) substr($nota, 4, 3);
        $no_nota++;

        $char = "NOTA";
        $newNo = $char . sprintf("%03s", $no_nota);

        while ($data_petugas = mysqli_fetch_array($petugas)) {
    ?>

    
    <h3><span class="glyphicon glyphicon-list-alt"></span> &nbsp Data Transaksi</h3>    
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

    <a style="margin-bottom:10px" href="cetak_transaksi_masuk.php" target="_blank" class="btn btn-default pull-right"><span
    class='glyphicon glyphicon-print'></span> Cetak</a>
    <form action="transaksi_masuk_search.php" method="get">
        <div class="input-group col-md-5 col-md-offset-7">
            <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span></span>
            <input type="text" class="form-control" placeholder="Cari" aria-describedby="basic-addon1"
                name="cari">
        </div>
    </form>
    <!-- <form action="" method="get">
        <div class="input-group col-md-5 col-md-offset-7">
            <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-calendar"></span></span>
            <select type="submit" name="tanggal" class="form-control" onchange="this.form.submit()">
                <option>Pilih Tanggal</option>
                <?php
                $pil = mysqli_query($koneksi, "select tgl_masuk from tblbrgmasuk order by tgl_masuk desc");
                while ($p = mysqli_fetch_array($pil)) {
                    ?>
                    <option><?php echo $p['tgl_masuk'] ?></option>
                <?php
                }
                ?>
            </select>
        </div>
    </form> -->
    <br />

    <table class="table table-hover">
        <tr>
            <th class="col-md-1"><center>No. Nota</th>
            <th class="col-md-2"><center>Tanggal Masuk</th>
            <th class="col-md-2"><center>ID Distributor</th>
            <th class="col-md-2"><center>ID Petugas</th>
            <th class="col-md-2"><center>Total</th>
            <th class="col-md-4"><center>Opsi</th>
        </tr>
        <?php
            if (isset($_GET['cari'])) {
                $cari = mysqli_real_escape_string($connect, $_GET['cari']);
                $barang = mysqli_query($connect, "select * from tblbrgmasuk where `no_nota` like '%$cari%' || `tgl_masuk` like '%$cari%' ||`id_distributor` like '%$cari%' || `id_petugas` like '%$cari%' || `total` like '%$cari%'");
            } 
            else {
                $barang = mysqli_query($connect, "select * from tblbrgmasuk limit $start, $per_hal");
            }

            while ($data_barang = mysqli_fetch_array($barang)) {
        ?>
        <tr>
            <td><center><?php echo $data_barang['no_nota']?></td>
            <td><center><?php echo $data_barang['tgl_masuk'] ?></td>
            <td><center><?php echo $data_barang['id_distributor'] ?></td>            
            <td><center><?php echo $data_barang['id_petugas'] ?></td>                        
            <td><center>Rp.<?php echo number_format($data_barang['total']) ?>,-</td>
            <td><center>
                <a href="transaksi_masuk_tampil.php?no_nota=<?php echo $data_barang['no_nota']; ?>" class="btn btn-info">Detail</a>
                <a onclick="if(confirm('Apakah anda yakin ingin menghapus data <?php echo $data_barang['no_nota']; ?>??')){ location.href='transaksi_masuk_delete.php?no_nota=<?php echo $data_barang['no_nota']; ?>' }" class="btn btn-danger">Hapus</a>
                
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

    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Tambah Transaksi</h4>
                </div>
                <div class="modal-body">               
                    <form action="transaksi_masuk_insert.php" method="post">
                        <table class="table">
                            <tr>
                                <td>No. Nota</td>
                                <td><input type="text" readonly="" class="form-control" name="no_nota" value="<?php echo $newNo; ?>"></td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td><input type="date" class="form-control" name="tanggal" value="<?php //echo date('d F Y');?>">
                            </tr>
                            <tr>
                                <td>Nama Distributor</td>
                                <td><select name="id_distributor" class="form-control">
                                    <?php
                                        $query = "select * from tbldistributor";
                                        $hasil = mysqli_query($connect, $query);
                                        echo '<option>-Pilih-</option>';	
                                        while ($qtabel = mysqli_fetch_array($hasil))
                                        {
                                            echo '<option value="'.$qtabel['id_distributor'].'">'.$qtabel['nama_distributor'].'</option>';	
                                        }
                                    ?>
                                </select></td>
                            </tr>
                            <tr>
                                <td>ID Petugas</td>
                                <td><input type="text" class="form-control" name="id_petugas" readonly="" value="<?php echo $data_petugas['id_petugas'] ?>" ></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td align="right" ><button type="reset" class="btn btn-default">Batal</button> &nbsp
                                <button type="submit" name="selanjutnya" class="btn btn-info"><i class="glyphicon glyphicon-arrow-right"></i></button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>

  
    <?php
    }

    
    ?>

</body>
