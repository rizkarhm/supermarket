<?php 
    include 'config.php';
    $id_petugas=$_GET['id_petugas'];
    
    mysqli_query($connect, "delete from tblpetugas where id_petugas='$id_petugas'");
    header("location:petugas_data.php");
?>