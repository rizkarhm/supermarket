<?php
// mysqli_connect("localhost","root","");
// mysqli_select_db("supermarket");

$connect = mysqli_connect("localhost", "root", "", "supermarket");

if (mysqli_connect_error()) {
	printf("Gagal terkoneksi : " . mysqli_connect_error());
	exit();
}
