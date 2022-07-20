<?php
// session_start();
if(empty($_SESSION["user"]))
{
	header("location:index");
}
//Membuat batasan waktu sesion untuk user di PHP 
$timeout = 1; // Set timeout menit
$logout_redirect_url = "index"; // Set logout URL
$timeout = $timeout * 1800; // Ubah menit ke detik
if (isset($_SESSION['start_time'])) {
    $elapsed_time = time() - $_SESSION['start_time'];
    if ($elapsed_time >= $timeout) {
        session_destroy();
        echo "<script>alert('Sistem Otomatis Logout!'); window.location = '$logout_redirect_url'</script>";
    }
}
 //Define relative path from this script to mPDF
$nama_file='Cetak Nota'; //Beri nama file PDF hasil.

require_once __DIR__ . './../assets/vendor/autoload.php';

// $mpdf = new \Mpdf\Mpdf();
$mpdf = new \Mpdf\Mpdf([        
    'mode' => 'utf-8', 
    'format' => [48, 80]
]);

//Beginning Buffer to save PHP variables and HTML tags
ob_start(); 

// $mpdf->useGraphs = true;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Print Nota - <?= $nama_toko ?></title>
     <style>
        @page {
            margin: 1%;
            padding-top: -5;
            size: 2,283in 3,15in;
            text-align: center;
            box-decoration-break: slice;
        }
        body
        {
            margin:0;
            padding:0;
            font-family: arial;
            font-size:6pt;
            color:#000;
        }
        body
        {
            width:100%;
            font-family: arial;
            font-size:6pt;
            margin:0;
            padding:0;
        }
         
        p
        {
            margin:0;
            padding:0;
            margin-left: 0px;
        }
         
        #wrapper
        {
            width:44mm;
            margin:0 0mm;
        }
        
        #main {
            float:left;
            width:0mm;
            background:#ffffff;
            padding:0mm;
        }
 
        #sidebar {
            float:right;
            width:0mm;
            background:#ffffff;
            padding:0mm;
        } 
         
        .page
        {
            height:200mm;
            width:44mm;
            page-break-after:always;
        }
 
        table
        {
            /** border-left: 1px solid #fff;
            border-top: 1px solid #fff; **/
            font-family: arial; 
            border-spacing:0;
            border-collapse: collapse; 
             
        }
         
        table td 
        {
            /**border-right: 1px solid #fff;
            border-bottom: 1px solid #fff;**/
            padding: 2mm;
            
        }
         
        table.heading
        {
            height:0mm;
            margin-bottom: -10px;            
        }
         
        h1.heading
        {
            font-size:6pt;
            color:#000;
            font-weight:normal;
            font-style: italic;                                 
        }
         
        h2.heading
        {
            font-size:6pt;
            color:#000;
            font-weight:normal;            
        }
         
        hr
        {
            color:#ccc;
            background:#ccc;
        }
         
        #invoice_body_tambah
        {
            height: auto;            
        }
         
        #invoice_body_tambah
        {   
            width:100%;
        }
        #invoice_body_tambah table 
        {
            width:100%;
            /** border-left: 1px solid #ccc;
            border-top: 1px solid #ccc; **/
     
            border-spacing:0;
            border-collapse: collapse; 
             
            margin-top:0mm;
        }
         
        #invoice_body_tambah table td 
        {
            text-align:center;
            font-size:5pt;
            /** border-right: 1px solid black;
            border-bottom: 1px solid black;**/
            padding:0 0;
            font-weight: normal;
        }

        #invoice_body
        {
            height: auto;
        }
         
        #invoice_body , #invoice_total
        {   
            width:100%;
        }
        #invoice_body table , #invoice_total table
        {
            width:100%;
            /** border-left: 1px solid #ccc;
            border-top: 1px solid #ccc; **/
     
            border-spacing:0;
            border-collapse: collapse; 
             
            margin-top:0mm;
        }
         
        #invoice_body table td , #invoice_total table td
        {
            text-align:center;
            font-size:8pt;
            /** border-right: 1px solid black;
            border-bottom: 1px solid black;**/
            padding:0 0;
            font-weight: normal;
        }
        
        #invoice_head table td
        {
            text-align:left;
            font-size:8pt;
            /** border-right: 1px solid black;
            border-bottom: 1px solid black;**/
            padding:0 0;
            font-weight: normal;
        }
         
        #invoice_body table td.mono  , #invoice_total table td.mono
        {
            text-align:right;
            padding-right:0mm;
            font-size:6pt;
            border: 1px solid white;
            font-weight: normal;
        }
         
        #footer
        {   
            width:44mm;
            margin:0 2mm;
            padding-bottom:1mm;
        }
        #footer table
        {
            width:100%;
            /** border-left: 1px solid #ccc;
            border-top: 1px solid #ccc; **/
             
            background:#eee;
             
            border-spacing:0;
            border-collapse: collapse; 
        }
        #footer table td
        {
            width:25%;
            text-align:center;
            font-size:8pt;
            /** border-right: 1px solid #ccc;
            border-bottom: 1px solid #ccc;**/
        }
    </style>
</head>
<body>
<div id="wrapper">     
      <div id="invoice_head">
    <table style="width:100%; border-spacing:0;">
        <tr>
            <td style="text-align:center; font-size: 6pt; font-weight: bold;"><!-- <img src="<?php // echo $_SESSION['gambar']; ?>" height="40" width="160" />--> <b><?= $nama_toko ?></b></td>            
        </tr>
        <tr>
            <td style="text-align:center; font-size: 6pt; font-weight: bold;> <p ">Alamat : <?= $alamat_toko ?> </p></td>            
        </tr>
        <tr>
            <td style="text-align:center; font-size: 6pt; font-weight: bold; font-family: sans-serif;"><p>No. HP/WA : <?= $no_toko ?></p></td>        
        </tr>
        <tr style="margin-top: 1px;">
            <td><p style="text-align:center; font-size: 6pt; margin-top: 1px; font-weight: bold;"></p></td>        
        </tr>
        <tr>
            <td style="border-bottom: 2px solid black;"></td>
        </tr>        
    </table>
    </div>
   
    <table border="0" class="heading" style="width:100%;">
        <tr>
            <td> <center><p style="text-align:center; font-size: 7pt; text-decoration: underline; font-weight:bold;">NOTA PENJUALAN</p></center></td>
        </tr>        
    </table>  
    <center>
    <table border="0">
        <tr>
            <td style="text-align:left; font-size: 6pt;">No. Nota<br>Tanggal</td>
            <td style="text-align:left; font-size: 6pt;">: <?= $no_nota ?><br>: <?= $tgl_nota ?></td>
        </tr>
    </table>
    </center>
         
    <div id="content">
         
        <div id="invoice_body_tambah">       
        <table border="1">            
            <tr>
                <!--<td style="width:10%; font-size: 6pt;"><b>No</b></td>-->
                <!--<td style="width:15%;"><b>Kode</b></td>-->
                <td style="width:5%; font-size: 5pt;"><b>#</b></td>
                <td style="width:45%; font-size: 5pt;"><b>Nama Produk</b></td>
                <td style="width:25%; font-size: 5pt;"><b>Harga</b></td>
                <td style="width:5%; font-size: 5pt;"><b>Qty</b></td>
                <td style="width:20%; font-size: 5pt;"><b>Jumlah</b></td>
            </tr>
            <?php 
                    $no=1;
                    foreach($db as $isi)                      
                    {   
                    ?>
            <tr>
                <td style="width:10%; text-align: center;" class="mono"><h4><?php echo $no++; ?></h4></td>                
                <td style="width:40%; text-align: left;" class="mono"><h4><?= ucwords($isi[15]) ?></h4></td>
                <td style="width:25%;" class="mono"><h4>Rp.<?= number_format($isi[10]) ?></h4></td>
                <td style="width:10%; text-align: center;" class="mono"><h4><?= $isi[9] ?></h4></td>
                <td style="width:25%;" class="mono"><h4>Rp.<?= number_format($isi[11]) ?></h4></td>
            </tr>         
             <?php   
              } 
              ?>
        </table>
        </div>
        
        <div id="invoice_total">
            <table border="1">
                <tr>
                  <td colspan="3" style="width:70%; font-size: 6pt;" class="mono"><b><i>Diskon</i></b></td>  
                  <td colspan="2" style="width:70%; font-size: 6pt;" class="mono"><b><?php if($isi[3] == 0) { echo '-'; } else echo 'Rp. '.number_format($isi[3]) ?></b></td>
                </tr>
                <tr>
                  <td colspan="3" style="width:70%; font-size: 6pt;" class="mono"><b><i>Total</i></b></td>  
                  <td colspan="2" style="width:70%; font-size: 6pt;" class="mono"><b>Rp.<?= number_format($isi[2]) ?></b></td>
                </tr>
                <tr>
                  <td colspan="3" style="width:70%; font-size: 6pt;" class="mono"><b><i>Bayar</i></b></td>  
                  <td colspan="2" style="width:70%; font-size: 6pt;" class="mono"><b>Rp.<?= number_format($isi[4]) ?></b></td>
                </tr>
                <tr>
                  <td colspan="3" style="width:70%; font-size: 6pt;" class="mono"><b><i>Kembali</i></b></td>  
                  <td colspan="2" style="width:70%; font-size: 6pt;" class="mono"><b>Rp.<?= number_format($isi[5]) ?></b></td>
                </tr>
            </table>
        </div>
         
          <div id="invoice_total">
            <table border="1">
                <tr>
                    <td style="text-align: left; border: 1px solid white;"><b></b></td>
                    <td style="width:20%; border: 1px solid white;" class="mono"><b><center></b></center></td>  
                    <td style="width:15%; border: 1px solid white;" class="mono"><b></b></td>
                </tr>
                <tr>
                    <td style="text-align: left; font-size: 6pt; border: 1px solid white;"><b>PERHATIAN : <br>1. Nota ini adalah bukti pembelian barang</b></td>
                    <td colspan="2" style="width:10%; font-size: 6pt; border: 1px solid white;" class="mono"><center>Kasir : <?= ucwords($nm_admin) ?></center></td>                    
                </tr>                
                <tr>
                    <td style="text-align: left; font-size: 6pt; border: 1px solid white;"><b>2. Barang yang sudah dibeli tidak dapat ditukar atau dikembalikan.</b></td>
                    <td style="width:10%; font-size: 6pt; border-left: 1px solid white; border-right: 1px solid white; border-bottom: 1px solid white; border-top: 1px solid white;" class="mono"><b><center></b></center></td>  
                    <td style="width:15%; border: 1px solid white;" class="mono"><b></b></td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: left; border: 1px solid white;"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                </tr>
            </table>
        <center>
        <table>
            <tr>
                <td style="font-size: 6pt; font-weight: bold;"><b>Terima kasih sudah berbelanja di <br>"<?= $nama_toko ?>" </b></td>
                <td style="font-size: 6pt; font-weight: bold;"></td>
                <td colspan="2" style="font-size: 10px; font-weight: bold;"></td>
            </tr>                        
        </table>
        <table>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2">----------------------------------------------------</td>                                
            </tr>
        </table>
        --------------------------------------------------------------
        <p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p>
        --------------------------------------------------------------
        <p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p>
        </center>
        </div>        
    </div>    
    </div>        
     <?php

$html = ob_get_contents(); //Proses untuk mengambil data
ob_end_clean();
//Here convert the encode for UTF-8, if you prefer the ISO-8859-1 just change for $mpdf->WriteHTML($html);
$mpdf->WriteHTML(utf8_encode($html));
// LOAD a stylesheet
$stylesheet = file_get_contents('mpdfstyletables.css');
$mpdf->WriteHTML($stylesheet,1);    // The parameter 1 tells that this is css/style only and no body/html/text

$mpdf->WriteHTML($html,1);

$mpdf->Output($nama_file."-".date("Y/m/d H:i:s").".pdf", "I");
 


// exit; 
?>
</body>
</html>
<script>
    window.print();
</script>