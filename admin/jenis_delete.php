<?php 
    include 'config.php';
    $kode_jenis=$_GET['kode_jenis'];
    
    mysqli_query($connect, "delete from tbljenis where kode_jenis='$kode_jenis'");
    header("location:jenis_data.php");
?>