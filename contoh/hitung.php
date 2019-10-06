<?php
    include "admin/config.php";
?>
<!DOCTYPE html>
<html>
<body>
	<form>
		<table>
			<tr>
				<td class="col-md-2">Kode Barang</td>
				<td><select onchange="cek_database()" class="form-control" name="kode_barang" id="kode_barang">
					<?php
						$tblbarang = mysqli_query($connect, "select * from tblbarang");
						echo '<option selected>-Pilih Disini-</option>';	
						while ($tabel = mysqli_fetch_array($tblbarang))
						{   
							echo '<option value="'.$tabel['kode_barang'].'">'.$tabel['nama_barang'].'</option>';	
						}
					?>
				</select></td>
			</tr>
			<tr>
				<th>Harga</th>
				<th><input type="text" class="form-control" name="harga" id="harga" onchange="total()"></th>
			</tr>
			<tr>
				<th>Stok Awal </th>
				<th><input type="text" class="form-control" name="stok_awal" id="stok_awal" size="7" value="0" onchange="total()"></th>
			</tr>
			<tr>
				<th><br> Stok Masuk</th>
				<th><br><input type="text" class="form-control" name="stok_masuk" id="stok_masuk" size="7" value="0" onchange="total()"></th>
			</tr>
			<tr>
				<th>Stok Akhir</th>
				<th><input type="text" class="form-control" name="stok_akhir" id="stok_akhir" size="7" value="" readonly></th>
			</tr>
			<tr>
				<th>Sub Total</th>
				<th><input type="text" class="form-control" name="stok_akhir" id="sub_total" size="7" value="0" onchange="total()" readonly></th>
			</tr>
		</table>
	</form>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script type="text/javascript">
		function cek_database(){
			var kode_barang = $("#kode_barang").val();
			$.ajax({
				url : 'cek_hitung.php',
				data:"kode_barang="+kode_barang ,
			}).success(function (data) {
				var json = data,
				obj = JSON.parse(json);
				$('#harga').val(obj.harga_net);
				$('#stok_awal').val(obj.stok);
			});
		}

		function total() {
			var stok_awal = parseInt(document.getElementById('stok_awal').value);
			var stok_masuk = parseInt(document.getElementById('stok_masuk').value);
			var harga = parseInt(document.getElementById('harga').value);

			var stok_akhir = stok_awal + stok_masuk;
			var sub_total = harga * stok_masuk;

			document.getElementById('stok_akhir').value = stok_akhir;
			document.getElementById('sub_total').value = sub_total;
		}
	</script>
</body>
</html>