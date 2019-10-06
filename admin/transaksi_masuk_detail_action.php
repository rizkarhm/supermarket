<?php
    include 'config.php';
    include 'header.php';

    $no_nota        = $_POST['no_nota'];
    $kode_barang    = $_POST['kode_barang'];
    $jumlah         = $_POST['stok_masuk'];
    $subtotal       = $_POST['sub_total'];

    $query    = mysqli_query($connect, "select sum(subtotal) as total from tbldetailbrgmasuk where no_nota='$no_nota'");
    $sum = mysqli_fetch_array($query);
    $total = $sum['total'];
    
    //mysqli_query($connect, "insert into tbldetailbrgmasuk values('$no_nota','$kode_barang', '$jumlah', '$subtotal')");

    $action = "INSERT into tbldetailbrgmasuk values('$no_nota','$kode_barang', '$jumlah', '$subtotal');";
    $action .= "UPDATE tblbrgmasuk set total = '$total' where no_nota = '$no_nota';";
    

    if (mysqli_multi_query($connect, $action))
    {
    do
        {
        // Store first result set
        if ($result=mysqli_store_result($connect)) {
        // Fetch one and one row
        while ($row=mysqli_fetch_row($result))
            {
            printf("%s\n",$row[0]);
            }
        // Free result set
        mysqli_free_result($result);
        }
        }
    while (mysqli_next_result($connect));
    }

    //echo $action;
    header("location:transaksi_masuk_detail.php");
?>