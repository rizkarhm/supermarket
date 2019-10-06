<?php 
    include 'config.php';
    $kode_jenis=$_POST['kode_jenis'];
    $jenis=$_POST['jenis'];

    mysqli_query($connect, "insert into tbljenis values('$kode_jenis','$jenis')");
    header("location:jenis_data.php");
?>