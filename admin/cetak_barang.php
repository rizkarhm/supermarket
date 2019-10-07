<?php
include 'config.php';
require('../assets/pdf/fpdf.php');

$pdf = new FPDF("L","cm","A4");

$pdf->SetMargins(2,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',11);   
$pdf->MultiCell(19.5,0.5,'SUPERMARKET',0,'L');
$pdf->MultiCell(19.5,0.5,'Telpon : (0341) 567236',0,'L');    
$pdf->SetFont('Arial','B',10);
$pdf->MultiCell(19.5,0.5,'JL. Piranha Atas',0,'L');
$pdf->MultiCell(19.5,0.5,'website : www.suermarket.com email : supermarket@gmail.com',0,'L');
$pdf->Line(1,3.1,28.5,3.1);
$pdf->SetLineWidth(0.1);      
$pdf->Line(1,3.2,28.5,3.2);   
$pdf->SetLineWidth(0);
$pdf->ln(1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(25.5,0.7,"Laporan Data Barang",0,10,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"Di cetak pada : ".date("D-d/m/Y"),0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(1, 0.8, 'No', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Kode Barang', 1, 0, 'C');
$pdf->Cell(7, 0.8, 'Nama Barang', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Jenis', 1, 0, 'C');
$pdf->Cell(4.5, 0.8, 'Harga Net', 1, 0, 'C');
$pdf->Cell(4.5, 0.8, 'Harga Jual', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Jumlah', 1, 1, 'C');
$pdf->SetFont('Arial','',10);
$no=1;
$query = mysqli_query($connect, "select B.kode_barang, B.nama_barang, B.kode_jenis, J.jenis, B.harga_net, B.harga_jual, B.stok from tblbarang B inner join tbljenis J on B.kode_jenis=J.kode_jenis");
while($lihat=mysqli_fetch_array($query)){
	$pdf->Cell(1, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(3, 0.8, $lihat['kode_barang'],1, 0, 'C');
	$pdf->Cell(7, 0.8, $lihat['nama_barang'], 1, 0,'C');
	$pdf->Cell(3, 0.8, $lihat['jenis'],1, 0, 'C');
	$pdf->Cell(4.5, 0.8, $lihat['harga_net'], 1, 0,'C');
	$pdf->Cell(4.5, 0.8, $lihat['harga_jual'],1, 0, 'C');
	$pdf->Cell(2, 0.8, $lihat['stok'], 1, 1,'C');

	$no++;
}

$pdf->Output("Laporan Data Barang.pdf","I");
