<?php
include "config.php";
$barang = mysqli_fetch_array(mysqli_query($connect, "SELECT * from tblbarang where kode_barang='$_GET[kode_barang]'"));
$data_barang = array('harga_net'   	=>  $barang['harga_net'],
                     'stok'			=>  $barang['stok']);
echo json_encode($data_barang);
 ?>