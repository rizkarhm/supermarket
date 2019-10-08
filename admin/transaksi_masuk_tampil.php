<?php
    include 'header.php';
    include 'config.php';
    $no_nota = mysqli_real_escape_string($connect, $_GET['no_nota']);
?>

<h3><span class="glyphicon glyphicon-import"></span> Detail Transaksi Masuk</h3>
<a class="btn" href="transaksi_masuk.php"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>

<a style="margin-bottom:10px" href="cetak_transaksi_masuk_detail.php?no_nota=<?php echo $no_nota; ?>" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span> Cetak</a>

<table class="table table-hover">
    <tr>
        <th class="col-md-2"><center>Kode Barang</th>
        <th class="col-md-2"><center>Nama Barang</th>
        <th class="col-md-2"><center>Stok Masuk</th>
        <th class="col-md-2"><center>Harga Satuan</th>
        <th class="col-md-2"><center>Sub Total</th>
        <th class="col-md-2"><center>Stok Akhir</th>
        <th class="col-md-2"><center>Opsi</center></th>
    </tr>
    <?php
        
        
        $barang = mysqli_query($connect, "select B.kode_barang, B.nama_barang, B.harga_net, B.stok, M.no_nota, M.kode_barang, M.jumlah, M.subtotal from tblbarang B inner join tbldetailbrgmasuk M on B.kode_barang=M.kode_barang where M.no_nota='$no_nota'");

        while ($d = mysqli_fetch_array($barang)) {
    ?>
    <tr>
        <td><center><?php echo $d['kode_barang']?></td>
        <td><center><?php echo $d['nama_barang'] ?></td>
        <td><center><?php echo $d['jumlah'] ?></td>                        
        <td><center>Rp.<?php echo number_format($d['harga_net']) ?>,-</td>
        <td><center>Rp.<?php echo number_format($d['subtotal']) ?>,-</td>         
        <td><center><?php echo $d['stok'] ?></td>   
        <td><center>
            <a onclick="if(confirm('Apakah anda yakin ingin menghapus barang <?php echo $d['nama_barang']; ?>??')){ location.href='transaksi_masuk_delete.php?kode_barang=<?php echo $d['kode_barang']; ?>' }" class="btn btn-danger">Hapus</a>
        </td> 
    </tr>
    
    <?php
    }
    ?>
</table>

<table class="table">
    <tr>
        <td  align='right'><b>TOTAL :</td>
        <td  align='left'>
        <?php 
            $total = mysqli_query($connect, "select sum(subtotal) as total from tbldetailbrgmasuk where no_nota='$no_nota'");
            $sum = mysqli_fetch_array($total);
            echo "Rp ".number_format($sum['total']);
        ?>,-
        </td>
    </tr>
    <tr>
    <td></td><td></td></tr>
</table>
