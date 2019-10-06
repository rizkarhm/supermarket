<?php
include "admin/config.php";
$pegawai = mysqli_fetch_array(mysqli_query($connect, "select * from pegawai where nip='$_GET[nip]'"));
$data_pegawai = array('nama_pegawai'   	=>  $pegawai['nama_pegawai'],
              		'jenis_kelamin'  	=>  $pegawai['jenis_kelamin'],
              		'alamat'    		=>  $pegawai['alamat'],);
 echo json_encode($data_pegawai);
 ?>