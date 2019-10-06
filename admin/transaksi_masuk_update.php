<?php 
    include 'config.php';
    $total=$_POST['total'];
    $no_nota=$_POST['no_nota'];
    $stok=$_POST['jumlah'];

    $kode_barang = $_POST['kode_barang'];
    $stok_awal = mysqli_query($connect, "select stok from tblbarang where kode_barang='$kode_barang'");

    $stok_akhir = $stok_awal+$stok;
    echo $stok_akhir;

    $action = "update tblbarang set stok='$stok_akhir' where kode_barang='$kode_barang'";
    $action .= "update tblbrgmasuk set total='$total' where no_nota='$no_nota'";

    // mysqli_query($connect, "update tblbarang set stok='$stok_akhir' where kode_barang='$kode_barang'");
    // mysqli_query($connect, "update tblbrgmasuk set total='$total' where no_nota='$no_nota'");
    //header("location:transaksi_masuk.php");

    // Execute multi query
    if (mysqli_multi_query($connect,$action))
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
?>