<!DOCTYPE html>
<html>
<head>
    <title>PHPMU.Com - Isi form otomatis PHP, MySQL, Ajax</title>
</head>
<body>
<form action="">
    <table>
        <tr><td>kode barang</td><td> <select onchange="cek_database()" id="kode_barang">
	<option value='' selected>- Pilih -</option>
	<?php
		include "admin/config.php";
        $data_barang = mysqli_query($connect,"SELECT * FROM tblbarang");
		while ($row = mysqli_fetch_array($data_barang)) {
			echo "<option value='$row[kode_barang]'>$row[nama_barang]</option>";
		}
	?>
	</select></td></tr>
        <tr><td>Harga</td><td> <input type="text" id="harga"></td></tr>
        <tr><td>Stok</td><td><input type="text" name="stok" value="0"/></td></tr>
    </table>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
    function cek_database(){
        var kode_barang = $("#kode_barang").val();
        $.ajax({
            url: 'cek_hitung.php',
            data:"kode_barang="+kode_barang ,
        }).success(function (data) {
            var json = data,
            obj = JSON.parse(json);
            $('#kode_barang').val(obj.kode_barang);
            $('#stok').val(obj.stok);
        });
    }
</script>
</body>
</html>