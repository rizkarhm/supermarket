<?php 
    include 'config.php';
    $id_petugas=$_POST['id_petugas'];
    $nama_petugas=$_POST['nama_petugas'];
    $alamat=$_POST['alamat'];
    $email=$_POST['email'];
    $telepon=$_POST['telepon'];
    $password=$_POST['password'];
    

    mysqli_query($connect, "insert into tblpetugas values('$id_petugas','$nama_petugas', '$alamat', '$email', '$telepon', MD5('$password'))");
    header("location:petugas_data.php");
?>