<?php
    include 'config.php';
    include 'header.php';

    $query = "SELECT max(no_faktur) as maxKode FROM tblpenjualan";
    $hasil = mysqli_query($connect, $query);
    $data  = mysqli_fetch_array($hasil);
    $faktur = $data['maxKode'];

    $bayar = $_POST['bayar'];
    $sisa  = $_POST['kembalian'];

    $total    = mysqli_query($connect, "select sum(subtotal) as total from tbldetailpenjualan where no_faktur='$faktur'");
    $sum = mysqli_fetch_array($total);
    $total = $sum['total'];
    
    mysqli_query($connect, "UPDATE tblpenjualan set total = '$total', bayar = '$bayar', sisa = '$sisa' where no_faktur = '$faktur';");

    header("location:transaksi_keluar.php");
?>