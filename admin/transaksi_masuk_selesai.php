<?php
    include 'config.php';
    include 'header.php';

    $query = "SELECT max(no_nota) as maxNota FROM tblbrgmasuk";
    $hasil = mysqli_query($connect, $query);
    $data  = mysqli_fetch_array($hasil);
    $no_nota = $data['maxNota'];

    $query    = mysqli_query($connect, "select sum(subtotal) as total from tbldetailbrgmasuk where no_nota='$no_nota'");
    $sum = mysqli_fetch_array($query);
    $total = $sum['total'];
    
    mysqli_query($connect, "UPDATE tblbrgmasuk set total = '$total' where no_nota = '$no_nota';");
    header("location:transaksi_masuk.php");
?>