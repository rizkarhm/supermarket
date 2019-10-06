<?php 
    include "config.php";

    $no_faktur       = $_POST['no_faktur'];
    $tgl_penjualan   = date("Y-m-d");
    $id_petugas      = $_POST['id_petugas'];

    mysqli_query($connect, "insert into tblpenjualan values('$no_faktur','$tgl_penjualan', '$id_petugas', '', '', '')");

    //echo "insert into tblpenjualan values('$no_faktur','$tgl_penjualan', '$id_petugas', '', '', '')";
    header("location:transaksi_keluar_detail.php");

 
?>