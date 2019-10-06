<!DOCTYPE html>
<html>
<head>
	<title></title>
	</head>
<body>
	<form id="formD" name="formD" action="" method="post" enctype="multipart/form-data">
	<div >
		<table border="0">
			<tr>
				<th>Harga</th>
				<th><input type="text" name="jumlah_algoritma" id="harga_algoritma" size="7" value="0" onchange="total()"></th>
			</tr>
			<tr>
				<th>Jumlah</th>
				<th><input type="text" name="jumlah_javascript" id="harga_javascript" size="7" value="0" onchange="total()"></th>
			</tr>
			<tr>
				<th  style="text-align:right">jumlah total</th>
				<th><input type="text" name="total_jumlah" id="total_all" size="7" value="" readonly></th>
			</tr>
		</table>
		<br><br>
		<script type="text/javascript">
		function total() {
		var harga = parseInt(document.getElementById('harga_algoritma').value);
		var jumlah = parseInt(document.getElementById('harga_javascript').value);
		var jumlah_harga = harga*jumlah;
		document.getElementById('total_all').value = jumlah_harga;
		}
		</script>
	</div>
</form>
</body>
</html>