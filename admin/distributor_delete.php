<?php 
    include 'config.php';
    $id_distributor=$_GET['id_distributor'];
    
    mysqli_query($connect, "delete from tbldistributor where id_distributor='$id_distributor'");
    header("location:distributor_data.php");
?>