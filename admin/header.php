<!DOCTYPE html>
<html>

<head>
    <?php
        session_start();
        include 'cek.php';
        include 'config.php';
    ?>
    <title>SUPERMARKET</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../assets/js/jquery-ui/jquery-ui.css">
    <script type="text/javascript" src="../assets/js/jquery.js"></script>
    <script type="text/javascript" src="../assets/js/jquery.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="../assets/js/jquery-ui/jquery-ui.js"></script>
</head>

<body>
    <div class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="home.php" class="navbar-brand">SUPERMARKET</a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <!-- nama petugas -->
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- <li><a id="pesan_sedia" href="#" data-toggle="modal" data-target="#modalpesan"><span
                                class='glyphicon glyphicon-comment'></span> Pesan</a></li> -->
                    <li><a class="dropdown-toggle" data-toggle="dropdown" role="button" href="#">Hi, <?php echo $_SESSION['user']  ?>&nbsp&nbsp<span class="glyphicon glyphicon-user"></span></a></li>
                </ul>
            </div>

        </div>
    </div>

    <!-- modal input -->
    <!-- <div id="modalpesan" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Pesan Notification</h4>
                </div>
                <div class="modal-body">
                    <?php
                    // include 'config.php';
                    // $periksa = mysqli_query($koneksi, "select * from barang where jumlah <=3");
                    // while ($q = mysqli_fetch_array($periksa)) {
                    //     if ($q['jumlah'] <= 3) {
                    //         echo "<div style='padding:5px' class='alert alert-warning'><span class='glyphicon glyphicon-info-sign'></span> Stok  <a style='color:red'>" . $q['nama'] . "</a> yang tersisa sudah kurang dari 3 . silahkan pesan lagi !!</div>";
                    //     }
                    // }
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                </div>

            </div>
        </div>
    </div> -->

    <div class="col-md-2">
        <div class="row"></div>
        <ul class="nav nav-pills nav-stacked">
            <li class="active"><a href="home.php"><span class="glyphicon glyphicon-home"></span> &nbsp Home</a></li>
            <li><a href="jenis_data.php"><span class="glyphicon glyphicon-tags"></span>  &nbsp Jenis Barang</a></li>
            <li><a href="barang_data.php"><span class="glyphicon glyphicon-list-alt"></span>  &nbsp Data Barang</a></li>
            <li><a href="distributor_data.php"><span class="glyphicon glyphicon-user"></span>  &nbsp Data Distributor</a></li>
            <li><a href="petugas_data.php"><span class="glyphicon glyphicon-wrench"></span>  &nbsp Data Petugas</a></li>
            <li><a href="transaksi_masuk.php"><span class="glyphicon glyphicon-import"></span>  &nbsp Transaksi Masuk</a></li>
            <li><a href="transaksi_keluar.php"><span class="glyphicon glyphicon-export"></span>  &nbsp Transaksi Keluar</a></li>
            <li><a onclick="if(confirm('Apakah anda yakin akan keluar?')){location.href='logout.php'}"><span class="glyphicon glyphicon-log-out"></span>  &nbsp Logout</a></li>
        </ul>
    </div>
    <div class="col-md-10">