<?php 
    include "config.php";
    include "header.php";

    $query = "SELECT max(no_faktur) as maxKode FROM tblpenjualan";
    $hasil = mysqli_query($connect, $query);
    $data  = mysqli_fetch_array($hasil);
    $faktur = $data['maxKode'];

    $total    = mysqli_query($connect, "select sum(subtotal) as total from tbldetailpenjualan where no_faktur='$faktur'");

    $sum = mysqli_fetch_array($total);
    //echo $sum['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Transaksi Keluar</title>
</head>
<body>
    <h3><span class="glyphicon glyphicon-import"></span> &nbsp Transaksi Keluar</h3>
    <a class="btn" href="transaksi_keluar.php"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
    <br/>
    <?php
        $user=$_SESSION['user'];
        //echo $user;

        $petugas = mysqli_query($connect, "select * from tblpetugas where nama_petugas='$user'");

        while ($data_petugas = mysqli_fetch_array($petugas)) {
    ?>

    <form action="transaksi_keluar_detail_action.php" method="post">
        <table class="table">
            <tr>
                <th>No. Faktur</th>
                <th><input name="no_faktur" type="text" readonly="" class="form-control" placeholder="No. Faktur" value="<?php echo $faktur; ?>"></th>
            </tr>
            <tr>
                <td class="col-md-2">Nama Barang</td>
                <td><select onchange="cek_database()" class="form-control" name="kode_barang" id="kode_barang">
                    <?php
                        $tblbarang = mysqli_query($connect, "select * from tblbarang");
                        echo '<option selected>-Pilih Disini-</option>';	
                        while ($tabel = mysqli_fetch_array($tblbarang))
                        {   
                            echo '<option value="'.$tabel['kode_barang'].'">'.$tabel['nama_barang'].'</option>';	
                        }
                    ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Harga</td>
                <td><input type="text" class="form-control" name="harga" id="harga" value="0" onchange="total()"></td>
            </tr>
            <tr>
                <td><br><br><br>Jumlah</td>
                <td><br><br><br><input type="text" class="form-control" name="jumlah" id="jumlah" size="7" value="0" onchange="total()"></td>
            </tr>
            <tr>
                <td>Sub Total</td>
                <td><input type="text" class="form-control" name="sub_total" id="sub_total" size="7" value="0" readonly></td>
            </tr>
            <tr>
                <th><br><br> TOTAL </th>
                <td><br><br><span class="form-control" name="total"><?php echo "Rp ".number_format($sum['total'])?></span></td>
            </tr>
            <tr>
                <td></td>
                <td align="right" >
                    <button type="reset" class="btn btn-default">Batal</button>
                    <button type="submit" name="selanjutnya" class="btn btn-info">OK</button>
                    <a data-toggle="modal" data-target="#myModal" name="selesai" type="submit" class="btn btn-success">SELESAI</a>
                </td>
            </tr>
        </table>
    </form>

    <!-- MODAL -->
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Pembayaran</h4>
                </div>
                <div class="modal-body">
                    <form action="transaksi_keluar_selesai.php" method="post">
                        <div class="form-group">
                            <label>No. Faktur</label>
                            <input name="no_faktur" type="text" readonly="" class="form-control"  value="<?php echo $faktur; ?>">
                        </div>
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input name="tanggal" type="text" class="form-control" value="<?php echo date('d F Y') ?>" readonly >
                        </div>
                        <div class="form-group">
                            <label>Total Belanja</label>
                            <input name="total_belanja" id="total_belanja" type="text" class="form-control"  onchange="total()" value="<?php echo $sum['total']?>">
                        </div>
                        <div class="form-group">
                            <label>Bayar</label>
                            <input type="text" class="form-control" name="bayar" id="bayar" size="7" value="0" onchange="total()">
                        </div>
                        <div class="form-group">
                            <label>Kembalian</label>
                            <input type="text" class="form-control" name="kembalian" id="kembalian" size="7" value="0" onchange="total()" readonly>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <input type="submit" class="btn btn-danger" value="Simpan">
                </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript">
        function cek_database(){
            var kode_barang = $("#kode_barang").val();
            $.ajax({
                url : 'transaksi_masuk_cek.php',
                data:"kode_barang="+kode_barang ,
            }).success(function (data) {
                var json = data,
                obj = JSON.parse(json);
                $('#harga').val(obj.harga_net);
                $('#stok_awal').val(obj.stok);
            });
        }

        function total() {
            var jumlah = parseInt(document.getElementById('jumlah').value);
            var harga = parseInt(document.getElementById('harga').value);

            var total = parseInt(document.getElementById('total_belanja').value);
            var bayar = parseInt(document.getElementById('bayar').value);

            var sub_total = harga * jumlah;
            var kembalian = bayar - total;

            document.getElementById('kembalian').value = kembalian;   
            document.getElementById('sub_total').value = sub_total;
        }

        // function bayar() {
        //     var total = parseInt(document.getElementById('total_belanja').value);
        //     var bayar = parseInt(document.getElementById('bayar').value);

                     
        // }
    </script>

        <?php
        }
        ?>

</body>

