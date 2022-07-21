<?php
// memanggil library FPDF
require('./assets/fpdf184/fpdf.php');
// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('l','mm','A5');
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial','B',16);
// mencetak string 
$pdf->Cell(190,7,'DATA BARANG',0,1,'C');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(190,7,'(Kategori : '.ucwords($jenis).')',0,1,'C');

// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,7,'',0,1);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(7,6,'No.',1,0);
$pdf->Cell(12,6,'Jenis',1,0);
$pdf->Cell(54,6,'Nama Barang',1,0);
$pdf->Cell(9,6,'Stok',1,0);
$pdf->Cell(21,6,'Harga Beli',1,0);
$pdf->Cell(20,6,'Harga Jual',1,0);
$pdf->Cell(33,6,'Total Harga Beli',1,0);
$pdf->Cell(33,6,'Total Harga Jual',1,1);

$pdf->SetFont('Arial','',8);

if($jenis == 'all') 
{
    $d = mysqli_query($con, "SELECT *, stok*hrg_beli as tot_hrg_beli, stok*hrg_jual as tot_hrg_jual
    FROM tb_barang b ORDER BY b.jns_brg DESC");
}
else
{ 
    $d = mysqli_query($con, "SELECT *, stok*hrg_beli as tot_hrg_beli, stok*hrg_jual as tot_hrg_jual
    FROM tb_barang b				
    WHERE b.jns_brg = '$jenis' ORDER BY b.jns_brg DESC");
}
$no = 1;
while ($row = mysqli_fetch_array($d)){    

    $pdf->Cell(7,6,$no++,1,0);
    $pdf->Cell(12,6,ucwords($row[1]),1,0);
    $pdf->Cell(54,6,ucwords($row[3]).' ('.ucwords($row[2]).')',1,0);
    $pdf->Cell(9,6,$row[4],1,0);
    $pdf->Cell(21,6,number_format($row[5]),1,0);
    $pdf->Cell(20,6,number_format($row[6]),1,0);
    $pdf->Cell(33,6,number_format($row[8]),1,0);
    $pdf->Cell(33,6,number_format($row[9]),1,1);    
}
$pdf->Cell(7,6,'',0,0);
$pdf->Cell(12,6,'',0,0);
$pdf->Cell(54,6,'',0,0);
$pdf->Cell(9,6,'',0,0);
$pdf->Cell(21,6,'',0,0);
$pdf->Cell(20,6,'TOTAL',1,0);
$pdf->Cell(33,6,number_format($qry2[0]),1,0);
$pdf->Cell(33,6,number_format($qry2[1]),1,1);

// $pdf->Output();
$pdf->Output('I','DATA BARANG KATEGORI '.strtoupper($jenis).'.pdf');
?>