<html>
<head>
	<title>Permata Motor Banyuwangi</title>
</head>
<body>
	<style type="text/css">
	body{
		font-family: sans-serif;
	}
	table{
		margin: 20px auto;
		border-collapse: collapse;
	}
	table th,
	table td{
		border: 1px solid #3c3c3c;
		padding: 3px 8px;
 
	}
	a{
		background: blue;
		color: #fff;
		padding: 8px 10px;
		text-decoration: none;
		border-radius: 2px;
	}
	</style>
 
	<?php
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Data Transaksi ($tgldari-$blndari-$thndari s.d. $tglke-$blnke-$thnke).xls");
	?>
    <center><h2>DATA TRANSAKSI <br>(<?= $tgldari.'-'.$blndari.'-'.$thndari ?> s.d. <?= $tglke.'-'.$blnke.'-'.$thnke ?>)</h2></center>
	<table border="1">
		<tr>
            <th>No.</th>
            <th>Tgl. Transaksi</th>
            <th>No. Nota</th>
            <th>Nama Barang</th>
			<th>Harga Jual</th>
            <th>Qty</th>
            <th>Total</th>
            <th>Harga beli @item</th>  
            <th>Laba</th>
                      
		</tr>
		<?php 
		$no = 1;
        foreach($qry as $d)        
            {
                $laba = $d[19] * $d[9];
		?>
		<tr>
			<td><?= $no++; ?></td>
            <td><?= $d[1]; ?></td>
            <td><?= $d[0]; ?></td>
            <td><?= ucwords($d[15]); ?></td>
            <td><?= $d[10]; ?></td>
            <td><?= $d[9]; ?></td>
            <td><?= $d[11]; ?></td>
            <td><?= $d[17]; ?></td>
            <td><?= $laba; ?></td>
		</tr>
		<?php 
		}
		?>
		<tr>
			<td align="right" colspan="6"><b>TOTAL</b></td>            
			<td><?= $qry2[0] ?></td>			
			<td>-</td>			
			<td><?= $qry2[1] ?></td>			
		</tr>
	</table>
</body>
</html>