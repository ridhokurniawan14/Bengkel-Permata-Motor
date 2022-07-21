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
$pdf->Cell(190,7,'DATA TRANSAKSI',0,1,'C');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(190,7,'('.$tgldari.'-'.$blndari.'-'.$thndari.' s.d '.$tglke.'-'.$blnke.'-'.$thnke.')',0,1,'C');

// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,7,'',0,1);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,6,'No.',1,0);
$pdf->Cell(27,6,'Tgl. Transaksi',1,0);
$pdf->Cell(17,6,'No. Nota',1,0);
$pdf->Cell(45,6,'Nama Barang',1,0);
$pdf->Cell(21,6,'Harga Jual',1,0);
$pdf->Cell(10,6,'Qty',1,0);
$pdf->Cell(15,6,'Total',1,0);
$pdf->Cell(33,6,'Harga beli @item',1,0);
$pdf->Cell(15,6,'Laba',1,1);

$pdf->SetFont('Arial','',8);

$d = mysqli_query($con, "SELECT *
FROM tb_transaksi t, tb_transaksi_detail td, tb_barang b
WHERE t.tgl_transaksi BETWEEN '$dari' and '$ke'
AND t.no_nota = td.no_nota
AND td.id_barang = b.id_barang
ORDER BY t.no_nota DESC");
$no = 1;
while ($row = mysqli_fetch_array($d)){
    $laba = $row[19] * $row[9];

    $pdf->Cell(10,6,$no++,1,0);
    $pdf->Cell(27,6,$row[1],1,0);
    $pdf->Cell(17,6,$row[0],1,0);
    $pdf->Cell(45,6,ucwords($row[15]),1,0);
    $pdf->Cell(21,6,number_format($row[10]),1,0);
    $pdf->Cell(10,6,$row[9],1,0);
    $pdf->Cell(15,6,number_format($row[11]),1,0);
    $pdf->Cell(33,6,number_format($row[17]),1,0);
    $pdf->Cell(15,6,number_format($laba),1,1); 
}
$pdf->Cell(10,6,'',0,0);
$pdf->Cell(27,6,'',0,0);
$pdf->Cell(17,6,'',0,0);
$pdf->Cell(45,6,'',0,0);
$pdf->Cell(21,6,'',0,0);
$pdf->Cell(10,6,'TOTAL',1,0);
$pdf->Cell(15,6,number_format($qry2[0]),1,0);
$pdf->Cell(33,6,'-',1,0);
$pdf->Cell(15,6,number_format($qry2[1]),1,1); 

// $pdf->Output();
$pdf->Output('I','Data Transaksi Barang per tanggal '.$ke.'.pdf');
?>