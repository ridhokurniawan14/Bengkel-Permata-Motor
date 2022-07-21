<?php
$hostDB = "localhost";
$usernameDB = "root";
$passwordDB = "";
$namaDB = "u1036689_abo";
date_default_timezone_set('Asia/Jakarta');

//KONEKSI KE DATABASE
$con = mysqli_connect($hostDB,$usernameDB,$passwordDB,$namaDB);

$data=mysqli_query($con,"SELECT * from tb_barang");
$op=isset($_GET['op'])?$_GET['op']:null;

if($op=='kode'){
    echo"<option>Nama Barang</option>";
    while($r=mysqli_fetch_array($data)){
        echo "<option value='$r[id_barang]'>$r[nm_brg] ($r[merk])</option>";
    }
}elseif($op=='ambildata'){
    $kode=$_GET['kode'];
    $dt=mysqli_query($con,"select * from tb_barang where id_barang='$kode'");
    $d=mysqli_fetch_array($dt);
    echo $d['nm_brg']."|".$d['hrg_beli']."|".$d['hrg_jual']."|".$d['stok'];
}elseif($op=='cek'){
    $kd=$_GET['kd'];
    $sql=mysqli_query($con,"select * from tb_barang where id_barang='$kd'");
    $cek=mysqli_num_rows($sql);
    echo $cek;
}elseif($op=='tambah'){
    $kode=$_GET['kode'];
    // $nama=$_GET['nama'];
    $jual=$_GET['jual'];
    $jumlah=$_GET['jumlah'];
    $subtotal=$jual*$jumlah;
    
    $tambah=mysqli_query($con,"INSERT INTO  tb_transaksi_sementara VALUES ('','$kode','$jumlah','$jual','$subtotal')");
    
    if($tambah){
        echo "sukses";
    }else{
        echo "ERROR";
    }
}elseif($op=='update'){
    $kode=$_GET['kode'];
    $nama=htmlspecialchars($_GET['nama']);
    $beli=htmlspecialchars($_GET['beli']);
    $jual=htmlspecialchars($_GET['jual']);
    $stok=htmlspecialchars($_GET['stok']);
    
    $update=mysqli_query($con,"update tb_barang set nama='$nama',
                        hrg_beli='$beli',
                        hrg_jual='$jual',
                        stok='$stok'
                        where kode='$kode'");
    if($update){
        echo "Sukses";
    }else{
        echo "ERROR. . .";
    }
}elseif($op=='delete'){
    $kode=$_GET['kode'];
    $del=mysqli_query($con,"delete from tb_barang where kode='$kode'");
    if($del){
        echo "sukses";
    }else{
        echo "ERROR";
    }
}elseif($op=='simpan'){
    $kode=$_GET['kode'];
    $nama=htmlspecialchars($_GET['nama']);
    $jual=htmlspecialchars($_GET['jual']);
    $beli=htmlspecialchars($_GET['beli']);
    $stok=htmlspecialchars($_GET['stok']);
    
    $tambah=mysqli_query($con,"insert into tb_barang (kode,nama,hrg_beli,hrg_jual,stok)
                        values ('$kode','$nama','$beli','$jual','$stok')");
    if($tambah){
        echo "sukses";
    }else{
        echo "error";
    }
}
?>