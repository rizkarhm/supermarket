<?php 
    include "config.php";

    $no_nota         = $_POST['no_nota'];
    $tgl_masuk       = $_POST['tanggal'];
    $id_distributor  = $_POST['id_distributor'];
    $id_petugas      = $_POST['id_petugas'];

    mysqli_query($connect, "insert into tblbrgmasuk values('$no_nota','$tgl_masuk', '$id_distributor', '$id_petugas', '')");
    header("location:transaksi_masuk_detail.php");

 
?>