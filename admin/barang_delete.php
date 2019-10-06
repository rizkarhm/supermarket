<?php 
    include 'config.php';
    $kode_barang=$_GET['kode_barang'];
    
    mysqli_query($connect, "delete from tblbarang where kode_barang='$kode_barang'");
    header("location:barang_data.php");
?>