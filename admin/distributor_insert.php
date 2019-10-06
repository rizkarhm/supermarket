<?php 
    include 'config.php';
    $id_distributor=$_POST['id_distributor'];
    $nama_distributor=$_POST['nama_distributor'];
    $alamat=$_POST['alamat'];
    $kota_asal=$_POST['kota_asal'];
    $email=$_POST['email'];
    $telepon=$_POST['telepon'];    

    mysqli_query($connect, "insert into tbldistributor values('$id_distributor','$nama_distributor', '$alamat','$kota_asal', '$email', '$telepon')");
    header("location:distributor_data.php");
?>