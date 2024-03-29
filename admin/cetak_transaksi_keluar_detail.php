<?php
include 'config.php';
require('../assets/pdf/fpdf.php');

$pdf = new FPDF("L","cm","A4");

$pdf->SetMargins(2,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);
$pdf->Cell(25.5,0.7,"NOTA",0,10,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5, 0.7,"Di cetak pada : ".date("D-d/m/Y"),0,0,'C');
$pdf->ln(1);
$pdf->Cell(5, 0.7,"No. Faktur : "."TRX001",0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(1, 0.8, 'No', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Kode Barang', 1, 0, 'C');
$pdf->Cell(7, 0.8, 'Nama Barang', 1, 0, 'C');
$pdf->Cell(4.5, 0.8, 'Jumlah', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Harga Satuan', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Sub Total', 1, 1, 'C');
$pdf->SetFont('Arial','',10);
$no=1;

$no_faktur = $_GET['no_faktur'];
$query = mysqli_query($connect, "select B.kode_barang, B.nama_barang, B.harga_net, K.no_faktur, K.kode_barang, K.jumlah, K.subtotal from tblbarang B inner join tbldetailpenjualan K on B.kode_barang=K.kode_barang where K.no_faktur='$no_faktur'");

while($lihat=mysqli_fetch_array($query)){
	$pdf->Cell(1, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(3, 0.8, $lihat['kode_barang'], 1, 0, 'C');
	$pdf->Cell(7, 0.8, $lihat['nama_barang'], 1, 0,'C');
	$pdf->Cell(4.5, 0.8, $lihat['jumlah'], 1, 0,'C');
	$pdf->Cell(4, 0.8, $lihat['harga_net'],1, 0, 'C');
	$pdf->Cell(2, 0.8, $lihat['subtotal'], 1, 1,'C');
	$no++;
}

$pdf->Output("Nota Penjualan.pdf","I");
