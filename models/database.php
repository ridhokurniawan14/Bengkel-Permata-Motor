<?php
// error_reporting(0);
class database {
	// HALAMAN LOGIN
	function login($con, $u, $p)
	{
		$q = mysqli_query($con, "SELECT * FROM tb_admin where user='$u'");
		$cek = mysqli_fetch_array($q);
		
		if (empty($cek[0]))
		{
			//WINDOWS DIALOG
			echo '<script>alert("Username/Password Salah!");window.location.href=""</script>';
		}
		elseif (!empty($cek[0]) && PassHash::check_password($cek[3], $p))
		{
			$_SESSION["id_admin"] = $cek[0];
			$_SESSION["nama"] = $cek[1];	
			$_SESSION["user"] = $cek[2];			
			$_SESSION["kat"] = $cek[4];

			echo '<script>alert("Selamat Datang di Sistem Manajemen Penjualan Barang");window.location.href="?p=dsb"</script>';			
		}	
		else
		{			
			echo '<script>alert("Password Salah");window.location.href=""</script>';
		}		
	}
	// ----- HALAMAN LOGIN
	// HALAMAN PROFIL PERUSAHAAN
	function save_pp($con,$np,$alamat,$hp,$filename_logo)
	{
		//query
		$save = mysqli_query($con,"INSERT INTO tb_profile VALUES ('','$np','$alamat','$hp','$filename_logo')");		
		if($save)	
		{
			echo '<script>alert("Data Berhasil Disimpan");window.location.href="?p=pp";</script>';
		}
		else
		echo '<script>alert("Data Gagal Disimpan");window.location.href="?p=pp";</script>';
	}
	function tampil_data_pp($con)
	{
		//query		
		$a = mysqli_query($con,"SELECT * FROM tb_profile ORDER BY id_profile DESC LIMIT 1");
		$b = mysqli_fetch_array($a);
		return $b;
	}
	function tampil_satu_data_pp($con,$id)
	{
		//query		
		$a = mysqli_query($con,"SELECT * FROM tb_profile WHERE id_profile = '$id'");
		$b = mysqli_fetch_array($a);
		return $b;
	}
	function update_pp($con,$np,$alamat,$hp,$filename_logo,$id)
	{
		//query
		$save = mysqli_query($con,"UPDATE tb_profile SET nm_company='$np',alamat='$alamat',hp_usaha='$hp',logo='$filename_logo' WHERE id_profile='$id'");				
		if($save)	
		{
			echo '<script>alert("Data Berhasil Diperbaharui");window.location.href="?p=pp";</script>';
		}
		else
		echo '<script>alert("Data Gagal Diperbaharui");window.location.href="?p=pp";</script>';
	}
	// ----- HALAMAN PROFIL PERUSAHAAN
	// HALAMAN ADMIN
	function save_ad($con,$nm,$user,$pass,$kat)
	{
		$save = mysqli_query($con,"INSERT INTO tb_admin VALUES ('','$nm','$user','$pass','$kat')");		
		if($save)	
		{
			echo '<script>alert("Data Berhasil Disimpan");window.location.href="?p=ad";</script>';
		}
		else
		echo '<script>alert("Data Gagal Disimpan");window.location.href="?p=ad";</script>';
	}
	function tampil_data_ad($con)
	{
		//query		
		$list = array();
		$a = mysqli_query($con, "SELECT * FROM tb_admin ORDER BY id_admin DESC");

		while($data = mysqli_fetch_array($a))
		{
			$list[] = $data;
		}
		return $list;	
	}
	function tampil_satu_data_ad($con,$id)
	{
		//query		
		$a = mysqli_query($con,"SELECT * FROM tb_admin WHERE id_admin = '$id'");
		$b = mysqli_fetch_array($a);
		return $b;
	}
	function update_ad($con,$nm,$user,$pass,$id)
	{
		//query
		$save = mysqli_query($con,"UPDATE tb_admin SET nama='$nm',user='$user',pass='$pass' WHERE id_admin='$id'");
		if($save)	
		{
			echo '<script>alert("Data Berhasil Diperbaharui");window.location.href="?p=ad";</script>';
		}
		else
		echo '<script>alert("Data Gagal Diperbaharui");window.location.href="?p=ad";</script>';
	}
	function hapus_ad($con,$kd)
	{
		$hapus = mysqli_query($con,"DELETE FROM tb_admin WHERE id_admin = '$kd'");
		if($hapus)
		{
			echo '<script>alert("Data Berhasil Dihapus");window.location.href="?p=ad";</script>';
		}
		else
		{
			echo '<script>alert("Data Gagal Dihapus!!");window.location.href="?p=ad";</script>';
		}
	}
	// ----- HALAMAN ADMIN
	// HALAMAN SUPPLIER
	function save_sp($con,$nm,$alamat,$hp)
	{
		$save = mysqli_query($con,"INSERT INTO tb_supplier VALUES ('','$nm','$alamat','$hp')");		
		if($save)
		{
			echo '<script>alert("Data Berhasil Disimpan");window.location.href="?p=sp";</script>';
		}
		else 
		echo '<script>alert("Data Gagal Disimpan");window.location.href="?p=sp";</script>';
	}
	function tampil_data_sp($con)
	{
		//query		
		$list = array();
		$a = mysqli_query($con, "SELECT * FROM tb_supplier ORDER BY id_supplier DESC");

		while($data = mysqli_fetch_array($a))
		{
			$list[] = $data;
		}
		return $list;	
	}
	function tampil_satu_data_sp($con,$id)
	{
		//query		
		$a = mysqli_query($con,"SELECT * FROM tb_supplier WHERE id_supplier = '$id'");
		$b = mysqli_fetch_array($a);
		return $b;
	}
	function update_sp($con,$nm,$alamat,$hp,$id)
	{
		//query
		$save = mysqli_query($con,"UPDATE tb_supplier SET nm_supplier='$nm',alamat='$alamat',hp='$hp' WHERE id_supplier='$id'");
		if($save)	
		{
			echo '<script>alert("Data Berhasil Diperbaharui");window.location.href="?p=sp";</script>';
		}
		else
		echo '<script>alert("Data Gagal Diperbaharui");window.location.href="?p=sp";</script>';
	}
	function hapus_sp($con,$kd)
	{
		$hapus = mysqli_query($con,"DELETE FROM tb_supplier WHERE id_supplier = '$kd'");
		if($hapus)
		{
			echo '<script>alert("Data Berhasil Dihapus");window.location.href="?p=sp";</script>';
		}
		else
		{
			echo '<script>alert("Data Gagal Dihapus!!");window.location.href="?p=sp";</script>';
		}
	}
	// ----- HALAMAN SUPPLIER
	// HALAMAN BARANG
	function save_brg($con,$jenis,$merk,$nm,$stok,$hb,$hj,$untung)
	{
		$save = mysqli_query($con,"INSERT INTO tb_barang VALUES ('','$jenis','$merk','$nm','$stok','$hb','$hj','$untung')");		
		if($save)
		{
			echo '<script>alert("Data Berhasil Disimpan");window.location.href="?p=brg";</script>';
		}
		else 
		echo '<script>alert("Data Gagal Disimpan");window.location.href="?p=brg";</script>';
	}
	function tampil_data_brg($con)
	{
		//query		
		$list = array();
		$a = mysqli_query($con, "SELECT * FROM tb_barang ORDER BY id_barang DESC");

		while($data = mysqli_fetch_array($a))
		{
			$list[] = $data;
		}
		return $list;	
	}
	function tampil_detbrg($con,$id)
	{
		$dt="SELECT * FROM tb_barang WHERE id_barang='$id'";
		$data = mysqli_query($con,$dt);
		return $data;
	}
	function tampil_satu_data_brg($con,$id)
	{
		//query		
		$a = mysqli_query($con,"SELECT * FROM tb_barang WHERE id_barang = '$id'");
		$b = mysqli_fetch_array($a);
		return $b;
	}
	function update_brg($con,$jenis,$merk,$nm,$hb,$hj,$untung,$id)
	{
		//query
		$save = mysqli_query($con,"UPDATE tb_barang SET jns_brg='$jenis',merk='$merk',nm_brg='$nm',hrg_beli='$hb',hrg_jual='$hj',untung='$untung' WHERE id_barang='$id'");
		if($save)	
		{
			echo '<script>alert("Data Berhasil Diperbaharui");window.location.href="?p=brg";</script>';
		}
		else
		echo '<script>alert("Data Gagal Diperbaharui");window.location.href="?p=brg";</script>';
	}
	function update_stok_brg($con,$stok,$id)
	{
		//query
		$save = mysqli_query($con,"UPDATE tb_barang SET stok='$stok' WHERE id_barang='$id'");
		if($save)	
		{
			echo '<script>alert("Stok Berhasil Diperbaharui");window.location.href="?p=brg";</script>';
		}
		else
		echo '<script>alert("Stok Gagal Diperbaharui");window.location.href="?p=brg";</script>';
	}
	function hapus_brg($con,$kd)
	{
		$hapus = mysqli_query($con,"DELETE FROM tb_barang WHERE id_barang = '$kd'");
		if($hapus)
		{
			echo '<script>alert("Data Berhasil Dihapus");window.location.href="?p=brg";</script>';
		}
		else
		{
			echo '<script>alert("Data Gagal Dihapus!!");window.location.href="?p=brg";</script>';
		}
	}
	// ----- HALAMAN BARANG
	// HALAMAN BELI BARANG
	function save_bb($con,$nota,$kd_barang,$kd_sup,$tgl_beli,$qty,$tot_bay,$per_item,$filename_logo)
	{
		$a = mysqli_query($con,"SELECT * FROM tb_barang WHERE id_barang = '$kd_barang'");
		$b = mysqli_fetch_array($a);
		$tambah_stok = $b[4] + $qty;
		$save           = mysqli_query($con,"INSERT INTO tb_pembelian VALUES ('','$nota','$kd_barang','$kd_sup','$tgl_beli','$qty','$tot_bay','$per_item','$filename_logo')");		
		$update_stok    = mysqli_query($con,"UPDATE tb_barang SET stok='$tambah_stok' WHERE id_barang='$kd_barang'");

		if($save && $update_stok)
		{
			echo '<script>alert("Data Berhasil Disimpan");window.location.href="?p=bb";</script>';
		}
		else 
		echo '<script>alert("Data Gagal Disimpan");window.location.href="?p=bb";</script>';
	}
	function tampil_data_bb($con)
	{
		//query		
		$list = array();
		$a = mysqli_query($con, "SELECT *
		FROM tb_pembelian p
		JOIN tb_barang b
		ON p.id_barang = b.id_barang
		JOIN tb_supplier s
		ON p.id_supplier = s.id_supplier");

		while($data = mysqli_fetch_array($a))
		{
			$list[] = $data;
		}
		return $list;	
	}	
	function tampil_detbb($con,$id)
	{
		$dt="SELECT *
		FROM tb_pembelian p
		JOIN tb_barang b
		ON p.id_barang = b.id_barang
		JOIN tb_supplier s
		ON p.id_supplier = s.id_supplier
		WHERE p.id_pembelian ='$id'";
		$data = mysqli_query($con,$dt);
		return $data;
	}
	function tampil_satu_data_bb($con,$id)
	{
		//query		
		$a = mysqli_query($con,"SELECT * FROM tb_pembelian WHERE id_pembelian = '$id'");
		$b = mysqli_fetch_array($a);
		return $b;
	}
	function update_bb($con,$nota,$kd_barang,$kd_sup,$tgl_beli,$qty,$tot_bay,$per_item,$filename_logo,$id)
	{
		//query
		$save = mysqli_query($con,"UPDATE tb_pembelian SET no_nota='$nota',id_barang='$kd_barang',id_supplier='$kd_sup',tgl_beli='$tgl_beli',stok='$qty',
		total_bayar='$tot_bay',hrg_item='$per_item',bukti_beli='$filename_logo' WHERE id_pembelian='$id'");
		if($save)	
		{
			echo '<script>alert("Data Berhasil Diperbaharui");window.location.href="?p=bb";</script>';
		}
		else
		echo '<script>alert("Data Gagal Diperbaharui");window.location.href="?p=bb";</script>';
	}
	function hapus_bb($con,$kd)
	{
		$a = mysqli_query($con,"SELECT * FROM tb_pembelian WHERE id_pembelian = '$kd'");
		$b = mysqli_fetch_array($a);
		$id = $b[2];
		$c = mysqli_query($con,"SELECT * FROM tb_barang WHERE id_barang = '$id'");
		$d = mysqli_fetch_array($c);

		$kurangi_stok = $d[4] - $b[5];
		$hapus = mysqli_query($con,"DELETE FROM tb_pembelian WHERE id_pembelian = '$kd'");		
		$update_stok    = mysqli_query($con,"UPDATE tb_barang SET stok='$kurangi_stok' WHERE id_barang='$id'");

		if($hapus && $update_stok)
		{
			echo '<script>alert("Data Berhasil Dihapus");window.location.href="?p=bb";</script>';
		}
		else
		{
			echo '<script>alert("Data Gagal Dihapus!!");window.location.href="?p=bb";</script>';
		}
	}
	// ----- HALAMAN BELI BARANG	
	// HALAMAN GANTI PASSWORD
	function update_gp($con,$pass_baru,$id)
	{
		//query
		$save = mysqli_query($con,"UPDATE tb_admin SET pass='$pass_baru' WHERE id_admin='$id'");
		if($save)	
		{
			echo '<script>alert("Data Berhasil Diperbaharui");window.location.href="?p=gp";</script>';
		}
		else
		echo '<script>alert("Data Gagal Diperbaharui");window.location.href="?p=gp";</script>';
	}
	// ----- HALAMAN GANTI PASSWORD
	// HALAMAN TRANSAKSI
	function save_transaksi_sementara($con,$kode,$qty,$hrg,$subtotal,$sisa_stok)
	{
		// $a = mysqli_query($con,"SELECT * FROM tb_barang WHERE id_barang = '$kd_barang'");
		// $b = mysqli_fetch_array($a);
		// $tambah_stok = $b[4] + $qty;		
		$save           = mysqli_query($con,"INSERT INTO tb_transaksi_sementara VALUES ('','$kode','$qty','$hrg','$subtotal')");
		$update_stok    = mysqli_query($con,"UPDATE tb_barang SET stok='$sisa_stok' WHERE id_barang='$kode'");

		if($save && $update_stok)
		{
			echo '<script>alert("Data Berhasil Disimpan");window.location.href="?p=trns";</script>';
		}
		else 
		echo '<script>alert("Data Gagal Disimpan");window.location.href="?p=trns";</script>';
	}
	function tampil_data_transaksi_sementara($con)
	{
		//query		
		$list = array();
		$a = mysqli_query($con, "SELECT * 
		FROM tb_transaksi_sementara s, tb_barang b 
		WHERE s.id_barang = b.id_barang
		ORDER BY id_transaksi ASC");

		while($data = mysqli_fetch_array($a))
		{
			$list[] = $data;
		}
		return $list;	
	}
	function total_pembayaran($con)
	{
		$data=mysqli_fetch_array(mysqli_query($con,"SELECT SUM(subtotal) AS total FROM tb_transaksi_sementara"));
		return $data;
	}	
	function hapus_transaksi_sementara($con,$kd)
	{
		$a              = mysqli_query($con,"SELECT * FROM tb_transaksi_sementara WHERE id_transaksi = '$kd'");
		$b              = mysqli_fetch_array($a);
		$id             = $b[1];
		$c              = mysqli_query($con,"SELECT * FROM tb_barang WHERE id_barang = '$id'");
		$d              = mysqli_fetch_array($c);

		$stok_kembali   = $d[4] + $b[2];

		$hapus          = mysqli_query($con,"DELETE FROM tb_transaksi_sementara WHERE id_transaksi = '$kd'");
		$update_stok    = mysqli_query($con,"UPDATE tb_barang SET stok='$stok_kembali' WHERE id_barang='$id'");

		if($hapus && $update_stok)
		{
			echo '<script>alert("Barang Berhasil Dihapus");window.location.href="?p=trns";</script>';
		}
		else
		{
			echo '<script>alert("Barang Gagal Dihapus!!");window.location.href="?p=trns";</script>';
		}
	}
	function save_transaksi($con,$tgl,$total_bayar,$diskon,$uang_bayar,$kembali_uang,$id_admin,$nota_terakhir)
	{
		$query    = mysqli_query($con,"SELECT * FROM tb_transaksi_sementara");
		$save     = mysqli_query($con,"INSERT INTO tb_transaksi VALUES ('$nota_terakhir','$tgl','$total_bayar','$diskon','$uang_bayar','$kembali_uang','$id_admin')");
		
		// $update_stok    = mysqli_query($con,"UPDATE tb_barang SET stok='$sisa_stok' WHERE id_barang='$kode'");	

		if($save)
		{
			while($r=mysqli_fetch_row($query)){
				mysqli_query($con,"INSERT INTO tb_transaksi_detail VALUES ('$nota_terakhir','$r[1]','$r[2]','$r[3]','$r[4]')");            				
			}
			mysqli_query($con,"truncate table tb_transaksi_sementara");			
			echo '<script>window.open( "?p=print_transaksi" );</script>','<script>alert("Data Berhasil Disimpan");window.location.href="?p=trns";</script>';
			// echo '<script>window.open("?p=print_transaksi", "Print Nota", "height=700, width=500, scrollbars=yes");</script>';			
		}
		else 
		echo '<script>alert("Data Gagal Disimpan");window.location.href="?p=trns";</script>';
	}
	function cari_nota_terakhir($con)
	{
		$data=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM tb_transaksi ORDER BY no_nota DESC LIMIT 1"));
		return $data;		
	}
	function cek_data_transaksi_sementara($con)
	{
		$data=mysqli_fetch_array(mysqli_query($con,"SELECT COUNT(id_transaksi) FROM tb_transaksi_sementara"));
		return $data;		
	}	
	function tampil_data_transaksi($con,$no_nota)
	{
		//query		
		$list = array();
		$a = mysqli_query($con, "SELECT * 
		FROM tb_transaksi t 
		JOIN tb_transaksi_detail d ON t.no_nota = d.no_nota 
		JOIN tb_barang b ON d.id_barang = b.id_barang
		WHERE t.no_nota = $no_nota");

		while($data = mysqli_fetch_array($a))
		{
			$list[] = $data;
		}
		return $list;	
	}
	function tampil_data_transaksi_semua($con)
	{
		//query		
		$list = array();
		$a = mysqli_query($con, "SELECT * FROM tb_transaksi ORDER BY no_nota DESC");

		while($data = mysqli_fetch_array($a))
		{
			$list[] = $data;
		}
		return $list;	
	}
	function cari_laporan($con,$dari,$ke)
	{
		//query		
		$list = array();
		$a = mysqli_query($con, "SELECT * 
		FROM tb_transaksi 
		WHERE tgl_transaksi 
		BETWEEN '$dari' and '$ke'
		ORDER BY no_nota DESC");

		while($data = mysqli_fetch_array($a))
		{
			$list[] = $data;
		}
		return $list;	
	}
	function cari_laporan_count($con,$dari,$ke)
	{
		$data=mysqli_num_rows(mysqli_query($con,"SELECT * 
		FROM tb_transaksi 
		WHERE tgl_transaksi 
		BETWEEN '$dari' and '$ke'
		ORDER BY no_nota DESC"));
		return $data;	
	}
	function download_laporan($con,$dari,$ke)
	{
		//query		
		$list = array();
		$a = mysqli_query($con, "SELECT *
		FROM tb_transaksi t, tb_transaksi_detail td, tb_barang b
		WHERE t.tgl_transaksi BETWEEN '$dari' and '$ke'
		AND t.no_nota = td.no_nota
		AND td.id_barang = b.id_barang
		ORDER BY t.no_nota DESC");

		while($data = mysqli_fetch_array($a))
		{
			$list[] = $data;
		}
		return $list;	
	}
	function tampil_data_transaksi_satu($con,$no_nota)
	{
		//query		
		$data=mysqli_fetch_array(mysqli_query($con,"SELECT distinct tgl_transaksi
		FROM tb_transaksi t 
		JOIN tb_transaksi_detail d ON t.no_nota = d.no_nota 
		JOIN tb_barang b ON d.id_barang = b.id_barang
		WHERE t.no_nota = $no_nota"));
		return $data;
	}
	function tampil_data_transaksi_id_admin($con,$no_nota)
	{
		//query		
			$data=mysqli_fetch_array(mysqli_query($con,"SELECT distinct id_admin
			FROM tb_transaksi t 
			JOIN tb_transaksi_detail d ON t.no_nota = d.no_nota 
			JOIN tb_barang b ON d.id_barang = b.id_barang
			WHERE t.no_nota = $no_nota"));
		return $data;
	}
	// ----- HALAMAN TRANSAKSI
	// HALAMAN LAPORAN HARIAN
	function hapus_transaksi($con,$kd)
	{
		$query          = mysqli_query($con,"SELECT * FROM tb_transaksi_detail WHERE no_nota = '$kd'");			

		if($query)
		{
			while($r=mysqli_fetch_row($query)){
				$c              = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM tb_barang WHERE id_barang = '$kd'"));								
				$stok_kembali   = $r[2] + $c[4];				
				mysqli_query($con,"UPDATE tb_barang SET stok='$stok_kembali' WHERE id_barang='$r[1]'");            				
			}				
			mysqli_query($con,"DELETE FROM tb_transaksi_detail WHERE no_nota = '$kd'");
			mysqli_query($con,"DELETE FROM tb_transaksi WHERE no_nota = '$kd'");		
			echo '<script>alert("Data Berhasil Dihapus");window.location.href="?p=lh";</script>';			
		}
		else 
		echo '<script>alert("Data Gagal Disimpan");window.location.href="?p=lh";</script>';
	}
	// ----- HALAMAN LAPORAN HARIAN
	// DIGUNAKAN UMUM
	function tgl_indo($tanggal)
	{
		$bulan = array (1 =>   'Januari',
					'Februari',
					'Maret',
					'April',
					'Mei',
					'Juni',
					'Juli',
					'Agustus',
					'September',
					'Oktober',
					'November',
					'Desember'
				);
		$split = explode('-', $tanggal);
		return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
	}
	function getBulan($bul)
	{
        switch ($bul)
		{
            case 1: 
                return "Januari";
                break;
            case 2:
                return "Februari";
                break;
            case 3:
                return "Maret";
                break;
            case 4:
                return "April";
                break;
            case 5:
                return "Mei";
                break;
            case 6:
                return "Juni";
                break;
            case 7:
                return "Juli";
                break;
            case 8:
                return "Agustus";
                break;
            case 9:
                return "September";
                break;
            case 10:
                return "Oktober";
                break;
            case 11:
                return "November";
                break;
            case 12:
                return "Desember";
                break;
        }
	}
	function tampil_jumlah($con)
	{

		$a = mysqli_num_rows(mysqli_query($con, "SELECT * from tb_transaksi order by no_nota DESC"));

		// BANYAK STOK
		$accu = mysqli_fetch_array(mysqli_query($con, "SELECT SUM(stok) AS stok FROM tb_barang WHERE jns_brg = 'accu'"));	
		$ban = mysqli_fetch_array(mysqli_query($con, "SELECT SUM(stok) AS stok FROM tb_barang WHERE jns_brg = 'ban'"));	
		$oli = mysqli_fetch_array(mysqli_query($con, "SELECT SUM(stok) AS stok FROM tb_barang WHERE jns_brg = 'oli'"));	

		// BANYAK PENJUALAN
		$bpaccu = mysqli_num_rows(mysqli_query($con, "SELECT *
		FROM tb_transaksi t, tb_transaksi_detail td, tb_barang b
		WHERE b.jns_brg = 'accu'
		AND t.no_nota = td.no_nota
		AND td.id_barang = b.id_barang"));	
		$bpban = mysqli_num_rows(mysqli_query($con, "SELECT *
		FROM tb_transaksi t, tb_transaksi_detail td, tb_barang b
		WHERE b.jns_brg = 'ban'
		AND t.no_nota = td.no_nota
		AND td.id_barang = b.id_barang"));	
		$bpoli = mysqli_num_rows(mysqli_query($con, "SELECT *
		FROM tb_transaksi t, tb_transaksi_detail td, tb_barang b
		WHERE b.jns_brg = 'oli'
		AND t.no_nota = td.no_nota
		AND td.id_barang = b.id_barang"));	

		return array($a,$accu[0],$ban[0],$oli[0],$bpaccu,$bpban,$bpoli);
	}
}
class PassHash {
    // blowfish
    private static $algo = '$2a';
    // cost parameter
    private static $cost = '$10';
 
    // mainly for internal use
    public static function unique_salt() {
        return substr(sha1(mt_rand()),0,22);
    }

     // this will be used to generate a hash
    public static function hash($password) {
        return crypt($password,
                    self::$algo .
                    self::$cost .
                    '$' . self::unique_salt());
    }

    // this will be used to compare a password against a hash
    public static function check_password($hash, $password) {
        $full_salt = substr($hash, 0, 29);
        $new_hash = crypt($password, $full_salt);
        return ($hash == $new_hash);
    }
}
?>