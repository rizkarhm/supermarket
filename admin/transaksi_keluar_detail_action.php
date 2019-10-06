<?php
    include 'config.php';
    include 'header.php';

    $no_faktur      = $_POST['no_faktur'];
    $kode_barang    = $_POST['kode_barang'];
    $jumlah         = $_POST['jumlah'];
    $subtotal       = $_POST['sub_total'];

    $query    = mysqli_query($connect, "select sum(subtotal) as total from tblpenjualan where no_faktur='$no_faktur'");
    $sum = mysqli_fetch_array($query);
    $total = $sum['total'];
    
    //mysqli_query($connect, "insert into tbldetailbrgmasuk values('$no_nota','$kode_barang', '$jumlah', '$subtotal')");

    $action = "INSERT into tbldetailpenjualan values('$no_faktur','$kode_barang', '$jumlah', '$subtotal');";
    $action .= "UPDATE tblpenjualan set total = '$total' where no_faktur = '$no_faktur';";
    

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
    header("location:transaksi_keluar_detail.php");
?>