<?php 
    include "config.php";
    include "header.php";

    $query = "SELECT max(no_nota) as maxNota FROM tblbrgmasuk";
    $hasil = mysqli_query($connect, $query);
    $data  = mysqli_fetch_array($hasil);
    $no_nota = $data['maxNota'];

    $total    = mysqli_query($connect, "select sum(subtotal) as total from tbldetailbrgmasuk where no_nota='$no_nota'");
    $sum = mysqli_fetch_array($total);
    //echo $sum['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Transaksi Masuk</title>
</head>
<body>
    <h3><span class="glyphicon glyphicon-import"></span> &nbsp Transaksi Masuk</h3>
    <a class="btn" href="transaksi_masuk.php"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
    <br/>
    <?php
        $user=$_SESSION['user'];
        //echo $user;

        $petugas = mysqli_query($connect, "select * from tblpetugas where nama_petugas='$user'");

        while ($data_petugas = mysqli_fetch_array($petugas)) {
    ?>

<form action="transaksi_masuk_detail_action.php" method="post">
    <table class="table">
        <tr>
            <th>No. Nota</th>
            <th><input name="no_nota" type="text" readonly="" class="form-control" placeholder="Kode Barang" value="<?php echo $no_nota; ?>"></th>
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
            <td>Stok Awal </td>
            <td><input type="text" class="form-control" name="stok_awal" id="stok_awal" size="7" value="0" readonly></td>
        </tr>
        <tr>
            <td><br><br><br> Stok Masuk</td>
            <td><br><br><br><input type="text" class="form-control" name="stok_masuk" id="stok_masuk" size="7" value="0" onchange="total()"></td>
        </tr>
        <tr>
            <td>Stok Akhir</td>
            <td><input type="text" class="form-control" name="stok_akhir" id="stok_akhir" size="7" value="0" readonly></td>
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
                <a href="transaksi_masuk_selesai.php" name="selesai" type="submit" class="btn btn-success">SELESAI</a>
            </td>
        </tr>
    </table>
</form>

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
        var stok_awal = parseInt(document.getElementById('stok_awal').value);
        var stok_masuk = parseInt(document.getElementById('stok_masuk').value);
        var harga = parseInt(document.getElementById('harga').value);

        var stok_akhir = stok_awal + stok_masuk;
        var sub_total = harga * stok_masuk;

        document.getElementById('stok_akhir').value = stok_akhir;
        document.getElementById('sub_total').value = sub_total;
    }
</script>

    <?php
    }
    ?>

</body>

