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
$pdf->Cell(25.5,0.7,"Laporan Transaksi Keluar",0,10,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"Di cetak pada : ".date("D-d/m/Y"),0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(1, 0.8, 'No', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'No. Faktur', 1, 0, 'C');
$pdf->Cell(7, 0.8, 'Tanggal Penjualan', 1, 0, 'C');
$pdf->Cell(4.5, 0.8, 'ID Petugas', 1, 0, 'C');
$pdf->Cell(4.5, 0.8, 'Total', 1, 1, 'C');
$pdf->SetFont('Arial','',10);
$no=1;
$query = mysqli_query($connect, "select * from tblpenjualan");
while($lihat=mysqli_fetch_array($query)){
	$pdf->Cell(1, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(3, 0.8, $lihat['no_faktur'],1, 0, 'C');
	$pdf->Cell(7, 0.8, $lihat['tgl_penjualan'], 1, 0,'C');
	$pdf->Cell(4.5, 0.8, $lihat['id_petugas'], 1, 0,'C');
    $pdf->Cell(4.5, 0.8, $lihat['total'],1, 1, 'C');
	$no++;
}

$pdf->Output("Laporan Transaksi Masuk.pdf","I");
