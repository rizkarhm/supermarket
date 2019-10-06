<?php 
    include 'config.php';
    $kode_barang=$_POST['kode_barang'];
    $nama_barang=$_POST['nama_barang'];
    $kode_jenis=$_POST['kode_jenis'];
    $harga_net=$_POST['harga_net'];
    $harga_jual=$_POST['harga_jual'];
    $stok=$_POST['stok'];
    

    mysqli_query($connect, "insert into tblbarang values('$kode_barang','$nama_barang', '$kode_jenis', '$harga_net', '$harga_jual', '$stok')");
    header("location:barang_data.php");
?>