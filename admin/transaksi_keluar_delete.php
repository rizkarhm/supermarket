<?php 
    include 'config.php';
    $no_faktur        = $_GET['no_faktur'];
    $kode_barang      = $_GET['kode_barang'];
    
    $delete = mysqli_query($connect, "DELETE from tblpenjualan where no_faktur='$no_faktur';") ;

    $delete .= mysqli_query($connect, "DELETE from tbldetailpenjualan where kode_barang='$kode_barang';") ;

    if (mysqli_multi_query($connect, $delete))
    {
    do
        {
        // Store first result set
        if ($result=mysqli_store_result($delete)) {
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
    
    //echo $delete;
    header("location:transaksi_keluar.php");
?>