<?php
	include "admin/config.php";
	session_start();
	$username = $_POST['user'];
	$password = $_POST['pass'];
	$pass = md5($password);

	$query = mysqli_query($connect, "select * from tblpetugas where nama_petugas='$username' and password='$pass'") or die(mysqli_connect_error());

	if (mysqli_num_rows($query) == 1) {
		$_SESSION['user'] = $username;
		header("location:admin/home.php");
	} 
	elseif ($query == null) {
		header("location:index.php?pesan=login-gagal") or die(mysqli_connect_error());		
	}
	else {
		header("location:index.php?pesan=password/username-salah") or die(mysqli_connect_error());
	}
?>